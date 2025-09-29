<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $casts = [
        'day_date' => 'date', // الأفضل
    ];
    protected $dates = [
        'day_date',
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function subjectTeacherClassroom()
    {
        return $this->belongsTo(SubjectTeacher::class, 'subject_teacher_classroom_id');
    }
    public function getDayDateWithDayAttribute(){
        // return $this->day_date->translatedFormat('1 Y-m-d');
        return Carbon::parse($this->day_date)->translatedFormat(' d-m-y l');
    }

    // Accessor للتحقق إذا كان اليوم هو يوم الامتحان
   
    public function getTimeExamAttribute(){
        if ( $this->day_date->isToday()){
           return [
            'html' => ' <span class="text-success"> Exam Today! 🟢</span>',
            'is_today' => 'yes',
            'day' => 'today',
           ]; 
                  }
        elseif($this->day_date->isPast()){
            return [
                'html' => ' <span class="text-danger "> Exam Ended 🔴</span>',
                'is_today' => 'no',
                'day' => 'past',
            ];
            
        }
        elseif($this->day_date->isFuture()){
            return [
                'html' => ' <span class="text-warning "> Upcoming Exam 🟡</span>',
                'is_today' => 'no',
                'day' => 'future',
            ];
            
        }
    }
    // Accessor لوقت البداية
    public function getFormattedStartAtAttribute()
    {
        return Carbon::parse($this->start_at)->format('h:i A');
    }

    // Accessor لوقت النهاية
    public function getFormattedEndAtAttribute()
    {
        return Carbon::parse($this->end_at)->format('h:i A');
    }
  
}
