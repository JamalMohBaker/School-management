@extends('layouts.dashboard')
@section('title','Edit Lecteure')
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
    <h1 class="page-title fw-semibold fs-18 mb-0"><a href="{{url('lectures')}}">
            <i class="fa-solid fa-circle-left " style="color: #9933FF;"></i> <span class="ml-2">
                All Of Lecteures </span> </a></h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('dashboard.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Edit Lecteure</li>
            </ol>
        </nav>
    </div>
</div>
<form id="edit_lecture">
    @csrf
    <div class="row gy-3">
        <div class="col-xl-12">
            <label for="title" class="form-label "> Tiltle Of Lecture </label>
            <input type="text" name="title" class="form-control" id="title" value="{{$lecture->title}}">
            <label for="url" class="form-label "> Url Of Lecture </label>
            <input type="text" name="url" class="form-control" id="url" value="{{$lecture->url}}">
            <label for="attachment" class="form-label">Attachment (Image or Video)</label>
            {{-- <input type="file" name="attachment" class="form-control" id="attachment" accept="image/*,video/*">
            --}}
            @if($lecture->attachment)
            <p> <a style="color: blue;" href="{{ asset('storage/' . $lecture->attachment) }}" target="_blank">Current attachment:</a></p>
            @endif
            <input type="file" class="single-fileupload" name="filepond" id="attachment" value="{{$lecture->attachment}}">
            <label for="lecture" class="form-label mt-3"> This Lecture For : </label>
            <select class="js-example-basic-single" name="lecture" id="lecture">
                @foreach ($sub_teachers as $sub_teacher )
                <option value="{{$sub_teacher->id}}" @selected ($sub_teacher->id == $lecture->SubjectTeacher->id ) >Teacher {{$sub_teacher->user->first_name}} {{$sub_teacher->subject->name}} Language For Grade {{$sub_teacher->classroom->grade->name}} {{$sub_teacher->classroom->name}}</option>
                @endforeach

            </select>
            <button type="button" onclick="performUpdate({{$lecture->id}})" class="btn btn-primary mt-3 w-100"> 
                {{__('dashboard.save')}}</button>
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
    
    function performUpdate(lectureId) {
            const formData = new FormData();
                formData.append('title',document.getElementById('title').value);
                formData.append('url',document.getElementById('url').value);
                formData.append('lecture',document.getElementById('lecture').value);
                const attachmentInput = document.getElementById('attachment');
                formData.append('_method', 'PUT');
               // الوصول إلى FilePond الحالي بدلاً من إنشاء واحد جديد
                const pondInstance = FilePond.find(document.querySelector('.single-fileupload'));
                const files = pondInstance ? pondInstance.getFiles() : [];
                if ( files.length > 0) {
                formData.append('attachment', files[0].file); 
                }else {
                console.log("No file selected.");
                }
                axios.post(`/lectures/${lectureId}`, formData, {
                 headers: {
                    'Content-Type': 'multipart/form-data',
                    }
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                window.location.href = '/lectures';
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
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

@endsection
@endsection