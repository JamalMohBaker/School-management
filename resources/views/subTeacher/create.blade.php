@extends('layouts.dashboard')
@section('title','Create subject for teacher classroom')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{url('sub_teachers')}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">
                All Of Subject For Teacher Classroom </span> </a></h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> add Subject_teacher </li>
            </ol>
        </nav>
    </div>
</div>
<form id="add_Subject_teacher">
    @csrf
    <div class="row gy-3">
        <div class="col-xl-12">
            <label for="description" class="form-label "> Description </label>
            <input type="text" class="form-control" id="description" placeholder="Ex:add teacher ali for classeoom 5 for english language">
            <label for="classroom" class="form-label mt-3"> classroom </label>
            <select class="js-example-basic-single" name="classroom" id="classroom">
                <option value="s-1"></option>
                @foreach ($classrooms as $classroom )
                <option value="{{$classroom->id}}">{{$classroom->grade->name}} {{$classroom->name }} </option>
                @endforeach
            </select>
            <label for="Subject" class="form-label mt-3"> Subject </label>
            <select class="js-example-basic-single" name="subject" id="subject">
                <option value="s-1"></option>
                @foreach ($subjects as $subject )
                <option value="{{$subject->id}}"> {{$subject->name }} that code {{$subject->code}} </option>
                @endforeach
            </select>
            <label for="Teacher" class="form-label mt-3"> Teacher </label>
            <select class="js-example-basic-single" name="teacher" id="teacher">
                <option value="s-1"></option>
                @foreach ($teachers as $teacher )
                <option value="{{$teacher->id}}"> {{$teacher->first_name }}  </option>
                @endforeach
            </select>
            <button type="button" onclick="performStore()" class="btn btn-primary mt-3 w-100"> +
                {{__('dashboard.add')}}</button>
        </div>

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
    function performStore() {
        
                axios.post('/sub_teachers', {
                description: document.getElementById('description').value,
                classroom: document.getElementById('classroom').value,
                subject: document.getElementById('subject').value,
                teacher: document.getElementById('teacher').value
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById("add_Subject_teacher").reset();
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
</script>

@endsection
@endsection