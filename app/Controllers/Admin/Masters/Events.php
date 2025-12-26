<?php

namespace App\Controllers\Admin\Masters;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\ArtistModel;
use App\Models\VenueModel;
use App\Models\EventArtistModel;
use Config\Database;

class Events extends BaseController
{
    protected $event;
    protected $artist;
    protected $venue;
    protected $eventArtist;
    protected $db;

    public function __construct()
    {
        $this->event       = new EventModel();
        $this->artist      = new ArtistModel();
        $this->venue       = new VenueModel();
        $this->eventArtist = new EventArtistModel();
        $this->db          = Database::connect();
    }

    /* ================= HELPERS ================= */
    private function isEditable($eventDate, $eventTime)
    {
        $eventTimestamp = strtotime($eventDate . ' ' . $eventTime);
        $now = time();
        $twoDaysBefore = strtotime('-2 days', $eventTimestamp);

        return $now < $twoDaysBefore;
    }

    private function isDateValid($date)
    {
        $yesterday = strtotime('-1 day', strtotime('today'));
        return strtotime($date) > $yesterday;
    }

    private function isVenueAvailable($venueId, $date, $startTime, $endTime, $excludeEventId = null)
    {
        $builder = $this->db->table('events')
            ->where('venue_id', $venueId)
            ->where('date', $date);

        if ($excludeEventId) {
            $builder->where('id !=', $excludeEventId);
        }

        $events = $builder->get()->getResultArray();

        foreach ($events as $event) {
            $existingStart = strtotime($event['date'] . ' ' . $event['start_time']);
            $existingEnd   = strtotime($event['date'] . ' ' . $event['end_time']);
            $newStart      = strtotime($date . ' ' . $startTime);
            $newEnd        = strtotime($date . ' ' . $endTime);

            // Check if time overlaps
            if ($newStart < $existingEnd && $newEnd > $existingStart) {
                return false;
            }
        }

        return true;
    }

    /* ================= INDEX ================= */
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $query = $this->event->select('events.*, venues.name AS venue_name')
                             ->join('venues', 'venues.id = events.venue_id', 'left');

        if ($keyword) {
            $query->like('events.title', $keyword);
        }

        $events = $query->paginate(10);

        foreach ($events as &$event) {
            $artists = $this->db->table('events_artists ea')
                ->select('artis.id, artis.name, artis.photo')
                ->join('artis', 'artis.id = ea.artist_id')
                ->where('ea.event_id', $event['id'])
                ->get()
                ->getResultArray();

            $event['artists']   = $artists;
            $event['editable']  = $this->isEditable($event['date'], $event['start_time']);
        }

        $data = [
            'events'  => $events,
            'pager'   => $this->event->pager,
            'keyword' => $keyword,
            'title'   => 'Master Events'
        ];

        return view('admin/masters/events_index', $data);
    }

    /* ================= CREATE ================= */
    public function create()
    {
        return view('admin/masters/events_form', [
            'title'           => 'Tambah Event',
            'event'           => null,
            'artists'         => $this->artist->findAll(),
            'venues'          => $this->venue->findAll(),
            'selectedArtists' => [],
            'formAction'      => '/admin/masters/events/store'
        ]);
    }

    /* ================= STORE ================= */
    public function store()
    {
        $date      = $this->request->getPost('date');
        $startTime = $this->request->getPost('start_time');
        $endTime   = $this->request->getPost('end_time');
        $venueId   = $this->request->getPost('venue_id');

        // Validasi tanggal tidak boleh hari ini/kemarin
        if (!$this->isDateValid($date)) {
            return redirect()->back()->withInput()->with('error', 'Tanggal event tidak boleh hari ini atau kemarin.');
        }

        // Validasi masa lalu
        if (strtotime($date . ' ' . $startTime) < time()) {
            return redirect()->back()->withInput()->with('error', 'Tanggal dan jam event tidak boleh di masa lalu.');
        }

        // Validasi venue
        if (!$this->isVenueAvailable($venueId, $date, $startTime, $endTime)) {
            return redirect()->back()->withInput()->with('error', 'Venue sudah terpakai pada tanggal dan jam tersebut.');
        }

        $posterFile = $this->request->getFile('poster');
        $posterName = null;

        if ($posterFile && $posterFile->isValid() && !$posterFile->hasMoved()) {
            $posterName = $posterFile->getRandomName();
            $posterFile->move('uploads/events', $posterName);
        }

        $eventId = $this->event->insert([
            'title'      => $this->request->getPost('title'),
            'venue_id'   => $venueId,
            'date'       => $date,
            'start_time' => $startTime,
            'end_time'   => $endTime,
            'poster'     => $posterName
        ]);

        $artistIds = $this->request->getPost('artist_ids') ?? [];
        foreach ($artistIds as $artistId) {
            $this->eventArtist->insert([
                'event_id'  => $eventId,
                'artist_id' => $artistId
            ]);
        }

        return redirect()->to('/admin/masters/events')
                         ->with('success', 'Event berhasil ditambahkan.');
    }

    /* ================= EDIT ================= */
    public function edit($id)
    {
        $event = $this->event->find($id);

        if (!$this->isEditable($event['date'], $event['start_time'])) {
            return redirect()->to('/admin/masters/events')
                             ->with('error', 'Event sudah mulai atau kurang dari 2 hari sebelum event, tidak bisa diedit.');
        }

        $selectedArtists = $this->eventArtist
            ->where('event_id', $id)
            ->findColumn('artist_id');

        $data = [
            'title'           => 'Edit Event',
            'event'           => $event,
            'artists'         => $this->artist->findAll(),
            'venues'          => $this->venue->findAll(),
            'selectedArtists' => $selectedArtists ?? [],
            'formAction'      => '/admin/masters/events/update/' . $id
        ];

        return view('admin/masters/events_form', $data);
    }

    /* ================= UPDATE ================= */
    public function update($id)
    {
        $event = $this->event->find($id);

        if (!$this->isEditable($event['date'], $event['start_time'])) {
            return redirect()->to('/admin/masters/events')
                             ->with('error', 'Event sudah mulai atau kurang dari 2 hari sebelum event, tidak bisa diperbarui.');
        }

        $date      = $this->request->getPost('date');
        $startTime = $this->request->getPost('start_time');
        $endTime   = $this->request->getPost('end_time');
        $venueId   = $this->request->getPost('venue_id');

        // Validasi tanggal tidak boleh hari ini/kemarin
        if (!$this->isDateValid($date)) {
            return redirect()->back()->withInput()->with('error', 'Tanggal event tidak boleh hari ini atau kemarin.');
        }

        // Validasi masa lalu
        if (strtotime($date . ' ' . $startTime) < time()) {
            return redirect()->back()->withInput()->with('error', 'Tanggal dan jam event tidak boleh di masa lalu.');
        }

        // Validasi venue
        if (!$this->isVenueAvailable($venueId, $date, $startTime, $endTime, $id)) {
            return redirect()->back()->withInput()->with('error', 'Venue sudah terpakai pada tanggal dan jam tersebut.');
        }

        $posterFile = $this->request->getFile('poster');
        $posterName = $event['poster'];

        if ($posterFile && $posterFile->isValid() && !$posterFile->hasMoved()) {
            if ($posterName && file_exists('uploads/events/' . $posterName)) {
                unlink('uploads/events/' . $posterName);
            }
            $posterName = $posterFile->getRandomName();
            $posterFile->move('uploads/events', $posterName);
        }

        $this->event->update($id, [
            'title'      => $this->request->getPost('title'),
            'venue_id'   => $venueId,
            'date'       => $date,
            'start_time' => $startTime,
            'end_time'   => $endTime,
            'poster'     => $posterName
        ]);

        // Sync artists
        $artistIds = $this->request->getPost('artist_ids') ?? [];
        $this->eventArtist->where('event_id', $id)->delete();
        foreach ($artistIds as $artistId) {
            $this->eventArtist->insert([
                'event_id'  => $id,
                'artist_id' => $artistId
            ]);
        }

        return redirect()->to('/admin/masters/events')
                         ->with('success', 'Event berhasil diperbarui.');
    }

    /* ================= DELETE ================= */
    public function delete($id)
    {
        $event = $this->event->find($id);

        if (!$event) {
            return redirect()->to('/admin/masters/events')
                             ->with('error', 'Event tidak ditemukan.');
        }

        // Hapus poster jika ada
        if ($event['poster'] && file_exists('uploads/events/' . $event['poster'])) {
            unlink('uploads/events/' . $event['poster']);
        }

        // Hapus event & relasi artist otomatis (ON DELETE CASCADE)
        $this->event->delete($id);

        return redirect()->to('/admin/masters/events')
                         ->with('success', 'Event berhasil dihapus.');
    }
}
