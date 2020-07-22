<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model{
    protected $table    = 'instansis';
    protected $fillable = ['nama_ins'];
    public $timestamps = false;
}
