<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teachers = User::teachers() // scope لجلب المدرسين فقط
            ->withAvg('givenRatings', 'score') // متوسط التقييمات
            ->withCount('givenRatings') // عدد التقييمات
            ->orderBy('given_ratings_avg_score', 'DESC') // ترتيب حسب الأعلى تقييماً
            ->paginate(10);
        return view('rating.index', [
            'teachers' => $teachers,
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
            $rating = new Rating();
            $rating->student_id = $request->input('student_id');
            $rating->teacher_id = $request->input('teacher_id');
            $rating->score = $request->input('score');  
            $isSaved = $rating->save();
            return response()->json([
                'message' => $isSaved ? 'Thank you for your rating!' : 'Rating submission failed. Please try again.'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
    public function update(Request $request, Rating $rating)
    {
        //
        $rating->student_id = $request->input('student_id');
        $rating->teacher_id = $request->input('teacher_id');
        $rating->score = $request->input('score');
        $isSaved = $rating->save();
        return response()->json([
            'message' => $isSaved ? 'Thank you for your rating!' : 'Rating submission failed. Please try again.'
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
