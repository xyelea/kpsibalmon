<?php

namespace App\Models;

use CodeIgniter\Model;

class Service_model extends Model
{
    protected $table = 'service';

    public function getService($id = false)
    {
        if ($id === false) {
            return $this->table('service')
                ->select('kendaraan.kendaraan_name, service.*')
                ->join('kendaraan', 'kendaraan.kendaraan_id = service.kendaraan_id')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('service')
                ->select('kendaraan.kendaraan_name, service.*')
                ->join('kendaraan', 'kendaraan.kendaraan_id = service.kendaraan_id')
                ->where('service.kendaraan_id', $id)
                ->get()
                ->getRowArray();
        }
    }

    public function insertService($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
}
