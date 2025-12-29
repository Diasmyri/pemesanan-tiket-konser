<?php

namespace App\Controllers\Admin\Masters;

use App\Controllers\BaseController;
use App\Models\TicketTypeModel;
use App\Models\EventModel;

class TicketTypes extends BaseController
{
    protected $ticketTypeModel;
    protected $eventModel;

    public function __construct()
    {
        $this->ticketTypeModel = new TicketTypeModel();
        $this->eventModel      = new EventModel();
    }

    // Cari bagian public function index() dan ubah menjadi seperti ini:

public function index()
{
    $keyword = $this->request->getGet('keyword');

    $perPage = 10;
    $page    = $this->request->getGet('page') ?? 1;

    // Join ke tabel events untuk mengambil nama event
    $this->ticketTypeModel->select('ticket_types.*, events.title as event_title')
                          ->join('events', 'events.id = ticket_types.event_id', 'left');

    if ($keyword) {
        $this->ticketTypeModel
            ->groupStart()
                ->like('ticket_types.name', $keyword)
                ->orLike('events.title', $keyword) // Tambah pencarian berdasarkan nama event
                ->orLike('ticket_types.price', $keyword)
            ->groupEnd();
    }

    $data = [
        'title'       => 'Ticket Types',
        'tickettypes' => $this->ticketTypeModel->paginate($perPage),
        'pager'       => $this->ticketTypeModel->pager,
        'keyword'     => $keyword,
        'page'        => $page,
        'perPage'     => $perPage,
    ];

    return view('admin/masters/tickettypes_index', $data);
}

    public function create()
    {
        $data = [
            'title'      => 'Tambah Ticket Type',
            'formAction' => '/admin/masters/tickettypes/store',
            'events'     => $this->eventModel->findAll(),
            'ticket'     => []
        ];

        return view('admin/masters/tickettypes_form', $data);
    }

    public function store()
    {
        $this->ticketTypeModel->save([
            'event_id' => $this->request->getPost('event_id'),
            'name'     => $this->request->getPost('name'),
            'price'    => $this->request->getPost('price'),
            'stock'    => $this->request->getPost('stock'),
        ]);

        return redirect()
            ->to('/admin/masters/tickettypes')
            ->with('success', 'Ticket Type berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $ticket = $this->ticketTypeModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to('/admin/masters/tickettypes')
                ->with('error', 'Data tiket tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Ticket Type',
            'ticket'     => $ticket,
            'events'     => $this->eventModel->findAll(),
            'formAction' => '/admin/masters/tickettypes/update/' . $id
        ];

        return view('admin/masters/tickettypes_form', $data);
    }

    public function update($id)
    {
        $this->ticketTypeModel->update($id, [
            'event_id' => $this->request->getPost('event_id'),
            'name'     => $this->request->getPost('name'),
            'price'    => $this->request->getPost('price'),
            'stock'    => $this->request->getPost('stock'),
        ]);

        return redirect()
            ->to('/admin/masters/tickettypes')
            ->with('success', 'Ticket Type berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->ticketTypeModel->delete($id);

        return redirect()
            ->to('/admin/masters/tickettypes')
            ->with('success', 'Ticket Type berhasil dihapus!');
    }
}
