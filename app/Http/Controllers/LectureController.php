<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lectures = Lecture::paginate(5);
        return view('lectures.index',[
            'lectures'=>$lectures,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $sub_teachers = SubjectTeacher::all();
        return view('lectures.create',[
            'sub_teachers' => $sub_teachers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'title' => 'required|string|max:255',
            'url' => 'nullable|required_without:attachment|url',
            'attachment' => 'nullable|required_without:url',
            'lecture' => 'required|exists:subject_teacher_classroom,id',
            // name that the same name in axios not necessary like id 
        ]);
        if (!$validator->fails()) {
            $lecture = new Lecture();
            $lecture->title = $request->input('title');
            $lecture->url = $request->input('url');
            if($request->hasFile('attachment')){
                $file = $request->file('attachment');
                $path = $file->store('attachment','public');
                $lecture->attachment = $path;
            }
            $lecture->subject_teacher_classroom_id = $request->input('lecture');
            $isSaved = $lecture->save();
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
    public function edit(Lecture $lecture)
    {
        //
        $sub_teachers = SubjectTeacher::all();
        return view('lectures.edit',[
            'lecture' => $lecture,
            'sub_teachers' => $sub_teachers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecture $lecture)
    {
        //
        $validator = Validator($request->all(), [
            'title' => 'required|string|max:255',
            'url' => 'nullable',
            'attachment' => 'nullable',
            'lecture' => 'required|exists:subject_teacher_classroom,id',
            // name that the same name in axios not necessary like id 
        ]);
        if (!$validator->fails()) {
            
            $lecture->title = $request->input('title');
            $lecture->url = $request->input('url');
            if ($request->hasFile('attachment')) {
                // حذف المرفق القديم إن وُجد
                if ($lecture->attachment && Storage::exists($lecture->attachment)) {
                    Storage::delete($lecture->attachment);
                }
                $file = $request->file('attachment');
                $path = $file->store('attachment', 'public');
                $lecture->attachment = $path;
            }
            $lecture->subject_teacher_classroom_id = $request->input('lecture');
            $isSaved = $lecture->save();
            return response()->json([
                'message' => $isSaved ? 'Updated Successfully' : 'updated Failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecture $lecture)
    {
        //
        $deleted = $lecture->delete();
        return response()->json([
            "message" => $deleted ? 'Deleted Successfully':'Deleted Failed!',
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        ]);

    }
}
