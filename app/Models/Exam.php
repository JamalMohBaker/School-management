<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function subjectTeacherClassroom()
    {
        return $this->belongsTo(SubjectTeacher::class, 'subject_teacher_classroom_id');
    }
  
}
