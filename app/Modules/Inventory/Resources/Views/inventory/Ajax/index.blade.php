@extends('layouts.main')

@section('title', 'Inventory')

@section('header')
@include('inc.header')
@endsection

@section('sidebar')
@include('inc.sidebar')
@endsection
@section('top_bar')
    <div id="top_bar">
        <div class="md-top-bar">
            <ul id="menu_top" class="uk-clearfix">
                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Product/Service </span></a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('inventory_create') }}">Create Product/Service </a></li>
                            <li><a href="{{ route('inventory') }}">All Product/Service </a></li>
                        </ul>
                    </div>
                </li>

                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Categories</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('inventory_category_create') }}">Create Category</a></li>
                            <li><a href="{{ route('inventory_category') }}">All Category</a></li>
                        </ul>
                    </div>
                </li>
                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Sub Category</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('inventory_sub_category') }}">All Sub Category</a></li>
                            <li><a href="{{ route('inventory_sub_category_add') }}">Create Sub Category</a></li>
                        </ul>
                    </div>
                </li>

                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Attributes</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('attributes') }}">@lang('trans.all_attributes')</a></li>
                            <li><a href="{{ route('attribute_create') }}">@lang('trans.create_attributes')</a></li>
                        </ul>
                    </div>
                </li>

                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Offers</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('offers') }}">@lang('trans.all_offers')</a></li>
                            <li><a href="{{ route('offers_create') }}">@lang('trans.create_offers')</a></li>
                        </ul>
                    </div>
                </li>

                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Damage</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('damage') }}">@lang('trans.all_damage')</a></li>
                            <li><a href="{{ route('damage_create') }}">@lang('trans.create_damage')</a></li>
                        </ul>
                    </div>
                </li>
                
            </ul>
        </div>
    </div>
@endsection
@section('content')
<?php $helper = new \App\Lib\Helpers ?>
<div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
    <div class="uk-width-large-10-10">
        <form action="" class="uk-form-stacked" id="user_edit_form">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">All Product/Service </span></h2>
                            </div>
                            <div class="uk-width-medium-1-1"
                                style="text-align: right; right: 10px; position: absolute; top:10px;">
                                <a href="/api/inventory/sync/all-products"
                                    class="md-btn md-btn-success md-btn-small md-btn-wave-light waves-effect waves-button alldata"><i
                                        class="material-icons">all_inclusive</i> Sync with E-commerce</a>
                                <a href="/inventory/consolidated-view"
                                    class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400 alldata"><i
                                        class="material-icons">&#xE254</i> Consolidated View</a>
                                <a href="{{ route('bulk_edit') }}"
                                    class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400 alldata"><i
                                        class="material-icons">&#xE254</i> Bulk Edit</a>
                                <a href="{{ route('import_excel') }}"
                                    class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400 alldata"><i
                                        class="material-icons">get_app</i> Import
                                    Excel</a>
                                <a
                                    class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-blue-grey-400 alldata">@lang('trans.show_all')</a>
                                <a
                                    class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-deep-orange-400 finddata">@lang('trans.find')</a>
                            </div>
                        </div>
                        <div style="display:none" class="md-card findinventory">
                            <br />
                            <hr />
                            <div class="uk-width-large-1-2 uk-width-medium-1-2" style="margin: 0 auto">
                                <div class="uk-input-group">
                                    <div class="md-input-wrapper"><label>Search By Name</label><input id="search_text"
                                            type="text" class="md-input"><span class="md-input-bar "></span></div>

                                    <span class="uk-input-group-addon"><a id="search_box" class="md-btn"
                                            href="#">@lang('trans.search')</a></span>
                                </div>

                            </div>
                            <br />
                        </div>
                        <div class="user_content">

                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <div id="spinner" class="spinner"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table_1">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Code</th>
                                            <th>@lang('trans.name')</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th class="uk-text-left">@lang('trans.action')</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Code</th>
                                            <th>@lang('trans.name')</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th class="uk-text-left">@lang('trans.action')</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('inventory_create') }}"
                                    class="md-fab md-fab-accent branch-create">
                                    <i class="material-icons">&#xE145;</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection


@section('scripts')


<script type="text/javascript">
    $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');

        $(window).load(function(){
            $(".alldata").trigger('click');
        })
        $(window).load(function(){
          $("#tiktok_account").trigger('click');
        })

        var all_inventory_list          = "{{ route("inventory_api_all_inventory_list") }}";
        var all_inventory_find          = "{{ route("inventory_api_seach_inventory_items_key") }}";
        var all_inventory_view          = "{{ route('inventory_show',["id"=>'']) }}";
        var all_inventory_edit          = "{{ route('inventory_edit',["id"=>'']) }}";
        var all_inventory_barcode       = "{{ route('inventory_barcode',["id"=>'']) }}";
        var all_stock_history           = "{{ route('stock_history',["id"=>'']) }}";
        var all_stock_history_create    = "{{ route('stock_history_create',["id"=>'']) }}";
        var all_inventory_delete        = "{{ route('inventory_delete',["id"=>'']) }}";
        var stock_report                = "";
        var item_report                 = "";

        $("#spinner").removeClass("spinner");

        $(".finddata").on("click",function () {
            $(".findinventory").show(1000);
        });

        $(".alldata").on("click",function () {

            $(".findinventory").hide(800);
            $("#spinner").addClass("spinner");

            $.get(all_inventory_list,function (datalist) {

                var data = [];

                $.each(datalist, function(k, v) {
                    var actiondata              = {};
                    actiondata.id               = v.id;
                    var date_created_at         = v.format_created_at;
                    actiondata.item_category_id = v.item_category_id;

                    data.push([++k, v.barcode_no, v.item_name, v.item_category_name||' ', v.item_sub_category_name||' ', actiondata] );
                });
                $('#data_table_1').DataTable({
                    "pageLength": 50,
                    destroy: true,
                    data: data,
                    deferRender: true,
                    "columnDefs": [
                        {
                            "targets": 5,
                            "render": function ( link, type, row )
                            {
                                var inventory_url       = '';
                                var stock_report_url    = stock_report.replace('new_id',link.id)
                                var item_report_url     = item_report.replace('new_id',link.id)

                                inventory_url += "<a href="+all_inventory_edit+"/"+link.id+">"+'<i data-uk-tooltip="{pos:\'top\'}" title="@lang('trans.edit')" class=" material-icons">&#xE254;</i>'+"</a>";
                                inventory_url += "<a href="+all_inventory_barcode+"/"+link.id+">"+'<i data-uk-tooltip="{pos:\'top\'}" title="Barcode" class="md-icon material-icons">view_week</i>'+"</a>";
                                inventory_url += "<a onclick='removeItem(this);' class='delete_btn'><i data-uk-tooltip=\"{pos:'top'}\" title='@lang('trans.delete')' class='material-icons'>&#xE872;</i></a>";
                                inventory_url += "<input class='inventory_id' type='hidden' value="+all_inventory_delete+'/'+link.id+">";

                                return inventory_url;
                            }
                        }
                    ]
                });

                $("#spinner").removeClass("spinner");

            });

        });

        $("#search_text").on("input",function () {
            var data = $("#search_text").val();
            if (data.length < 3) {
                return false;
            }
            $("#spinner").addClass("spinner");
            $.get(all_inventory_find,{ name: data },function (datalist) {
                var data = [];
                $.each(datalist, function(k, v) {
                    var actiondata = {};
                    actiondata.id = v.id;
                    var date_created_at = v.format_created_at;
                    actiondata.item_category_id = v.item_category_id;

                    data.push([++k, v.barcode_no, v.item_name, v.item_category_name||' ', v.item_sub_category_name||' ', actiondata] );
                });
                $('#data_table_1').DataTable({
                    "pageLength": 50,
                    destroy: true,
                    data:           data,
                    deferRender:    true,
                    "columnDefs": [
                        {
                            "targets": 4,
                            "render": function ( link, type, row )
                            {
                                var inventory_url = '';
                                var stock_report_url = stock_report.replace('new_id',link.id)
                                var item_report_url = item_report.replace('new_id',link.id)

                                inventory_url+="<a href="+all_inventory_edit+"/"+link.id+">"+'<i data-uk-tooltip="{pos:\'top\'}" title="@lang('trans.edit')" class=" material-icons">&#xE254;</i>'+"</a>";
                                inventory_url+=  "<a onclick='removeItem(this);' class='delete_btn'><i data-uk-tooltip=\"{pos:'top'}\" title='@lang('trans.delete')' class='material-icons'>&#xE872;</i></a>";
                                inventory_url+=  "<input class='inventory_id' type='hidden' value="+all_inventory_delete+'/'+link.id+">";

                                return inventory_url;
                            }
                        }
                    ]
                });
                $("#spinner").removeClass("spinner");
            });

        });

        $("#search_box").on("click",function () {
            var data = $("#search_text").val();
            if (data.length < 3) {
                return false;
            }
            $("#spinner").addClass("spinner");
            $.get(all_inventory_find,{ name: data },function (datalist) {
                var data = [];
                $.each(datalist, function(k, v) {
                    var actiondata = {};
                    actiondata.id = v.id;
                    var date_created_at = v.format_created_at;
                    actiondata.item_category_id = v.item_category_id;

                    data.push([++k, v.barcode_no, v.item_name, v.item_category_name||' ', v.item_sub_category_name||' ', actiondata ] );
                });
                $('#data_table_1').DataTable({
                    "pageLength": 50,
                    destroy: true,
                    data:           data,
                    deferRender:    true,
                    "columnDefs": [
                        {
                            "targets": 4,
                            "render": function ( link, type, row )
                            {
                                var inventory_url = '';
                                var stock_report_url = stock_report.replace('new_id',link.id)
                                var item_report_url = item_report.replace('new_id',link.id)

                                inventory_url+="<a href="+all_inventory_edit+"/"+link.id+">"+'<i data-uk-tooltip="{pos:\'top\'}" title="@lang('trans.edit')" class=" material-icons">&#xE254;</i>'+"</a>";
                                inventory_url+=  "<a onclick='removeItem(this);' class='delete_btn'><i data-uk-tooltip=\"{pos:'top'}\" title='@lang('trans.delete')' class='material-icons'>&#xE872;</i></a>";
                                inventory_url+=  "<input class='inventory_id' type='hidden' value="+all_inventory_delete+'/'+link.id+">";

                                return inventory_url;
                            }
                        }
                    ]
                });
                $("#spinner").removeClass("spinner");
            });

        });

        function removeItem(row)
        {
            var url = $(row).next('.inventory_id').val();

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = url;
            })
        }

</script>
@endsection