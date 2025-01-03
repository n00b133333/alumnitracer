<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    //

    protected $fillable = [
        'title',
        'description',
        'admin_ID'
    ];
}
