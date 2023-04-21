@extends('layouts.simple.master')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Resources</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Resources</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!--<div class="col-xl-12 box-col-6 col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Change IP </h5>
                    </div>
                    <form class="form theme-form" method="POST" action="{{ url('/resources') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="selectResource">Select Resource</label>
                                        <select class="form-select digits" id="selectResource" name="resource">
                                            <?php

                                            $keys = \App\Models\Key::all()->where('owner_id', auth()->user()->id);
                                            $first = true;

                                            foreach ($keys as $key) {
                                                if ($first) {
                                                    echo '<option selected value="' . $key->resource->id . '">' . $key->resource->name . '</option>';
                                                    $first = false;
                                                } else {
                                                    echo '<option value="' . $key->resource->id . '">' . $key->resource->name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="ipInput">New IP</label>
                                        <input class="form-control" id="ipInput" type="text"
                                               placeholder="Example: 69.69.69.69" name="newip" data-bs-original-title=""
                                               title="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 mb-0">
                                        <label for="reasonTextarea">Reason</label>
                                        <textarea class="form-control" id="reasonTextarea" rows="2" minlength="10"
                                                  name="reason"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Submit
                            </button>
                            <input class="btn btn-light" type="reset" value="Cancel" data-bs-original-title="" title="">
                        </div>
                    </form>
                </div>
            </div>-->
            <div class="row">
                <div class="col-xl-12 box-col-6 col-lg-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Your Resources </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                    <div id="basic-1_filter" class="dataTables_filter">
                                        <table class="display dataTable no-footer" id="basic-1" role="grid"
                                               aria-describedby="basic-1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 1%;">ID
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 15%;">Name
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 8%;">Authentications
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Position: activate to sort column ascending"
                                                    style="width: 15%;">Token
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Office: activate to sort column ascending"
                                                    style="width: 12%;">Server IP
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Age: activate to sort column ascending"
                                                    style="width: 8%;">Status
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Start date: activate to sort column ascending"
                                                    style="width: 10%">Ending date
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Salary: activate to sort column ascending"
                                                    style="width: 30%;">Actions
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            $keys = \App\Models\Key::all()->where('owner_id', auth()->user()->id);
                                            foreach ($keys as $key) {

                                                if ($key->value == '') {
                                                    $key->value = 'N/A';
                                                }

                                                echo '<tr role="row" class="odd">';
                                                echo '<td class="sorting_1">' . $key->resource->id . '</td>';
                                                echo '<td>' . $key->resource->name . '</td>';
                                                echo '<td>' . $key->auth_requests . '</td>';
                                                echo '<td><input disabled="" class="form-control" id="token" value="' . $key->key . '" type="text" placeholder="' . $key->key . '" name="token" data-bs-original-title="" title=""></td>';
                                                echo '<td>' . $key->value . '</td>';
                                                echo '<td><span class="badge bg-success">License active</span></td>';
                                                echo '<td><span>Never</span></td>';
                                                echo '<td>';
                                                echo '<a href="' . url('resources/' . $key->resource->id) . '" class="btn btn-primary btn-sm" style="margin-right: 10px" data-bs-original-title="" title="">Details</a>';
                                                echo '<a href="' . url('resources/' . $key->resource->id . '/download') . '" class="btn btn-secondary btn-sm" data-bs-original-title="" title="">Download</a>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }

                                            ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection
