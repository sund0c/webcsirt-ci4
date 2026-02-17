<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table      = 'activity_logs';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'action',
        'module',
        'reference_id',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected $useTimestamps = false;

    protected $returnType = 'array';
}
