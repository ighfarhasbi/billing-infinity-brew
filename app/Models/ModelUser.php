<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';

    // Ambil Semua Data di Database
    public function AllData()
    {
        return $this->db->table('tb_user')->get()->getResultArray();
    }

    // Memasukkan Data ke Database
    public function TambahData($data)
    {
        $this->db->table('tb_user')->insert($data);
    }

    // Mengupdate Data di Database Berdasarkan IDnya
    public function EditData($data)
    {
        $this->db->table('tb_user')
            ->where('id_user', $data['id_user'])->update($data);
    }

    // Menghapus Data di Database Berdasarkan IDnya
    public function HapusData($data)
    {
        $this->db->table('tb_user')
            ->where('id_user', $data['id_user'])->delete($data);
    }

    // Mengecek akun yang terlogin
    public function LoginUser($email, $password)
    {
        return $this->db->table('tb_user')
            ->where([
                'email' => $email,
                'password' => $password
            ])
            ->get()->getRowArray();
    }
}
