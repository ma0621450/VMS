<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $primaryKey = 'destination_id';
    protected $guarded = [];

    public function vps()
    {
        return $this->belongsToMany(Vp::class, 'vp_destinations', 'destination_id', 'vp_id');
    }
}