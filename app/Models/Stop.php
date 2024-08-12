<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;

    protected $fillable = [
        'day','id_trip', 'name', 'image', 'description', 'country', 'region', 'city', 'street', 'foods', 'curiosities', 'rating'
    ];

    public function notes(){
        return $this->hasMany(note::class);
    }

    public function days()
    {
        return $this->belongsTo(Trip::class);
    }
}
