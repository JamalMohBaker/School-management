<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    public function classrooms()
    {
        return $this->hasMany(Classroom::class,'grade_id');
    }
}
