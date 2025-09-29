<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    //
    protected $table = 'exam_session';  
    
    protected $fillable = [
        'exam_id',
        'user_id',
        'start_time_exam'
    ];

    /**
     * الحقول التي يجب تحويلها إلى تواريخ
     *
     * @var array
     */
    protected $dates = [
        'start_time_exam',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'start_time_exam' => 'datetime',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
