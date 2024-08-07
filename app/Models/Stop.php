<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;

    public function notes(){
        return $this->hasMany(note::class);
    }

    public function days()
    {
        return $this->belongsTo(day::class, 'id_day');
    }
}
