<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'status',
        'user_id',
        'stay_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function stay()
    {
        return $this->belongsTo('App\Models\Stay');
    }

    public function getPending(){
        return $this->where('status', 'pending')->get();
    }
}
