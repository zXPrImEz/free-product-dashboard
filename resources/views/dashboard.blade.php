@extends('layouts.simple.master')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
@endsection

<?php
{
    $localAuthRequests = 0;
    $localKeys = \App\Models\Key::all()->where('owner_id', auth()->user()->id);

    foreach ($localKeys as $localKey) {
        $localAuthRequests += $localKey->auth_requests;
    }
}
{
    $allAuthRequests = 0;

    $allKeys = \App\Models\Key::all();

    foreach ($allKeys as $allKey) {
        $allAuthRequests += $allKey->auth_requests;
    }
}
?>

@section('content')
    <div class="container-fluid">
        <div class="row second-chart-list third-news-update">
            <div class="col-xl-3 xl-100 chart_data_right box-col-12">
                <div class="card">
                    <div class="card-body" style="padding: 53px">
                        <h4 class="f-w-600 font-primary" id="greeting">
                            <span>Good day</span>, {{ Auth::user()->username }}</h4>
                        <p>Welcome to our Dashboard! </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 xl-100 chart_data_left box-col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row m-0 chart-main">
                            <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                <div class="media align-items-center">
                                    <div class="hospital-small-chart">
                                        <div class="small-bar">
                                            <div class="small-chart flot-chart-container">
                                                <div class="chartist-tooltip"></div>
                                                <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                                     height="100%" class="ct-chart-bar"
                                                     style="width: 100%; height: 100%;">
                                                    <g class="ct-grids"></g>
                                                    <g>
                                                        <g class="ct-series ct-series-a">
                                                            <line x1="13.571428571428571" x2="13.571428571428571"
                                                                  y1="69" y2="58.2" class="ct-bar" ct:value="400"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="20.714285714285715" x2="20.714285714285715"
                                                                  y1="69" y2="44.7" class="ct-bar" ct:value="900"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="27.857142857142858" x2="27.857142857142858"
                                                                  y1="69" y2="47.4" class="ct-bar" ct:value="800"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="35" x2="35" y1="69" y2="42" class="ct-bar"
                                                                  ct:value="1000" style="stroke-width: 3px"></line>
                                                            <line x1="42.14285714285714" x2="42.14285714285714" y1="69"
                                                                  y2="50.1" class="ct-bar" ct:value="700"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="49.285714285714285" x2="49.285714285714285"
                                                                  y1="69" y2="36.6" class="ct-bar" ct:value="1200"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="56.42857142857143" x2="56.42857142857143" y1="69"
                                                                  y2="60.9" class="ct-bar" ct:value="300"
                                                                  style="stroke-width: 3px"></line>
                                                        </g>
                                                        <g class="ct-series ct-series-b">
                                                            <line x1="13.571428571428571" x2="13.571428571428571"
                                                                  y1="58.2" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="1000" style="stroke-width: 3px"></line>
                                                            <line x1="20.714285714285715" x2="20.714285714285715"
                                                                  y1="44.7" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="500" style="stroke-width: 3px"></line>
                                                            <line x1="27.857142857142858" x2="27.857142857142858"
                                                                  y1="47.4" y2="31.199999999999996" class="ct-bar"
                                                                  ct:value="600" style="stroke-width: 3px"></line>
                                                            <line x1="35" x2="35" y1="42" y2="31.200000000000003"
                                                                  class="ct-bar" ct:value="400"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="42.14285714285714" x2="42.14285714285714"
                                                                  y1="50.1" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="700" style="stroke-width: 3px"></line>
                                                            <line x1="49.285714285714285" x2="49.285714285714285"
                                                                  y1="36.6" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="200" style="stroke-width: 3px"></line>
                                                            <line x1="56.42857142857143" x2="56.42857142857143"
                                                                  y1="60.9" y2="31.199999999999996" class="ct-bar"
                                                                  ct:value="1100" style="stroke-width: 3px"></line>
                                                        </g>
                                                    </g>
                                                    <g class="ct-labels"></g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div class="right-chart-content">
                                            <h4>{{ \App\Models\Key::all()->where('owner_id', auth()->user()->id)->count() }}</h4>
                                            <span>My Resources</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                <div class="media align-items-center">
                                    <div class="hospital-small-chart">
                                        <div class="small-bar">
                                            <div class="small-chart1 flot-chart-container">
                                                <div class="chartist-tooltip"></div>
                                                <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                                     height="100%" class="ct-chart-bar"
                                                     style="width: 100%; height: 100%;">
                                                    <g class="ct-grids"></g>
                                                    <g>
                                                        <g class="ct-series ct-series-a">
                                                            <line x1="13.571428571428571" x2="13.571428571428571"
                                                                  y1="69" y2="58.2" class="ct-bar" ct:value="400"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="20.714285714285715" x2="20.714285714285715"
                                                                  y1="69" y2="52.8" class="ct-bar" ct:value="600"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="27.857142857142858" x2="27.857142857142858"
                                                                  y1="69" y2="44.7" class="ct-bar" ct:value="900"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="35" x2="35" y1="69" y2="47.4" class="ct-bar"
                                                                  ct:value="800" style="stroke-width: 3px"></line>
                                                            <line x1="42.14285714285714" x2="42.14285714285714" y1="69"
                                                                  y2="42" class="ct-bar" ct:value="1000"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="49.285714285714285" x2="49.285714285714285"
                                                                  y1="69" y2="36.6" class="ct-bar" ct:value="1200"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="56.42857142857143" x2="56.42857142857143" y1="69"
                                                                  y2="55.5" class="ct-bar" ct:value="500"
                                                                  style="stroke-width: 3px"></line>
                                                        </g>
                                                        <g class="ct-series ct-series-b">
                                                            <line x1="13.571428571428571" x2="13.571428571428571"
                                                                  y1="58.2" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="1000" style="stroke-width: 3px"></line>
                                                            <line x1="20.714285714285715" x2="20.714285714285715"
                                                                  y1="52.8" y2="31.199999999999996" class="ct-bar"
                                                                  ct:value="800" style="stroke-width: 3px"></line>
                                                            <line x1="27.857142857142858" x2="27.857142857142858"
                                                                  y1="44.7" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="500" style="stroke-width: 3px"></line>
                                                            <line x1="35" x2="35" y1="47.4" y2="31.199999999999996"
                                                                  class="ct-bar" ct:value="600"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="42.14285714285714" x2="42.14285714285714" y1="42"
                                                                  y2="31.200000000000003" class="ct-bar" ct:value="400"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="49.285714285714285" x2="49.285714285714285"
                                                                  y1="36.6" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="200" style="stroke-width: 3px"></line>
                                                            <line x1="56.42857142857143" x2="56.42857142857143"
                                                                  y1="55.5" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="900" style="stroke-width: 3px"></line>
                                                        </g>
                                                    </g>
                                                    <g class="ct-labels"></g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div class="right-chart-content">
                                            <h4>{{ $localAuthRequests }}</h4>
                                            <span>Your auth requests</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                <div class="media align-items-center">
                                    <div class="hospital-small-chart">
                                        <div class="small-bar">
                                            <div class="small-chart2 flot-chart-container">
                                                <div class="chartist-tooltip"></div>
                                                <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                                     height="100%" class="ct-chart-bar"
                                                     style="width: 100%; height: 100%;">
                                                    <g class="ct-grids"></g>
                                                    <g>
                                                        <g class="ct-series ct-series-a">
                                                            <line x1="13.571428571428571" x2="13.571428571428571"
                                                                  y1="69" y2="39.3" class="ct-bar" ct:value="1100"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="20.714285714285715" x2="20.714285714285715"
                                                                  y1="69" y2="44.7" class="ct-bar" ct:value="900"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="27.857142857142858" x2="27.857142857142858"
                                                                  y1="69" y2="52.8" class="ct-bar" ct:value="600"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="35" x2="35" y1="69" y2="42" class="ct-bar"
                                                                  ct:value="1000" style="stroke-width: 3px"></line>
                                                            <line x1="42.14285714285714" x2="42.14285714285714" y1="69"
                                                                  y2="50.1" class="ct-bar" ct:value="700"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="49.285714285714285" x2="49.285714285714285"
                                                                  y1="69" y2="36.6" class="ct-bar" ct:value="1200"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="56.42857142857143" x2="56.42857142857143" y1="69"
                                                                  y2="60.9" class="ct-bar" ct:value="300"
                                                                  style="stroke-width: 3px"></line>
                                                        </g>
                                                        <g class="ct-series ct-series-b">
                                                            <line x1="13.571428571428571" x2="13.571428571428571"
                                                                  y1="39.3" y2="31.199999999999996" class="ct-bar"
                                                                  ct:value="300" style="stroke-width: 3px"></line>
                                                            <line x1="20.714285714285715" x2="20.714285714285715"
                                                                  y1="44.7" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="500" style="stroke-width: 3px"></line>
                                                            <line x1="27.857142857142858" x2="27.857142857142858"
                                                                  y1="52.8" y2="31.199999999999996" class="ct-bar"
                                                                  ct:value="800" style="stroke-width: 3px"></line>
                                                            <line x1="35" x2="35" y1="42" y2="31.200000000000003"
                                                                  class="ct-bar" ct:value="400"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="42.14285714285714" x2="42.14285714285714"
                                                                  y1="50.1" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="700" style="stroke-width: 3px"></line>
                                                            <line x1="49.285714285714285" x2="49.285714285714285"
                                                                  y1="36.6" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="200" style="stroke-width: 3px"></line>
                                                            <line x1="56.42857142857143" x2="56.42857142857143"
                                                                  y1="60.9" y2="31.199999999999996" class="ct-bar"
                                                                  ct:value="1100" style="stroke-width: 3px"></line>
                                                        </g>
                                                    </g>
                                                    <g class="ct-labels"></g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div class="right-chart-content">
                                            <h4>{{ $allAuthRequests }}</h4>
                                            <span>Auth requests</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                <div class="media border-none align-items-center">
                                    <div class="hospital-small-chart">
                                        <div class="small-bar">
                                            <div class="small-chart3 flot-chart-container">
                                                <div class="chartist-tooltip"></div>
                                                <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                                     height="100%" class="ct-chart-bar"
                                                     style="width: 100%; height: 100%;">
                                                    <g class="ct-grids"></g>
                                                    <g>
                                                        <g class="ct-series ct-series-a">
                                                            <line x1="13.571428571428571" x2="13.571428571428571"
                                                                  y1="69" y2="58.2" class="ct-bar" ct:value="400"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="20.714285714285715" x2="20.714285714285715"
                                                                  y1="69" y2="52.8" class="ct-bar" ct:value="600"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="27.857142857142858" x2="27.857142857142858"
                                                                  y1="69" y2="47.4" class="ct-bar" ct:value="800"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="35" x2="35" y1="69" y2="42" class="ct-bar"
                                                                  ct:value="1000" style="stroke-width: 3px"></line>
                                                            <line x1="42.14285714285714" x2="42.14285714285714" y1="69"
                                                                  y2="50.1" class="ct-bar" ct:value="700"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="49.285714285714285" x2="49.285714285714285"
                                                                  y1="69" y2="39.3" class="ct-bar" ct:value="1100"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="56.42857142857143" x2="56.42857142857143" y1="69"
                                                                  y2="60.9" class="ct-bar" ct:value="300"
                                                                  style="stroke-width: 3px"></line>
                                                        </g>
                                                        <g class="ct-series ct-series-b">
                                                            <line x1="13.571428571428571" x2="13.571428571428571"
                                                                  y1="58.2" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="1000" style="stroke-width: 3px"></line>
                                                            <line x1="20.714285714285715" x2="20.714285714285715"
                                                                  y1="52.8" y2="39.3" class="ct-bar" ct:value="500"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="27.857142857142858" x2="27.857142857142858"
                                                                  y1="47.4" y2="31.199999999999996" class="ct-bar"
                                                                  ct:value="600" style="stroke-width: 3px"></line>
                                                            <line x1="35" x2="35" y1="42" y2="33.9" class="ct-bar"
                                                                  ct:value="300" style="stroke-width: 3px"></line>
                                                            <line x1="42.14285714285714" x2="42.14285714285714"
                                                                  y1="50.1" y2="31.200000000000003" class="ct-bar"
                                                                  ct:value="700" style="stroke-width: 3px"></line>
                                                            <line x1="49.285714285714285" x2="49.285714285714285"
                                                                  y1="39.3" y2="33.9" class="ct-bar" ct:value="200"
                                                                  style="stroke-width: 3px"></line>
                                                            <line x1="56.42857142857143" x2="56.42857142857143"
                                                                  y1="60.9" y2="31.199999999999996" class="ct-bar"
                                                                  ct:value="1100" style="stroke-width: 3px"></line>
                                                        </g>
                                                    </g>
                                                    <g class="ct-labels"></g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div class="right-chart-content">
                                            <h4>{{ \App\Models\User::all()->count() }}</h4>
                                            <span>Users</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 xl-100 box-col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Products last changed</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-spin fa-cog"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-status table-responsive best-seller-table mb-0">
                            <table class="table table-bordernone">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Token</th>
                                    <th scope="col">Value</th>
                                    <th class="text-end" scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $keys = \App\Models\Key::all()->where('owner_id', auth()->user()->id)->sortByDesc('updated_at');

                                foreach ($keys as $key) {

                                    $keyFormatted = $key->value;

                                    if ($keyFormatted == '') {
                                        $keyFormatted = 'N/A';
                                    }

                                    echo '<tr>';
                                    echo '<td>' . $key->resource->name . '</td>';
                                    echo '<td class="digits">' . $key->key . '</td>';
                                    echo '<td class="digits font-primary">' . $keyFormatted . '</td>';
                                    echo '<td class="text-end"><span class="badge badge-light-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check me-2"><polyline points="20 6 9 17 4 12"></polyline></svg> Active</span></td>';
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
    <script type="text/javascript">
        let session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
    <script src="{{asset('assets/js/dashboard/default.js')}}"></script>
@endsection
