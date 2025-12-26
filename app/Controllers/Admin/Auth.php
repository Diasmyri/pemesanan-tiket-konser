<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    // ========================
    // LOGIN PAGE
    // ========================
    public function login()
    {
        // Kalau sudah login, langsung ke dashboard
        if (session()->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/auth/login', [
            'title' => 'Admin Login'
        ]);
    }

    // ========================
    // LOGIN PROCESS
    // ========================
    public function loginProcess()
    {
        $username = $this->request->getPost('name');
        $password = $this->request->getPost('password');

        if (!$username || !$password) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username dan password wajib diisi!');
        }

        // Cari admin
        $admin = $this->adminModel
            ->where('name', $username)
            ->where('role', 'admin')
            ->first();

        if (!$admin) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun admin tidak ditemukan!');
        }

        if (!password_verify($password, $admin['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah!');
        }

        // Set session admin
        session()->set([
            'admin_logged_in' => true,
            'admin_id'        => $admin['id'],
            'admin_name'      => $admin['name'],
            'role'            => 'admin'
        ]);

        return redirect()->to('/admin/dashboard');
    }

    // ========================
    // LOGOUT
    // ========================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/auth/login');
    }

    // ========================
    // BLOCKED ROUTES (REGISTER & FORGOT)
    // ========================
    public function register()
    {
        return redirect()->to('/admin/auth/login');
    }

    public function registerProcess()
    {
        return redirect()->to('/admin/auth/login');
    }

    public function forgotPassword()
    {
        return redirect()->to('/admin/auth/login');
    }

    public function forgotProcess()
    {
        return redirect()->to('/admin/auth/login');
    }
}
