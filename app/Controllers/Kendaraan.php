<?php

namespace App\Controllers;

use CodeIgniter\Controller;
// Model yang di pakai di kontroler ini
use App\Models\Kendaraan_model;
use App\Models\Category_model;

class Kendaraan extends Controller
{
    protected $helpers = [];

    // Panggil model di konstruktor supaya tidak perlu di panggil tiap di pake di fungsi
    public function __construct()
    {
        // Panggil form helper
        helper(['form']);
        // Muat/Inisiasi modelnya
        $this->category_model = new Category_model();
        $this->kendaraan_model = new Kendaraan_model();
    }

    public function index()
    {
        // ambil kategori dan keyword
        $category           = $this->request->getGet('category');
        $keyword            = $this->request->getGet('keyword');
        // oper ke variabel data untuk di bawa ke halaman index
        $data['category']   = $category;
        $data['keyword']    = $keyword;
        // kelompokkan fielname dan id pada tabel kategori
        $categories         = $this->category_model->where('category_status', 'Active')->findAll();
        $data['categories'] = ['' => 'Semua Tipe'] + array_column($categories, 'category_name', 'category_id');

        // filter
        $where      = [];
        $like       = [];
        $or_like    = [];

        if (!empty($category)) {
            $where = ['kendaraan.category_id' => $category];
        }

        if (!empty($keyword)) {
            $like   = ['kendaraan.kendaraan_name' => $keyword];
            $or_like   = ['kendaraan.no_plat' => $keyword,];
        }
        // end filter

        // paginate
        $paginate = 5;
        $data['kendaraan']   = $this->kendaraan_model->join('categories', 'categories.category_id = kendaraan.category_id')->where($where)->like($like)->orLike($or_like)->paginate($paginate, 'kendaraan');
        $data['pager']      = $this->kendaraan_model->pager;

        echo view('kendaraan/index', $data);
    }

    public function create()
    {
        // jalankan kueri untuk menemukan semua data kategori yang berstatus aktif
        $categories = $this->category_model->where('category_status', 'Active')->findAll();
        // Tampilkan list kategori dengan bantuan language construct php array column
        // kategori akan dikelompokkan hanya nama dan idnya saja
        // buat digunakan pada dropdown nanti
        // dd($categories);
        $data['categories'] = ['' => 'Pilih Tipe kendaraan'] + array_column($categories, 'category_name', 'category_id');
        // dd(array_column($categories, 'category_name', 'category_id'));
        return view('kendaraan/create', $data);
    }

    public function store()
    {
        // Panggil aturan validasi pada app/config/validation
        $validation =  \Config\Services::validation();

        // get file upload
        $image = $this->request->getFile('kendaraan_image');
        // random name file
        $name = $image->getRandomName();
        // Ambil data dari kolom view
        $data = array(
            'category_id'           => $this->request->getPost('category_id'),
            'kendaraan_name'          => $this->request->getPost('kendaraan_name'),
            'no_plat'           => $this->request->getPost('no_plat'),
            'kendaraan_status'        => $this->request->getPost('kendaraan_status'),
            'kendaraan_image'         => $name,
        );
        // apabila ada eror
        if ($validation->run($data, 'kendaraan') == FALSE) {
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
            // return redirect()->to(base_url('product/create'));
            // Kalau tidak ada eror
        } else {
            // upload file 
            $image->move(ROOTPATH . 'public/uploads', $name);
            // insert
            $simpan = $this->kendaraan_model->insertKendaraan($data);
            if ($simpan) {
                session()->setFlashdata('success', 'Kendaraan berhasil di tambah');
                return redirect()->to(base_url('kendaraan'));
            }
        }
    }

    public function show($id)
    {
        $data['kendaraan'] = $this->kendaraan_model->getKendaraan($id);
        return view('kendaraan/show', $data);
    }

    public function edit($id)
    {
        $categories = $this->category_model->where('category_status', 'Active')->findAll();
        $data['categories'] = ['' => 'Pilih Tipe Kendaraan'] + array_column($categories, 'category_name', 'category_id');

        $data['kendaraan'] = $this->kendaraan_model->getKendaraan($id);
        echo view('kendaraan/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('kendaraan_id');

        $validation =  \Config\Services::validation();

        // get file
        $image = $this->request->getFile('kendaraan_image');
        // random name file
        $name = $image->getRandomName();

        $data = array(
            'category_id'             => $this->request->getPost('category_id'),
            'kendaraan_name'          => $this->request->getPost('kendaraan_name'),
            'no_plat'                 => $this->request->getPost('no_plat'),
            'kendaraan_status'        => $this->request->getPost('kendaraan_status'),
            'kendaraan_image'         => $name,
        );

        if ($validation->run($data, 'kendaraan') == FALSE) {
            session()->setFlashdata('errors', $validation->getErrors());
            // return redirect()->back($id)->withInput();
            return redirect()->to(base_url('kendaraan/edit/' . $id));
        } else {
            // upload
            $image->move(ROOTPATH . 'public/uploads', $name);
            // update
            $ubah = $this->kendaraan_model->updateKendaraan($data, $id);
            if ($ubah) {
                session()->setFlashdata('info', 'Kendaraan berhasil di update');
                return redirect()->to(base_url('kendaraan'));
            }
        }
    }

    public function delete($id)
    {
        $hapus = $this->kendaraan_model->deleteKendaraan($id);
        if ($hapus) {
            session()->setFlashdata('warning', 'Kendaraan Berhasil di hapus');
            return redirect()->to(base_url('product'));
        }
    }
}
