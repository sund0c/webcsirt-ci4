<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('site_settings')->insert([
            'site_name'     => 'Bali CSIRT',
            'site_tagline'  => 'Computer Security Incident Response Team',
            'site_email'    => 'csirt@baliprov.go.id',
            'site_phone'    => '+62 361 123456',
            'site_address'  => 'Denpasar, Bali',
            'kanal_aduan'   => 'https://lapor.baliprov.go.id',
        ]);
    }
}
