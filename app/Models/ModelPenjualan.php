<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{
    public function NoFaktur()
    {
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(no_faktur,4)) as no_urut from tb_jual where DATE(tgl_jual)='$tgl'");
        $hasil = $query->getRowArray();
        if ($hasil['no_urut'] > 0) {
            $tmp = $hasil['no_urut'] + 1;
            $kd = sprintf("%04s", $tmp);
        } else {
            $kd = "0001";
        }
        $no_faktur = date('Ymd') . $kd;
        return $no_faktur;
    }

    public function CekProduk($kode_produk)
    {
        return $this->db->table('tb_produk')
            ->join('tb_kategori', 'tb_kategori.id_kategori=tb_produk.id_kategori')
            ->join('tb_satuan', 'tb_satuan.id_satuan=tb_produk.id_satuan')
            ->where('kode_produk', $kode_produk)
            ->get()->getRowArray();
    }

    // Keranjang
    public function AllKeranjang()
    {
        return $this->db->table('tb_jual_temp')->get()->getResultArray();
    }
    public function CekKode($data)
    {
        return $this->db->table('tb_jual_temp')->where('kode_produk', $data['kode_produk'])->get()->getRowArray();
    }
    public function UpdateKeranjang($data)
    {
        $this->db->table('tb_jual_temp')->where('kode_produk', $data['kode_produk'])->update($data);;
    }
    public function TambahKeranjang($data)
    {
        $this->db->table('tb_jual_temp')->insert($data);
    }
    public function TotalBayar()
    {
        return $this->db->table('tb_jual_temp')->selectSum('total_harga', 'sumQuantities')->get()->getRow()->sumQuantities;
    }
    public function HapusKeranjang()
    {
        $this->db->table('tb_jual_temp')->emptyTable();
    }
    public function RemoveKeranjang($data)
    {
        $this->db->table('tb_jual_temp')->where('id_jual_temp', $data['id_jual_temp'])->delete($data);
    }
    //Cek Stok dulu
    public function CekStok($kode_produk)
    {
        $query = $this->db->query('SELECT stok FROM tb_produk WHERE kode_produk = ' . $kode_produk . '');
        $stok = $query->getRowArray();
        return $stok;
    }
    // Bayar
    public function Bayar($data)
    {
        $this->db->table('tb_jual')->insert($data);
    }
    public function Pindahkan($noFaktur)
    {
        //This is the copy process from Table tb_jual_temp to Table tb_rinci_jual
        $this->db->query('INSERT INTO tb_rinci_jual (kode_produk,harga_jual,qty,total_harga,total_zakat)
   SELECT kode_produk,harga_jual,qty,total_harga,total_zakat from tb_jual_temp');

        // Then Update null no_faktur where no_faktur = null
        $this->db->query('UPDATE tb_rinci_jual
                     SET no_faktur=' . $noFaktur . '
                     WHERE no_faktur IS NULL');
    }
}
