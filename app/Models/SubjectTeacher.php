<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    //
    protected $table = 'subject_teacher_classroom';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class, 'user_id');
    }
    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'subject_teacher_classroom_id');
    }
}
