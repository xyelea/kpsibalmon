<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\Controller;
use App\Models\Kendaraan_model;
use App\Models\Service_model;

class Service extends Controller
{
    protected $helpers = [];

    public function __construct()
    {
        helper(['form']);
        $this->service_model = new Service_model();
        $this->kendaraan_model = new Kendaraan_model();
    }

    public function index()
    {
        $data['service'] = $this->service_model->getService();
        echo view('service/index', $data);
    }

    public function manual()
    {
        echo view('service/manual');
    }
    public function import()
    {
        echo view('service/import');
    }

    public function proses_import()
    {
        $validation =  \Config\Services::validation();

        $file = $this->request->getFile('trx_file');

        $data = array(
            'trx_file'           => $file,
        );

        if ($validation->run($data, 'service') == FALSE) {

            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('service/import'));
        } else {

            // ambil extension dari file excel
            $extension = $file->getClientExtension();

            // format excel 2007 ke bawah
            if ('xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                // format excel 2010 ke atas
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($file);
            $data = $spreadsheet->getActiveSheet()->toArray();

            foreach ($data as $idx => $row) {

                // lewati baris ke 0 pada file excel
                // dalam kasus ini, array ke 0 adalahpara title
                if ($idx == 0) {
                    continue;
                }

                // get kendaraan_id from excel
                $kendaraan_id   = $row[0];
                $no_plat        = $this->getNoPlat($row[0]);
                // get svc_date from excel
                $svc_date       = $row[1];
                $svc_desc       = $row[2];
                $svc_price      = $row[3];
                // tampilkan BD berdasarkan id menggunakan function getNoPlat()
                // $svc_price      = $this->getNoPlat($row[0]);

                $data = [
                    "kendaraan_id"  => $kendaraan_id,
                    "no_plat"       => $no_plat,
                    "svc_date"      => date('Y-m-d', strtotime($svc_date)),
                    "svc_desc"      => $svc_desc,
                    "svc_price"     => $svc_price,
                ];

                $simpan = $this->service_model->insertService($data);
            }

            if ($simpan) {
                session()->setFlashdata('success', 'Data Berhasil di Impor');
                return redirect()->to(base_url('service'));
            }
        }
    }

    public function getNoPlat($kendaraan_id)
    {
        $no_plat = $this->kendaraan_model->getNoPlat($kendaraan_id);
        $data = $no_plat['no_plat'];
        return $data;
    }

    public function export()
    {
        // ambil data transaction dari database
        $transactions = $this->service_model->getService();
        // panggil class Sreadsheet baru
        $spreadsheet = new Spreadsheet;
        // Buat custom header pada file excel
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Kendaraan')
            ->setCellValue('C1', 'No Plat')
            ->setCellValue('D1', 'Date')
            ->setCellValue('E1', 'Desc')
            ->setCellValue('F1', 'Price');
        // define kolom dan nomor
        $kolom = 2;
        $nomor = 1;
        // tambahkan data transaction ke dalam file excel
        foreach ($transactions as $data) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, $data['no_plat'])
                ->setCellValue('C' . $kolom, $data['kendaraan_name'])
                ->setCellValue('D' . $kolom, date('j F Y', strtotime($data['svc_date'])))
                ->setCellValue('E' . $kolom, $data['svc_desc'])
                ->setCellValue('F' . $kolom, "Rp. " . number_format($data['svc_price']));

            $kolom++;
            $nomor++;
        }
        // download spreadsheet dalam bentuk excel .xlsx
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Servis.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
