<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $primaryKey = 'destination_id';

    public function vpDestinations()
    {
        return $this->hasMany(VpDestination::class, 'destination_id', 'destination_id');
    }
}
