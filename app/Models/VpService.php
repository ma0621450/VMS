<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpService extends Model
{
    protected $primaryKey = 'vp_service_id';

    public function vp()
    {
        return $this->belongsTo(Vp::class, 'vp_id', 'vp_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }
}
