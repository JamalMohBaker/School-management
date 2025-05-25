<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
class Sub_teacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sub_teachers = SubjectTeacher::paginate(5);
        $grads = Grade::all();
        return view('subTeacher.index',[
            'sub_teachers' => $sub_teachers,
            'grads' => $grads,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $classrooms = Classroom::with('grade')->get();
        $subjects = Subject::all();
        $teachers = User::where('type', 'teacher')->where('status','active')->get();
        return view('subTeacher.create',[
            'classrooms' => $classrooms,
            'subjects' => $subjects,
            'teachers' => $teachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request )
    {
        //
        $validator = Validator($request->all(),[
            'description' => 'required|string',
            'classroom' => 'required|exists:classrooms,id',
            'subject' => 'required|exists:subjects,id',
            'teacher' => 'required|exists:users,id',
        ]);
        if(!$validator->fails()){
            $SubjectTeacher = new SubjectTeacher();
            $SubjectTeacher->description = $request->input('description');
            $SubjectTeacher->classroom_id  = $request->input('classroom');
            $SubjectTeacher->subject_id = $request->input('subject');
            $SubjectTeacher->user_id = $request->input('teacher');
            $isSaved = $SubjectTeacher->save();
            return response()->json([
                "message" => $isSaved ? 'Created Successfully':'Failed Created!',
                $isSaved ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST
            ]);
        }else{
            return response()->json(["message" => $validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
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
    public function destroy(SubjectTeacher $sub_teacher)
    {
        $deleted = $sub_teacher->forceDelete();

        return response()->json(
            [
                "message" => $deleted ? 'Deleted Successfully' : 'Deleted Failed'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
        // dd($subject_teacher);
        // $deleted = $subject_teacher->delete();
        // if ($deleted) {
        //     return response()->json([
        //         "message" => "Deleted Successfully"
        //     ], Response::HTTP_OK);
        // } else {
        //     return response()->json([
        //         "message" => "Deletion Failed"
        //     ], Response::HTTP_BAD_REQUEST);
        // }
        // return response()->json(
        //     [
        //         "message" => $deleted ? 'Deleted Successfully'  : 'Deleted Failed',
        //         $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        //     ]
        // );
        // $deleted = $subject_teacher->delete();
       
        // return response()->json([
        //     "message" => $deleted ?  'Deleted Successfully'  : 'Deleted Failed',
            
        // ],
        //     $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
