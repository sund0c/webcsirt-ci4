<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingSectionModel extends Model
{
    protected $table = 'landing_sections';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'section_key',
        'title',
        'subtitle',
        'content',
        'button_text',
        'button_link',
        'background_image',
        'updated_by'
    ];

    protected $useTimestamps = false;
}
