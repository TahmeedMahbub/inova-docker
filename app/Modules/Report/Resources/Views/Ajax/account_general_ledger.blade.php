@extends('layouts.admin')

@section('title', 'Account General Ledger '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/uikit/css/uikit.almost-flat.min.css')}}" media="all">
    <link rel="stylesheet" href="{{ asset('admin/assets/icons/flags/flags.min.css')}}" media="all">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style_switcher.min.css')}}" media="all">
    <style>
        .no_display{

            display:none;
        }
        @media print {
            a[href]:after {
                content:"" !important;

            }
            a{
                text-decoration: none;
            }
            .md-card-toolbar{
                display: none;
            }

            .uk-table{

            }
            .uk-table tr td{
                padding: 1px 2px;
                border: none !important;
                font-size: 11px !important;
                width: 20%;
            }
            .uk-table tr th{
                padding: 1px 2px;
                border-top: 1px solid black;
                border-bottom: 1px solid black;
                width: 20%;
                font-size: 11px !important;
            }
            .uk-table tr th:last-child, .uk-table tr td:last-child{
                text-align: right !important;
            }

            body{
                margin-top: -40px;
            }
        }
    </style>
@endsection

@section('content_header')
    <div id="top_bar">
        <div class="md-top-bar">
            <ul id="menu_top" class="uk-clearfix">
                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Reports</span></a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li>Business Overview</li>
                            <li><a href="{{route('report_account_profit_loss')}}">Profit and Loss</a></li>
                            <li><a href="{{route('report_account_cash_flow_statement')}}">Cash Flow Statement</a></li>
                            <li><a href="{{route('report_account_balance_sheet')}}">Balance Sheet</a></li>
                            <li>Accountant</li>
                            <li><a href="{{route('report_account_transactions')}}">Account Transactions</a></li>
                            <li><a href="{{route('report_account_general_ledger_search')}}">General Ledger</a></li>
                            <li><a href="{{route('report_account_journal_search')}}">Journal Report</a></li>
                            <li><a href="{{route('report_account_trial_balance_search')}}">Trial Balance</a></li>
                            <li>Sales</li>
                            <li><a href="{{route('report_account_customer')}}">Sales by Customer</a></li>
                            <li><a href="">Sales by Item</a></li>
                            <li><a href="{{route('report_account_item')}}">Product Report</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
<div class="uk-width-medium-10-10 uk-container-center reset-print">
    <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
        <div class="uk-width-large-10-10">
            <div class="md-card md-card-single main-print">
                <div id="invoice_preview">
                    <div class="md-card-toolbar">
                        <div style="float:left;margin:5px" class="dt_colVis_buttons">
                            <button class="md-btn buttons-collection buttons-colvis" tabindex="0" aria-controls="dt_colVis" type="button" aria-haspopup="true"><span>Column visibility</span></button>
                                <div class="dt-buttons btn-group" id="dt-buttons" style="display:none">
                                        <ul class="dt-button-collection uk-dropdown uk-nav" role="menu" style="display: block; top: 35px; left: 0px;">
                                            <li id="dt_colVis_buttons_1" data-val="1" class="dt-button buttons-columnVisibility  dt_colVis_buttons active" tabindex="0" aria-controls="dt_colVis"><a href="#">Name</a></li>
                                            <li id="dt_colVis_buttons_2" data-val="2" class="dt-button buttons-columnVisibility  dt_colVis_buttons active" tabindex="0" aria-controls="dt_colVis"><a href="#">Opening Balance</a></li>
                                            <li id="dt_colVis_buttons_3" data-val="3" class="dt-button buttons-columnVisibility  dt_colVis_buttons active" tabindex="0" aria-controls="dt_colVis"><a href="#">DEBIT</a></li>
                                            <li id="dt_colVis_buttons_4" data-val="4" class="dt-button buttons-columnVisibility  dt_colVis_buttons active" tabindex="0" aria-controls="dt_colVis"><a href="#">CREDIT</a></li> 
                                            <li id="dt_colVis_buttons_5" data-val="5" class="dt-button buttons-columnVisibility  dt_colVis_buttons active" tabindex="0" aria-controls="dt_colVis"><a href="#">BALANCE</a></li>
                                        </ul> 
                                </div>                
                        </div>

                        <div class="md-card-toolbar-actions hidden-print">
                            <i class="md-icon material-icons" id="invoice_print"></i>

                            <!--coustorm modal start -->
                            <div class="uk-modal" id="coustom_modal">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Select Date Range <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                    </div>
                                    <div class="uk-width-large-10-10 uk-width-10-10">
                                        <div class="uk-width-large-1-2 uk-width-1-2">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">Select date</label>
                                                <input class="md-input" type="text" id="uk_dp_1" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                            </div>
                                        </div>
                                        <div class="uk-width-large-1-2 uk-width-1-2">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">Select date</label>
                                                <input class="md-input" type="text" id="uk_dp_1" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button data-uk-modal="{target:'#modal_new'}" type="button" class="md-btn md-btn-flat md-btn-flat-primary">Open New Modal</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true">
                                
                                <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>   
                            </div>
                            <!--coustorm setting modal start -->

                            <div class="uk-modal" id="coustom_setting_modal">
                                <div class="uk-modal-dialog">
                                {!! Form::open(['url' => 'report/account/general/ledger', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Select Date Range and Transaction Type <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                    </div>

                                    <div class="uk-width-large-2-2 uk-width-2-2">
                                        @if(Auth::user()->branch_id==1)
                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-input-group">
                                                <label for="branch_id" style="margin-left: 10px;">Branch</label>
                                                <select style="padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray"  id="branch_id" name="branch_id">
                                                <!-- <option value="">Account</option> -->
                                                @foreach($branch as $branch_data)
                                                    <option style="z-index: 10002" value="{{$branch_data->id}}">{{$branch_data->branch_name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">From</label>
                                                <input class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                            </div>
                                        </div>
                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">To</label>
                                                <input class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'DD.MM.YYYY'}">
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

                    <div class="md-card-content invoice_content print_bg" style="height: 100%;">
                        
                        <div class="uk-grid" data-uk-grid-margin="">
                            
                            <div class="uk-width-small-5-5 uk-text-center">
                                <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                <p style="line-height: 5px;" class="heading_b uk-text-success">Account General Ledger</p>
                                @if(isset($branch_id))<p>@foreach($branch as $branchs) @if($branchs->id==$branch_id) {{$branchs->branch_name}} @endif @endforeach</p>@endif
                                <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                            </div>
                        </div>

                        <div class="uk-grid uk-margin-large-bottom">
                       
                            <div class="uk-width-1-1">
                               
                                <i class="spinner"> </i>
                                <table style="width: 100%;padding: 7px;" id="ledger_book_table" class="uk-table">
                                    <thead>
                                        <tr class="uk-text-upper">
                                            <th class="no_display"></th>
                                            <th id="display_1" class="uk-text-left display_1">ACCOUNT NAME</th>
                                            <th id="display_2" class="uk-text-right display_2">Opening Balance </th>
                                            <th id="display_3" class="uk-text-right display_3">DEBIT</th>
                                            <th id="display_4" class="uk-text-right display_4">CREDIT</th>
                                            <th id="display_5" class="uk-text-right display_5">BALANCE</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ url('admin/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <!-- handlebars.js -->
    <script src="{{ url('admin/bower_components/handlebars/handlebars.min.js')}}"></script>
    <script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js')}}"></script>
    <!--  invoices functions -->
    <script src="{{ url('admin/assets/js/pages/page_invoices.min.js')}}"></script>
    <script src="{{ url('admin/bower_components/datatables-buttons/js/buttons.colVis.js')}}"></script>
    <script src="{{ url('admin/assets/js/uikit_custom.min.js')}}"></script>
    <script src="{{url('admin/assets/js/pages/plugins_datatables.min.js')}}"></script>

    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_reports').addClass('act_item');
        
        var branch_id    = {{ $branch_id }};
        
        var ledger_url   = "{{ route("report_account_general_ledger_list_api",["branch_id"=>'']) }}";
        var details_url  = "{{ route("report_account_transactions_account_search",["id"=>'']) }}";
        var todate       = "{{ $end }}";
        var from_date    = "{{ $start }}";

        window.onload = function () {
            $.get(ledger_url,{end:todate, branch_id:branch_id,from_date:from_date },function (datalist) {
                var reorderdata = [];
                console.log(datalist);
                $.each(datalist, function(k, v) {
                   
                   var balance =v.balance ;
                   
                   
                   if (balance < 0){
                       balance = "(" + balance + ")";
                    }

                   reorderdata.push( [v.id, v.account_name, v.opening_balance, v.debit , v.credit, balance] );
                });

                $('#ledger_book_table').DataTable({
                   "paging": false,
                   "searching": false,
                   "bFilter": false,
                   "bInfo": false,
                   "bPaginate":false,
                   info: false,
                   rowReorder: {
                       enable: false
                   },

                   "ordering": false,
                   "rowCallback": function(row, data, index){
                      // if ((data[2] == 0 && data[4] == 0) || (data[3] == 0 && data[4] == 0) || (data[2] == null && data[3] == null)) {
                      //    jQuery(row).hide();
                      // }
                   },
                   data:reorderdata,
                   "columnDefs": [
                       { className: "no_display", "targets": 0  },

                       {
                           "targets": 1,
                           className: "display_1",
                           "render": function ( link, type, row ) {
                               return "<a target='_blank' href="+details_url+"/"+row[0]+">"+link+"</a>";
                           }
                       },

                       { className: "uk-text-right display_2", "targets": 2  },
                       { className: "uk-text-right display_3", "targets": 3  },

                       { className: "uk-text-right display_4", "targets": 4  },                       

                       { className: "uk-text-right display_5", "targets": 5  }

                   ]
                });
                $(".spinner").remove();
           });
       };
    </script>

    <script> 
        $('body').click( function() {
            var display = $('#dt-buttons').css( "display" );
            if( display == 'block')
            {
                $('#dt-buttons').css('display','none')  
            }    
        });

        $(".dt_colVis_buttons").click(function(){
           
            var display = $('#dt-buttons').css( "display" );
            if( display == 'block')
            {
                $('#dt-buttons').css('display','none')  
            }
            else 
            {
                $('#dt-buttons').css('display','block')
                return false; 
            }
          
            var class_attr   = $( this ).attr( "class" );
            var id           = $( this).data('val');
            var class_dis    = 'display_'+id;
            if(id != 1){}
                if( class_attr == 'dt-button buttons-columnVisibility  dt_colVis_buttons active')
                {
                    $('#dt_colVis_buttons_'+id).attr('class', '');
                    $('#dt_colVis_buttons_'+id).attr('class', 'dt-button buttons-columnVisibility  dt_colVis_buttons');
                    $('.display_'+id).attr('class', 'no_display display_'+id)
                }
                else{
                    $('#dt_colVis_buttons_'+id).attr('class', 'dt-button buttons-columnVisibility  dt_colVis_buttons active');
                    if(id != 1){
                        $('.display_'+id).attr('class', 'uk-text-right display_'+id);
                    }
                    else{
                        $('.display_'+id).attr('class', 'uk-text-left display_'+id);
                    }

                }   
        });
    </script>
@endsection
