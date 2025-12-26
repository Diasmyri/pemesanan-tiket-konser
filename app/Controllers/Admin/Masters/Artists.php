<?php

namespace App\Controllers\Admin\Masters;

use App\Controllers\BaseController;
use App\Models\ArtistModel;

class Artists extends BaseController
{
    protected $artist;

    public function __construct()
    {
        $this->artist = new ArtistModel();
    }

    /* ================= INDEX ================= */
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $query = $this->artist;

        if ($keyword) {
            $query = $query->like('name', $keyword);
        }

        $data = [
            'artists' => $query->paginate(10),
            'pager'   => $query->pager,
            'keyword' => $keyword,
            'page'    => $this->request->getVar('page_default') ?? 1,
            'perPage' => 10,
            'title'   => 'Master Artists'
        ];

        return view('admin/masters/artists_index', $data);
    }

    /* ================= CREATE ================= */
    public function create()
    {
        return view('admin/masters/artists_form', [
            'title'      => 'Tambah Artist',
            'artist'     => null,
            'formAction' => '/admin/masters/artists/store',
            'validation' => \Config\Services::validation()
        ]);
    }

    /* ================= STORE ================= */
    public function store()
    {
        $validation = \Config\Services::validation();

        // Validasi
        if (!$this->validate([
            'name' => 'required|is_unique[artis.name]',
            'photo' => 'is_image[photo]|max_size[photo,2048]'
        ])) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $validation->getErrors());
        }

        $name = $this->request->getPost('name');
        $photoFile = $this->request->getFile('photo');
        $photoName = null;

        if ($photoFile && $photoFile->isValid() && !$photoFile->hasMoved()) {
            $photoName = $photoFile->getRandomName();
            $photoFile->move('uploads/artists', $photoName);
        }

        $this->artist->insert([
            'name'  => $name,
            'photo' => $photoName
        ]);

        return redirect()->to('/admin/masters/artists')
                         ->with('success', 'Artist berhasil ditambahkan.');
    }

    /* ================= EDIT ================= */
    public function edit($id)
    {
        $artist = $this->artist->find($id);
        if (!$artist) {
            return redirect()->to('/admin/masters/artists')
                             ->with('error', 'Artist tidak ditemukan.');
        }

        return view('admin/masters/artists_form', [
            'title'      => 'Edit Artist',
            'artist'     => $artist,
            'formAction' => '/admin/masters/artists/update/' . $id,
            'validation' => \Config\Services::validation()
        ]);
    }

    /* ================= UPDATE ================= */
    public function update($id)
    {
        $artist = $this->artist->find($id);
        if (!$artist) {
            return redirect()->to('/admin/masters/artists')
                             ->with('error', 'Artist tidak ditemukan.');
        }

        $validation = \Config\Services::validation();

        // Validasi (unique name kecuali untuk ID sendiri)
        if (!$this->validate([
            'name' => "required|is_unique[artis.name,id,{$id}]",
            'photo' => 'is_image[photo]|max_size[photo,2048]'
        ])) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $validation->getErrors());
        }

        $name = $this->request->getPost('name');
        $photoFile = $this->request->getFile('photo');
        $photoName = $artist['photo'];

        if ($photoFile && $photoFile->isValid() && !$photoFile->hasMoved()) {
            if ($artist['photo'] && file_exists('uploads/artists/' . $artist['photo'])) {
                unlink('uploads/artists/' . $artist['photo']);
            }
            $photoName = $photoFile->getRandomName();
            $photoFile->move('uploads/artists', $photoName);
        }

        $this->artist->update($id, [
            'name'  => $name,
            'photo' => $photoName
        ]);

        return redirect()->to('/admin/masters/artists')
                         ->with('success', 'Artist berhasil diupdate.');
    }

    /* ================= DELETE ================= */
    public function delete($id)
    {
        $artist = $this->artist->find($id);
        if (!$artist) {
            return redirect()->to('/admin/masters/artists')
                             ->with('error', 'Artist tidak ditemukan.');
        }

        if ($artist['photo'] && file_exists('uploads/artists/' . $artist['photo'])) {
            unlink('uploads/artists/' . $artist['photo']);
        }

        $this->artist->delete($id);

        return redirect()->to('/admin/masters/artists')
                         ->with('success', 'Artist berhasil dihapus.');
    }
}
