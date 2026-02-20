<?php

namespace App\Models;

use CodeIgniter\Model;

class CsirtBaliModel extends Model
{
    protected $table      = 'csirtbalis';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'site_link',
        'deleted_at',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
