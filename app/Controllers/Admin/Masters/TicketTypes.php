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

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        // pagination config
        $perPage = 10;
        $page    = $this->request->getGet('page') ?? 1;

        if ($keyword) {
            $this->ticketTypeModel
                ->groupStart()
                    ->like('name', $keyword)
                    ->orLike('price', $keyword)
                    ->orLike('stock', $keyword)
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
