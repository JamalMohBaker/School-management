@extends('layouts.dashboard')
@section('title', __('dashboard.app_name'))

@section('content')

<div class="text-center mt-2 bg-info-gradient p-1 rounded-pill" >
     {{$exam->title}}
</div>
<div class="d-sm-flex align-items-center mt-2">
    <div>
        Opens
    {{$exam->day_date_with_day}}
    
    </div>
    
    <div class="ms-auto">
        {!! $exam->time_exam['html'] !!}
    </div>
    
</div>
<div class="d-sm-flex align-items-center mt-2">
    <div>
        ⏱️ Duration:
    {{$exam->duration_minutes}}
        minutes
    </div>
    
    <div class="ms-auto">
        ❓ Questions : {{$exam->question_num}}
    </div>
    
</div>
<div class="d-sm-flex align-items-center mt-2">
    <div>
      ⭐ Points per question:
    {{$exam->score}}
    </div>
    
    <div class="ms-auto">
        🏆 Total score : {{$exam->final_score}}
    </div>
    
</div>
<div class="d-sm-flex align-items-center mt-2">
    <div>
        Starts
    {{$exam->formatted_start_at}}
    
    </div>
    
    <div class="ms-auto">
        Closes {{$exam->formatted_end_at}}
    </div>
    
</div>
<div class="text-center mt-2">
    {{-- <a class="bg-success p-3 " href="#">Join Exam</a> --}}
    @if ($session_exam_is_between == 1 && $exam_submited == 0 && ($exam->time_exam['day'] == 'today'))
        <a class="btn btn-success-gradient rounded-pill btn-wave" href="{{route('student.questinExam',$exam->id)}}">Join Exam →</a>
    @else
        <a class="btn btn-info-gradient rounded-pill btn-wave" href="#"> Not available now</a>
    @endif
</div>
@if($exam_submited == 1)
    <div class="table-responsive mt-5">
        <table class="table text-nowrap table-dark">
            <thead>
                <tr>
                    <th colspan="2"> Attempt 1 </th>


                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Status</th>
                    <td>Finished</td>

                </tr>
                <tr>
                    <th>Starts</th>
                    <td>{{$exam_session->start_time_exam}}</td>

                </tr>
                <tr>
                    <th>Closes</th>
                    <td>{{$exam_session->submitted_at}}</td>
                </tr>
                <tr>
                    <th>period</th>
                    <td>{{
                        \Carbon\Carbon::parse($exam_session->start_time_exam)->diff($exam_session->submitted_at)->format('%I
                        M and %S
                        Seconds') }}</td>
                </tr>

            </tbody>
        </table>
    </div>
@endif
@if ($exam_submited == 0 && ($exam->time_exam['day'] == 'past'))
 <div class="alert alert-danger d-flex align-items-center mt-3 mb-2" role="alert">
    <svg class="flex-shrink-0 me-2 svg-danger" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
        height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000">
        <g>
            <rect fill="none" height="24" width="24" />
        </g>
        <g>
            <g>
                <g>
                    <path
                        d="M15.73,3H8.27L3,8.27v7.46L8.27,21h7.46L21,15.73V8.27L15.73,3z M19,14.9L14.9,19H9.1L5,14.9V9.1L9.1,5h5.8L19,9.1V14.9z" />
                    <rect height="6" width="2" x="11" y="7" />
                    <rect height="2" width="2" x="11" y="15" />
                </g>
            </g>
        </g>
    </svg>
    <div>
        Sorry !! The Exam Is Done!
    </div>
</div>   
@endif

@endsection