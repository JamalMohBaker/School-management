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
                            <th scope="col">Name</th>
                            <th scope="col">Number Of Student</th>
                            <th scope="col">Result </th>
                            <th scope="col">Status</th>
                            <th scope="col">Detailes</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exam_sessions as $exam_session)
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    {{-- {{ $grade->id }} --}}
                                    {{$exam_sessions->firstItem() + $loop->index}}
                                    {{-- $grades->firstItem() تعطي الرقم الفعلي لأول عنصر في الصفحة الحالية.
                                    $loop->index هو رقم العنصر داخل الحلقة (يبدأ من 0). --}}
                                </div>
                            </th>

                            <td>{{ $exam_session->user->first_name }} {{ $exam_session->user->last_name }}</td>
                            <td>{{ $exam_session->user->national_id }}</td>
                            <td>{{ $exam_session->total_score }} / {{ $final_score}}</td>
                            <td>
                                @if ($exam_session->total_score >= $pass)
                                   <span class="text-success fs-16">Pass</span> 
                                @else
                                <span class="text-danger fs-16">Failed</span>
                                       
                                @endif
                                </td>
                            <td><a href="{{route('exam.answerQuestion', ['user_id' => $exam_session->user->id, 'exam_id' =>$id])}}"
                                    class="btn bg-primary text-white">Show All Questions</a></td>
                           

                          
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                <div class="mt-3">
                    {{ $exam_sessions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>



@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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