@extends('layouts.dashboard')
@section('title','Create Question')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{route('questions.show' ,['question' => $id])}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">
                All Questions </span> </a></h1>
    <div class="ms-md-1 ms-0">
        {{-- {{route('exam.addQuestion' , ['id' => $exam_id,])}} --}}
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> add Question </li>
            </ol>
        </nav>
    </div>
</div>

{{-- <h1>{{ $id }} {{ $title }}</h1> --}}
<div class="text-center fs-18 text-primary" id="questions_count">
    Add Question ({{$questions_count ?: 1 }}) For {{$title}} Exam
</div>

<form class="row g-3 mt-0" id="add_Question">
    @csrf

    <input type="hidden" name="exam_id" id="exam_id" value="{{$id}}">
    <input type="hidden" name="num_of_questions" id="num_of_questions" value="{{$num_of_questions}}">
    <input type="hidden" name="requiredQuestionsCount" id="requiredQuestionsCount" value="{{$requiredQuestionsCount}}">
    <div class="col-md-12">
        <label for="question" class="form-label"> Question {{$questions_count ?: 1 }} </label>
        <input type="text" name="question" class="form-control" id="question" placeholder="question">
    </div>
    <div class="col-md-12">
        <label for="option_A" class="form-label"> option_A</label>
        <input type="text" name="option_A" class="form-control" id="option_A" placeholder="option_A">
    </div>
    <div class="col-md-12">
        <label for="option_B" class="form-label"> option_B</label>
        <input type="text" name="option_B" class="form-control" id="option_B" placeholder="option_B">
    </div>
    <div class="col-md-12">
        <label for="option_C" class="form-label"> option_C</label>
        <input type="text" name="option_C" class="form-control" id="option_C" placeholder="option_C">
    </div>
    <div class="col-md-12">
        <label for="option_D" class="form-label"> option_D</label>
        <input type="text" name="option_D" class="form-control" id="option_D" placeholder="option_D">
    </div>
    {{-- <div class="col-md-12">
        <label for="correctAnswer" class="form-label"> correct Answer </label>
        <input type="text" name="correctAnswer" class="form-control" id="correctAnswer" placeholder="correctAnswer">
    </div> --}}
    <div class="col-md-12">
        <label for="correctAnswer" class="form-label">Correct Answer</label>
        <select name="correctAnswer" class="form-control" id="correctAnswer">
            <option value="" disabled selected>Select the correct answer</option>
            <option value="option_A">option_A</option>
            <option value="option_B">option_B</option>
            <option value="option_C">option_C</option>
            <option value="option_D">option_D</option>
        </select>
    </div>


    <div class="col-md-6">
        <button type="button" onclick="performStore('yes')" style="background-color: #90e0ef" class="btn mt-3 w-100">Add
            another question <i class="fa-solid fa-arrow-right"></i></button>
    </div>
    <div class="col-md-6">
        <button type="button" onclick="performStore('no')" class="btn btn-success mt-3 w-100">Finish <i
                class="fa-solid fa-check"></i></button>
    </div>





</form>




@section('scripts')
<!-- Select2 Cdn -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Internal Select-2.js -->
<script src="{{asset('assets/js/select2.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const num_of_questions = document.getElementById('num_of_questions').value;
        const requiredQuestionsCountValue = document.getElementById('requiredQuestionsCount').value;
        
        console.log(num_of_questions);
        console.log(requiredQuestionsCountValue);
        

    });
</script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2({
    width: '100%' // اجعل الاختيار بعرض الحاوية
    });
    });
    function performStore(anotrherQuestion) {
       const num_of_questions = document.getElementById('num_of_questions').value;
        const requiredQuestionsCountValue = document.getElementById('requiredQuestionsCount').value;
          
        // }
        if (anotrherQuestion === 'no' && num_of_questions < requiredQuestionsCount) { toastr.error(
            `The number of questions must be at least equal to the number of questions that will be shown to the students.`
        );
             return;    
            }
                axios.post('/questions', {
                question: document.getElementById('question').value,
                option_A: document.getElementById('option_A').value,
                option_B: document.getElementById('option_B').value,
                option_C: document.getElementById('option_C').value,
                option_D: document.getElementById('option_D').value,
                correctAnswer: document.getElementById('correctAnswer').value,
                exam_id: document.getElementById('exam_id').value,
                anotrherQuestion:anotrherQuestion,
                })
                .then(function (response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    // تحديث عدد الأسئلة المعروضة
                    // document.getElementById('questions_count').textContent = response.data.questions_count;
                    if (anotrherQuestion === 'yes') {
                    // document.getElementById("add_Question").reset();
                    location.reload();
                    } 
                    else {
                    window.location.href = '/'; // توجيه المستخدم إلى الصفحة الرئيسية
                    }              
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
</script>

@endsection
@endsection