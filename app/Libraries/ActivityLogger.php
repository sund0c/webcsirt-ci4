<?php

namespace App\Libraries;

use App\Models\ActivityLogModel;

class ActivityLogger
{
    protected $model;

    public function __construct()
    {
        $this->model = new ActivityLogModel();
    }

    public function log($action, $module, $referenceId = null, $description = null, $old = null, $new = null)
    {
        $request = service('request');

        $this->model->insert([
            'user_id'      => session('user_id'),
            'action'       => $action,
            'module'       => $module,
            'reference_id' => $referenceId,
            'description'  => $description,
            'old_values'   => is_array($old) ? json_encode($old) : null,
            'new_values'   => is_array($new) ? json_encode($new) : null,
            'ip_address'   => $request->getIPAddress(),
            'user_agent'   => $request->getUserAgent()->getAgentString(),
        ]);
    }
}
