@extends('layouts.dashboard')
@section('title', 'Update user')
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
                <li class="breadcrumb-item active" aria-current="page"> Update User </li>
            </ol>
        </nav>
    </div>
</div>
<form id="edit_user" class="row g-3 mt-0">
    @csrf
    <div class="col-md-6">
        <label class="form-label">First Name</label>
        <input type="text" name="fname" id="fname" class="form-control" value="{{old('fname',$user->first_name)}}" aria-label="First name">
    </div>

    <div class="col-md-6">
        <label class="form-label">Last Name</label>
        <input type="text" name="lname" id="lname" class="form-control" value="{{old('lname',$user->last_name)}}" aria-label="Last name">
    </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" name="email" value="{{old('email',$user->email)}}" class="form-control" id="email">
    </div>
    <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" value="123456" class="form-control" id="password">
    </div>
    
    <div class="col-md-6">
        <label class="form-label">National Id</label>
        <input type="text" name="nationalid" value="{{old('nationalid',$user->national_id)}}" class="form-control" id="nationalid">
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone number</label>
        <input type="text" name="ph_num" value="{{old('ph_num',$user->phone_number)}}" class="form-control" id="ph_num">
    </div>

    <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Type</label>
        <select name="Type" class="js-example-basic-single" id="type">
            <option value="student" @selected('student' == $user->type)>student</option>
            <option value="teacher" @selected('teacher' == $user->type)>teacher</option>
            <option value="admin" @selected('admin' == $user->type)>admin</option>
            <option value="secretary" @selected('secretary' == $user->type)>secretary</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Status</label>
        <select name="status" class="js-example-basic-single" id="status">
            <option value="active" @selected ('active' == $user->status) >Active</option>
            <option value="inactive" @selected ('inactive' == $user->status) >Inactive</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Age</label>
        <input type="text" name="age" value="{{old('age',$user->age)}}" class="form-control" id="age">
    </div>
    <div class="col-md-6">
        <label class="form-label">Address</label>
        <input type="text" name="address" value="{{old('address',$user->address)}}" class="form-control" id="address">
    </div>

    <div class="col-12">
        <button type="button" onclick="performUpdate()" class="btn btn-primary w-100">Save</button>
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
</script>
<script>
 
    function performUpdate() {
    
        axios.put('/users/{{$user->id}}', {
        fname: document.getElementById('fname').value,
        lname: document.getElementById('lname').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        nationalid: document.getElementById('nationalid').value,
        ph_num: document.getElementById('ph_num').value,
        type: document.getElementById('type').value,
        status: document.getElementById('status').value,
        age: document.getElementById('age').value,
        address: document.getElementById('address').value
        })
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        window.location.href = '/users';
        })
        .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data.message);
        });
    }
</script>

@endsection
@endsection