<?php

namespace App\Models;

use CodeIgniter\Model;

class Dashboard_model extends Model
{
    protected $table = 'service';

    // hitung total data pada transaction
    public function getCountSvc()
    {
        return $this->db->table("service")->countAll();
    }

    // hitung total data pada category
    public function getCountCategory()
    {
        return $this->db->table("categories")->countAll();
    }

    // hitung total data pada product
    public function getCountKendaraan()
    {
        return $this->db->table("kendaraan")->countAll();
    }

    // hitung total data pada user
    public function getCountUser()
    {
        return $this->db->table("users")->countAll();
    }
    // Fungsi untuk menampilkan data bulan dan total penjualan setiap bulannya
    public function getGrafik()
    {
        $query = $this->db->query("SELECT svc_price, MONTHNAME(svc_date) as month, COUNT(kendaraan_id) as total FROM service GROUP BY MONTHNAME(svc_date) ORDER BY MONTH(svc_date)");
        $hasil = [];
        if (!empty($query)) {
            foreach ($query->getResultArray() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }
    // ambil data transaksi terakhir
    public function getLatestSvc()
    {
        return $this->table('service')
            ->select('kendaraan.kendaraan_name, service.*')
            ->join('kendaraan', 'kendaraan.kendaraan_id = service.kendaraan_id')
            ->orderBy('service.svc_id', 'desc')
            ->limit(5)
            ->get()
            ->getResultArray();
    }
}
