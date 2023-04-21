@extends('layouts.simple.master')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Keys</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Management</li>
    <li class="breadcrumb-item">Keys</li>
@endsection

<?php
function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
?>

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-xl-12 box-col-6 col-lg-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="pull-left">All Keys</h5>
                            <ul class="pull-right nav nav-pills nav-primary" id="pills-clrtabinfo" role="tablist">
                                <li class="nav-item">
                                    <button class="btn btn-primary pull-right" style="margin-right: 10px" type="button"
                                            data-bs-toggle="modal" data-bs-target="#importKeys"
                                            data-bs-original-title="" title="">Import keys
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="btn btn-primary pull-right" type="button" data-bs-toggle="modal"
                                            data-bs-target="#createKey" data-bs-original-title="" title="">Create key
                                    </button>
                                </li>
                            </ul>

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
                                                    colspan="1"
                                                    aria-label="Start date: activate to sort column ascending"
                                                    style="width: 10%">Owner
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Salary: activate to sort column ascending"
                                                    style="width: 30%;">Actions
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $keys = \App\Models\Key::all();

                                            foreach ($keys as $key) {

                                                if ($key->value == '') {
                                                    $key->value = 'N/A';
                                                }

                                                $user = 'N/A';

                                                if($key->owner) {
                                                    $user = $key->owner->username . '#' . $key->owner->discriminator;
                                                }


                                                echo '<tr role="row" class="odd">';
                                                echo '<td class="sorting_1">' . $key->resource->id . '</td>';
                                                echo '<td>' . $key->resource->name . '</td>';
                                                echo '<td>' . $key->auth_requests . '</td>';
                                                echo '<td><input disabled="" class="form-control" id="token" value="' . $key->key . '" type="text" placeholder="' . $key->key . '" name="token" data-bs-original-title="" title=""></td>';
                                                echo '<td>' . $key->value . '</td>';
                                                echo '<td><span class="badge bg-success">License active</span></td>';
                                                echo '<td><span>Never</span></td>';
                                                echo '<td><span>' . $user . '</span></td>';
                                                echo '<td>';
                                                echo '<form method="post" action=' . url('/admin/keys', $key->id) . '>';
                                                echo csrf_field();
                                                echo method_field('delete');
                                                echo '<button value="DELETE" class="btn btn-danger btn-sm" data-bs-original-title="" title="">DELETE</a>';
                                                echo '</form>';
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
        <div class="modal fade" id="createKey" tabindex="-1" aria-labelledby="createKey" style="display: none;"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create new key</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Resource</label>
                                <!--<input class="form-control" type="text" value="@getbootstrap" data-bs-original-title="" title=""> -->
                                <select class="form-select mb-4" name="resource" aria-label="Default select example">
                                    <?php

                                    $resources = \App\Models\Resource::all();
                                    $first = true;

                                    foreach ($resources as $resource) {
                                        if ($first) {
                                            echo '<option selected value="' . $resource->id . '">' . $resource->name . '</option>';
                                            $first = false;
                                        } else {
                                            echo '<option value="' . $resource->id . '">' . $resource->name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="message-text">Key</label>
                                <?php
                                $randomKey = "XW-" . randomString(4) . "-" . randomString(4) . "-" . randomString(4) . "-" . randomString(4);
                                ?>
                                <input class="form-control" name="key" placeholder="{{ $randomKey }}"
                                       value="{{ $randomKey }}">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"
                                    data-bs-original-title="" title="">Close
                            </button>
                            <button type="submit" class="btn btn-primary" data-bs-original-title="" title="">Create
                                key
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="importKeys" tabindex="-1" aria-labelledby="importKeys" style="display: none;"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import keys</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="{{ url('/admin/keys/import') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="col-form-label" for="recipient-name">Resource</label>
                                <!--<input class="form-control" type="text" value="@getbootstrap" data-bs-original-title="" title=""> -->
                                <select class="form-select mb-4" name="resource" aria-label="Default select example">
                                    <?php

                                    $resources = \App\Models\Resource::all();
                                    $first = true;

                                    foreach ($resources as $resource) {
                                        if ($first) {
                                            echo '<option selected value="' . $resource->id . '">' . $resource->name . '</option>';
                                            $first = false;
                                        } else {
                                            echo '<option value="' . $resource->id . '">' . $resource->name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="keysTextArea">Keys</label>
                                <textarea id="keysTextArea" name="licenses" class="form-control"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"
                                    data-bs-original-title="" title="">Close
                            </button>
                            <button type="submit" class="btn btn-primary" data-bs-original-title="" title="">Import
                                keys
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
    <script src="{{asset('assets/js/dashboard/default.js')}}"></script>
@endsection
