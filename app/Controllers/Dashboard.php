<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDashboard;

class Dashboard extends BaseController
{
    protected $modelDashboard;
    public function __construct()
    {
        $this->modelDashboard = new ModelDashboard();
    }
    public function index()
    {
        // Jika Session bukan admin
        if (session()->get('level') != 1) {
            return redirect()->to(base_url('Penjualan'));
        }
        // jika tanggal awal blm diinput (saat awal masik halaman dashboard)
        if ($this->request->getPost('tgl_awal')) {
            $awal = $this->request->getPost('tgl_awal');
            $akhir = $this->request->getPost('tgl_akhir');
        } else {
            $awal = date('Y-m-01');
            $akhir = date('Y-m-d');
        }
        $data = [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'submenu' => '',
            'p_hari_ini' => $this->modelDashboard->PendapatanHariIni(),
            'p_bulan_ini' => $this->modelDashboard->PendapatanBulanIni(),
            'p_tahun_ini' => $this->modelDashboard->PendapatanTahunIni(),
            'jml_produk' => $this->modelDashboard->JmlProduk(),
            'jml_kategori' => $this->modelDashboard->JmlKategori(),
            'jml_user' => $this->modelDashboard->JmlUser(),
            'grafik' => $this->modelDashboard->TampilGrafik($awal, $akhir),
            'grafikDonat' => $this->modelDashboard->grafikDonat(),
            'blnAwal' => $awal,
            'blnAkhir' => $akhir
        ];
        return view('v_dashboard', $data);
    }
}
