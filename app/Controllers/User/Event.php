<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\TicketTypeModel;
use App\Models\OrderModel;

class Event extends BaseController
{
    protected $eventModel;
    protected $ticketModel;
    protected $orderModel;

    public function __construct()
    {
        $this->eventModel  = new EventModel();
        $this->ticketModel = new TicketTypeModel();
        $this->orderModel  = new OrderModel();
    }

    /* ================= EVENT LIST ================= */
    public function index()
    {
        // Ambil semua event lengkap dengan info venue
        $events = $this->eventModel->getAllEventsWithVenue();

        // Ambil info user yang login (jika ada)
        $session = session();
        $user_id = $session->get('user_id');
        $user = null;
        if ($user_id) {
            $userModel = new \App\Models\UserModel();
            $user = $userModel->find($user_id);
        }

        return view('user/event', [
            'events' => $events,
            'user'   => $user
        ]);
    }

    /* ================= AJAX ARTISTS ================= */
    public function getArtists($eventId)
    {
        // Ambil daftar artis berdasarkan event ID
        $artists = $this->eventModel->getArtistsByEvent($eventId);

        return $this->response->setJSON($artists);
    }

    /* ================= AJAX TICKET TYPES ================= */
    public function getTicketTypes($eventId)
    {
        // Ambil ticket types yang stock > 0
        $tickets = $this->ticketModel
            ->where('event_id', $eventId)
            ->where('stock >', 0)
            ->findAll();

        return $this->response->setJSON($tickets);
    }
}
