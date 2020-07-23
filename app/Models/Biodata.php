<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'biodatas';
    protected $primaryKey = 'nid';
    protected $fillable =['nid', 'nama', 'tmpt_lahir', 'tgl_lahir', 'pangkat_id', 'instansi_id'];
}
