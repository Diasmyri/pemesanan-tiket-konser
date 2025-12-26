<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketTypeModel extends Model
{
    protected $table            = 'ticket_types';
    protected $primaryKey       = 'id';

    protected $allowedFields = [
        'event_id',
        'name',
        'price',
        'stock',
        'updated_at'
    ];

    // Kalau tabel punya created_at & updated_at gunakan ini
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Ambil ticket types lengkap dengan nama event
    public function getWithEvent()
    {
        return $this->select('ticket_types.*, events.title as event_title')
                    ->join('events', 'events.id = ticket_types.event_id', 'left')
                    ->findAll();
    }
}
