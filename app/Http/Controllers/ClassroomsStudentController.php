<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassroomsStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ClassroomsStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $class_students = ClassroomsStudent::paginate(4);
        return view('classStudent.index',[
            'class_students' => $class_students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $classrooms = Classroom::all();
        $users = User::where('type','student')->get();
        return view('classStudent.create',[
            'classrooms' => $classrooms,
            'users' =>  $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'user' => 'required|exists:users,id',
            'classroom' => 'required|exists:classrooms,id',
            // name that the same name in axios not necessary like id 
        ]);
        if (!$validator->fails()) {
            $classroom_student = new ClassroomsStudent();
            $classroom_student->user_id = $request->input('user');
            $classroom_student->classroom_id = $request->input('classroom');
            $isSaved = $classroom_student->save();
            return response()->json([
                'message' => $isSaved ? 'Created Successfully' : 'Create Failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
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
    public function edit($classroom_id, $user_id)
    {
        //
        $class_student = DB::table('classroom_student')
            ->where('classroom_id', $classroom_id)
            ->where('user_id', $user_id)
            ->first();
        if (! $class_student) {
            abort(404);
        }
        $classrooms = Classroom::all();
        $users = User::where('type', 'student')->get();
        return view('classStudent.edit', [
            'classrooms' => $classrooms,
            'users' =>  $users,
            'class_student' =>  $class_student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $classroom_id, $user_id)
    {
        //
        $validator = Validator($request->all(), [
            'user' => 'required|exists:users,id',
            'classroom' => 'required|exists:classrooms,id',
            // name that the same name in axios not necessary like id 
        ]);
        if (!$validator->fails()) {
            try {
                DB::transaction(function () use ($request, $classroom_id, $user_id) {
                    DB::table('classroom_student')
                        ->where('classroom_id', $classroom_id)
                        ->where('user_id', $user_id)
                        ->delete();

                    $inserted = DB::table('classroom_student')->insert([
                        'user_id' => $request->user,
                        'classroom_id' => $request->classroom,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    if (!$inserted) {
                        // ترمي استثناء لو الإدخال فشل
                        throw new \Exception('Insert failed');
                    }
                });

                return response()->json([
                    'message' => 'Updated Successfully'
                ], Response::HTTP_CREATED);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Update Failed! ' . $e->getMessage()
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                "message" => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
        // if (!$validator->fails()) {
            
        //     // $classroom_student = new ClassroomsStudent();
        //      DB::transaction(function () use ($request, $classroom_id, $user_id) {
        //         DB::table('classroom_student')
        //             ->where('classroom_id', $classroom_id)
        //             ->where('user_id', $user_id)
        //             ->delete();

        //         DB::table('classroom_student')->insert([
        //             'user_id' => $request->user,
        //             'classroom_id' => $request->classroom,
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
               
        //     });
        //     return response()->json([
        //         'message' => $isSaved ? 'Updated Successfully' : 'Update Failed!'
        //     ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        // } else {
        //     return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request)
    {
        // $classroomId = $classroom_id;
        // $userId = $user_id;
        $classroomId = $request->input('classroom_id');
        $userId = $request->input('user_id');

        if (!$classroomId || !$userId) {
            return response()->json(['message' => 'Missing classroom_id or user_id'], 400);
        }

        try {
            $deleted = DB::table('classroom_student')
                ->where('classroom_id', $classroomId)
                ->where('user_id', $userId)
                ->delete();

            if ($deleted) {
                return response()->json(['message' => 'Student Deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'Record not found.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Delete failed: ' . $e->getMessage()], 500);
        }
    }
}
