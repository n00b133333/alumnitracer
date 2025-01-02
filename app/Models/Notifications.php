<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'notifications';

    // Allow mass assignment for all attributes
    protected $guarded = [];

    /**
     * Define the relationships for the foreign keys.
     */

    // Relationship to the Admin model (assuming you have an Admin model)
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_ID');
    }
}
