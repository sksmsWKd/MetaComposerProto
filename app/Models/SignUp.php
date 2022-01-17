<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignUp extends Model
{
    use HasFactory;

    public function what_lesson_have_i_joined()
    {
        return $this->hasMany('Attendance');
    }
}
