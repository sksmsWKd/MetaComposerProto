<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $casts = [
        'length'  =>  'time:H:00 I:00',
    ];
    public function sign_up_list()
    {
        return $this->hasMany('SignUp');
    }
}
