@extends('layouts.dashboard')
@section('title', __('dashboard.app_name'))
@section('styles')

<style>
   .rating-container {
      max-width: 600px;
      margin: 0 auto;
      text-align: center;
   }

   .stars-container {
      direction: ltr;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      padding: 10px 0;
   }

   .star {
      font-size: 2rem;
      color: #e0e0e0;
      cursor: pointer;
      transition: color 0.2s, transform 0.2s;
      display: inline-block;
   }

   .star:hover,
   .star.active {
      color: #ffc107;
      transform: scale(1.1);
   }

   .rating-text {
      text-align: center;
      margin-top: 10px;
      font-weight: bold;
      color: #6c757d;
      font-size: 1.1rem;
   }
</style>
@endsection
@section('content')
{{-- {{ "Welcome $id" }} --}}

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


   <div class="card custom-card mt-2">
      <h3 class="mt-3 italic">Evaluate Your Teacher</h3>
      <div class="card-header border-bottom-0 pb-0">
         <div class="rating-container">
            <input type="hidden" id="ratingValue" value="0">
            <input type="hidden" id="student_id" value="{{ Auth::id() }}">
            <input type="hidden" id="teacher_id" value="{{$teacher_id}}">

            @if($rating)
            <input type="hidden" id="rating_id" value="{{ $rating->id }}">
            <div class="stars-container" id="starsContainer">
               <span class="star {{ $rating->score >= 1 ? 'active' : '' }}" data-rating="1" data-toggle="tooltip"
                  data-placement="top" title="Bad" onclick="updaterating(1)">
                  <i class="bi bi-star-fill "></i>
               </span>
               <span class="star {{ $rating->score >= 2 ? 'active' : '' }}" data-rating="2" data-toggle="tooltip"
                  data-placement="top" title="Acceptable" onclick="updaterating(2)">
                  <i class="bi bi-star-fill"></i>
               </span>
               <span class="star {{ $rating->score >= 3 ? 'active' : '' }}" data-rating="3" data-toggle="tooltip"
                  data-placement="top" title="Good" onclick="updaterating(3)">
                  <i class="bi bi-star-fill"></i>
               </span>
               <span class="star {{ $rating->score >= 4 ? 'active' : '' }}" data-rating="4" data-toggle="tooltip"
                  data-placement="top" title="Very Good" onclick="updaterating(4)">
                  <i class="bi bi-star-fill"></i>
               </span>
               <span class="star {{ $rating->score >= 5 ? 'active' : '' }}" data-rating="5" data-toggle="tooltip"
                  data-placement="top" title="Excellent" onclick="updaterating(5)">
                  <i class="bi bi-star-fill"></i>
               </span>
            </div>
            @else
            <div class="stars-container" id="starsContainer">
               <span class="star" data-rating="1" data-toggle="tooltip" data-placement="top" title="Bad"
                  onclick="addrating(1)">
                  <i class="bi bi-star-fill"></i>
               </span>
               <span class="star " data-rating="2" data-toggle="tooltip" data-placement="top" title="Acceptable"
                  onclick="addrating(2)">
                  <i class="bi bi-star-fill "></i>
               </span>
               <span class="star" data-rating="3" data-toggle="tooltip" data-placement="top" title="Good"
                  onclick="addrating(3)">
                  <i class="bi bi-star-fill"></i>
               </span>
               <span class="star" data-rating="4" data-toggle="tooltip" data-placement="top" title="Very Good"
                  onclick="addrating(4)">
                  <i class="bi bi-star-fill"></i>
               </span>
               <span class="star" data-rating="5" data-toggle="tooltip" data-placement="top" title="Excellent"
                  onclick="addrating(5)">
                  <i class="bi bi-star-fill"></i>
               </span>
            </div>
            @endif



         </div>
      </div>
   </div>





</div>
@endsection
@section('scripts')

<script>
   document.addEventListener('DOMContentLoaded', function() {
    const starsContainer = document.getElementById('starsContainer');
    const ratingText = document.getElementById('ratingText');
    const submitBtn = document.getElementById('submitRating');
    const ratingInput = document.getElementById('ratingValue');
    
    let currentRating = 0;
    
    // إضافة الأحداث للنجوم
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function() {
            currentRating = parseInt(this.dataset.rating);
            updateStars();
            // updateRatingText();
            ratingInput.value = currentRating;
            // submitBtn.disabled = false;
        });
        
      //   star.addEventListener('mouseover', function() {
      //       const hoverRating = parseInt(this.dataset.rating);
      //       highlightStars(hoverRating);
      //   });
    });
    
   //  starsContainer.addEventListener('mouseleave', function() {
   //      updateStars();
   //  });
    
    function updateStars() {
        document.querySelectorAll('.star').forEach(star => {
            const starRating = parseInt(star.dataset.rating);
            if (starRating <= currentRating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }
    
    function highlightStars(rating) {
        document.querySelectorAll('.star').forEach(star => {
            const starRating = parseInt(star.dataset.rating);
            if (starRating <= rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }
    
    
   });
</script>
<script>
   $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip(); 
   });
</script>
<script>
   function addrating(score){
      axios.post('/rating', {
      student_id:document.getElementById('student_id').value,
      teacher_id:document.getElementById('teacher_id').value,
      score:score,
   })
   .then(function (response) {
   toastr.success(response.data.message);
   })
   .catch(function (error) {
   toastr.error(error.response.data.message);
   });
   }
   function updaterating(score){
   const ratingId = document.getElementById('rating_id').value;
   axios.put(`/rating/${ratingId}`, {
   student_id:document.getElementById('student_id').value,
   teacher_id:document.getElementById('teacher_id').value,
   score:score,
   })
   .then(function (response) {
   toastr.success(response.data.message);
   })
   .catch(function (error) {
   toastr.error(error.response.data.message);
   });
   }
</script>

@endsection