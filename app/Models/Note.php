<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public function stops()
    {
        return $this->belongsTo(stop::class, 'id_stop');
    }
}
