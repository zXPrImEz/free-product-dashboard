@extends('layouts.simple.master')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Resources</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Management</li>
    <li class="breadcrumb-item">Resources</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-xl-12 box-col-6 col-lg-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="pull-left">All Resources</h5>
                            <button class="btn btn-primary pull-right" type="button" data-bs-toggle="modal"
                                    data-bs-target="#createResource" data-bs-original-title="" title="">Create resource
                            </button>
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
                                                    style="width: 8%;">Downloadable
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Position: activate to sort column ascending"
                                                    style="width: 15%;">Lock Type
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Salary: activate to sort column ascending"
                                                    style="width: 30%;">Actions
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $resources = \App\Models\Resource::all();

                                            foreach ($resources as $resource) {

                                                echo '<tr role="row" class="odd">';
                                                echo '<td class="sorting_1">' . $resource->id . '</td>';
                                                echo '<td>' . $resource->name . '</td>';
                                                echo '<td>' . $resource->downloadable . '</td>';
                                                echo '<td>' . $resource->lock_type . '</td>';
                                                echo '<td style="display: flex;">';
                                                echo '<form method="post" action=' . url('/admin/resources', $resource->id) . '>';
                                                echo csrf_field();
                                                echo method_field('delete');
                                                echo '<button value="DELETE" class="btn btn-danger btn-sm" data-bs-original-title="" title="">DELETE</button>';
                                                echo '</form>';
                                                echo '<a style="margin-left: 10px;" href="'. url('/admin/resources/'. $resource->id . '/download') .'" class="btn btn-success" data-bs-original-title="" title="">DOWNLOAD</a>';
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

    <div class="modal fade" id="createResource" tabindex="-1" aria-labelledby="createResource" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create new resource</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                            data-bs-original-title="" title=""></button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="col-form-label" for="name">Key</label>
                            <input class="form-control" id="name" name="name" placeholder="xw_resource" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="recipient-name">Lock type</label>
                            <select id="lock" name="lock_type" class="form-select mb-4" aria-label="Default select example">
                                <option selected value="ipv4">IPv4 address</option>
                                <option value="discord-guild">Discord Guild ID</option>
                                <option value="hwid">HWID</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" role="switch" name="downloadable" type="checkbox" value="on" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Downloadable
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="image">Image</label>
                            <input class="form-control" id="image" name="image" placeholder="Product image" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="server_code">Server code</label>
                            <textarea id="server_code" name="server_code" class="form-control" placeholder="-- SERVER SIDE CODE" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"
                                data-bs-original-title="" title="">Close
                        </button>
                        <button type="submit" class="btn btn-primary" data-bs-original-title="" title="">Create
                            resource
                        </button>
                    </div>
                </form>
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
