<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\Stop;
class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_trip',
        'id_stop',
        'rating',
        'review',
    ];

    // Una valutazione può avere più viaggi
    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id_trip');
    }
    
    public function stop()
    {
        return $this->hasMany(Stop::class);
    }
}
