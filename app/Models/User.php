<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'user_id';
    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id', 'user_id');
    }

    public function travelAgency()
    {
        return $this->belongsTo(TravelAgency::class, 'user_id', 'user_id');
    }

}
