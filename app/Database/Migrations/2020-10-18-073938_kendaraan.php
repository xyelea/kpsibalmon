<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kendaraan extends Migration
{
	public function up()
	{
		//aktifkan cek foreign key
		$this->db->enableForeignKeyChecks();
		// Tambah kolom
		$this->forge->addField([
			'kendaraan_id'            => [
				'type'              => 'BIGINT',
				'constraint'        => 20,
				'unsigned'          => TRUE,
				'auto_increment'    => TRUE
			],
			'category_id'           => [
				'type'              => 'BIGINT',
				'constraint'        => 20,
				'unsigned'          => TRUE,
				'null'              => TRUE
			],
			'kendaraan_name'          => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'no_plat'           => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'kendaraan_status'        => [
				'type'              => 'ENUM',
				'constraint'        => "'Active','Inactive'",
				'default'           => 'Active'
			],
			'kendaraan_image'         => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
				'null'              => TRUE,
			],

		]);
		// Buat primary key
		$this->forge->addKey('kendaraan_id', TRUE);
		// Buat Foreign key
		$this->forge->addForeignKey('category_id', 'categories', 'category_id', 'CASCADE', 'CASCADE');
		// Buat Tabel
		$this->forge->createTable('kendaraan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
