<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelAgency extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'travel_agency_id';
    protected $fillable = ['user_id', 'travel_agency_name', 'travel_agency_description'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function vps()
    {
        return $this->hasMany(Vp::class, 'travel_agency_id', 'travel_agency_id');
    }
}
