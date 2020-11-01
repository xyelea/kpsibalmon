<?php

namespace App\Controllers;

use App\Models\Dashboard_model;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->cek_login();
        $this->dashboard_model = new Dashboard_model();
    }

    public function index()
    {
        if ($this->cek_login() == FALSE) {
            session()->setFlashdata('error_login', 'Silahkan login terlebih dahulu untuk mengakses data');
            return redirect()->to('/auth/login');
        }
        $data['total_service']      = $this->dashboard_model->getCountSvc();
        $data['total_kendaraan']    = $this->dashboard_model->getCountKendaraan();
        $data['total_category']     = $this->dashboard_model->getCountCategory();
        $data['total_user']         = $this->dashboard_model->getCountUser();
        $data['latest_svc']         = $this->dashboard_model->getLatestSvc();
        $data['nama']               = $this->dashboard_model->getLatestSvc();

        $chart['grafik']            = $this->dashboard_model->getGrafik();

        echo view('dashboard', $data);
        echo view('_partials/footer', $chart);
    }
}
