<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\EventModel;
use Config\Database;

class Auth extends BaseController
{
    protected $userModel;
    protected $eventModel;
    protected $db;

    public function __construct()
    {
        $this->userModel  = new UserModel();
        $this->eventModel = new EventModel();
        $this->db         = Database::connect(); // ⬅️ FIX UTAMA
    }

    // ======================================================
    // Halaman khusus sebelum login / landing page
    // ======================================================
public function homeLogin()
{
    $db = \Config\Database::connect();

    // Ambil event + venue
    $events = $db->table('events')
        ->select('events.*, venues.name AS venue_name')
        ->join('venues', 'venues.id = events.venue_id', 'left')
        ->get()
        ->getResultArray();

    // Ambil artis per event (TANPA description)
    foreach ($events as &$event) {
        $event['artists'] = $db->table('events_artists')
            ->select('artis.name, artis.photo')
            ->join('artis', 'artis.id = events_artists.artist_id')
            ->where('events_artists.event_id', $event['id'])
            ->get()
            ->getResultArray();
    }

    return view('user/home_login', [
        'events' => $events
    ]);
}



    // ======================================================
    // FORM LOGIN
    // ======================================================
    public function loginForm()
    {
        return view('user/login');
    }

    // ======================================================
    // PROSES LOGIN
    // ======================================================
    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id'],
                'username'   => $user['username'],
            ]);

            return redirect()->to('/user/home');
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function artists($eventId)
{
    $db = \Config\Database::connect();

    $artists = $db->table('events_artists')
        ->select('artis.name, artis.photo')
        ->join('artis', 'artis.id = events_artists.artist_id')
        ->where('events_artists.event_id', $eventId)
        ->get()
        ->getResultArray();

    return $this->response->setJSON($artists);
}


    // ======================================================
    // FORM REGISTER
    // ======================================================
    public function registerForm()
    {
        return view('user/register');
    }

    // ======================================================
    // PROSES REGISTER
    // ======================================================
    public function registerProcess()
    {
        $username = $this->request->getPost('username');
        $email    = $this->request->getPost('email');
        $phone    = $this->request->getPost('nomor_telepon');
        $password = $this->request->getPost('password');

        if (!$username || !$email || !$phone || !$password) {
            return redirect()->back()->withInput()->with('error', 'Semua field wajib diisi.');
        }

        if ($this->userModel->where('username', $username)->first()) {
            return redirect()->back()->withInput()->with('error', 'Username sudah digunakan.');
        }

        if ($this->userModel->where('email', $email)->first()) {
            return redirect()->back()->withInput()->with('error', 'Email sudah terdaftar.');
        }

        if ($this->userModel->where('nomor_telepon', $phone)->first()) {
            return redirect()->back()->withInput()->with('error', 'Nomor telepon sudah terdaftar.');
        }

        $this->userModel->insert([
            'username'      => $username,
            'nama'          => $this->request->getPost('nama'),
            'email'         => $email,
            'nomor_telepon' => $phone,
            'password'      => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/user/login')
            ->with('success', 'Registrasi berhasil. Silakan login!');
    }

    // ======================================================
    // FORM LUPA PASSWORD
    // ======================================================
    public function forgotForm()
    {
        return view('user/forgot_password');
    }

    // ======================================================
    // PROSES RESET PASSWORD
    // ======================================================
    public function forgotProcess()
    {
        $email   = $this->request->getPost('email');
        $phone   = $this->request->getPost('nomor_telepon');
        $newPass = $this->request->getPost('password');

        if (!$email || !$phone || !$newPass) {
            return redirect()->back()->withInput()->with('error', 'Semua field wajib diisi.');
        }

        $user = $this->userModel
            ->where('email', $email)
            ->where('nomor_telepon', $phone)
            ->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Email dan nomor telepon tidak cocok.');
        }

        $this->userModel->update($user['id'], [
            'password' => password_hash($newPass, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/user/login')
            ->with('success', 'Password berhasil direset. Silakan login.');
    }

    // ======================================================
    // LOGOUT
    // ======================================================
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('user'));
    }
}
