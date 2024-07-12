<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = 'service_id';

    public function vps()
    {
        return $this->belongsToMany(Vp::class, 'vp_services', 'service_id', 'vp_id');
    }
}
