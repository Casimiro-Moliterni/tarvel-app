<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_trip',
        'description',
        'start_date',
        'end_date',
    ];

    public function stops()
    {
        return $this->hasMany(stop::class);
    }

    public function trips()
    {
        return $this->belongsTo(trip::class, 'id_trip');
    }
}
