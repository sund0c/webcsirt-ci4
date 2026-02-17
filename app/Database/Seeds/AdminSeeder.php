<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'username' => 'portalmaster_x9k3',
            'password' => password_hash('Admin123!!', PASSWORD_DEFAULT),
            'role' => 'admin',
        ]);
    }
}
