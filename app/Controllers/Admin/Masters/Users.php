<?php

namespace App\Controllers\Admin\Masters;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // =============================
    // LIST USERS
    // =============================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $this->userModel
                ->groupStart()
                    ->like('username', $keyword)
                    ->orLike('nama', $keyword)
                    ->orLike('email', $keyword)
                    ->orLike('nomor_telepon', $keyword)
                ->groupEnd();
        }

        $users = $this->userModel
            ->orderBy('id', 'DESC')
            ->paginate(10, 'users');

        return view('admin/masters/users_index', [
            'title'       => 'Data Users',
            'users'       => $users,
            'pager'       => $this->userModel->pager,
            'keyword'     => $keyword ?? '',
            'currentPage' => $this->userModel->pager->getCurrentPage('users'),
            'perPage'     => $this->userModel->pager->getPerPage('users'),
        ]);
    }

    // =============================
    // CREATE FORM
    // =============================
    public function create()
    {
        return view('admin/masters/users_form', [
            'title'      => 'Tambah User',
            'formAction' => '/admin/masters/users/store',
            'user'       => null
        ]);
    }

    // =============================
    // STORE USER
    // =============================
    public function store()
    {
        $rules = [
            'username'      => 'required|min_length[3]|is_unique[users.username]',
            'nama'          => 'required',
            'email'         => 'required|valid_email|is_unique[users.email]',
            'nomor_telepon' => 'required|min_length[8]|is_unique[users.nomor_telepon]',
            'password'      => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'username'      => $this->request->getPost('username'),
            'nama'          => $this->request->getPost('nama'),
            'email'         => $this->request->getPost('email'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'password'      => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
        ]);

        return redirect()->to('/admin/masters/users')
            ->with('success', 'User berhasil ditambahkan!');
    }

    // =============================
    // EDIT FORM
    // =============================
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            return redirect()->to('/admin/masters/users')
                ->with('error', 'User tidak ditemukan!');
        }

        return view('admin/masters/users_form', [
            'title'      => 'Edit User',
            'formAction' => '/admin/masters/users/update/' . $id,
            'user'       => $user
        ]);
    }

    // =============================
    // UPDATE USER
    // =============================
    public function update($id)
    {
        $rules = [
            'username'      => "required|min_length[3]|is_unique[users.username,id,{$id}]",
            'nama'          => 'required',
            'email'         => "required|valid_email|is_unique[users.email,id,{$id}]",
            'nomor_telepon' => "required|min_length[8]|is_unique[users.nomor_telepon,id,{$id}]",
            'password'      => 'permit_empty|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id'            => $id,
            'username'      => $this->request->getPost('username'),
            'nama'          => $this->request->getPost('nama'),
            'email'         => $this->request->getPost('email'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $this->userModel->save($data);

        return redirect()->to('/admin/masters/users')
            ->with('success', 'User berhasil diupdate!');
    }

    // =============================
    // DELETE USER
    // =============================
    public function delete($id)
    {
        $this->userModel->delete($id);

        return redirect()->to('/admin/masters/users')
            ->with('success', 'User berhasil dihapus!');
    }
}
