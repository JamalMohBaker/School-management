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
}
