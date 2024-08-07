<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Trip extends Model
{
    use HasFactory;
    
     protected $fillable=['title','description','start_date','end_date','thumb','longitude','latitude'];
    public function days(){
        return $this->hasMany(day::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
