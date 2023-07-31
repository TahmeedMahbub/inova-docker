@extends('layouts.main')

@section('title', 'Stock Management')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <?php $helper = new \App\Lib\Helpers ?>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">@lang('trans.stock_item_list')</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('trans.name')</th>
                                        <th>@lang('trans.category')</th>
                                        <th>@lang('trans.total')</th>
                                        <th>@lang('trans.re_order')</th>
                                        <th>@lang('trans.updated_at')</th>
                                        <th>@lang('trans.updated_by')</th>
                                        <th class="uk-text-center">@lang('trans.action')</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('trans.name')</th>
                                        <th>@lang('trans.category')</th>
                                        <th>@lang('trans.total')</th>
                                        <th>@lang('trans.re_order')</th>
                                        <th>@lang('trans.updated_at')</th>
                                        <th>@lang('trans.updated_by')</th>
                                        <th class="uk-text-center">@lang('trans.action')</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($items as $item)
                                    <tr>
                                        <td>
                                            @if(Session::get('locale') == 'bn')
                                                {{  $helper->bn2enNumber($count++) }}
                                            @else
                                                {{ $count++ }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(Session::get('locale') == 'bn')
                                                {{ $item->item_name }}
                                            @else
                                                {{ $item->item_name }}
                                            @endif
                                         </td>
                                        <td>
                                            @if(Session::get('locale') == 'bn')
                                                {{ $item->itemCategory->item_category_name }}
                                            @else
                                                {{ $item->itemCategory->item_category_name }}
                                            @endif
                                        </td>
                                        <td>
                                            <?php $sum = 0; ?>
                                            @foreach($item->stocks as $stock)
                                                <?php $sum += $stock->total; ?>
                                            @endforeach
                                                @if(Session::get('locale') == 'bn')
                                                    {{  $helper->bn2enNumber($sum) }}
                                                @else
                                                    {{ $sum }}
                                                @endif

                                        </td>
                                        <td>
                                            @if(Session::get('locale') == 'bn')
                                                {{  $helper->bn2enNumber($item->reorder_point) }}
                                            @else
                                                {{ $item->reorder_point }}
                                            @endif
                                        </td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>{{ $item->updatedBy->name }}</td>
                                        <td class="uk-text-center">
                                            <a href="{{ route('stock_history',['id' => $item->id]) }}"><i data-uk-tooltip title="History" class="md-icon material-icons">&#xE85C;</i></a>
                                            <a href="{{ route('inventory_show',['id' => $item->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">&#xE8F4;</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent" href="{{ route('stock_create') }}">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_inventory').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
    </script>
@endsection