@extends('layouts.main')

@section('title', 'Bill Of Materials')

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
        .slate   { background-color: #ddd; }
        .slate select   { color: #000; }
        span.select2-container {
            z-index: 1500 !important;
        }
        @media screen and (-webkit-min-device-pixel-ratio:0)
        {
            .styled-select.slate {
                background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;

            }
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">

                    <div class="md-card">
                        
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Bill of Material List</span></h2>
                            </div>
                        </div>

                        <?php $helper = new \App\Lib\Helpers; ?>

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th width="7%">SL</th>
                                        <th>Project Name</th>
                                        <th>Item Name</th>
                                        <th>Invoice</th>
                                        <th>Date</th>
                                        <th>Quantity</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th width="7%">SL</th>
                                        <th>Project Name</th>
                                        <th>Item Name</th>
                                        <th>Invoice</th>
                                        <th>Date</th>
                                        <th>Quantity</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $i = 1;?>
                                    @foreach ($bill_of_materials as $bill_of_material)
                                        <tr>
                                            <td width="7%">{{ $i++ }}</td>
                                            <td>{{ $bill_of_material->project_name }}</td>
                                            <td>{{ $bill_of_material->item->item_name }}</td>
                                            <td>{{ !empty($bill_of_material->invoice->invoice_number) ? 'INV-'.$bill_of_material->invoice->invoice_number : '' }}</td>
                                            <td>{{date('d-m-Y', strtotime($bill_of_material->date))}}</td>
                                            <td> {{$bill_of_material->quantity}}  </td>
                                            <td class="uk-text-center" style="white-space:nowrap !important;">
                                                <a href="{{ route('bomShow', ['id' => $bill_of_material->id])}} "><i data-uk-tooltip="{pos:'top'}" title="View" class="material-icons">visibility</i></a>
                                                <a href="{{ route('bomEdit', ['id' => $bill_of_material->id])}} "><i data-uk-tooltip="{pos:'top'}" title="Edit" class="material-icons">&#xE254;</i></a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="bill_of_material_id" value="{{$bill_of_material->id}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_bom_button" href="{{ route('bomCreate') }}" class="md-fab md-fab-accent bom-create">
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
        $('#sidebar_bom').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
        $('.delete_btn').click(function () {
            var id = $(this).next('.bill_of_material_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/bill-of-material/delete/"+id;
            })
        })




    </script>
@endsection
