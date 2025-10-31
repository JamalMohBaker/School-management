<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    public function student(){
        return $this->belongsTo(related: User::class, foreignKey: 'student_id');
    }

    public function teacher(){
        return $this->belongsTo(User::class, foreignKey: 'teacher_id');
    }
    
}
