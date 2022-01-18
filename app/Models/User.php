<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'user_id');
    }

    public function students_lesson()
    {
        return $this->hasMany(SignUp::class, 'user_id');
    }
    public function my_attandance()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }
}
