<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = 'service_id';

    public function vpServices()
    {
        return $this->hasMany(VpService::class, 'service_id', 'service_id');
    }
}
