<?php

namespace App\Models;

use CodeIgniter\Model;

class EventArtistModel extends Model
{
    protected $table      = 'events_artists'; // sesuaikan nama tabel
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'event_id',
        'artist_id',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
}
