<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProduk extends Model
{
    protected $table = 'tb_produk';
    protected $primaryKey = 'id_produk';

    // Ambil Semua Data di Database
    public function AllData()
    {
        return $this->db->table('tb_produk')
            ->join('tb_kategori', 'tb_kategori.id_kategori=tb_produk.id_kategori')
            ->join('tb_satuan', 'tb_satuan.id_satuan=tb_produk.id_satuan')
            ->orderBy('id_produk', 'DESC')
            ->get()->getResultArray();
    }

    // Memasukkan Data ke Database
    public function TambahData($data)
    {
        $this->db->table('tb_produk')->insert($data);
    }

    // Mengupdate Data di Database Berdasarkan IDnya
    public function EditData($data)
    {
        $this->db->table('tb_produk')
            ->where('id_produk', $data['id_produk'])->update($data);
    }

    // Menghapus Data di Database Berdasarkan IDnya
    public function HapusData($data)
    {
        $this->db->table('tb_produk')
            ->where('id_produk', $data['id_produk'])->delete($data);
    }
}
