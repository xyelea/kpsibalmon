<?php

namespace App\Controllers;

use PHPExcel;
use PHPExcel_IOFactory;

class Home extends BaseController
{

	public function index()
	{
		$data['contacts'] = $this->contact->findAll();
		echo view('index', $data);
	}
	public function prosesExcel()
	{
		$file = $this->request->getFile('fileexcel');
		if ($file) {
			$excelReader  = new PHPExcel();
			//mengambil lokasi temp file
			$fileLocation = $file->getTempName();
			//baca file
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
			//ambil sheet active
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
			//looping untuk mengambil data
			foreach ($sheet as $idx => $data) {
				//skip index 1 karena title excel
				if ($idx == 1) {
					continue;
				}
				$nama = $data['A'];
				$hp = $data['B'];
				$email = $data['C'];
				// insert data
				$this->contact->insert([
					'nama' => $nama,
					'handphone' => $hp,
					'email' => $email
				]);
			}
		}
		session()->setFlashdata('message', 'Berhasil import excel');
		return redirect()->to('/home');
	}
}
