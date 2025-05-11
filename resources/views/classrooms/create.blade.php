@extends('layouts.dashboard')
@section('title',__('classroom.create_classroom'))
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{url('classrooms')}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">
                {{__('classroom.all_of_class')}} </span> </a></h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{__('dashboard.add_class')}} </li>
            </ol>
        </nav>
    </div>
</div>
<form id="add_classroom">
    @csrf
    <div class="row gy-3">
        <div class="col-xl-12">
            <label for="name_classroom" class="form-label "> {{__('classroom.name_of_class')}} </label>
            <input type="text" class="form-control" id="name_classroom" placeholder="{{__('classroom.name_of_class')}}">
           <label for="name_grade" class="form-label mt-3"> {{__('grade.name_of_grade')}} </label>
            <select class="js-example-basic-single"  name="grade" id="grade_id">
                <option value="s-1">{{__('grade.name_of_grade')}}</option>
                @foreach ($grades as $grade )
                    <option value="{{$grade->id}}">{{$grade->name}}</option>
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
        
                axios.post('/classrooms', {
                name_classroom: document.getElementById('name_classroom').value,
                grade_id: document.getElementById('grade_id').value
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById("add_classroom").reset();
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
</script>

@endsection
@endsection