<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'order_id',
        'method',
        'amount',
        'payment_date',
        'proof'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // ======================
    // LIST PAYMENT + RELASI
    // ======================
    public function getPaymentsWithRelations($keyword = null)
    {
        $builder = $this->select('
                payments.*,
                users.username AS user_name,
                events.title AS event_name,
                orders.total_price AS order_total,
                orders.status AS order_status    -- <===== FIX UTAMA!
            ')
            ->join('orders', 'orders.id = payments.order_id', 'left')
            ->join('users', 'users.id = orders.user_id', 'left')
            ->join('events', 'events.id = orders.event_id', 'left');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('users.username', $keyword)
                ->orLike('events.title', $keyword)
                ->orLike('payments.method', $keyword)
                ->groupEnd();
        }

        return $builder;
    }

    // ======================
    // DETAIL PAYMENT
    // ======================
    public function findWithRelations($id)
    {
        return $this->select('
                payments.*,
                users.username AS user_name,
                events.title AS event_name,
                orders.total_price AS order_total,
                orders.status AS order_status    -- <===== FIX UTAMA!
            ')
            ->join('orders', 'orders.id = payments.order_id', 'left')
            ->join('users', 'users.id = orders.user_id', 'left')
            ->join('events', 'events.id = orders.event_id', 'left')
            ->where('payments.id', $id)
            ->first();
    }
}
