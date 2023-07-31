@extends('layouts.main')

@section('title', 'Product Item')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/inventory/productphase/phase.module.js')}}"></script>
    <script src="{{url('app/inventory/productphase/phase.controller.js')}}"></script>
@endsection

@section('content')
    <?php $_SESSION['item_id'] = $product_id;
    ?>
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
                                <div class="uk-grid uk-margin-top" data-uk-grid-margin>
                                  <div class="uk-width-medium-1-2">
                                    <div class="user_heading_content">
                                        <h2 class="heading_b"><span class="uk-text-truncate">@lang('trans.phase_item')</span></h2>

                                    </div>
                                  </div>
                                  <div class="uk-width-medium-1-2">
                                    <?php $i = 0; $arr_cnt  = count($product_phases); ?>
                                    @foreach($product_phases as $product_phase)
                                    <div style="float:right" class="">
                                      @php

                                       if($product_phase->status)
                                       {
                                         $i++;
                                       }
                                      @endphp
                                      @if($i ==$arr_cnt )
                                      <form class="" action="{{ route('item_name_add',['id' => $product_id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="d" value="">
                                        <button  type="submit" class="btn btn-success" id="add_to_stock" name="button"> Add to Stock</button>
                                      </form>
                                      @endif
                                    </div>
                                  @endforeach
                                  </div>
                              </div>
                            </div>
                            <form class="" action="" method="get">
                              @foreach($product_phases as $product_phase)
                                <div class="user_content">
                                  <div class="uk-margin-top">
                                      <?php $i = 0; ?>
                                      <h3 class="full_width_in_card heading_c">
                                          <span>{{$product_phase->product_phase_name}} @lang('trans.phase') </span>
                                          <div class="uk-float-right">
                                              <input type="checkbox" value="{{$product_phase->id}}" name="first_phase_{{ $i }}" onclick="product_phase({{$product_phase->id}})" id="first_phase_{{$product_phase->id}}" {{$product_phase->status ? 'checked' : ''}}/>
                                              <label class="inline-label"   for="first_phase_{{ $product_phase->id }}">
                                                  <p id="first_phase_level_{{ $product_phase->id }}">{{$product_phase->status ? 'Complete' : 'Incomplete' }} </p>
                                              </label>
                                          </div>
                                      </h3>
                                          <?php $i++ ?>

                                      <div class="uk-overflow-container uk-margin-bottom">
                                          <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>


                                          <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                              <thead>
                                              <tr>
                                                  <th>@lang('trans.item_name')</th>
                                                  <th>@lang('trans.total_quantity')</th>
                                                  <th>@lang('trans.recepient_name')</th>
                                                  <th>@lang('trans.issued_by')</th>
                                                  <th>@lang('trans.issued_number')</th>
                                                  <th>@lang('trans.reference')</th>
                                                  <th>@lang('trans.date'):</th>
                                                  <th class="uk-text-center">@lang('trans.action')</th>
                                              </tr>
                                              </thead>

                                              <tfoot>
                                              <tr>
                                                  <th>@lang('trans.item_name')</th>
                                                  <th>@lang('trans.total_quantity')</th>
                                                  <th>@lang('trans.recepient_name')</th>
                                                  <th>@lang('trans.issued_by')</th>
                                                  <th>@lang('trans.issued_number')</th>
                                                  <th>@lang('trans.reference')</th>
                                                  <th>@lang('trans.date'):</th>
                                                  <th class="uk-text-center">@lang('trans.action')</th>
                                              </tr>
                                              </tfoot>

                                              <tbody>
                                              @foreach($product_phase->productPhaseItems as $items)

                                              @foreach($items->productPhaseItemAdds as $item)
                                              <tr>
                                                  <td>
                                                      @if(Session::get('locale') == 'bn')
                                                      {{$item->item->item_name}}
                                                      @else
                                                      {{$item->item->item_name}}
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if(Session::get('locale') == 'bn')
                                                          {{ $helper->bn2enNumber($item->total) }}
                                                      @else
                                                          {{$item->total}}
                                                      @endif
                                                  </td>
                                                  <td>
                                                      {{$items->contact->first_name." ".$items->contact->last_name}}
                                                      @if(Session::get('locale') == 'bn')
                                                          {{$items->contact->first_name." ".$items->contact->last_name }}
                                                      @else
                                                          {{ $items->contact->first_name." ".$items->contact->last_name }}
                                                      @endif
                                                  </td>
                                                  <td>

                                                      @if(Session::get('locale') == 'bn')
                                                          {{$items->issuedBy->name}}
                                                      @else
                                                          {{$items->issuedBy->name}}
                                                      @endif
                                                  </td>
                                                  <td>

                                                      @if(Session::get('locale') == 'bn')
                                                          {{ $helper->bn2enNumber($items->issued_number) }}
                                                      @else
                                                          {{ $items->issued_number }}
                                                      @endif
                                                  </td>
                                                  <td>
                                                      {{$items->reference}}
                                                  </td>
                                                  <td>
                                                      {{$items->date}}
                                                  </th>
                                                  <td class="uk-text-center">
                                                      <a href="{{ route('product_phase_item_show',['id' => $items->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">&#xE8F4;</i></a>
                                                      <a href="{{ route('product_phase_item_edit',['id' => $items->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                      <a href="{{ route('product_phase_item_delete',['id' => $items->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                  </td>
                                              </tr>
                                              @endforeach
                                              @endforeach
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                              @endforeach()
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
    //id: 11, product_phase_name: "01", status: "0", product_id: 3, created_by: 9, …
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_product').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

        function product_phase(x)
        {
          var project_id = '{{$product_id}}';
          var phase_id   =  $('#first_phase_'+x).val();
          var i          = 0;
          $.get('{{url("product-track/item/phage_id")}}'+'/'+project_id+'/'+phase_id ,function(data){
            $.each(data,function(index, value)
            {
              if(value.status==1)
              {
              $('#first_phase_level_'+ value.id).html('Complete');
              }
              else
              {
                 $('#first_phase_level_'+value.id).html('Incomplete');
              }
                if(value.status==1)
                {
                  i++;
                }

            });

            if(data.length == i)
            {
            $('#add_to_stock').show();
            }
            else
            {
              {
               $('#add_to_stock').hide();
              }
            }
          });

        }
    </script>
@endsection
