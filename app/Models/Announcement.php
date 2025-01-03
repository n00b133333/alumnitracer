<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //

    protected $fillable = [
        'announcement_title',
        'description',
        'start_date',
        'end_date',
        'status'
    ];
}
