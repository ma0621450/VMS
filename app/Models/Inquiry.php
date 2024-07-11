<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    protected $primaryKey = 'inquiry_id';
    protected $fillable = ['customer_id', 'vp_id', 'subject', 'message'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function vp()
    {
        return $this->belongsTo(Vp::class, 'vp_id', 'vp_id');
    }
}
