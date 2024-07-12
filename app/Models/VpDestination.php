<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpDestination extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'vp_destination_id';

    public function vp()
    {
        return $this->belongsTo(Vp::class, 'vp_id', 'vp_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'destination_id');
    }
}
