@extends('layouts.dashboard')
@section('title','Create Exam')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
@if (session('success'))
<div class="alert alert-danger">
    {{ session('failed') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger mt-3">
    <ul>
        
        <li>{{ $errors->first() }}</li>
        
    </ul>
</div>
@endif
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{url('exams')}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">
                All Exams </span> </a></h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> add Exam </li>
            </ol>
        </nav>
    </div>
</div>

<form class="row g-3 mt-0" method="post" action="{{route('exams.store')}}">
    @csrf

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="col-md-6">
            <label for="title" class="form-label"> Tiltle Of Exam </label>
            <input type="text" value="{{ old('title') }}" name="title" class="form-control" id="title" placeholder="English Exam">
        </div>
        <div class="col-md-6">
            <label for="subject_teacher_classrooms" class="form-label"> For any class </label>
            <select class="js-example-basic-single" name="subject_teacher_classrooms" id="subject_teacher_classrooms">
              
                @foreach ($subject_teacher_classrooms as $class_student  )
                <option value="{{$class_student->id}}" {{ old('subject_teacher_classrooms') == $class_student->id ? 'selected' : '' }}> {{$class_student->classroom->grade->name}}
                    {{$class_student->classroom->name}} Class {{$class_student->subject->name}}
                    Language with Teacher {{$class_student->user->first_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="time_duration" class="form-label"> Time Duration </label>
            <input type="text" value="{{ old('time_duration') }}" name="time_duration" class="form-control" id="time_duration" placeholder="45 Min">
        </div>
        <div class="col-md-6">
            <label for="date" class="form-label"> Date </label>
            <input type="date" value="{{ old('date') }}" name="date" class="form-control" id="date" >
        </div>
        <div class="col-md-6">
            <label for="time_open" class="form-label"> Time Open </label>
            <input type="time" value="{{ old('time_open') }}" name="time_open" class="form-control" id="time_open" >
        </div>
        <div class="col-md-6">
            <label for="time_close" class="form-label"> Time Closed </label>
            <input type="time" value="{{ old('time_close') }}" name="time_close" class="form-control" id="time_close" >
        </div>
        
        <div class="col-md-3">
            <label for="question_num" class="form-label"> How Many Questions For Students? </label>
            <input type="text" value="{{ old('question_num') }}" name="question_num" class="form-control" id="question_num" placeholder="10">
        </div>
        <div class="col-md-3">
            <label for="score" class="form-label"> Score Per Question </label>
            <input type="text" value="{{ old('score') }}" name="score" class="form-control" id="score" placeholder="1">
        </div>
        <div class="col-md-3">
            <label for="final_score" class="form-label"> Final Score </label>
            <input type="text" value="{{ old('final_score') }}" name="final_score" class="form-control" id="final_score" placeholder="20">
        </div>
        <div class="col-md-3">
            <label for="show_score" class="form-label"> Show Score </label>
            <select class="js-example-basic-single" name="show_score" id="show_score">
                <option value="1">Yes</option>
                <option value="0" selected>No</option>
            </select>
        
        </div>
        <button type="submit" class="btn btn-primary mt-3 w-100">Next <i class="fa-solid fa-arrow-right"></i></button>

        


  
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
</script>
{{-- <script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2({
    width: '100%' // اجعل الاختيار بعرض الحاوية
    });
    });
    function performStore() {
        
                axios.post('/class_students', {
                user: document.getElementById('user').value,
                classroom: document.getElementById('classroom').value,
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById("add_Classroom_Student").reset();
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
</script> --}}

@endsection
@endsection