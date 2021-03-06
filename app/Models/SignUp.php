<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignUp extends Model
{
    use HasFactory;

    public function attendance_info_by_sign_up()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }
}
