<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lecture extends Model
{
    //
    public function SubjectTeacher()
    {
        return $this->belongsTo(SubjectTeacher::class, 'subject_teacher_classroom_id');
    }
    public function getMediaHtmlAttribute()
    {
        if (!$this->attachment || !Storage::disk('public')->exists($this->attachment)) {
            return '<span style="color:red;"> No Img or Video</span>';
        }

        $ext = strtolower(pathinfo($this->attachment, PATHINFO_EXTENSION));

        $imageExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $videoExts = ['mp4', 'mov', 'avi', 'webm'];

        $url = asset('storage/' . $this->attachment);

        if (in_array($ext, $imageExts)) {
            return '<img src="' . $url . '" width="100">';
        } elseif (in_array($ext, $videoExts)) {
            return '<video width="100" controls><source src="' . $url . '" type="video/' . $ext . '">متصفحك لا يدعم الفيديو</video>';
        }

        return '<span style="color:orange;"> Unsupported type </span>';
    }
    public function getUrlHtmlAttribute()
    {
        if ($this->url) {
            return '<a href="' . e($this->url) . '" target="_blank">Url Of Lecture </a>';
        } else {
            return '<span style="color: gray;">No Url </span>';
        }
    }
}
