<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassroomsStudent extends Model
{
    protected $table = 'classroom_student';
    //
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->where('type', 'student');
    }
}
