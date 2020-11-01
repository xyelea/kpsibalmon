<?php

namespace App\Models;

use CodeIgniter\Model;

class Kendaraan_model extends Model
{
    protected $table = 'kendaraan';
    protected $session;
    public function getKendaraan($id = false)
    {
        if ($id === false) {
            return $this->table('kendaraan')
                ->join('categories', 'categories.category_id = kendaraan.category_id')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('kendaraan')
                ->join('categories', 'categories.category_id = kendaraan.category_id')
                ->where('kendaraan.kendaraan_id', $id)
                ->get()
                ->getRowArray();
        }
    }

    public function insertKendaraan($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateKendaraan($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['kendaraan_id' => $id]);
    }

    public function deleteKendaraan($id)
    {
        return $this->db->table($this->table)->delete(['kendaraan_id' => $id]);
    }
    // Function ini dibutuhkan untuk mendapatkan data harga dari suatu product berdasarkan product_id
    public function getNoPlat($id)
    {
        return $this->db->table($this->table)->getWhere(['kendaraan_id' => $id])->getRowArray();
    }
}
