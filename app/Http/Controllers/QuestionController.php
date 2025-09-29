<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
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
    public function addQuestion($id)
    {
        $exam = Exam::findOrFail($id);
        $title = $exam->title;
        $requiredQuestionsCount = $exam->question_num;
        $questions_count = Question::where('exam_id', $id)->count() + 1;
        $num_of_questions = Question::where('exam_id', $id)->count() + 2;
        return view('question.create', [
            'id' => $id,
            'title' => $title,
            'questions_count' => $questions_count,
            'requiredQuestionsCount' => $requiredQuestionsCount,
            'num_of_questions' => $num_of_questions,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

            $question = new Question();
            $question->the_question = $request->input('question');
            $question->option_A = $request->input('option_A');
            $question->option_B = $request->input('option_B');
            $question->option_C = $request->input('option_C');
            $question->option_D = $request->input('option_D');
            $question->correct_answer = $request->input('correctAnswer');
            $question->exam_id = $request->input('exam_id');
            $isSaved = $question->save();
            $anotrherQuestion = $request->input('anotrherQuestion');
            if ($isSaved) {
                // $questions_count = Question::where('exam_id', $question->exam_id)->count();
                return response()->json([
                    'message' => 'Question added successfully!',
                    // 'questions_count' => $questions_count,
                    'anotrherQuestion' => $anotrherQuestion
                ]);
            } else {

                return response()->json(['message' => 'Failed to add question.'], 500);
            }
        } else {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $questions = Question::where('exam_id', $id)->paginate(10);
        $exam_id = $id;
        return view('question.allQuestions', [
            'questions' => $questions,
            'exam_id' => $exam_id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
   
    public function edit(Question $question)
    {
        $exam_id = $question->exam_id;
        $exam = Exam::find($exam_id);
        $options = [
            'option_A' => 'option_A ',
            'option_B' => 'option_B',
            'option_C' => 'option_C',
            'option_D' => 'option_D',
        ];
        // $title = $exam->title;
        return view('question.edit', [
            'question' => $question,
            'exam' => $exam,
            'exam_id' => $exam_id,
            'options' => $options,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
  
    public function update(Request $request, Question $question)
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
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
        $exam_id = $question->exam_id;
        $exam = Exam::findOrFail($exam_id);
        $requiredQuestionsCount = $exam->question_num;
        $num_of_questions = Question::where('exam_id', $exam_id)->count();
        if ($num_of_questions <= $requiredQuestionsCount) {
            return response()->json(
                [
                    "message" => 'Cannot delete. The number of questions is at or below the required count.',
                ],
                Response::HTTP_BAD_REQUEST
            );
        } else {
            $deleted = $question->delete();
            return response()->json(
                [
                    "message" => $deleted ? 'Deleted Successfully' : 'Deleted Failed',
                    $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
                ]
            );
            }
    }
}
