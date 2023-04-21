@extends('layouts.simple.master')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Product Details</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Resources</li>
    <li class="breadcrumb-item">{{ $resource->name }}</li>
@endsection

<?php

$keyFormatted = $key->value;
$lockTypeFormatted = '';

switch ($key->resource->lock_type) {
    case 'ipv4': {
        $lockTypeFormatted = 'IP-Address';
        break;
    }
    case 'discord-guild': {
        $lockTypeFormatted = 'Guild ID';
        break;
    }
    case 'hwid': {
        $lockTypeFormatted = 'HWID';
        break;
    }
}

if ($keyFormatted == '') {
    $keyFormatted = 'N/A';
}
?>

@section('content')
    <div class="container-fluid">
        <div class="modal fade show" id="modal2177" tabindex="-1" aria-labelledby="modal2177"
             style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ url('resources/' . $key->resource->id . '/update') }}" method="post">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">Set {{ $lockTypeFormatted }}</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                    data-bs-original-title="" title=""></button>
                        </div>
                        <div class="modal-body">
                            <p>Here you can change the {{ strtolower($lockTypeFormatted) }} for this product.</p>
                            <div class="col-md-8 ">
                                <div class="col-sm-6">
                                    <input required class="form-control" id="value" value="" type="text"
                                           placeholder="{{ $lockTypeFormatted }}" name="value" data-bs-original-title="" title="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"
                                    data-bs-original-title="" title="">Close
                            </button>
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Save
                                changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div>
            <div class="row product-page-main p-0">
                <div class="col-xl-4 xl-cs-65 box-col-12">
                    <div class="card">
                        <div class="card-body">
                            <img class="img-fluid" width="700" height="400"
                                 style="border-radius: 15px; aspect-ratio: 16/9;"
                                 src="{{ $resource->image }}"
                                 alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 xl-100 box-col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-page-details">
                                <h3>{{ $resource->name }}</h3>
                            </div>
                            <div class="product-price">
                                {{ $resource->id }}
                            </div>
                            <hr>
                            <div>
                                <table class="product-page-width">
                                    <tbody>
                                    <tr>
                                        <td><b>{{ $lockTypeFormatted }}</b></td>
                                        <td>{{ $keyFormatted }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Token &nbsp;</b></td>
                                        <td>{{ $key->key }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Status &nbsp;</b></td>
                                        <td class="txt-success">Active</td>
                                    </tr>
                                    <tr>
                                        <td><b>Refundable &nbsp;</b></td>
                                        <td>No</td>
                                    </tr>
                                    <tr>
                                        <td><b>Valid until &nbsp;</b></td>
                                        <td>Permanent</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="m-t-15">
                                <button class="btn btn-primary m-r-10" type="button" title="" data-bs-toggle="modal"
                                        data-bs-target="#modal2177" data-bs-original-title=""><i
                                        class="fa fa-solid fa-network-wired"></i> Change {{ $lockTypeFormatted }}
                                </button>
                                <a class="btn btn-secondary" href="{{ url('resources/' . $key->resource->id . '/download') }}"
                                   data-bs-original-title="" title=""> <i class="fa fa-solid fa-download"></i> Download</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 xl-cs-35 box-col-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Further Details</h3>
                            <br>
                            <div class="collection-filter-block">
                                <ul class="pro-services">
                                    <li>
                                        <div class="media">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-truck">
                                                <rect x="1" y="3" width="15" height="13"></rect>
                                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                            </svg>
                                            <div class="media-body">
                                                <h5>Product claimed since </h5>
                                                <p>{{ $key->claimed_at }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-clock">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <div class="media-body">
                                                <h5>Authentications </h5>
                                                <p>{{ $key->auth_requests }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-credit-card">
                                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                                <line x1="1" y1="10" x2="23" y2="10"></line>
                                            </svg>
                                            <div class="media-body">
                                                <h5>Servers </h5>
                                                <p>18 </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- silde-bar colleps block end here-->
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="user-status table-responsive best-seller-table mb-0">
                    <table class="table table-bordernone">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Slots</th>
                            <th scope="col">{{ $lockTypeFormatted }}</th>
                            <th class="text-end" scope="col">Updated at</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>FXServer, but unconfigured</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>xbx Server lol</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>48</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>48</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        <tr>
                            <td>[XBX] 👑 xbx.wtf 👑 | heheboi</td>
                            <td>64</td>
                            <td class="digits font-primary">69.69.69.69</td>
                            <td class="digits font-primary">2022-09-16 22:17:57</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
