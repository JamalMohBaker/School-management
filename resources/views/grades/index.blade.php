@extends('layouts.dashboard')
@section('title', 'create Grade')
@section('styles')
{{-- <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}"> --}}
@endsection
@section('content')
    <div class="table-responsive">
        <table class="table text-nowrap table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Updated_at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                {{ $grade->id }}
                            </div>
                        </th>
                        
                        <td>{{ $grade->name }}</td>
                        <td>{{ $grade->created_at }}</td>
                        <td>{{ $grade->updated_at }}</td>
                        <td>
                            <div class="hstack gap-2 flex-wrap">
                                <a href="javascript:void(0);" class="text-info fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                <a href="javascript:void(0);" class="text-danger fs-14 lh-1"><i
                                        class="ri-delete-bin-5-line"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>
    </div>
           
    
    @section('scripts')

    @endsection
@endsection    

