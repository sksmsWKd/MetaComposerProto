<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'sns_id',
        'sns_type',
        'self_introduce',
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
        //속성 정보 (Claim) 가져옴
    }

    public function getJWTCustomClaims()
    {
        // return [
        //     'email' => $this->email,
        //     'name' => $this->name
        // ];

        // php artisan jwt:secret
        // and after:
        // php artisan clear-compiled && php artisan optimize

        return [];
    }
}
