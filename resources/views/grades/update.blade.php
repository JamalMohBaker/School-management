@extends('layouts.dashboard')
@section('title', __('grade.update_grade'))
@section('styles')

@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{url('grades')}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">{{__('dashboard.main_Page')}}</span> </a></h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('grade.update_grade')}}</li>
            </ol>
        </nav>
    </div>
</div>
<form>
    @csrf
    <div class="row gy-3">
        <div class="col-xl-12">
            <label for="name_grade" class="form-label">{{__('grade.name_of_grade')}}</label>
            <input type="text" class="form-control" id="name_grade" value="{{$grade->name}}">
            <button type="button" onclick="performUpdate()" class="btn btn-primary mt-3 w-100">{{__('grade.save')}}</button>
        </div>
        {{-- <button type="button" onclick="performUpdate()" class="btn btn-primary">Save</button> --}}
    </div>
</form>




@section('scripts')

<script>
    function performUpdate() {
                axios.put('/grades/{{$grade->id}}', {
                name: document.getElementById('name_grade').value
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                window.location.href = '/grades';
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
</script>

@endsection
@endsection