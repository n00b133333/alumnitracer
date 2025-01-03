<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name','middle_name', 'last_name', 'student_ID','sex', 'birthday','contact_number', 'address','civil_status', 'email', 'password', 'course_ID', 'status'
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_ID');
    }

    public function employmentStatus()
    {
        // Assuming 'user_ID' is the foreign key in 'User_employment_statuses'
        return $this->hasOne(User_employment_status::class, 'user_ID')->latest();
    }

    public function statuses()
    {
        // Assuming 'user_ID' is the foreign key in 'User_employment_statuses'
        return $this->hasMany(User_employment_status::class, 'user_ID')->orderBy('created_at', 'desc');
    }

    

    public function answers()
    {
        return $this->hasMany(Employment_answer::class, 'user_ID');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
