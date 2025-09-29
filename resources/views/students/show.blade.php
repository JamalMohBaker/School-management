@extends('layouts.dashboard')
@section('title', __('dashboard.app_name'))

@section('content')
{{-- {{ "Welcome $id"  }} --}}

<div class="accordion accordion-secondary row" id="accordionSecondaryExample">
  
   <div class="accordion-item col-sm-6">
      <h2 class="accordion-header" id="headingSecondaryOne">
         <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSecondaryOne"
            aria-expanded="true" aria-controls="collapseSecondaryOne">
            Lectures 
         </button>
      </h2>
      <div id="collapseSecondaryOne" class="accordion-collapse collapse show" aria-labelledby="headingSecondaryOne"
         data-bs-parent="#accordionSecondaryExample">
         <div class="accordion-body">
            @foreach ($lectures as $lecture)
            <div class="mt-3">
               <div class="p-2">
                 {{-- Lecture {{$lectures->firstItem() + $loop->index}} --}}
                 Lecture {{ $loop->iteration }}
               </div>
               <div class="p-2">
                  Name Of Lecture / {{$lecture->title}}
               </div>
               @if ($lecture->attachment)
                  <div class="p-2">{!! $lecture->media_html !!}</div>
               @endif
               @if ($lecture->url)
                  <div class="p-2 btn btn-info"> {!! $lecture->url_html !!}</div>
               @endif
            </div>
            <div class="p-2">
               ______________________________________________
            </div>
            @endforeach
         </div>
      </div>
   </div>
   <div class="accordion-item col-sm-6">
      <h2 class="accordion-header" id="headingSecondaryTwo">
         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseSecondaryTwo" aria-expanded="false" aria-controls="collapseSecondaryTwo">
            Exams
         </button>
      </h2>
      <div id="collapseSecondaryTwo" class="accordion-collapse collapse" aria-labelledby="headingSecondaryTwo"
         data-bs-parent="#accordionSecondaryExample">
         <div class="accordion-body">
           @if($exams->count() > 0)
               @foreach ($exams as $exam)
               <div class="d-sm-flex align-items-center mt-2">
                  <div>
                     Open On
                     {{$exam->day_date_with_day}}
                  </div>
                  <div class="ms-auto">
                     Exam Period:
                     {{$exam->formatted_start_at}}
                     -
                     {{$exam->formatted_end_at}}
                  </div>
               </div>
               <div>
                  {!! $exam->time_exam['html'] !!}
               </div>
                     <a class="p-2 btn btn-info d-block mt-1" href="{{route('student.info',$exam->id)}}"> {{$exam->title}} </a>
               @endforeach
           @else
            <div class="text-center p-4">
               <p class="text-info">No exams available!</p>

            </div>
           @endif
         </div>
      </div>
   </div>
   
</div>
@endsection