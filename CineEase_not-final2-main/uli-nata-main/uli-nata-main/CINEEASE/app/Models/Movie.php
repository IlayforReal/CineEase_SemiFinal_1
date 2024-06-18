<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'poster', 
        'description', 
        'date_showing', 
        'amount', 
        'seats_available',
    ];

    protected $attributes = [
        'seats_available' => 0,
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
