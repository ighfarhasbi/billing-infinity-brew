<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProduk;
use App\Models\ModelKategori;
use App\Models\ModelSatuan;

class Produk extends BaseController
{
    protected $modelProduk;
    protected $modelKategori;
    protected $modelSatuan;
    public function __construct()
    {
        $this->modelProduk = new ModelProduk();
        $this->modelKategori = new ModelKategori();
        $this->modelSatuan = new ModelSatuan();
    }

    public function index()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = [
            'title' => 'Produk',
            'menu' => 'masterdata',
            'submenu' => 'produk',
            'produk' => $this->modelProduk->allData(),
            'kategori' => $this->modelKategori->allData(),
            'satuan' => $this->modelSatuan->allData()
        ];
        return view('v_produk', $data);
    }

    public function tambahData()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        if ($this->validate([
            'kode_produk' => [
                'label' => 'Kode Produk',
                'rules' => 'is_unique[tb_produk.kode_produk]',
            ]
        ])) {
            $hargaBeli = str_replace(",", "", $this->request->getPost('harga_beli'));
            $hargaJual = str_replace(",", "", $this->request->getPost('harga_jual'));
            $modalPokok = str_replace(",", "", $this->request->getPost('modal_pokok'));
            $data = [
                'kode_produk' => $this->request->getPost('kode_produk'),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'id_satuan' => $this->request->getPost('id_satuan'),
                'modal_pokok' => $modalPokok,
                'harga_beli' => $hargaBeli,
                'persen_untung' => (($hargaJual - $hargaBeli) / $hargaBeli) * 100,
                'harga_jual' => $hargaJual,
                'stok' => $this->request->getPost('stok')
            ];
            $this->modelProduk->TambahData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
            return redirect()->to(base_url('Produk'));
        } else {
            session()->setFlashdata('errors', 'Kode Produk sudah terdaftar, silahkan coba lagi!');
            return redirect()->to(base_url('Produk'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function editData($id_produk)
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $hargaBeli = str_replace(",", "", $this->request->getPost('harga_beli'));
        $hargaJual = str_replace(",", "", $this->request->getPost('harga_jual'));
        $modalPokok = str_replace(",", "", $this->request->getPost('modal_pokok'));
        $data = [
            'id_produk' => $id_produk,
            'kode_produk' => $this->request->getPost('kode_produk'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_satuan' => $this->request->getPost('id_satuan'),
            'modal_pokok' => $modalPokok,
            'harga_beli' => $hargaBeli,
            'persen_untung' => (($hargaJual - $hargaBeli) / $hargaBeli) * 100,
            'harga_jual' => $hargaJual,
            'stok' => $this->request->getPost('stok')
        ];
        $this->modelProduk->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diedit!');
        return redirect()->to(base_url('Produk'));
    }

    public function hapusData($id_produk)
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = ['id_produk' => $id_produk];
        $this->modelProduk->HapusData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('Produk'));
    }
}
