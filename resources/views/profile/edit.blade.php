@extends('layouts.dashboard')
@section('title', 'Update user')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href=" {{asset('assets/libs/filepond/filepond.min.css')}} ">
<link rel="stylesheet"
    href="{{asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/dropzone/dropzone.css')}}">
@endsection
@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{url('/')}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">
                Home Page</span> </a></h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Update Profile </li>
            </ol>
        </nav>
    </div>
</div>


<form id="edit_user" class="row g-3 mt-0" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="user_id" value="{{ $user->id }}">
    @if($user->image)
    <input type="hidden" id="old_image" value="{{ asset('storage/' . $user->image) }}">
    @else
    <input type="hidden" id="old_image" value="{{ asset('assets/images/image.jpeg') }}">
    @endif
    <div class="col-md-12">
        <input type="file" class="single-fileupload" name="filepond" id="attachment" accept="image/*">
    </div>
    
    <div class="col-md-6">
        <label class="form-label">First Name</label>
        <input type="text" name="fname" id="fname" class="form-control" value="{{old('fname',$user->first_name)}}"
            aria-label="First name">
    </div>

    <div class="col-md-6">
        <label class="form-label">Last Name</label>
        <input type="text" name="lname" id="lname" class="form-control" value="{{old('lname',$user->last_name)}}"
            aria-label="Last name">
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
        <input type="text" name="nationalid" value="{{old('nationalid',$user->national_id)}}" class="form-control"
            id="nationalid">
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone number</label>
        <input type="text" name="ph_num" value="{{old('ph_num',$user->phone_number)}}" class="form-control" id="ph_num">
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
  
    // function performUpdate() {
    // const userId = document.getElementById('user_id').value;
    
    // // إنشاء FormData object
    // const formData = new FormData();
    
    // // إضافة الحقول النصية
    // formData.append('fname', document.getElementById('fname').value);
    // formData.append('lname', document.getElementById('lname').value);
    // formData.append('email', document.getElementById('email').value);
    // formData.append('password', document.getElementById('password').value);
    // formData.append('nationalid', document.getElementById('nationalid').value);
    // formData.append('ph_num', document.getElementById('ph_num').value);
    // formData.append('age', document.getElementById('age').value);
    // formData.append('address', document.getElementById('address').value);
    
    // // إضافة الصورة إذا تم اختيارها
    // const imageFile = document.getElementById('attachment').files[0];
    // if (imageFile) {
    // formData.append('attachment', imageFile);
    // }
    
    // // إضافة _method للتعامل مع PUT في Laravel
    // formData.append('_method', 'PUT');
    
    // // إرسال البيانات باستخدام axios مع headers مناسبة للملفات
    // axios.post(`/users/${userId}/profile`, formData, {
    // headers: {
    // 'Content-Type': 'multipart/form-data'
    // }
    // })
    // .then(function (response) {
    // console.log(response);
    // toastr.success(response.data.message);
    // // window.location.href = '/users';
    // })
    // .catch(function (error) {
    // console.log(error);
    // toastr.error(error.response.data.message);
    // });
    // }
    function performUpdate() {
    const userId = document.getElementById('user_id').value;
    const formData = new FormData();
    
    // إضافة الحقول النصية
    formData.append('fname', document.getElementById('fname').value);
    formData.append('lname', document.getElementById('lname').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('password', document.getElementById('password').value);
    formData.append('nationalid', document.getElementById('nationalid').value);
    formData.append('ph_num', document.getElementById('ph_num').value);
    formData.append('age', document.getElementById('age').value);
    formData.append('address', document.getElementById('address').value);
    
    // التعامل مع FilePond بدلاً من input مباشر
    const pondInstance = FilePond.find(document.querySelector('.single-fileupload'));
    
    if (pondInstance) {
    const files = pondInstance.getFiles();
    if (files.length > 0) {
    formData.append('attachment', files[0].file);
    // console.log('تم إضافة الصورة:', files[0].file.name);
    } else {
    console.log("No file selected.");
    }
    } else {
    console.log("FilePond instance not found");
    }
    
    // إضافة _method للتعامل مع PUT
    formData.append('_method', 'PUT');
    
    // إرسال البيانات
    axios.post(`/users/${userId}/profile`, formData, {
    headers: {
    'Content-Type': 'multipart/form-data'
    }
    })
    .then(function (response) {
    console.log(response);
    toastr.success(response.data.message);
    // window.location.href = '/users';
    })
    .catch(function (error) {
    console.log(error);
    if (error.response) {
    toastr.error(error.response.data.message || 'خطأ في الاستجابة');
    } else if (error.request) {
    toastr.error('الخادم لم يستجب. ربما الملف كبير جدًا.');
    } else {
    toastr.error('حدث خطأ غير متوقع.');
    }
    });
    }
</script>
<!-- Filepond JS -->
<script src="{{asset('assets/libs/filepond/filepond.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')}}"></script>
<script
    src="{{asset('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')}}">
</script>
<script src="{{asset('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')}}">
</script>
<script src="{{asset('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}">
</script>
<script src="{{asset('assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}">
</script>
<script src="{{asset('assets/libs/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js')}}"></script>
<script src="{{asset('assets/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js')}}"></script>
<!-- Fileupload JS -->
<script src=" {{asset('assets/js/fileupload.js')}} "></script>
<script src="{{asset('assets/libs/dropzone/dropzone-min.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // انتظر حتى يتم تحميل FilePond
    setTimeout(function() {
        // رابط الصورة القديمة
        const oldImageUrl = document.getElementById('old_image').value; // مثال
        
        // إضافة الصورة القديمة
        if (oldImageUrl) {
            // ابحث عن عنصر FilePond وأضف الصورة
            const pond = FilePond.find(document.getElementById('attachment'));
            if (pond) {
                pond.addFile(oldImageUrl);
            }
        }
    }, 100);
});
</script>
@endsection
@endsection