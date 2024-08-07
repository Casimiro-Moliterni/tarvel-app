<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public function stops(){
        return $this->hasMany(stop::class);
    }

    public function trips()
    {
        return $this->belongsTo(trip::class, 'id_trip');
    }
}
