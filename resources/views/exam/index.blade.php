@extends('layouts.dashboard')
@section('title', 'All Exams')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<style>
    #file-export_paginate,
    .dataTables_info {
        display: none !important;
    }
</style>
{{--
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}"> --}}
@endsection
@section('content')
<div class="row">
  @if(session('success'))
    <div class="alert alert-success mt-5" id="success-alert">
        {{ session('success') }}
    </div>
    
    <script>
        // انتظر 5 ثوانٍ ثم قم بإخفاء الرسالة
            setTimeout(function() {
                var alertBox = document.getElementById('success-alert');
                if (alertBox) {
                    alertBox.style.display = 'none';
                }
            }, 5000); // 5000 milliseconds = 5 seconds
    </script>
    @endif
    <div class="col-xl-12 mt-5">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">File Export Datatable</div>
            </div>
            <div class="card-body">
                <table id="file-export" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Subject</th>
                            <th scope="col">For Class </th>
                            <th scope="col">Show Questions</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $exam)
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    {{-- {{ $grade->id }} --}}
                                    {{$exams->firstItem() + $loop->index}}
                                    {{-- $grades->firstItem() تعطي الرقم الفعلي لأول عنصر في الصفحة الحالية.
                                    $loop->index هو رقم العنصر داخل الحلقة (يبدأ من 0). --}}
                                </div>
                            </th>

                            <td>{{ $exam->title }}</td>
                            <td>{{ $exam->subjectTeacherClassroom->subject->name }}</td>
                            <td>{{ $exam->subjectTeacherClassroom->classroom->grade->name }} {{ $exam->subjectTeacherClassroom->classroom->name }}</td>
                            <td><a href="{{route('questions.show', ['question' => $exam->id])}}" class="btn bg-success text-white">Show All Questions</a></td>
                            
                            <td>
                                <div class="hstack gap-2 flex-wrap">
                                    <a href="{{ route('exams.edit', $exam->id) }}" class="text-info fs-14 lh-1"><i
                                            class="ri-edit-line"></i></a>
                                    <a href="#" onclick="confirmDelete('{{$exam->id}}', this)"
                                        class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                <div class="mt-3">
                    {{ $exams->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="position-relative">
    <a href="{{route('exams.create')}}">
        <div class="position-absolute bottom-10 end-0 btn btn-primary">
            + {{__('dashboard.add')}}
        </div>
    </a>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, element){
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                    performDelete(id,element);
                    // Swal.fire({
                    // title: "Deleted!",
                    // text: "Your file has been deleted.",
                    // icon: "success"
                    // });
                }
                });
            }
    
            function performDelete(id, element){
                axios.delete('/exams/' + id)
                .then(function (response){
                    toastr.success(response.data.message);
                    element.closest('tr').remove();
                    // element.closest('tr') اقرب tr الها
                
                })
                .catch(function (error){
                toastr.error(error.response.data.message);
                });
                
            }
</script>
<!-- Datatables Cdn -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- Internal Datatables JS -->
<script src="{{asset('assets/js/datatables.js')}}"></script>

@endsection
@endsection