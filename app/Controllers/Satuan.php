<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelSatuan;

class Satuan extends BaseController
{
    protected $modelSatuan;
    public function __construct()
    {
        $this->modelSatuan = new ModelSatuan();
    }

    public function index()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = [
            'title' => 'Satuan',
            'menu' => 'masterdata',
            'submenu' => 'satuan',
            'satuan' => $this->modelSatuan->AllData()
        ];
        return view('v_satuan', $data);
    }

    public function tambahData()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = ['nama_satuan' => $this->request->getPost('nama_satuan')];
        $this->modelSatuan->TambahData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to(base_url('Satuan'));
    }

    public function editData($id_satuan)
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = [
            'id_satuan' => $id_satuan,
            'nama_satuan' => $this->request->getPost('nama_satuan')
        ];
        $this->modelSatuan->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diedit!');
        return redirect()->to(base_url('Satuan'));
    }

    public function hapusData($id_satuan)
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = ['id_satuan' => $id_satuan];
        $this->modelSatuan->HapusData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('Satuan'));
    }
}
