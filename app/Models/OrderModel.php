<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    
    protected $allowedFields = [
        'user_id',  
        'event_id',
        'ticket_type_id',
        'qty',
        'price',
        'total_price',
        'status',          
        'created_at',
        'updated_at'
    ];

}
