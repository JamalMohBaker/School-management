<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function subjectTeachers(){
        return $this->hasMany(subjectTeacher::class,'classroom_id');
    }
}
