<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $category = [
		'category_name'     => 'required',
		'category_status'     => 'required'
	];

	public $category_errors = [
		'category_name' => [
			'required'    => 'Nama kategori wajib diisi.',
		],
		'category_status'    => [
			'required' => 'Status kategori wajib diisi.'
		]
	];

	public $kendaraan = [
		'category_id'           => 'required',
		'kendaraan_name'          => 'required',
		'no_plat'           => 'required',
		'kendaraan_status'        => 'required',
		'kendaraan_image'         => 'uploaded[kendaraan_image]|mime_in[kendaraan_image,image/jpg,image/jpeg,image/gif,image/png]|max_size[kendaraan_image,1000]',
	];

	public $kendaraan_errors = [
		'category_id'   => [
			'required'  => 'Nama kategori wajib diisi.',
		],
		'kendaraan_name'  => [
			'required'  => 'Nama kendaraan wajib diisi.'
		],
		'no_plat'   => [
			'required'  => 'Nomor kendaraan wajib diisi.'
		],
		'kendaraan_status' => [
			'required'  => 'Status kendaraan wajib diisi.'
		],
		'kendaraan_image' => [
			'mime_in'   => 'Gambar kendaraan hanya boleh diisi dengan jpg, jpeg, png atau gif.',
			'max_size'  => 'Gambar kendaraan maksimal 1mb',
			'uploaded'  => 'Gambar kendaraan wajib diisi'
		],
	];

	public $service = [
		'trx_file'         => 'uploaded[trx_file]|ext_in[trx_file,xls,xlsx]|max_size[trx_file,1000]',
	];

	public $service_errors = [
		'trx_file' => [
			'ext_in'    => 'File Excel hanya boleh diisi dengan xls atau xlsx.',
			'max_size'  => 'File Excel maksimal 1mb',
			'uploaded'  => 'File Excel wajib diisi'
		]
	];

	public $authlogin = [
		'email'         => 'required|valid_email',
		'password'      => 'required'
	];

	public $authlogin_errors = [
		'email' => [
			'required'  => 'Email wajib diisi.',
			'valid_email'   => 'Email tidak valid'
		],
		'password' => [
			'required'  => 'Password wajib diisi.'
		]
	];

	public $authregister = [
		'email'             => 'required|valid_email|is_unique[users.email]',
		'username'          => 'required|alpha_numeric|is_unique[users.username]|min_length[6]|max_length[35]',
		'name'              => 'required|alpha_numeric_space|min_length[6]|max_length[35]',
		'password'          => 'required|string|min_length[8]|max_length[35]',
		'confirm_password'  => 'required|string|matches[password]|min_length[8]|max_length[35]',
	];

	public $authregister_errors = [
		'email' => [
			'required'      => 'Email wajib diisi',
			'valid_email'   => 'Email tidak valid',
			'is_unique'     => 'Email sudah terdaftar'
		],
		'username' => [
			'required'      => 'Username wajib diisi',
			'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka',
			'is_unique'     => 'Username sudah terdaftar',
			'min_length'    => 'Username minimal 3 karakter',
			'max_length'    => 'Username maksimal 35 karakter'
		],
		'name' => [
			'required'              => 'Name wajib diisi',
			'alpha_numeric_spaces'  => 'Name hanya boleh berisi huruf, angka dan spasi',
			'min_length'            => 'Name minimal 3 karakter',
			'max_length'            => 'Name maksimal 35 karakter'
		],
		'password' => [
			'required'      => 'Password wajib diisi',
			'string'        => 'Password hanya boleh berisi huruf, angka, spasi dan karakter lain',
			'min_length'    => 'Password minimal 8 karakter',
			'max_length'    => 'Password maksimal 35 karakter'
		],
		'confirm_password' => [
			'required'      => 'Konfirmasi password wajib diisi',
			'string'        => 'Konfirmasi password hanya boleh berisi huruf, angka, spasi dan karakter lain',
			'matches'       => 'Konfirmasi password tidak sama dengan password',
			'min_length'    => 'Konfirmasi password minimal 8 karakter',
			'max_length'    => 'Konfirmasi password maksimal 35 karakter'
		]
	];
}
