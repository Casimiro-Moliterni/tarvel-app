<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Trip extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $fillable=['title','description','start_date','end_date','thumb','lonCountry','latCountry','latCity','lonCity','country','city','code'];

    public function stops(){
        return $this->hasMany(Stop::class,'id_trip');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function users()
{
    return $this->belongsToMany(User::class, 'trip_user');
}
    public function ratings()
    {
        return $this->hasMany(Rating::class,'trip_id');
    }


     // Metodo per generare un codice univoco
     public static function boot()
     {
         parent::boot();
 
         static::creating(function ($trip) {
             $trip->code = Str::random(8);  // Genera un codice casuale di 8 caratteri
         });
     }

       // Relazione con il creatore del viaggio
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
