<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    //
    protected $table = 'exam_answer'; // إذا كان اسم الجدول مختلف

    protected $fillable = [
        'exam_session_id',
        'question_id',
        'answer',
        'score'
    ];

    public function examSession()
    {
        return $this->belongsTo(ExamSession::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
