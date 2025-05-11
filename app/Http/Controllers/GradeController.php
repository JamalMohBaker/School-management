<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::paginate(3);
        return view('grades.index',
        ['grades' => $grades]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string|min:3',
            // name that the same name in axios not necessary like id 
        ]);
        if(!$validator->fails()){
            $grade = new Grade();
            $grade->name = $request->input('name');
            $isSaved = $grade->save();
            return response()->json([
                'message' => $isSaved ? 'Created Successfully' : 'Create Failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(["message"=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
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
    public function edit(Grade $grade)
    {
        //
        return view(
            'grades.edit',
            ['grade' => $grade]
        );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            // name that the same name in axios not necessary like id 
        ]);
        if (!$validator->fails()) {
            // $grade = new Grade();
            $grade->name = $request->input('name');
            $isSaved = $grade->save();
            return response()->json([
                'message' => $isSaved ? 'Updated Successfully' : 'Update Failed!'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
        $deleted = $grade->delete();
        return response()->json(
            ["message" => $deleted ? 'Deleted Successfully' : 'Delete failed',
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            ]
        );
    }
}
