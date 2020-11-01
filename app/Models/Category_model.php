<?php

namespace App\Models;

use CodeIgniter\Model;

class Category_model extends Model
{
    // Definisikan tabel yang digunakan
    protected $table = 'categories';
    protected $session;
    // Ambil data kategori 
    // Nilai default dari paremeter id adalah false
    // Gunanya supaya Fungsi berjalan normal walau tanpa pemanggilan 
    //  getCategory($id).
    public function getCategory($id = false)
    {
        // Jika ID bernilai false($id tidak ada isinya alias kosong) cari semua data
        if ($id === false) {
            return $this->findAll();
        } else {
            // Jika Kondisi True ($id ada isinya) cari berdasarkan kolom category_id
            //  yang nilainya di dapat dari parameter $id
            return $this->getWhere(['category_id' => $id]);
        }
    }
    // fungsi menambah data
    public function insertCategory($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateCategory($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['category_id' => $id]);
    }

    public function deleteCategory($id)
    {
        return $this->db->table($this->table)->delete(['category_id' => $id]);
    }
}
