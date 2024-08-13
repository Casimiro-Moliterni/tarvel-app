<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;

    protected $fillable = [
        'day','id_trip', 'name', 'image', 'description',  'street', 'foods', 'curiosities', 'rating',
        'time_start','time_end','lonCountry','latCountry','lonCity','latCity','lonStreet','latStreet',
        'country','city','streeet'
    ];

    public function notes(){
        return $this->hasMany(note::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class,'id_trip');
    }
}
