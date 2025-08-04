@extends('layouts.dashboard')
@section('title', __('dashboard.app_name'))
@section('content')
<div style="display: flex; justify-content: center; align-items: center; background-color: #e0e0e0; color: white; font-size: larger; height: 100vh" >
    <p class="mt-5" style="color: #f5a623">
        Wellcome MR. {{Auth::user()->first_name}}
    </p>
    
</div>
@endsection