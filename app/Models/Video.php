<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = ['id', 'name', 'viewers'];

    protected $hidden = ['created_at', 'updated_at'];
}
