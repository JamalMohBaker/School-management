<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HistoryController extends Controller
{
    //
    public function index(){
        $histories = History::paginate(10);
        return view('history.index',[
            'histories' => $histories,
        ]);
    }

    public function destroy(History $history){
        $deleted = $history->delete();
        return response()->json(
            [
                "message" => $deleted ? 'Deleted Successfully'  : 'Deleted Failed',
                $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            ]
        );
    }
}
