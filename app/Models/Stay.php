<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stay extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'amenities',
        'rooms',
        'beds',
        'type',
        'location',
        'price',
        'user_id',
    ];

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback');
    }

    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }


    public function getAvgRating() {
        return collect($this->ratings->pluck('rating'))->avg();
    }

    public function checkIsUserVoted() {
        $user = auth()->id();
        $filtered = $this->ratings->pluck("user_id")->first(function ($value) use ($user) {
            return $value == $user ;
        });

        return $filtered ? 1 : 0;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
