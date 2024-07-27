<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class Login extends BaseController
{
    protected $modelUser;
    public function __construct()
    {
        $this->modelUser = new ModelUser();
    }

    public function index()
    {
        if (session('id_user')) {
            return redirect()->to('Dashboard');
        }
        return view('v_login');
    }

    public function cekLogin()
    {
        $email = $this->request->getPost('email');
        $password = ($this->request->getPost('password'));
        $cek_login = $this->modelUser->LoginUser($email, $password);
        if ($cek_login) {
            // Jika berhasil Login
            session()->set('id_user', $cek_login['id_user']);
            session()->set('nama_user', $cek_login['nama_user']);
            session()->set('level', $cek_login['level']);
            if ($cek_login['level'] == 1) {
                session()->setFlashdata('pesan', 'Anda berhasil masuk sebagai Admin!');
                return redirect()->to(base_url('Dashboard'));
            } else {
                return redirect()->to(base_url('Penjualan'));
            }
        } else {
            // Jika gagal Login
            session()->setFlashdata('gagal', 'Email atau Password Salah, silahkan coba lagi!');
            return redirect()->to(base_url('Login'));
        }
    }

    public function logout()
    {
        session()->remove('id_user');
        session()->remove('nama_user');
        session()->remove('level');
        return redirect()->to(base_url('Login'));
    }
}
