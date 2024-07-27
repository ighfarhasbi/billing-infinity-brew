<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDashboard extends Model
{
    protected $table = 'tb_jual';
    protected $primaryKey = 'id_jual';

    public function PendapatanHariIni()
    {
        return $this->db->table('tb_jual')
            ->where('tgl_jual', date('Y-m-d'))
            ->groupBy('tgl_jual')->selectSum('grand_total')
            ->get()->getRowArray();
    }
    public function PendapatanBulanIni()
    {
        return $this->db->table('tb_jual')
            ->where('month(tgl_jual)', date('m'))
            ->where('year(tgl_jual)', date('Y'))
            ->groupBy('month(tgl_jual)')->selectSum('grand_total')
            ->get()->getRowArray();
    }
    public function PendapatanTahunIni()
    {
        return $this->db->table('tb_jual')
            ->where('year(tgl_jual)', date('Y'))
            ->groupBy('year(tgl_jual)')->selectSum('grand_total')
            ->get()->getRowArray();
    }
    public function JmlProduk()
    {
        return $this->db->table('tb_produk')->countAll();
    }
    public function JmlKategori()
    {
        return $this->db->table('tb_kategori')->countAll();
    }
    public function JmlUser()
    {
        return $this->db->table('tb_user')->countAll();
    }

    // Percobaan novinaldi
    public function TampilGrafik($awal, $akhir)
    {
        $query = $this->db->query("SELECT COUNT(no_faktur) AS jumlah,tgl_jual FROM tb_jual WHERE tgl_jual BETWEEN '$awal' AND '$akhir' GROUP BY tgl_jual;");
        $result = $query->getResultArray();
        return $result;
    }

    // Percobaan padang tekno
    public function Grafik()
    {
        return $this->db->table('tb_jual')
            ->where('month(tgl_jual)', date('m'))
            ->where('year(tgl_jual)', date('Y'))
            ->groupBy('month(tgl_jual)')->selectSum('grand_total')
            ->get()->getResultArray();
    }

    public function grafikDonat()
    {
        $query = $this->db->query("SELECT tb_kategori.nama_kategori,tb_produk.id_kategori, SUM(tb_rinci_jual.qty) AS jumlah_terjual FROM tb_rinci_jual LEFT JOIN tb_produk ON tb_rinci_jual.kode_produk = tb_produk.kode_produk LEFT JOIN tb_kategori ON tb_produk.id_kategori = tb_kategori.id_kategori GROUP BY id_kategori,nama_kategori;");
        $result = $query->getResultArray();
        return $result;
    }
}
