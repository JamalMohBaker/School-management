@extends('layouts.dashboard')
@section('title', 'create Grade')
@section('styles')

@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{url('grades')}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2"> {{__('dashboard.main_Page')}} </span> </a></h1>    
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> {{__('dashboard.add_grade')}} </li>
                </ol>
            </nav>
        </div>
</div>
    <form id="add_grade">
        @csrf
        <div class="row gy-3">
            <div class="col-xl-12">
                <label for="name_grade" class="form-label"> {{__('grade.name_of_grade')}} </label>
                <input type="text" class="form-control" id="name_grade" placeholder="{{__('grade.name_of_grade')}}">
                <button type="button" onclick="performStore()" class="btn btn-primary mt-3 w-100"> + {{__('grade.add')}}</button>
            </div>
          
        </div>
    </form>




    @section('scripts')
        
        <script>
            function performStore() {
                axios.post('/grades', {
                name: document.getElementById('name_grade').value
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById("add_grade").reset();
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
        </script>
    
    @endsection
@endsection