<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vp extends Model
{
    use HasFactory;

    protected $table = 'vp';
    protected $primaryKey = 'vp_id';
    protected $fillable = ['travel_agency_id', 'title', 'description', 'price', 'start_date', 'end_date', 'persons'];

    public function travelAgency()
    {
        return $this->belongsTo(TravelAgency::class, 'travel_agency_id', 'travel_agency_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'vp_services', 'vp_id', 'service_id');
    }

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'vp_destinations', 'vp_id', 'destination_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'vp_id', 'vp_id');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'vp_id', 'vp_id');
    }
}
