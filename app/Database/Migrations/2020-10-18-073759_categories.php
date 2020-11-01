<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
	public function up()
	{
		// tambah kolom
		$this->forge->addField([
			'category_id'           => [
				'type'              => 'BIGINT',
				'constraint'        => 20,
				'unsigned'          => TRUE,
				'auto_increment'    => TRUE
			],
			'category_name'         => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'category_status'       => [
				'type'              => 'ENUM',
				'constraint'        => "'Active','Inactive'",
				'default'           => 'Active'
			],
		]);
		// buat primary key
		$this->forge->addKey('category_id', TRUE);
		// buat tabel kategori
		$this->forge->createTable('categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
