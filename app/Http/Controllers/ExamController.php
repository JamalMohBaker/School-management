<?php

namespace App\Http\Controllers;

use App\Models\ClassroomsStudent;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamSession;
use App\Models\Question;
use App\Models\SubjectTeacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $exams = Exam::where('user_id' , Auth::id())->paginate(5);
        return view('exam.index',[
            'exams' => $exams,
        ]);
    }
    // public function question($id)
    // {
    //     //
    //     $questions = Question::where('exam_id' , $id)->paginate(20);
    //     $exam_id = $id;
    //     return view('exam.allQuestions',[
    //         'questions' => $questions,
    //         'exam_id' => $exam_id,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $subject_teacher_classrooms = SubjectTeacher::where('user_id',Auth::user()->id)->get();
        return view('exam.create',[
            'subject_teacher_classrooms' => $subject_teacher_classrooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            // 'from name in html'
            'title' => 'required|string',
            'subject_teacher_classrooms' => 'required|exists:subject_teacher_classroom,id',
            'time_duration' => 'required|numeric',
            'date' => 'required|string',
            'time_open' => 'required|string',
            'time_close' => 'required|string',
            'question_num' => 'required|numeric',
            'score' => 'required|numeric',
            'final_score' => 'required|numeric',
            // name that the same name in axios not necessary like id 
        ]);
        if (!$validator->fails()) {
            $exam = new Exam();
            // $exam->title -> from Database
            $exam->title = $request->input(key: 'title');
            $exam->subject_teacher_classroom_id = $request->input(key: 'subject_teacher_classrooms');
            $exam->duration_minutes = $request->input(key: 'time_duration');
            $exam->start_at = $request->input(key: 'time_open');
            $exam->end_at = $request->input(key: 'time_close');
            $exam->day_date = $request->input(key: 'date');
            $exam->user_id = Auth::id();
            $exam->question_num = $request->input(key: 'question_num');
            $exam->score = $request->input(key: 'score');
            $exam->final_score = $request->input(key: 'final_score');
            $exam->show_score = $request->input(key: 'show_score');
            $isSaved = $exam->save();
            if($isSaved){
               
                return redirect()->route('exam.addQuestion' , ['id' => $exam->id,]);
            }else{
                session()->flash('failed', 'Created Failed!!');
                return redirect()->route('exams.create');
            }
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
    }
    /**
     * Add Two Function For Questions
     */

    //  public function addQuestion($id){
    //     $exam = Exam::findOrFail($id);
    //     $title = $exam->title;
    //     $requiredQuestionsCount = $exam->question_num;
    //     $questions_count = Question::where('exam_id',$id)->count() + 1;
    //     $num_of_questions = Question::where('exam_id',$id)->count();
    //     return view('exam.addQuestion',[
    //         'id' => $id,
    //         'title' => $title,
    //         'questions_count' => $questions_count,
    //         'requiredQuestionsCount' => $requiredQuestionsCount,
    //         'num_of_questions' => $num_of_questions,
    //     ]);
    //  }

    // public function storeQuestion(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'question' => 'required|string',
    //         'option_A' => 'required|string',
    //         'option_B' => 'required|string',
    //         'option_C' => 'required|string',
    //         'option_D' => 'required|string',
    //         'correctAnswer' => 'required|string',
    //         'exam_id' => 'required|exists:exams,id',
    //     ]);
        
    //     if (!$validator->fails()) {

    //         $question = new Question();
    //         $question->the_question = $request->input('question');
    //         $question->option_A = $request->input('option_A');
    //         $question->option_B = $request->input('option_B');
    //         $question->option_C = $request->input('option_C');
    //         $question->option_D = $request->input('option_D');
    //         $question->correct_answer = $request->input('correctAnswer');
    //         $question->exam_id = $request->input('exam_id');
    //         $isSaved = $question->save();
    //         $anotrherQuestion = $request->input('anotrherQuestion');
    //         if($isSaved){
    //             // $questions_count = Question::where('exam_id', $question->exam_id)->count();
    //             return response()->json([
    //                 'message' => 'Question added successfully!',
    //                 // 'questions_count' => $questions_count,
    //                 'anotrherQuestion' => $anotrherQuestion
    //                 ]);
    //         }else{

    //             return response()->json(['message' => 'Failed to add question.'], 500);
    //         }
            
    //     }else{
    //         return response()->json(['message' => $validator->errors()->first()], 422);
    //     }

        

       
    // }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $exam_sessions = ExamSession::where('exam_id',$id)->paginate(10);
        // $user_id = $exam_session->user_id;
        // $users = User::where('id', $user_id)->get();
        $exam = Exam::where('id', $id)->firstOrFail();
        $final_score = $exam->final_score;
        $pass = $final_score/2;
        return view('exam.show',[
            'exam_sessions' => $exam_sessions,
            'id' => $id,
            'final_score' => $final_score,
            'pass' => $pass,
        ]);
    }
    public function answerQuestion($user_id,$exam_id){
        $exam_session = ExamSession::where('user_id',$user_id)
                                    ->where('exam_id',$exam_id)->firstOrFail();
        $user = User::where('id',$user_id)->first();
        $exam = Exam::where('id',$exam_id)->first();
        $examanswers = ExamAnswer::where('exam_session_id',$exam_session->id)->paginate(10);
        return view('exam.answerQuestion',
        [
            'user' => $user,
            'exam' => $exam,
            'examanswers' => $examanswers
        ])  ;                                  
    }
    
    public function updateQuestion(Request $request , Question $question)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'option_A' => 'required|string',
            'option_B' => 'required|string',
            'option_C' => 'required|string',
            'option_D' => 'required|string',
            'correctAnswer' => 'required|string',
            'exam_id' => 'required|exists:exams,id',
        ]);

        if (!$validator->fails()) {

            // $question = new Question();
            $question->the_question = $request->input('question');
            $question->option_A = $request->input('option_A');
            $question->option_B = $request->input('option_B');
            $question->option_C = $request->input('option_C');
            $question->option_D = $request->input('option_D');
            $question->correct_answer = $request->input('correctAnswer');
            $question->exam_id = $request->input('exam_id');
            $isSaved = $question->save();
            
            if ($isSaved) {
                // $questions_count = Question::where('exam_id', $question->exam_id)->count();
                return response()->json(['message' => 'Question Updated successfully!',]);
            } else {

                return response()->json(['message' => 'Failed to add question.'], 500);
            }
        } else {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
        $subject_teacher_classrooms = SubjectTeacher::where('user_id', Auth::user()->id)->get();

        return view('exam.edit',[
            'exam' => $exam,
            'subject_teacher_classrooms' => $subject_teacher_classrooms,
        ]);

    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
        $id = $exam->id;
        $num_questions =  Question::where('exam_id', $id)->count();
        $validator = Validator::make($request->all(), [
            // 'from name in html'
            'title' => 'required|string',
            'subject_teacher_classrooms' => 'required|exists:subject_teacher_classroom,id',
            'time_duration' => 'required|numeric',
            'date' => 'required|string',
            'time_open' => 'required|string',
            'time_close' => 'required|string',
            'question_num' => 'required|numeric|max:' . $num_questions,
            'score' => 'required|numeric',
            'final_score' => 'required|numeric',
            // name that the same name in axios not necessary like id 
        ], [
            'question_num.max' => 'The number of questions that will be displayed to the students must be less than or equal to the total number of questions, which is '.$num_questions,
        ]);
        if (!$validator->fails()) {
            // $exam = new Exam();
            // $exam->title -> from Database
            $exam->title = $request->input(key: 'title');
            $exam->subject_teacher_classroom_id = $request->input(key: 'subject_teacher_classrooms');
            $exam->duration_minutes = $request->input(key: 'time_duration');
            $exam->start_at = $request->input(key: 'time_open');
            $exam->end_at = $request->input(key: 'time_close');
            $exam->day_date = $request->input(key: 'date');
            $exam->user_id = Auth::id();
            $exam->question_num = $request->input(key: 'question_num');
            $exam->score = $request->input(key: 'score');
            $exam->final_score = $request->input(key: 'final_score');
            $exam->show_score = $request->input(key: 'show_score');
            $isSaved = $exam->save();
            if ($isSaved) {
                session()->flash('success', 'Updateed Successfully!!');
                return redirect()->route('exams.index');
            } else {
                session()->flash('failed', 'Created Failed!!');
                return redirect()->back();
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
        $deleted = $exam->delete();
        return response()->json(
            [
                "message" => $deleted ? 'Deleted Successfully' : 'Deleted Failed',
                $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            ]
            );
    }
    

}
