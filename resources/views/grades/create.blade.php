@extends('layouts.dashboard')
@section('title', 'create Grade')
@section('styles')
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboards</a></li>
                <li class="breadcrumb-item active" aria-current="page">add grade</li>
            </ol>
        </nav>
    </div>
</div>
    <form>
        @csrf
        <div class="row gy-3">
            <div class="col-xl-12">
                <label for="name_grade" class="form-label">Name Of Grade</label>
                <input type="text" class="form-control" id="name_grade" placeholder="Name Of Grade">
            </div>
           <button type="button" onclick="performStore()" class="btn btn-primary"> + Add</button>
        </div>
    </form>




    @section('scripts')
        <script src="{{asset('js/axios.js')}}"></script>
        <!-- Toastr -->
        <script src="{{asset('js/toastr.min.js')}}"></script>
        <script>
            function performStore() {
                axios.post('/grades', {
                name: document.getElementById('name_grade').value
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
        </script>
    
    @endsection
@endsection