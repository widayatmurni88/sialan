<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TtdReference extends Model
{
    protected $table = 'ttd_references';
    protected $fillable = ['instansi_id', 'bio_nid'];
    public $timestamps = false;

}
