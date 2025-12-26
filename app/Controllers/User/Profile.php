<?php


namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // ============================
    // PROFILE USER LOGIN
    // ============================
   public function index()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/user/login');
    }

    $userId = session()->get('user_id');

    // 🔐 Ambil HANYA user yang login
    $user = $this->userModel->find($userId);
    if (!$user) {
        session()->destroy();
        return redirect()->to('/user/login');
    }

    return view('user/profile', [
        'user' => $user
    ]);
}


    // ============================
    // UPDATE PROFILE (AMAN)
    // ============================
    public function update()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/user/login');
        }

        $userId = session()->get('user_id');

        if (!$this->validate([
            'email' => 'required|valid_email',
            'nomor_telepon' => 'required|numeric'
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau nomor telepon tidak valid.');
        }

        // 🔐 Update user LOGIN SAJA
        $this->userModel->update($userId, [
            'username'      => $this->request->getPost('username'),
            'nama'          => $this->request->getPost('nama'),
            'email'         => $this->request->getPost('email'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'alamat'        => $this->request->getPost('alamat'),
        ]);

        return redirect()->to('/user/profile')
            ->with('success', 'Profile berhasil diperbarui.');
    }
}
