<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Servis extends Migration
{
	public function up()
	{
		//
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'svc_id'                => [
				'type'              => 'BIGINT',
				'constraint'        => 20,
				'unsigned'          => TRUE,
				'auto_increment'    => TRUE
			],
			'kendaraan_id'            => [
				'type'              => 'BIGINT',
				'constraint'        => 20,
				'unsigned'          => TRUE,
				'null'              => TRUE
			],
			'no_plat'             => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'svc_price'             => [
				'type'              => 'INT',
				'constraint'        => '11',
			],
			'svc_date'              => [
				'type'              => 'DATE'
			],
			'svc_desc'              => [
				'type'              => 'TEXT'
			],
		]);
		// Tambah Primary Key
		$this->forge->addKey('svc_id', TRUE);
		// Tambah Foreign key dengan rule On delete dan update cascade
		$this->forge->addForeignKey('kendaraan_id', 'kendaraan', 'kendaraan_id', 'CASCADE', 'CASCADE');
		// Buat tabel
		$this->forge->createTable('service');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
