<?php

namespace App\Models;

use CodeIgniter\Model;

class IncidentReportModel extends Model
{
    protected $table      = 'incident_reports';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'reporter_name',
        'reporter_email',
        'organization',
        'incident_type',
        'description',
        'status',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $returnType = 'array';
}
