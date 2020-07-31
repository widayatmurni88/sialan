<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surattj extends Model{
    protected $table = 'surat_tjs';
    protected $fillable = ['bio_nid', 'instansi_id', 'periode'];
}
