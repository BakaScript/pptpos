<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UangMasuk extends Model
{
    protected $table = 'uang_masuk' ;

    protected $fillable = ['sumber', 'nominal', 'tanggal_masuk'] ;
    
}
