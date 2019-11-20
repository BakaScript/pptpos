<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kajian extends Model
{
    protected $table = 'kajian' ;

    protected $fillable = ['tempat', 'tema', 'ustadz', 'tanggal_kajian', 'jumlah_jamaah'] ;
}
