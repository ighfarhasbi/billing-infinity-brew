<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPenjualan;
use App\Models\ModelProduk;
use App\Models\ModelTransaksi;
//printer thermal
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;

class Penjualan extends BaseController
{
    protected $modelPenjualan;
    protected $modelProduk;
    protected $modelTransaksi;
    public function __construct()
    {
        $this->modelPenjualan = new ModelPenjualan();
        $this->modelProduk = new ModelProduk();
        $this->modelTransaksi = new ModelTransaksi();
    }

    public function index()
    {
        $data = [
            'title' => 'Penjualan',
            'menu' => 'penjualan',
            'no_faktur' => $this->modelPenjualan->NoFaktur(),
            'menu' => $this->modelProduk->AllData(),
            'keranjang' => $this->modelPenjualan->AllKeranjang(),
            'total_bayar' => $this->modelPenjualan->TotalBayar()
        ];
        return view('v_penjualan', $data);
    }

    // Jquery saat pilih menu
    public function cekProduk()
    {
        $kode_produk  = $this->request->getPost('kode_produk');
        $produk = $this->modelPenjualan->CekProduk($kode_produk);
        if ($produk == null) {
            $data = [
                'kode_produk' => '',
                'nama_kategori' => '',
                'nama_satuan' => '',
                'harga_jual' => ''
            ];
        } else {
            $data = [
                'kode_produk' => $produk['kode_produk'],
                'nama_kategori' => $produk['nama_kategori'],
                'nama_satuan' => $produk['nama_satuan'],
                'harga_jual' => $produk['harga_jual'],
                'nama_produk' => $produk['nama_produk']
            ];
        }
        echo json_encode($data);
    }

    // Proses Masukkan Keranjang
    public function keranjang()
    {
        $hargaJual = str_replace(",", "", $this->request->getPost('harga_jual'));
        $kode_produk = $this->request->getPost('kode_produk');
        $modalPokok = $this->modelTransaksi->ModalPokokGet($kode_produk);
        $data = [
            'kode_produk' => $this->request->getPost('kode_produk'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'harga_jual' => $hargaJual,
            'qty' => $this->request->getPost('qty'),
            'total_harga' => $hargaJual * $this->request->getPost('qty'),
            'total_zakat' => 0.025 * $this->request->getPost('qty') * $modalPokok['modal_pokok'],
        ];
        $cari = $this->modelPenjualan->CekKode($data);
        if ($cari) {
            $qty = $data['qty'] + $cari['qty'];
            $data = [
                'kode_produk' => $this->request->getPost('kode_produk'),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'nama_kategori' => $this->request->getPost('nama_kategori'),
                'harga_jual' => $hargaJual,
                'qty' => $qty,
                'total_harga' => $hargaJual * $qty,
                'total_zakat' => 0.025 * $qty * $modalPokok['modal_pokok'],
            ];
            $stok = $this->modelPenjualan->CekStok($data['kode_produk']);
            $stokTersedia = $stok['stok'] - $qty;
            if ($stokTersedia < 0) {
                session()->setFlashdata('pesan', 'Pembelian Melebihi Stok! Stok Tersedia = ' . $stok['stok'] . '');
                return redirect()->to(base_url('Penjualan'));
            }
            $this->modelPenjualan->UpdateKeranjang($data);
            return redirect()->to(base_url('Penjualan'));
        }

        $stok = $this->modelPenjualan->CekStok($data['kode_produk']);
        $stokTersedia = $stok['stok'] - $data['qty'];
        if ($stokTersedia < 0) {
            session()->setFlashdata('pesan', 'Pembelian Melebihi Stok! Stok Tersedia = ' . $stok['stok'] . '');
            return redirect()->to(base_url('Penjualan'));
        }
        $this->modelPenjualan->TambahKeranjang($data);
        return redirect()->to(base_url('Penjualan'));
    }
    public function hapusKeranjang()
    {
        $this->modelPenjualan->HapusKeranjang();
        return redirect()->to(base_url('Penjualan'));
    }
    public function removeKeranjang($id)
    {
        $data = ['id_jual_temp' => $id];
        $this->modelPenjualan->RemoveKeranjang($data);
        return redirect()->to(base_url('Penjualan'));
    }
    public function bayar()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('H:i:s');
        $metodeBayar = $this->request->getPost('metode');
        if ($metodeBayar == 'NON-TUNAI') {
            $dibayar = $this->modelPenjualan->TotalBayar();
        } else {
            $dibayar = str_replace(",", "", $this->request->getPost('cash'));
        }
        $data = [
            'grand_total' => $this->modelPenjualan->TotalBayar(),
            'dibayar' => $dibayar,
        ];
        if (is_numeric($data['grand_total']) && is_numeric($data['dibayar'])) {
            $kembalian = $data['dibayar'] - $data['grand_total'];
            $data = [
                'no_faktur' => $this->modelPenjualan->NoFaktur(),
                'tgl_jual' => date('Y-m-d'),
                'jam' => $date,
                'grand_total' => $this->modelPenjualan->TotalBayar(),
                'dibayar' => $dibayar,
                'kembalian' => $kembalian,
                'nama_kasir' => session()->get('nama_user'),
                'nama_customer' => $this->request->getPost('nama_customer'),
                'metode_bayar' => $this->request->getPost('metode')
            ];
        } else {
            // do some error handling...
        }
        if ($kembalian < 0) {
            session()->setFlashdata('salahKembali', 'Anda salah memasukkan JUMLAH UANG CASH!');
            return redirect()->to(base_url('Penjualan'));
        }
        $noFaktur = $data['no_faktur'];
        $this->modelPenjualan->Bayar($data);
        $this->modelPenjualan->Pindahkan($noFaktur);
        $this->modelTransaksi->Zakat();
        $this->modelPenjualan->HapusKeranjang();
        session()->setFlashdata('kembali', $kembalian);
        return redirect()->to(base_url('Penjualan'));
    }

    //Cetak Struk
    public function cetakStruk()
    {
        $profile = CapabilityProfile::load("simple");
        $connector = new WindowsPrintConnector("MacBook-Air-Ash"); //Sharename printer di pengaturan windows
        $printer = new Printer($connector, $profile);

        $printer->text("Hello World!\n");
        $printer->feed(4);
        $printer->cut();
        $printer->close();
    }

    //untuk melihat output doang
    public function cobacobaweh()
    {
        $data = [
            'hasil' => $this->modelTransaksi->TotalZakat(),
            'menu' => $this->modelProduk->AllData(),
            'semuaZakat' => $this->modelTransaksi->SemuaZakat(),
        ];
        echo dd($data);
    }
}
