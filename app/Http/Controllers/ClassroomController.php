<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $classrooms = Classroom::with('grade')->paginate(3);
        return view(
            'classrooms.index',
            ['classrooms' => $classrooms]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $grades = Grade::all();
        return view('classrooms.create',
        ['grades' => $grades]
    );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name_classroom' => 'required|string|max:3',
            'grade_id' => 'required|exists:grades,id',
            // name that the same name in axios not necessary like id 
        ]);
        if (!$validator->fails()) {
            $classroom = new Classroom();
            $classroom->name = $request->input('name_classroom');
            $classroom->grade_id = $request->input('grade_id');
            $isSaved = $classroom->save();
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
    public function edit(Classroom $classroom)
    {
        $classroom->load('grade'); // تحميل العلاقة
        $grades = Grade::all();    // جميع المراحل لاستخدامها في <select>
        return view('classrooms.edit',[
            'classroom' => $classroom,
            'grades' => $grades,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
        $validator = Validator($request->all(), [
            'name_classroom' => 'required|string|max:3',
            'grade_id' => 'required|exists:grades,id',
            // name that the same name in axios not necessary like id 
        ]);
        if (!$validator->fails()) {
            $classroom->name = $request->input('name_classroom');
            $classroom->grade_id = $request->input('grade_id');
            $isSaved = $classroom->save();
            return response()->json([
                'message' => $isSaved ? 'Updated Successfully' : 'Updated Failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
        $deleted = $classroom->delete();
        return response()->json(
            [
                "message" => $deleted ? 'Deleted Successfully' : 'Delete failed',
                $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            ]
        );
    }
}
