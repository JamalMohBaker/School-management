<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    public function subjectTeachers(){
        return $this->hasMany(SubjectTeacher::class, 'subject_id');
    }
}
