@extends('layouts.main')

@section('title', 'Pos Invoice')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        .uk-form-select{
            color:rgba(0, 0, 0, 0.8) !important;


        }
        .styled-select select {
            background: transparent;
            border: none;
            font-size: 18px;
            height: 29px;
            padding: 5px; /* If you add too much padding here, the options won't show in IE */
            width: 90%;

        }
        #map{
        height:500px;width:100%
        }
        #map{ z-index:1; }
#

        .styled-select.slate {
            {{--background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;--}}
            height: 34px;
            width: 240px;
            z-index: 10;
        }

        .styled-select.slate select {

            border-bottom: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 268px;
        }
        .styled-select.slate option{
            font-size: 16pt;

        }
        .modal{
            width:100%;
            height:900px;
        }
        .slate   { background-color: #ddd; }
        .slate select   { color: #000; }
        /* @media screen and (-webkit-min-device-pixel-ratio:0)
        {
            .styled-select.slate {
                background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;

            }
        } */
        #googleMap {
          height: 300px;
          width: 500px;
        }
    </style>
@endsection
@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">

                    <div class="md-card">
                        <div class="md-card-toolbar" style="">
                            <div class="md-card-toolbar-actions hidden-print">
                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => 'pos', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range {{ session('branch_id')==1?"and Branch":'' }}   <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            @if(session('branch_id')==1)
                                                <div class="uk-width-medium-2-2">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-building"></i></span>

                                                        <select style="width: 90%" class="styled-select slate"  id="report_account_id" name="branch_id" >

                                                            @if(isset($branch_id))
                                                                @foreach($branchs as $branch)
                                                                    <option {{ ($branch_id==$branch->id)?"selected":'' }} value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach($branchs as $branch)
                                                                    <option  value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                                @endforeach

                                                            @endif
                                                        </select>

                                                    </div>
                                                    <br/>
                                                </div>
                                            @endif
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">From</label>
                                                    <input value="{{ isset($from_date)?$from_date:date('Y-m-d') }}" required class="md-input" type="text"  name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input value="{{ isset($to_date)?$to_date:date('Y-m-d') }}" required class="md-input" type="text"  name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                            <button type="submit" name="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <!--end  -->
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                        </div>
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Invoice List</span>
                              
                                 </h2>
                            </div>
                        </div>

                        <?php
                            $helper = new \App\Lib\Helpers;
                        ?>

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th width="7%">SL</th>
                                        <th>Date</th>
                                        <th>Invoice#</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Balance Due</th>
                                        <th>Created By</th>
                                        @if(Auth::user()->branch_id == 1)
                                        <th>Branch Name</th>
                                        @endif
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th width="7%">SL. No.</th>
                                        <th>Date</th>
                                        <th>Invoice#</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Balance Due</th>
                                        <th>Created By</th>
                                        @if(Auth::user()->branch_id == 1)
                                        <th>Branch Name</th>
                                        @endif
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>

                                    <?php $i = 1;?>
                                    @foreach($invoices as $key=>$invoice)
                                        <tr>
                                            <td width="7%">{{ $i++ }}</td>
                                            <td>{{date('d-m-Y', strtotime($invoice->invoice_date)) }}</td>
                                            <td>INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</td>

                                            <td>{{ $invoice->customer->display_name }} </td>
                                            <td

                                                @if($helper->getPaymentStatus($invoice->id) == "Paid")
                                                    style="color:green;"
                                                @endif
                                                @if($helper->getPaymentStatus($invoice->id) == "Partially Paid")
                                                    style="color:blue;"
                                                @endif
                                                @if($helper->getPaymentStatus($invoice->id) == "Payment Due")
                                                    style="color:red;"
                                                @endif
                                                @if($helper->getPaymentStatus($invoice->id) == "Draft")
                                                style="color:green;"
                                                @endif

                                            >
                                                {{ $helper->getPaymentStatus($invoice->id) }}
                                            </td>

                                            <td>{{ $invoice->total_amount }} </td>
                                            <td>{{ $invoice->due_amount }} </td>
                                            <td>{{ $invoice->createdBy->name }} </td>
                                            @if(Auth::user()->branch_id == 1)
                                            <td>{{ $invoice->createdBy->branch->branch_name }}</td>
                                            @endif
                                            <td class="uk-text-center" style="white-space:nowrap !important;">
                                                <a href="{{ route('point_of_sales_show', ['id' => $invoice->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="material-icons">visibility</i></a>
                                                <!--<a href="#"id="map_{{$i}}" onclick="mapId(<?php echo $i; ?>)"   data-uk-modal="{target:'#coustom_setting_modal2'}"> <i class="material-icons">location_on</i> </a>-->
                                                <!--<a target="_blank" href="{{ route('invoice_show2', ['id' => $invoice->id]) }}"id="map_{{$i}}"> <i class="material-icons">location_on</i> </a>-->
                                                <a href="{{ route('point_of_sales_edit', ['id' => $invoice->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="material-icons">&#xE254;</i></a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="invoice_id" value="{{ $invoice->id }}">
                                                <input type="hidden" id="map_tel_{{$i}}" class="invoice_id" value="{{ $invoice->latitude.', '. $invoice->longitude }}">
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            </div>
                            <div style="width: 100px;margin-left: 300px" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="uk-modal  modal-lg" id="coustom_setting_modal2">
                                <div class="uk-modal-dialog">
                                    <div class="uk-width-large-2-2 uk-width-2-2">
                                     <div id='map'></div>
                                    </div>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>

                                    </div>

                                </div>
                            </div>

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('point_of_sales_create') }}" class="md-fab md-fab-accent branch-create">
                                    <i class="material-icons">&#xE145;</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
  <script>
        $('#sidebar_point_of_sell_index').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
        $('.delete_btn').click(function () {
            var id = $(this).next('.invoice_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/pos/delete/"+id;
            })
        })
  </script>

  <script>


     function mapId(x)
    {
         var lat_lon =$("#map_tel_"+x).val();
      var lat     = lat_lon.split(',');

      var lat1    = lat[0];
      var lat2    = lat[1];
         var map = L.map('map', {
      center: [[lat1, lat2]],
      scrollWheelZoom: true,
    //   inertia: true,
    //   inertiaDeceleration: 2000
    });
    map.setView([lat1, lat2], 15);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
        minZoom: 2,
      maxZoom: 20,
        id: 'superpikar.n28afi10',
        accessToken: 'pk.eyJ1Ijoic3VwZXJwaWthciIsImEiOiI0MGE3NGQ2OWNkMzkyMzFlMzE4OWU5Yjk0ZmYzMGMwOCJ9.3bGFHjoSXB8yVA3KeQoOIw'
    }).addTo(map);


      console.log(lat1,lat2);
                  L.marker([lat1, lat2])
                .bindPopup('asad')
                .addTo(map);

    }


</script>

</script>
@endsection
