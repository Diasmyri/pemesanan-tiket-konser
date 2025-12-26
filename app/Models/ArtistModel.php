<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtistModel extends Model
{
    protected $table = 'artis';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'description',
        'photo',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
}
