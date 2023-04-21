@extends('layouts.simple.master')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Users</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Management</li>
    <li class="breadcrumb-item">Users</li>
@endsection

@section('content')
    <div class="container-fluid">

    </div>
    <script type="text/javascript">
        let session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
    <script src="{{asset('assets/js/dashboard/default.js')}}"></script>
@endsection
