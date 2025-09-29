<?php

namespace App\Http\Controllers;

use App\Models\ClassroomsStudent;
use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\Lecture;
use App\Models\Question;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $students = User::where('id', Auth::id())->get();
        $subject_teachers = SubjectTeacher::whereHas('classroom.classroom_student', function($query){
            $query->where('user_id',Auth::id());
        })->get();
        return view('students.index',[
            'subject_teachers' => $subject_teachers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $subject_teachers = SubjectTeacher::where('subject_teacher_classroom_id', $id)->get();
    //     return view('students.show', [
    //         'subject_teachers' => $subject_teachers,
    //         'id' => $id,
    //     ]);
    // }
    public function show($id)
    {
        // أزل المسافة الزائدة بعد subject_teacher_classroom_id
        $lectures = Lecture::where('subject_teacher_classroom_id', $id)->get();
        $exams = Exam::where('subject_teacher_classroom_id', $id)->get();

        return view('students.show', [
            'lectures' => $lectures,
            'exams' => $exams,
            
        ]);
    }
    public function information($id){
        $exam = Exam::where('id',$id)->first();
        $startExam = $exam->start_at;
        $endExam = $exam->end_at;
        $session_exam_is_between =0;
        $now= now()->format('H:i:s');
        $today = Carbon::now()->format('d-m-y l');
        $nowCarbon = Carbon::createFromFormat('H:i:s', $now);
      
        $exam_session = ExamSession::where('exam_id', $exam->id)
                                    ->where('user_id',Auth::id())
                                    ->first();
        if(now()->between($exam->start_at, $exam->end_at)) {
            $session_exam_is_between = 1;
        }                           
        // $exam_submited=0;                             
        // if($exam_session->submitted_at){
        //     $exam_submited = 1;
        // }   
        $exam_submited = isset($exam_session->submitted_at) ? 1 : 0;                        
        return view('students.information',[
            'exam' => $exam,
            'startExam' => $startExam,
            'endExam' => $endExam,
            'session_exam_is_between' => $session_exam_is_between,
            'nowCarbon' => $nowCarbon,
            'today' => $today,
            'exam_session' => $exam_session,
            'exam_submited' => $exam_submited,
            
        
        ]);
    }
    public function questinExam($id){
        $exam = Exam::where('id',$id)->first();
        // التحقق من وجود الامتحان
        if (!$exam) {
            return redirect()->back()->with('error', 'Exam not found');
        }
        $num_of_questions = $exam->question_num;
        $allQuestions = Question::where('exam_id',$id)
                                ->orderBy(DB::raw('RAND()'))
                                ->limit($num_of_questions)    
                                ->get();
        
        $exam_session = ExamSession::where('exam_id',$id)
                                    ->where('user_id', Auth::id())
                                    ->first();
        if(!$exam_session){
            $exam_session = ExamSession::create([
                'exam_id' => $id,
                'user_id' => Auth::id(),
                'start_time_exam' => now(),
            ]);
            
        } elseif (!$exam_session->start_time_exam) {
            $exam_session->update(['start_time_exam' => now()]);
        }
        $exam_session->refresh();

        $startTimeFromDB = $exam_session->start_time_exam ?: now();
  
        // حساب وقت الانتهاء بناءً على وقت البدء من الجلسة
        $duration = (int)$exam->duration_minutes;
        $endTime = $startTimeFromDB->copy()->addMinutes($duration);
       

        $startTime = $startTimeFromDB->format('g:i:s A');
        return view('students.questionExam',[
            'exam' => $exam,
            'allQuestions' => $allQuestions,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'duration' => $duration,
            'exam_session' => $exam_session,
           
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
