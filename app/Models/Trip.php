<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $fillable=['title','description','start_date','end_date','thumb','longitude','latitude'];

    public function days(){
        return $this->hasMany(day::class, 'id_trip');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
