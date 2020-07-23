<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model{
    protected $table = 'absens';
    protected $fillable = ['id', 'nid', 'bio_nid', 'pangkat_id', 'tgl_absen'];
    public $timestamps = false;
}
