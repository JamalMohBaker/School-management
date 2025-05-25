<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subjects = Subject::paginate(5);
        return view('subjects.index',[
            'subjects' => $subjects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = validator($request->all(),[
            'name_subject' => 'required|string',
            'code_subject' => 'required|string|unique:subjects,code',
        ]);
        if(!$validator->fails()){
            $subject = new Subject();
            $subject->name = $request->input('name_subject');
            $subject->code = $request->input('code_subject');
            $isSaved = $subject->save();
            return response()->json([
                'message' => $isSaved ? 'Created Successfully': 'Created Failed!' 
            ], $isSaved ?Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
        }else{
            return response()->json(['message' => $validator->getMessageBag()->first()] , Response::HTTP_BAD_REQUEST);
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
    public function edit(Subject $subject)
    {
        //
        return view('subjects.edit',[
            'subject' => $subject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $validator = validator($request->all(), [
            'name_subject' => 'required|string',
            'code_subject' => 'required|string|unique:subjects,code',
        ]);
        if (!$validator->fails()) {
            $subject->name = $request->input('name_subject');
            $subject->code = $request->input('code_subject');
            $isSaved = $subject->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Updated Successfully' : 'Updated Failed!'
                ],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
        $deleted = $subject->delete();
        return response()->json([
            "message" => $deleted ? 'Deleted Successfully' : 'Deleted Failed',
           $deleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST
        ]);
        
    }
}
