<?php

namespace App\Controllers\Admin\Masters;

use App\Controllers\BaseController;
use App\Models\VenueModel;

class Venues extends BaseController
{
    protected $venueModel;

    public function __construct()
    {
        $this->venueModel = new VenueModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        // Clone model agar tidak mengganggu instance utama
        $query = $this->venueModel;

        if ($keyword) {
            $query = $query->groupStart()
                ->like('name', $keyword)
                ->orLike('location', $keyword)
                ->orLike('capacity', $keyword)
                ->groupEnd();
        }

        $data = [
            'title'   => 'Data Venue',
            'venues'  => $query->paginate(10, 'default'),
            'pager'   => $query->pager,
            'keyword' => $keyword,
        ];

        return view('admin/masters/venues_index', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Tambah Venue',
            'venue'      => [],
            'formAction' => '/admin/masters/venues/store'
        ];

        return view('admin/masters/venues_form', $data);
    }

    public function store()
    {
        $this->venueModel->save([
            'name'     => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'capacity' => $this->request->getPost('capacity'),
        ]);

        return redirect()
            ->to('/admin/masters/venues')
            ->with('success', 'Venue berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $venue = $this->venueModel->find($id);

        if (!$venue) {
            return redirect()
                ->to('/admin/masters/venues')
                ->with('error', 'Data venue tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Venue',
            'venue'      => $venue,
            'formAction' => '/admin/masters/venues/update/' . $id
        ];

        return view('admin/masters/venues_form', $data);
    }

    public function update($id)
    {
        $this->venueModel->update($id, [
            'name'     => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'capacity' => $this->request->getPost('capacity'),
        ]);

        return redirect()
            ->to('/admin/masters/venues')
            ->with('success', 'Venue berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->venueModel->delete($id);

        return redirect()
            ->to('/admin/masters/venues')
            ->with('success', 'Venue berhasil dihapus!');
    }
}
