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
    rating-container {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
    }
    
    .stars-container {
    direction: ltr;
    display: flex;
    justify-content: left;
    align-items: center;
    gap: 5px;
    padding: 5px 0;
    }
    
    .star {
    font-size: 2rem;
    color: #e0e0e0;
    cursor: pointer;
    transition: color 0.2s, transform 0.2s;
    display: inline-block;
    }
    
    
    .star.active {
    color: #ffc107;
    transform: scale(1.1);
    }
    
    .rating-text {
    text-align: center;
    margin-top: 10px;
    font-weight: bold;
    color: #6c757d;
    font-size: 1.1rem;
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
                            <th scope="col">Name of Teacher</th>
                            <th scope="col">Email of Teacher</th>
                            <th scope="col">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    {{-- {{ $grade->id }} --}}
                                    {{$teachers->firstItem() + $loop->index}}
                                    {{-- $grades->firstItem() تعطي الرقم الفعلي لأول عنصر في الصفحة الحالية.
                                    $loop->index هو رقم العنصر داخل الحلقة (يبدأ من 0). --}}
                                </div>
                            </th>

                            <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                            <td>{{ $teacher->email }}</td>
                            {{-- <td>{{ $teacher->given_ratings_avg_score }}</td> --}}
                            <td>
                                <div class="stars-container" id="starsContainer">
                                    <span class="star {{ $teacher->given_ratings_avg_score >= 1 ? 'active' : '' }}" data-rating="1" data-toggle="tooltip"
                                        data-placement="top" title="Bad" onclick="updaterating(1)">
                                        <i class="bi bi-star-fill "></i>
                                    </span>
                                    <span class="star {{ $teacher->given_ratings_avg_score >= 2 ? 'active' : '' }}" data-rating="2" data-toggle="tooltip"
                                        data-placement="top" title="Acceptable" onclick="updaterating(2)">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    <span class="star {{ $teacher->given_ratings_avg_score >= 3 ? 'active' : '' }}" data-rating="3" data-toggle="tooltip"
                                        data-placement="top" title="Good" onclick="updaterating(3)">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    <span class="star {{ $teacher->given_ratings_avg_score >= 4 ? 'active' : '' }}" data-rating="4" data-toggle="tooltip"
                                        data-placement="top" title="Very Good" onclick="updaterating(4)">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    <span class="star {{ $teacher->given_ratings_avg_score >= 5 ? 'active' : '' }}" data-rating="5" data-toggle="tooltip"
                                        data-placement="top" title="Excellent" onclick="updaterating(5)">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                <div class="mt-3">
                    {{ $teachers->links() }}
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