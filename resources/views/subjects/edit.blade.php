@extends('layouts.dashboard')
@section('title', 'Update subject')
@section('styles')

@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{url('subjects')}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">
                All Subjects </span> </a></h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Update Subject </li>
            </ol>
        </nav>
    </div>
</div>
<form id="edit_subject">
    @csrf
    <div class="row gy-3">
        <div class="col-xl-12">
            <label for="name_subject" class="form-label"> Name_Of_Subject </label>
            <input type="text" class="form-control" id="name_subject" name="name_subject" value="{{old('name_subject',$subject->name)}}" >
            <br>
            <label for="code_subject" class="form-label"> Code_Of_Subject </label>
            <input type="text" class="form-control" id="code_subject" name="code_subject" value="{{old('code_subject', $subject->code)}}">
            <button type="button" onclick="performUpdate()" class="btn btn-primary mt-3 w-100"> Save
                </button>
        </div>

    </div>
</form>




@section('scripts')

<script>
    function performUpdate() {
        
                axios.put('/subjects/{{$subject->id}}', {
                name_subject: document.getElementById('name_subject').value,
                code_subject: document.getElementById('code_subject').value,
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                window.location.href = '/subjects';
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
</script>

@endsection
@endsection