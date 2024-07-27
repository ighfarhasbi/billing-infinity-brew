<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSatuan extends Model
{
    protected $table = 'tb_satuan';
    protected $primaryKey = 'id_satuan';

    // Ambil Semua Data di Database
    public function AllData()
    {
        return $this->db->table('tb_satuan')->get()->getResultArray();
    }

    // Memasukkan Data ke Database
    public function TambahData($data)
    {
        $this->db->table('tb_satuan')->insert($data);
    }

    // Mengupdate Data di Database Berdasarkan IDnya
    public function EditData($data)
    {
        $this->db->table('tb_satuan')
            ->where('id_satuan', $data['id_satuan'])->update($data);
    }

    // Menghapus Data di Database Berdasarkan IDnya
    public function HapusData($data)
    {
        $this->db->table('tb_satuan')
            ->where('id_satuan', $data['id_satuan'])->delete($data);
    }
}
