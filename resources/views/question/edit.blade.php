@extends('layouts.dashboard')
@section('title','Edit Question')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{route('questions.show' ,['question' => $exam_id,] )}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">
                All Questions </span> </a></h1>
    <div class="ms-md-1 ms-0">
        {{-- {{route('exam.addQuestion' , ['id' => $exam_id,])}} --}}
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Edit Question </li>
            </ol>
        </nav>
    </div>
</div>

{{-- <h1>{{ $id }} {{ $title }}</h1> --}}
<div class="text-center fs-18 text-primary" id="questions_count">
    Edit Question For {{$exam->title}} Exam
</div>

<form class="row g-3 mt-0" id="add_Question">
    @csrf
    @method('PUT')
    <input type="hidden" name="exam_id" id="exam_id" value="{{$exam_id}}">
    {{-- <input type="hidden" name="num_of_questions" id="num_of_questions" value="{{$num_of_questions}}"> --}}
    {{-- <input type="hidden" name="requiredQuestionsCount" id="requiredQuestionsCount"
        value="{{$requiredQuestionsCount}}"> --}}
    <div class="col-md-12">
        <label for="question" class="form-label"> Question </label>
        <input type="text" name="question" class="form-control" id="question"
            value="{{ old('question', $question->the_question) }}">
    </div>
    <div class="col-md-12">
        <label for="option_A" class="form-label"> option_A</label>
        <input type="text" name="option_A" class="form-control" id="option_A"
            value="{{ old('option_A', $question->option_A) }}">
    </div>
    <div class="col-md-12">
        <label for="option_B" class="form-label"> option_B</label>
        <input type="text" name="option_B" class="form-control" id="option_B"
            value="{{ old('option_B', $question->option_B) }}">
    </div>
    <div class="col-md-12">
        <label for="option_C" class="form-label"> option_C</label>
        <input type="text" name="option_C" class="form-control" id="option_C"
            value="{{ old('option_C', $question->option_C) }}">
    </div>
    <div class="col-md-12">
        <label for="option_D" class="form-label"> option_D</label>
        <input type="text" name="option_D" class="form-control" id="option_D"
            value="{{ old('option_D', $question->option_D) }}">
    </div>
    {{-- <div class="col-md-12">
        <label for="correctAnswer" class="form-label"> correct Answer </label>
        <input type="text" name="correctAnswer" class="form-control" id="correctAnswer" placeholder="correctAnswer">
    </div> --}}
    <div class="col-md-12">
        <label for="correctAnswer" class="form-label">Correct Answer</label>
        <select name="correctAnswer" class="form-control" id="correctAnswer">
            @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ old('correctAnswer', $question->correct_answer) == $value ? 'selected' : ''
                }}>
                {{ $label }}
            </option>
            @endforeach
        </select>

    </div>



    <div class="col-md-12">
        <button type="button" onclick="performUpdate({{ $exam_id }}, {{ $question->id }})"
            class="btn btn-success mt-3 w-100">Update Question <i class="fa-solid fa-check"></i></button>
    </div>





</form>




@section('scripts')
<!-- Select2 Cdn -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Internal Select-2.js -->
<script src="{{asset('assets/js/select2.js')}}"></script>

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2({
    width: '100%' // اجعل الاختيار بعرض الحاوية
    });
    });
    function performUpdate(exam_id , questionId) {
             
            
                axios.put(`/questions/${questionId}`, {
                question: document.getElementById('question').value,
                option_A: document.getElementById('option_A').value,
                option_B: document.getElementById('option_B').value,
                option_C: document.getElementById('option_C').value,
                option_D: document.getElementById('option_D').value,
                correctAnswer: document.getElementById('correctAnswer').value,
                exam_id: exam_id,
                // anotrherQuestion:anotrherQuestion,
                })
                .then(function (response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '{{ route('questions.show', ['question' => $exam_id]) }}';                               
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
</script>

@endsection
@endsection