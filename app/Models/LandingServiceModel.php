<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingServiceModel extends Model
{
    protected $table            = 'landing_services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'title',
        'description',
        'icon',
        'link',
        'sort_order',
        'updated_by'
    ];

    protected $useTimestamps = false;

    /**
     * Ambil maksimal 3 layanan, urut berdasarkan sort_order
     */
    public function getServices()
    {
        return $this->orderBy('sort_order', 'ASC')
            ->limit(3)
            ->findAll();
    }
}
