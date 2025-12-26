<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\TicketTypeModel;
use App\Models\EventModel;

class Orders extends BaseController
{
    protected $orderModel;
    protected $ticketTypeModel;
    protected $eventModel;

    public function __construct()
    {
        $this->orderModel      = new OrderModel();
        $this->ticketTypeModel = new TicketTypeModel();
        $this->eventModel      = new EventModel();
    }

    // SHOW EVENTS + ORDER FORM
    public function create($eventId = null)
    {
        $events = $this->eventModel->findAll();

        $ticketTypes = [];
        $eventStatus = [];
        if ($eventId) {
            $ticketTypes = $this->ticketTypeModel->where('event_id', $eventId)->findAll();
            $event = $this->eventModel->find($eventId);
            if ($event) {
                $eventDateTime = strtotime($event['date'] . ' ' . $event['start_time']);
                if ($eventDateTime <= time()) {
                    $eventStatus['started'] = true;
                } else {
                    $eventStatus['started'] = false;
                }
            }
        }

        return view('user/event', [
            'events'      => $events,
            'event_id'    => $eventId,
            'ticketTypes' => $ticketTypes,
            'eventStatus' => $eventStatus
        ]);
    }

    // STORE ORDER via AJAX
    public function store()
    {
        $session = session();
        $user_id = $session->get('user_id');

        if (!$user_id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Silakan login terlebih dahulu.'
            ]);
        }

        $event_id       = $this->request->getPost('event_id');
        $ticket_type_id = $this->request->getPost('ticket_type_id');
        $qty            = (int) $this->request->getPost('qty');

        // Ambil data event
        $event = $this->eventModel->find($event_id);
        if (!$event) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Event tidak ditemukan.'
            ]);
        }

        // VALIDASI: Event sudah mulai atau lewat
        $eventDateTime = strtotime($event['date'] . ' ' . $event['start_time']);
        if ($eventDateTime <= time()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Maaf, event sudah mulai atau lewat, tiket tidak bisa dipesan.'
            ]);
        }

        $ticketType = $this->ticketTypeModel->find($ticket_type_id);
        if (!$ticketType) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Jenis tiket tidak ditemukan.'
            ]);
        }

        if ($qty <= 0 || $qty > $ticketType['stock']) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Jumlah tiket tidak valid.'
            ]);
        }

        // Ambil price dari form jika tersedia
        $price = (float) $this->request->getPost('price');
        if (!$price) {
            $price = (float) $ticketType['price'];
        }

        $total = (float) $this->request->getPost('total_price');
        if (!$total) {
            $total = $price * $qty;
        }

        // INSERT ORDER
        $this->orderModel->insert([
            'user_id'        => $user_id,
            'event_id'       => $event_id,
            'ticket_type_id' => $ticket_type_id,
            'qty'            => $qty,
            'price'          => $price,
            'total_price'    => $total,
            'status'         => 'pending',
            'order_name'     => $this->request->getPost('name'),
            'order_email'    => $this->request->getPost('email'),
            'order_phone'    => $this->request->getPost('phone'),
        ]);

        // UPDATE STOCK
        $newStock = $ticketType['stock'] - $qty;
        if ($newStock >= 0) {
            $this->ticketTypeModel->update($ticket_type_id, [
                'stock'      => $newStock,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Order berhasil dibuat!'
        ]);
    }
}
