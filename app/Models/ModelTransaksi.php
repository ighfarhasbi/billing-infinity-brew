<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    protected $table = 'tb_rinci_jual';
    protected $primaryKey = 'id_rinci_jual';

    // Ambil Semua Data di Database
    public function AllDataDetail()
    {
        // return $this->db->table('tb_rinci_jual')->get()->getResultArray();
        return $this->db->table('tb_rinci_jual')
            ->join('tb_produk', 'tb_produk.kode_produk=tb_rinci_jual.kode_produk')
            ->join('tb_jual', 'tb_jual.no_faktur=tb_rinci_jual.no_faktur')
            ->orderBy('id_rinci', 'DESC')
            ->get()->getResultArray();
    }

    // Ambil Semua Data di Database
    public function AllDataPenjualan()
    {
        return $this->db->table('tb_jual')
            ->orderBy('id_jual', 'DESC')
            ->get()->getResultArray();
    }
    public function AllDataZakat()
    {
        return $this->db->table('tb_zakat')
            ->join('tb_produk', 'tb_produk.kode_produk=tb_zakat.kode_produk')
            ->get()->getResultArray();
    }
    public function Zakat()
    {
        //This is the copy process from Table tb_jual_temp to Table tb_zakat
        $this->db->query('INSERT INTO tb_zakat (kode_produk,qty,zakat) SELECT kode_produk,qty,total_zakat from tb_jual_temp');
    }
    public function HapusData($data)
    {
        $this->db->table('tb_zakat')->where('id_zakat', $data['id_zakat'])->delete($data);
    }
    public function TotalZakat()
    {
        $totZakat = $this->db->query('SELECT SUM(zakat) AS zakat FROM tb_zakat');
        $hasil = $totZakat->getRowArray();
        return $hasil;
    }
    public function ModalPokokGet($data)
    {
        $modalPokok = $this->db->query('SELECT modal_pokok FROM tb_produk WHERE kode_produk=' . $data . '');
        $hasil = $modalPokok->getRowArray();
        return $hasil;
    }
    public function HapusSemuaZakat()
    {
        $this->db->table('tb_zakat')->emptyTable();
    }

    public function Pengeluaran()
    {
        return $this->db->table('tb_pengeluaran')->get()->getResultArray();
    }
}
