<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model{
    protected $table = 'holidays';
    protected $fillable = [
        'holi_date', 'desc'
    ];
}
