<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;
class Stop extends Model
{
    use HasFactory;

    protected $fillable = [
        'day','id_trip', 'name', 'image', 'description','country','city'  ,'street', 'foods', 'curiosities',
        'time_start','time_end','lonCountry','latCountry','lonCity','latCity','lonStreet','latStreet',
    ];

    public function notes(){
        return $this->hasMany(note::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class,'id_trip');
    }
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
