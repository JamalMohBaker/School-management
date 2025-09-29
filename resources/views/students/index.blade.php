@extends('layouts.dashboard')
@section('title', __('dashboard.app_name'))

@section('content')


<div class="row mt-5">
    
    @foreach ($subject_teachers as $subject_teacher)
        <div class="col-sm-6 design" style="cursor: pointer;" data-toggle="tooltip" data-placement="top"
        title="Go To Class" onclick="window.location.href='{{ route('students.show', $subject_teacher->id) }}'">
        
        <div class="card custom-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-2">{{$subject_teacher->classroom->grade->name}} {{$subject_teacher->classroom->name}} Class</p>
                    <h4 class="mb-0 fw-semibold mb-2">{{$subject_teacher->subject->name}} Language</h4>
                    <span class="badge bg-success-transparent">T. {{$subject_teacher->user->first_name}}</span>
                </div>
                <div>
                    <span class="avatar avatar-md bg-primary p-2">
                        <i class="ti ti-file-check fs-20 op-7"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
@section('scripts')

<script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
{{-- <script>
    document.querySelectorAll('.design').forEach(item => {
        item.addEventListener('click', function() {
            window.location.href = "{{ route('students.show', '') }}/" + this.getAttribute('data-id');
        });
    });
</script> --}}
@endsection