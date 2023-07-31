@extends('layouts.main')

@section('title', 'Quotation Request')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        .wrapper{
            color: black;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 15px;
        }

        th {
            border: 1px solid #000;
        }

        td {

            height: 2em;
            border: 1px solid #000;
            text-align: center;
        }

        .column-left {
            float: left;
            width: 50%;
        }

        .column-right {
            float: right;
            width: 50%;
        }

        .container {
            margin-top: 15px;
        }

        @page {
            margin: 180px 50px;
        }

        #footer {
            position: fixed;
            left: 0px;
            bottom: -75px;
            right: 0px;
        }

        #header {
            position: fixed;
            left: 0px;
            top: -140px;
            right: 0px;
            text-align: center;
        }

        #footer .page:after {
            content: counter(page, upper-roman);
        }
    </style>
@endsection
@section('content')
<div class="wrapper">
    <div id="header">
        @inject('theader', '\App\Lib\TemplateHeader')
        {{-- @if ($theader->getBanner()->headerType)
            <img style="margin-top: -40px; " class="logo_regular" src="{{ asset($theader->getBanner()->file_url) }}"
                alt="" width="100%" />
        @else
            <img style="margin-top: -40px;" height="100" class="logo_regular"
                src="{{ asset('uploads/op-logo/logo.png') }}" alt="" width="100%" />
        @endif --}}

    </div>
    @php
        $number = new \App\Lib\NumberFormat();
    @endphp

    {{-- <div style=" clear: both;"></div> --}}
    {{-- <div id="footer">
        <div class="container" style="padding-top: 0px;">


            <div class="column-left" style="text-align: left;line-height: 3px;">
                <p> {!! $estimateRequest->left_notation !!}</p>

            </div>

            <div class="column-right" style="text-align: right;line-height: 5px;">
                <p> {!! $estimateRequest->right_notation !!}</p>

            </div>
        </div>
        <div style=" clear: both;"></div>
        <div class="container" style="text-align: center;line-height: 3px;">

            <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }}-{{ $OrganizationProfile->zip_code }},{{ $OrganizationProfile->country }}
            </p>

            <p>Cell:{{ $OrganizationProfile->contact_number }},Email:{{ $OrganizationProfile->email }}</p>
        </div>
    </div> --}}

    <div style="font-size: 1.5em">
        <div class="column-left"> <strong>Order Code: </strong>{{ $estimateRequest->order_code }}</div>
        <div class="column-right" style="text-align: right"><strong>Date:</strong> {{ date('d-M-Y', strtotime($estimateRequest->request_date)) }}</div>
    </div>

    <br>
    <br>

    <?php $subtotal = 0;
    $total_count = []; ?>

    @foreach ($estimateRequestModel as $key => $model)
        <table style="margin-top: 20px">
            <caption style="text-align: left; padding: 10px 5px; font-size: 1.2em; color: black"><strong>Model: {{ $model->model_name }}</strong></caption>
            <tr>
                <td style="background-color: #f4b083"><strong>#</strong></td>
                <td style="background-color: #f4b083"><strong>Length</strong></td>
                <td style="background-color: #f4b083"><strong>Size</strong></td>
                <td style="background-color: #f4b083"><strong>Color</strong></td>
                <td style="background-color: #f4b083"><strong>Quantity</strong></td>
            </tr>
            <?php $total = 0; ?>
            @foreach ($estimateRequestModel[$key]->estimateRequestModelEntries as $key1 => $value)
                <tr>
                    <td>{{ ++$key1 }}</td>
                    <td>{{ $value->length }}</td>
                    <td>{{ $value->size }}</td>
                    <td>{{ $value->color }}</td>
                    <td>{{ $value->quantity }}</td>
                </tr>
                <?php $total += $value->quantity;
                $subtotal += $value->quantity; ?>
            @endforeach

            <tr>
                <td colspan="4" style="text-align: center;padding-right: 6px; background-color:#acb9ca"><strong>Total</strong></td>
                <td colspan="1" style=" background-color:#acb9ca; text-align: center"><strong>{{ $total }}</strong></td>
            </tr>
        </table>
        <?php $total_count[$key] = $total; ?>
    @endforeach

    <table style="margin: 20px 0">
        <tr style="background-color: #70ad47">
        <td colspan="2">
            Order Summary
        </td>
        </tr>
        @foreach ($estimateRequestModel as $key => $model)
            <tr>
                <td>{{ $model->model_name }}</td>
                <td>{{ $total_count[$key] }}</td>
            </tr>
        @endforeach
        <tr style="background-color: #ffc000">
            <td><strong>Total</strong></td>
            <td><strong>{{ $subtotal }}</strong></td>
        </tr>
    </table>

    <strong style="font-size: 1.3em">Requirement:</strong>
    <div style="padding-left: 50px">{!! $estimateRequest->requirements !!}
    </div>

    <div style="text-align: center" style="font-size: 1.3em">
        <strong>Shipment Deadline:</strong> {{ $estimateRequest->deadline_date }}
    </div>

    <br>

    <strong style="font-size: 1.3em">Note:</strong> {{ $estimateRequest->note }}
</div>
@endsection

@section('scripts')
    <script>
        $('#sidebar_estimate_request').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection