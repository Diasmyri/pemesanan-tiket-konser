<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckinModel extends Model
{
    protected $table            = 'checkins';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $useTimestamps = true; // created_at & updated_at

    protected $allowedFields = [
        'order_id',
        'checked_in_at',
        'status',
        'created_at',
        'updated_at'
    ];

    // Optional: ambil check-in + info order
    public function getWithOrder()
    {
        return $this->select('checkins.*, orders.order_code, orders.event_id, orders.user_id')
                    ->join('orders', 'orders.id = checkins.order_id');
    }
}
