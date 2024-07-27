<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $table = 'tb_kategori';
    protected $primaryKey = 'id_kategori';

    // Ambil Semua Data di Database
    public function AllData()
    {
        return $this->db->table('tb_kategori')->get()->getResultArray();
    }

    // Memasukkan Data ke Database
    public function TambahData($data)
    {
        $this->db->table('tb_kategori')->insert($data);
    }

    // Mengupdate Data di Database Berdasarkan IDnya
    public function EditData($data)
    {
        $this->db->table('tb_kategori')
            ->where('id_kategori', $data['id_kategori'])->update($data);
    }

    // Menghapus Data di Database Berdasarkan IDnya
    public function HapusData($data)
    {
        $this->db->table('tb_kategori')
            ->where('id_kategori', $data['id_kategori'])->delete($data);
    }
}
