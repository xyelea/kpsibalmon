<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		//buat kolom
		$this->forge->addField([
			'id'            => [
				'type'              => 'BIGINT',
				'constraint'        => 20,
				'unsigned'          => TRUE,
				'auto_increment'    => TRUE
			],
			'username'              => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'name'                  => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'email'                 => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'password'              => [
				'type'              => 'VARCHAR',
				'constraint'        => '255',
			],
			'status'                => [
				'type'              => 'ENUM',
				'constraint'        => "'Active','Inactive'",
				'default'           => 'Active'
			],
			'level'                 => [
				'type'              => 'ENUM',
				'constraint'        => "'Admin','User'",
				'default'           => 'Admin'
			],
		]);
		// Tambah Primary key
		$this->forge->addKey('id', TRUE);
		// Buat tabel
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
