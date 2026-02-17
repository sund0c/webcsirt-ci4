<?php

namespace App\Models;

use CodeIgniter\Model;

class GuideModel extends Model
{
    protected $table            = 'guides';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';


    protected $allowedFields = [
        'title',
        'description',
        'file_name',
        'stored_name',
        'file_hash',
        'file_size',
        'file_mime',
        'status',
        'published_at',
        'created_by',
        'updated_by',
        'deleted_at',
    ];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
}
