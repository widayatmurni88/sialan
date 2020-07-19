<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankUser extends Model
{
    protected $table = 'rank_users';
    protected $fillable = ['pangkat'];
    public $timestamps = false;
}
