@extends('layouts.dashboard')
@section('title', 'History')
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
                            <th scope="col">Description</th>
                            <th scope="col">Performed By</th>
                            <th scope="col">Type Of Operation</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    {{-- {{ $grade->id }} --}}
                                    {{$histories->firstItem() + $loop->index}}
                                    {{-- $grades->firstItem() تعطي الرقم الفعلي لأول عنصر في الصفحة الحالية.
                                    $loop->index هو رقم العنصر داخل الحلقة (يبدأ من 0). --}}
                                </div>
                            </th>
                            <td style="white-space: pre-line;">{{ $history->description }}</td>
                            <td>{{ $history->user->first_name }} {{ $history->user->last_name }}</td>
                            <td>{{ $history->type }}</td>
                            <td>{{ $history->created_at }}</td>
                            <td>{{ $history->updated_at }}</td>
                           
                            <td>
                                <div class="hstack gap-2 flex-wrap">
                                    <a href="#" onclick="confirmDelete('{{$history->id}}', this)"
                                        class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                <div class="mt-3">
                    {{ $histories->links() }}
                </div>
            </div>
        </div>
    </div>
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
                axios.delete('/history/' + id)
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