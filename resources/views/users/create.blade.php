@extends('layouts.dashboard')
@section('title','Create User')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{url('users')}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">
                All Users </span> </a></h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Add User </li>
            </ol>
        </nav>
    </div>
</div>

    
    <form id="add_user" class="row g-3 mt-0">
        @csrf
        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" id="fname" class="form-control" placeholder="First name" aria-label="First name">
        </div>
        
        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" id="lname" class="form-control" placeholder="Last name" aria-label="Last name">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="email">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" id="password">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Type</label>
            <select name="Type" class="js-example-basic-single" id="type">
                <option value="student">student</option>
                <option value="teacher">teacher</option>
                <option value="admin">admin</option>
                <option value="secretary">secretary</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">National Id</label>
             <input type="text" class="form-control" id="nationalid">
        </div>
       
        
        <div class="col-12">
            <button type="button" onclick="performStore()" class="btn btn-primary w-100">+ {{__('dashboard.add')}}</button>
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
        
                axios.post('/users', {
                fname: document.getElementById('fname').value,
                lname: document.getElementById('lname').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                type: document.getElementById('type').value,
                nationalid: document.getElementById('nationalid').value,
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById("add_user").reset();
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
</script>

@endsection
@endsection