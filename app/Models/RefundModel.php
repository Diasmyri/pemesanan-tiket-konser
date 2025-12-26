<?php

namespace App\Models;

use CodeIgniter\Model;

class RefundModel extends Model
{
    protected $table      = 'refunds';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'order_id',
        'user_id',
        'qty',
        'refund_amount',
        'reason',
        'status',
        'admin_note',
        'approved_by',
        'approved_at',
        'created_at'
    ];

    protected $useTimestamps = false;

    // ======================================================
    // CEK REFUND AKTIF
    // ======================================================
    public function hasActiveRefund($orderId)
    {
        return $this->where('order_id', $orderId)
            ->whereIn('status', ['pending', 'approved'])
            ->first();
    }
}
