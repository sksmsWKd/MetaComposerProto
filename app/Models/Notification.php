<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function notifiable()
    {
        return $this->morphTo();
        //모델 지정 안해도됨
    }
}
