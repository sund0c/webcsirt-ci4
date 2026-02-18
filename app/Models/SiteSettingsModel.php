<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteSettingsModel extends Model
{
    protected $table = 'site_settings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'site_name',
        'site_tagline',
        'site_email',
        'site_phone',
        'site_address',
        'kanal_aduan',
        'logo',
        'favicon'
    ];
}
