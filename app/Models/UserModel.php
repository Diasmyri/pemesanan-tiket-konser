<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'nama',
        'email',
        'nomor_telepon',
        'alamat',
        'password'
    ];

    // timestamps aktif karena kolom sudah ada
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // =============================
    // DASHBOARD SUPPORT FUNCTIONS
    // =============================

    public function getTotalUsers()
    {
        return $this->countAllResults();
    }

    public function getRecentUsers($limit = 5)
    {
        return $this->orderBy('id', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
