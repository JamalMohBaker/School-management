<?php

namespace App\Http\Controllers;

use App\Models\ExamAnswer as ModelsExamAnswer;
use App\Models\ExamSession;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class ExamAnswer extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // $validated = $request->validate([
        //     'exam_id' => 'required|exists:exams,id',
        //     'answers' => 'required|array',
        //     'answers.*' => 'required|in:A,B,C,D'
        // ]);

        try {
            $userId = Auth::id();
            $examId = $request->exam_id;
            $answers = $request->answers;

            // احصل على exam_session_id الحالي
            $examSession = ExamSession::where('user_id', $userId)
                ->where('exam_id', $examId)
                ->first();

            // إذا لم يكن هناك exam session، أنشئ واحداً جديداً
            if (!$examSession) {
                $examSession = ExamSession::create([
                    'user_id' => $userId,
                    'exam_id' => $examId,
                    'status' => 'in_progress'
                ]);
            }

            foreach ($answers as $questionId => $selectedAnswer) {
                ModelsExamAnswer::updateOrCreate(
                    [
                        'exam_session_id' => $examSession->id,
                        'question_id' => $questionId
                    ],
                    [
                        'answer' => $selectedAnswer,
                        'score' => $this->checkAnswer($questionId, $selectedAnswer) ? '1' : '0'
                    ]
                );
            }
            $this->totalScore($examId);
            return response()->json([
                'success' => true,
                'message' => 'Answers saved successfully'
            ]);
        } catch (\Exception $e) {
            logger()->error('Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' =>'An error occurred while saving your responses'
            ], 500);
        }
    }

    private function checkAnswer($questionId, $selectedAnswer)
    {
        $question = Question::find($questionId);
        return $question->correct_answer === $selectedAnswer;
    }
    private function totalScore($examId){
        $user_id = Auth::id();
        $exam_session = ExamSession::where('exam_id',$examId)
                                       ->where('user_id', $user_id)
                                       ->first();
        $exam_session_id = $exam_session->id;
        $total_score = ModelsExamAnswer::where('exam_session_id',$exam_session_id)->sum('score');
        ExamSession::where('id', $exam_session_id)->update([
            'submitted_at' => now(),
            'total_score' => $total_score
        ])  ;                                       
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
