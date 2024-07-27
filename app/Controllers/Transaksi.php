<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;

class Transaksi extends BaseController
{
    protected $modelTransaksi;
    protected $modelPengeluaran;
    public function __construct()
    {
        $this->modelTransaksi = new ModelTransaksi();
        $this->modelPengeluaran = new ModelTransaksi();
    }
    public function transaksiPenjualan()
    {
        // if (session()->get('level') != 1) {
        //     return redirect()->to(base_url('Penjualan'));
        // }
        $data = [
            'title' => 'Transaksi',
            'menu' => 'Transaksi',
            'submenu' => 'Transaksi Penjualan',
            'transaksi' => $this->modelTransaksi->AllDataPenjualan(),
        ];
        return view('v_transaksi_penjualan', $data);
    }

    public function transaksiDetail()
    {
        // if (session()->get('level') != 1) {
        //     return redirect()->to(base_url('Penjualan'));
        // }
        $data = [
            'title' => 'Transaksi',
            'menu' => 'Transaksi',
            'submenu' => 'Transaksi Detail',
            'transaksi' => $this->modelTransaksi->AllDataDetail()
        ];
        return view('v_transaksi_detail', $data);
    }

    public function zakat()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = [
            'title' => 'Zakat',
            'menu' => 'Transaksi',
            'submenu' => 'Zakat',
            'dataZakat' => $this->modelTransaksi->AllDataZakat(),
            'totalZakat' => $this->modelTransaksi->TotalZakat()
        ];
        return view('v_zakat', $data);
    }

    public function hapusZakat($id_zakat)
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $data = ['id_zakat' => $id_zakat];
        $this->modelTransaksi->HapusData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diselesaikan!');
        return redirect()->to(base_url('Transaksi/zakat'));
    }

    public function hapusSemuaZakat()
    {
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        $this->modelTransaksi->HapusSemuaZakat();
        session()->setFlashdata('pesan', 'Semua Data Berhasil Diselesaikan!');
        return redirect()->to(base_url('Transaksi/zakat'));
    }

    public function pengeluaran()
    {
        $data = [
            'title' => 'Pengeluaran',
            'menu' => 'Transaksi',
            'submenu' => 'Pengeluaran',
            'pengeluaran' => $this->modelPengeluaran->Pengeluaran()
        ];
        return view('v_pengeluaran', $data);
    }
}
