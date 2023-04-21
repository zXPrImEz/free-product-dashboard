@extends('layouts.simple.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Redeem</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Redeem</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Redeem Key</h5>
                    </div>
                    <form class="form theme-form" method="POST" action="{{ url('/redeem') }}">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1">Key</label>
                                        <input required class="form-control" id="exampleFormControlInput1" type="password"
                                               placeholder="Key here" name="key" data-bs-original-title="" title="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var session_layout = '';
    </script>
@endsection

@section('script')
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/js/dashboard/default.js')}}"></script>
@endsection
