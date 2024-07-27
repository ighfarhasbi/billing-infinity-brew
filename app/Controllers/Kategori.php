<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori;

class Kategori extends BaseController
{
    protected $modelKategori;
    public function __construct()
    {
        $this->modelKategori = new ModelKategori();
    }

    public function index()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = [
            'title' => 'Kategori',
            'menu' => 'masterdata',
            'submenu' => 'kategori',
            'kategori' => $this->modelKategori->AllData()
        ];
        return view('v_kategori', $data);
    }

    public function tambahData()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = ['nama_kategori' => $this->request->getPost('nama_kategori')];
        $this->modelKategori->TambahData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to(base_url('Kategori'));
    }

    public function editData($id_kategori)
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];
        $this->modelKategori->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diedit!');
        return redirect()->to(base_url('Kategori'));
    }

    public function hapusData($id_kategori)
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = ['id_kategori' => $id_kategori];
        $this->modelKategori->HapusData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('Kategori'));
    }
}
