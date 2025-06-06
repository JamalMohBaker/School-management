@extends('layouts.dashboard')
@section('title', 'All Subjects')
@section('styles')
{{--
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}"> --}}
@endsection
@section('content')
<div class="table-responsive">
    <table class="table text-nowrap table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">{{__('grade.created_at')}}</th>
                <th scope="col">{{__('grade.updated_at')}}</th>
                <th scope="col">{{__('grade.action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
            <tr>
                <th scope="row">
                    <div class="d-flex align-items-center">
                        {{-- {{ $grade->id }} --}}
                        {{$subjects->firstItem() + $loop->index}}
                        {{-- $grades->firstItem() تعطي الرقم الفعلي لأول عنصر في الصفحة الحالية.
                        $loop->index هو رقم العنصر داخل الحلقة (يبدأ من 0). --}}
                    </div>
                </th>

                <td>{{ $subject->name }}</td>
                <td>{{ $subject->code }}</td>
                <td>{{ $subject->created_at }}</td>
                <td>{{ $subject->updated_at }}</td>
                <td>
                    <div class="hstack gap-2 flex-wrap">
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="text-info fs-14 lh-1"><i
                                class="ri-edit-line"></i></a>
                        <a href="#" onclick="confirmDelete('{{$subject->id}}', this)" class="text-danger fs-14 lh-1"><i
                                class="ri-delete-bin-5-line"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    <div class="mt-3">
        {{ $subjects->links() }}
    </div>
</div>
<div class="position-relative">
    <a href="{{route('subjects.create')}}">
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
                axios.delete('/subjects/' + id)
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

@endsection
@endsection