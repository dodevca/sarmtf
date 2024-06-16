<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AirportData extends Seeder
{
	public function run()
	{
        $this->db->table('airport')->insertBatch([
            [
                'email' => 'admin@gmail.com',
                'name' => 'Admin',
                'password' => 'Admin',
                'hierarchy' => 'admin',
                'dealer' => NULL
            ]
        ]);
	}
}