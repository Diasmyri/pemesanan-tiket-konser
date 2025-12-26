<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table      = 'events';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'venue_id',
        'date',
        'start_time',
        'end_time',
        'poster'
    ];

    protected $useTimestamps = true;

    // Ambil semua event + venue (Termasuk Location)
    public function getAllEventsWithVenue()
    {
        return $this->select('events.*, venues.name as venue_name, venues.location as venue_location')
                    ->join('venues', 'venues.id = events.venue_id', 'left')
                    ->findAll();
    }

    // Ambil semua artis per event
    public function getArtistsByEvent($event_id)
    {
        return $this->db->table('artis')
            ->select('artis.id, artis.name, artis.photo')
            ->join('events_artists', 'events_artists.artist_id = artis.id')
            ->where('events_artists.event_id', $event_id)
            ->get()
            ->getResultArray(); // Diubah ke Array agar konsisten dengan findAll()
    }

    // Ambil event lengkap dengan venue + location + artis
    public function getFullEvent($event_id)
    {
        $event = $this->db->table('events')
            ->select('events.*, venues.name as venue_name, venues.location as venue_location')
            ->join('venues', 'venues.id = events.venue_id', 'left')
            ->where('events.id', $event_id)
            ->get()
            ->getRow();

        if ($event) {
            $event->artists = $this->getArtistsByEvent($event_id);
        }

        return $event;
    }
}