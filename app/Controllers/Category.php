<?php

namespace App\Controllers;

use CodeIgniter\Controller;
// Definisikan model yang digunakan/Panggil Model kategori
use App\Models\Category_model;

class Category extends Controller
{

    public function index()
    {
        // inisiasi Model (Panggil kelasny)
        $model = new Category_model();
        // Panggil Fungsi getCategory
        $data['categories'] = $model->getCategory();
        // Muat View beserta data yang di bawa
        echo view('category/index', $data);
    }
    //Fungsi untuk memuat form tambah data
    public function create()
    {
        return view('category/create');
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $data = array(
            'category_name'     => $this->request->getPost('category_name'),
            'category_status'   => $this->request->getPost('category_status'),
        );

        if ($validation->run($data, 'category') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            // return redirect()->to(base_url('category/create'));
            // arahkan kembali ke halaman create dengan nilai input yang telah di ketik pengguna
            return redirect()->back()->withInput();
        } else {
            $model = new Category_model();
            $simpan = $model->insertCategory($data);
            if ($simpan) {
                session()->setFlashdata('success', 'Kategori berhasil dibuat');
                return redirect()->to(base_url('category'));
            }
        }
    }

    public function edit($id)
    {

        $model = new Category_model();
        $data['category'] = $model->getCategory($id)->getRowArray();
        echo view('category/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('category_id');
        $validation =  \Config\Services::validation();

        $data = array(
            'category_name'     => $this->request->getPost('category_name'),
            'category_status'   => $this->request->getPost('category_status'),
        );

        if ($validation->run($data, 'category') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('category/edit/' . $id));
        } else {
            $model = new Category_model();
            $ubah = $model->updateCategory($data, $id);
            if ($ubah) {
                session()->setFlashdata('info', 'Kategori kendaraan berhasil di update');
                return redirect()->to(base_url('category'));
            }
        }
    }

    public function delete($id)
    {
        $model = new Category_model();
        $hapus = $model->deleteCategory($id);
        if ($hapus) {
            session()->setFlashdata('warning', 'Kategori Kendaraan berhasil di hapus');
            return redirect()->to(base_url('category'));
        }
    }
}
