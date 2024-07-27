<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    protected $modelUser;
    public function __construct()
    {
        $this->modelUser = new ModelUser();
    }

    public function index()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = [
            'title' => 'User',
            'menu' => 'masterdata',
            'submenu' => 'user',
            'user' => $this->modelUser->AllData()
        ];
        return view('v_user', $data);
    }

    public function tambahData()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => ($this->request->getPost('password')),
            'level' => $this->request->getPost('level')
        ];
        $this->modelUser->TambahData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to(base_url('User'));
    }

    public function editData($id_user)
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = [
            'id_user' => $id_user,
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'level' => $this->request->getPost('level')
        ];
        $this->modelUser->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diedit!');
        return redirect()->to(base_url('User'));
    }

    public function hapusData($id_user)
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = ['id_user' => $id_user];
        $this->modelUser->HapusData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('User'));
    }
}
