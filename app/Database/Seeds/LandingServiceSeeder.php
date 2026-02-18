<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LandingServiceSeeder extends Seeder
{
    public function run()
    {
        $table = $this->db->table('landing_services');

        // Jangan seed jika sudah ada data
        if ($table->countAllResults() > 0) {
            return;
        }

        $data = [
            [
                'title'       => 'Incident Response',
                'description' => 'Penanganan dan koordinasi insiden keamanan siber.',
                'icon'        => 'shield',
                'link'        => '#',
                'sort_order'  => 1,
                'updated_by'  => null,
            ],
            [
                'title'       => 'Vulnerability Handling',
                'description' => 'Koordinasi dan mitigasi kerentanan sistem.',
                'icon'        => 'bug',
                'link'        => '#',
                'sort_order'  => 2,
                'updated_by'  => null,
            ],
            [
                'title'       => 'Awareness & Guidance',
                'description' => 'Edukasi dan panduan keamanan informasi.',
                'icon'        => 'book',
                'link'        => '#',
                'sort_order'  => 3,
                'updated_by'  => null,
            ],
        ];

        $table->insertBatch($data);
    }
}
