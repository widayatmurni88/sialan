<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocKegiatan extends Model
{
    protected $table = 'doc_kegiatans';
    protected $fillable = ['id', 'title', 'desk', 'absen_id', 'file_link'];
}
