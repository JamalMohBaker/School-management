<?php

namespace App\Http\Middleware;

use App\Models\Exam;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserExam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $current_user_id = Auth::user()->id;
        $exam_id = $request->route('id');

        if(!Exam::where('id',$exam_id)->where('user_id',$current_user_id)->exists()){
           abort(403);
        }
        return $next($request);
    }
}
