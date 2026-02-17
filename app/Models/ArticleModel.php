<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'slug',
        'title',
        'body',
        'status',
        'published_at',
        'excerpt',
        'featured_image',
        'file_hash',
        'image_caption',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    protected $useTimestamps = true;
}
