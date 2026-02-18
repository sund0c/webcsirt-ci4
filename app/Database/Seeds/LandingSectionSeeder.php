<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LandingSectionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'section_key' => 'hero',
                'title' => 'Web CSIRT',
                'subtitle' => 'Computer Security Incident Response Team',
                'content' => 'Kami menangani insiden keamanan siber dan memberikan advisory resmi.',
                'button_text' => 'Lihat Advisory',
                'button_link' => '/advisory',
                'background_image' => null,
            ],
            [
                'section_key' => 'about',
                'title' => 'Tentang CSIRT',
                'subtitle' => null,
                'content' => 'CSIRT bertugas melakukan koordinasi dan penanganan insiden siber.',
                'button_text' => null,
                'button_link' => null,
                'background_image' => null,
            ],
            [
                'section_key' => 'kontak',
                'title' => 'Hubungi Kami',
                'subtitle' => null,
                'content' => 'Email: csirt@example.go.id',
                'button_text' => null,
                'button_link' => null,
                'background_image' => null,
            ],
        ];

        $this->db->table('landing_sections')->insertBatch($data);
    }
}
