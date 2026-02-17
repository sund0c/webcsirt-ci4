<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table      = 'pages';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'slug',
        'title',
        'body',
        'status',
        'published_at',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
