<?php

namespace App\Models;

use CodeIgniter\Model;

class AdvisoryModel extends Model
{

    protected $table = 'advisories';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'slug',
        'title',
        'body',
        'status',
        'published_at',
        'excerpt',
        'source_url',
        'featured_image',
        'file_hash',
        'image_caption',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
}
