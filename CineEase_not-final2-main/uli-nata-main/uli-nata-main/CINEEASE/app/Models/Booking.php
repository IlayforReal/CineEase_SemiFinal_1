<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'movie_title',
        'poster',
        'amount',
        'seatArrangement',
        'seats_booked',
        'total_amount',
        'payment_method',
    ];

    protected $casts = [
        'seatArrangement' => 'array', // Cast seatArrangement as an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
