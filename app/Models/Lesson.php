<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $casts = [
        'length'  =>  'datetime:H:i',
    ];
    public function sign_up_list()
    {
        return $this->hasMany('SignUp');
        //안되면 ::class , '외래키'
    }
}
