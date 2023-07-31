@extends('layouts.invoice')

@section('title', 'Bill of Material View')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
    <script src="{{url('app/moneyin/invoice/invoice.module.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.useCredit.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.excessPayment.js')}}"></script>
@endsection

@section('styles')
    <style>
        
        .uk-table td, .uk-table th {
            padding: 6px 6px;
        }
        
        #table_center th,td,tr{
            border-bottom-color: black !important;
            border: 1px solid black !important;
            padding: 3px 3px;
        }
        
        .no-border{
            border:0px !important;
        }
        
        table#info{
            font-size: 12px !important;
            line-height: 2px;
            border: none !important;
            min-width: 200px;
            width: 200px;
            float:right;
        }
        table#info tr td{
             border: none !important;
        }
        table#info tr{
            padding: 0px;
            border: none !important;
        }
        
        @media print {
            body {
              /*margin-top: 130px;*/
              margin-top: -100px;
            }

            #print{
                display: none;
            }
            
            /*.print_header{*/
            /*    position: fixed;*/
            /*    top: 0px;*/
            /*    left: 0px;*/
            /*}*/
            
        }
    </style>
@endsection

@section('content')
@section('content')

    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Invoices</li>

                        @foreach($bill_of_materials as $bill_of_material)
                        <li>
                            <a href="{{ route('bomShow', ['id' => $bill_of_material->id])}}" class="md-list-content">
                                <span class="md-list-heading uk-text-truncate">{{$bill_of_material->item->item_name}} <span class="uk-text-small uk-text-muted">({{ date('d M Y', strtotime($bill_of_material->date)) }})</span></span>
                                <span class="uk-text-small uk-text-muted">BOM-{{ str_pad($bill_of_material->id, 6, '0', STR_PAD_LEFT) }}</span>
                            </a>
                        </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ route('bom') }}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>

            <?php $helper = new \App\Lib\Helpers; ?>
            
            @inject('theader', '\App\Lib\TemplateHeader')
            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar" style="border-bottom: 0px solid rgba(0,0,0,.12);">
                            <div  style="float: left;margin-right: 15px; height: 14px;" class="uk-form-file md-btn md-btn-wave-light">
                                <a href="{{route('bomCreate')}}">Create Bill Of Material</a>
                            </div>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="margin-top: 0px;">
                            
                           @if($theader->getBanner()->headerType)
                                <div class="print_header" style="text-align: center;">
                                    <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center; margin-top:50px;">
                                    <h1 style="width: 100%; text-align: center;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="" style="text-align: center;">
                                    <p>{{ $OrganizationProfile->street }}, {{ $OrganizationProfile->city }}, {{ $OrganizationProfile->state }}, {{ $OrganizationProfile->country }}</p>
                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }}, {{ $OrganizationProfile->contact_number }}</p>
                                    <p style="margin-top: -20px;">{{ $OrganizationProfile->etin > 0 ? 'BIN ' . $OrganizationProfile->etin : '' }}</p>
                                    <br>
                                </div>
                           @endif
    
                            <div class="uk-grid" data-uk-grid-margin>
                                
                                <div class="uk-width-5-5" style="font-size: 15px;">
                                    <div class="uk-grid">
                                        <h2 style="text-align: center; width: 100%;" class="">
                                            <u>
                                                Bill Of Material
                                            </u>
                                            <div>
                                                <small> BOM-{{ str_pad($id, 6, '0', STR_PAD_LEFT) }} </small>
                                            </div>
                                        </h2>
                                        
                                    </div>
                                </div>
                                
                            </div>


                            {{-- New Top Section --}}
                            @php $bill_of_material = $bill_of_materials->where('id', $id)->first(); @endphp
                            <div class="uk-grid">
                                <div class="uk-width-3-4">
                                    <p style="font-weight: bold;">
                                        Project Name: {{$bill_of_material->project_name}} <br>
                                        Product Name: {{$bill_of_material->item->item_name}} <br>
                                        Model No: {{$bill_of_material->item->barcode_no}} <br>
                                        Spl. Product Size: {{$bill_of_material->product_size}} <br>
                                    </p>
                                </div>
                                <div class="uk-width-1-4">
                                    <p style="font-weight: bold;">
                                        Date: {{ date('d M Y', strtotime($bill_of_material->date)) }} <br>
                                        Quantity: {{$bill_of_material->quantity}} Pcs
                                    </p>
                                </div>
                            </div>
                            {{-- End New Top Section --}}
                            <h3 style="margin-top: 14px;">Materials: {{$sub_categories}}</h3>
                            
                            <table id="table_center" border="1" style="width: 100%"> {{-- 12 TDs --}}
                                <tr>
                                    <th rowspan="2" class="uk-text-center">LS No.</th>
                                    <th rowspan="2" class="uk-text-center">Materials Description</th>
                                    <th colspan="{{ $max_attr }}" class="uk-text-center">Specification / Size</th>
                                    <th rowspan="2" class="uk-text-center">Qty</th>
                                    <th rowspan="2" class="uk-text-center">Total Material</th>
                                    <th rowspan="2" class="uk-text-center">Wastage (%)</th>
                                    <th rowspan="2" class="uk-text-center">Total Mat including Wastage</th>
                                    <th rowspan="2" class="uk-text-center">Unit</th>
                                    <th rowspan="2" class="uk-text-center">Unit Price</th>
                                    <th rowspan="2" class="uk-text-center">Total Mat Cost</th>
                                </tr>
                                <tr>
                                    @foreach ($max_attributes as $max_attribute)
                                        <th class="uk-text-center">{{ $max_attribute->name }}</th>
                                    @endforeach
                                </tr>
                                
                                @php 
                                    $last_sub_category_id = 0;  
                                    $total_material_cost = 0; 
                                    $attribute_multiplier = 1;
                                    $subtotal = 0; 
                                @endphp
                                @foreach ($bill_of_material_entries as $bill_of_material_entry)
                                    @if ($last_sub_category_id != $bill_of_material_entry->sub_category_id)
                                        @if ($last_sub_category_id != 0)
                                            <tr>
                                                <th colspan="11" class="uk-text-right">Total =</th>
                                                <th colspan="1" class="uk-text-right">{{$total_material_cost}}</th>
                                            </tr>
                                            @php $subtotal += $total_material_cost; $total_material_cost = 0; @endphp
                                        @endif
                                        <tr>
                                            <th colspan="12" class="uk-text-center">{{$bill_of_material_entry->subcategory->item_sub_category_name}}</th>
                                        </tr>
                                        @php $last_sub_category_id = $bill_of_material_entry->sub_category_id; @endphp
                                        
                                    @endif
                                    <tr>                                   
                                        <td class="uk-text-center">{{$loop->iteration}}</td>
                                        <td class="uk-text-left">{{$bill_of_material_entry->item->item_name}}</td>
                                        @php
                                            $item_attributes = $bill_of_material_entry->item->ItemAttributeValues->where('measurable', 1);
                                            for ($i = count($item_attributes); $i<$max_attr; $i++)
                                            {
                                                echo '<td class="uk-text-center">0</td>';
                                            }
                                        @endphp
                                        @foreach ($item_attributes as $attribute_values_id)
                                            {{-- <td class="uk-text-center">{{$attribute_values_id->attributeValues->attribute}}</td> --}}
                                            <td class="uk-text-center">{{$attribute_values_id->attributeValues->value}}</td>
                                            @php
                                                if($bill_of_material_entry->item->Unit->name == "Sft") //FOR SFT TAKE 2 ATTRIBUTES
                                                {
                                                    if($attribute_values_id->attributeValues->attribute->name == "L" || $attribute_values_id->attributeValues->attribute->name == "W")
                                                    {
                                                        $attribute_multiplier *= $attribute_values_id->attributeValues->value;
                                                    }
                                                }
                                                else {
                                                    $attribute_multiplier *= $attribute_values_id->attributeValues->value;
                                                }
                                            @endphp
                                        @endforeach

                                        @if($attribute_multiplier == 1)
                                        
                                        @endif

                                        <td class="uk-text-center">{{$bill_of_material_entry->quantity}}</td>
                                        {{-- <td class="uk-text-center">{{$total_material = $attribute_multiplier}}</td> --}}
                                        <td class="uk-text-center">{{round($total_material = $attribute_multiplier == 1 ? $bill_of_material_entry->quantity : (empty($bill_of_material_entry->item->Unit->basic_unit_conversion) ? $attribute_multiplier * $bill_of_material_entry->quantity : $attribute_multiplier * $bill_of_material_entry->quantity / $bill_of_material_entry->item->Unit->basic_unit_conversion), 2)}}</td>
                                        <td class="uk-text-center">{{$bill_of_material_entry->wastage_percent}}%</td>
                                        <td class="uk-text-center">{{round($total_qty = ($total_material * $bill_of_material_entry->wastage_percent /100) + $total_material, 2)}}</td>
                                        <td class="uk-text-center">{{$bill_of_material_entry->item->Unit->name ?? 'Pcs'}}</td>
                                        <td class="uk-text-right">{{ $unit_price = $bill_of_material_entry->unit_price ?? 0}}</td>
                                        <td class="uk-text-right">{{ round($unit_price * $total_qty, 2)}}</td>
                                    </tr>
                                    @php 
                                        $total_material_cost += round($unit_price * $total_qty, 2);
                                        $attribute_multiplier = 1;                                    
                                    @endphp
                                @endforeach
                                <tr>
                                    <th colspan="11" class="uk-text-right">Total =</th>
                                    <th colspan="1" class="uk-text-right">{{$total_material_cost}}</th>
                                </tr>
                                @php 
                                    $subtotal += $total_material_cost; 
                                    $total_material_cost = 0; 
                                    $production_cost = 0; 
                                    $production_cost += $subtotal;
                                    $production_cost += $subtotal * $bill_of_material->cho_percent / 100;
                                    $production_cost += $subtotal * $bill_of_material->foh_percent / 100;
                                    $production_cost += $subtotal * $bill_of_material->profit_percent / 100;
                                    $production_cost += $subtotal * $bill_of_material->design_percent / 100;

                                @endphp
                                


                                
                                <tr>
                                    <th colspan="11" class="uk-text-right">Sub Total =</th>
                                    <th colspan="11" class="uk-text-right">{{$subtotal}}</th>
                                </tr>
                                <tr>
                                    <th class="uk-text-center">1</th>
                                    <th class="uk-text-right" colspan="8">COH</th>
                                    <th class="uk-text-center" colspan="2">{{$bill_of_material->cho_percent}}%</th>
                                    <th class="uk-text-right">{{round($subtotal * $bill_of_material->cho_percent / 100, 2)}}</th>
                                </tr>
                                <tr>
                                    <th class="uk-text-center">1</th>
                                    <th class="uk-text-right" colspan="8">FOH</th>
                                    <th class="uk-text-center" colspan="2">{{$bill_of_material->foh_percent}}%</th>
                                    <th class="uk-text-right">{{round($subtotal * $bill_of_material->foh_percent / 100, 2)}}</th>
                                </tr>
                                <tr>
                                    <th class="uk-text-center">2</th>
                                    <th class="uk-text-right" colspan="8">Profit</th>
                                    <th class="uk-text-center" colspan="2">{{$bill_of_material->profit_percent}}%</th>
                                    <th class="uk-text-right">{{round($subtotal * $bill_of_material->profit_percent / 100, 2)}}</th>
                                </tr>   
                                <tr>
                                    <th class="uk-text-center">3</th>
                                    <th class="uk-text-right" colspan="8">Design</th>
                                    <th class="uk-text-center" colspan="2">{{$bill_of_material->design_percent}}%</th>
                                    <th class="uk-text-right">{{round($subtotal * $bill_of_material->design_percent / 100, 2)}}</th>
                                </tr>   
                                <tr>
                                    <th colspan="11" class="uk-text-right">Production Cost =</th>
                                    <th colspan="11" class="uk-text-right">{{round($production_cost, 2)}}</th>
                                </tr>
                                <tr><th colspan="12"><br></th></tr>  
                                <tr>
                                    <th class="uk-text-right" colspan="9">MRP</th>
                                    <th class="uk-text-center" colspan="2">{{$bill_of_material->mrp_percent}}%</th>
                                    <th class="uk-text-right">{{round($mrp_amount = $production_cost + $production_cost * $bill_of_material->mrp_percent / 100, 2)}}</th>
                                </tr>   
                                <tr><th colspan="12"><br></th></tr>  
                                <tr>
                                    <th class="uk-text-right" colspan="9">VAT</th>
                                    <th class="uk-text-center" colspan="2">{{$bill_of_material->vat_percent}}%</th>
                                    <th class="uk-text-right">{{round($mrp_amount * $bill_of_material->vat_percent / 100, 2)}}</th>
                                </tr>   
                                <tr><th colspan="11"></th><th class="uk-text-right" bgcolor="yellow">{{$bill_of_material->trade_total}}</th></tr>  
                            </table>

                            {{-- Signature Section --}}

                            <div class="uk-grid" style="margin-top:30px;">
                                <div class="uk-width-1-10"></div>
                                <div class="uk-width-1-5 uk-text-center">
                                    <p class="uk-text-small uk-margin-bottom" style="border-top: solid 1px; margin: 50px 0px">Prepared By</p>
                                </div>
                                <div class="uk-width-1-10"></div>
                                <div class="uk-width-1-5 uk-text-center" >
                                </div>
                                <div class="uk-width-1-10"></div>
                                <div class="uk-width-1-5 uk-text-center" >
                                    <p  class="uk-text-small uk-margin-bottom" style="border-top: solid 1px; margin: 50px 0px">Approved By</p>
                                </div>
                                <div class="uk-width-1-10"></div>
                            </div>

                            {{-- End Signature Section --}}

                        </div>
                    </div>
                </div>


                
            </div>

        </div>
@endsection
@endsection

@section('sweet_alert')

            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
            <script>
                $('#sidebar_bom').addClass('act_item');
                $('#sidebar_main_account').addClass('current_section');
                $(window).load(function(){
                    $("#tiktok_account").trigger('click');

                });

                $('.payment_receive_delete_btn').click(function () {
                    var id = $(this).next('.payment_receive_entry_id').val();
                    swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this! If you delete this",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function () {
                        window.location.href = "/payment-received/delete-payment-receive-entry/"+id;
                    })
                })

                $('.credit_receive_entry_delete_btn').click(function () {
                    var id = $(this).next('.credit_receive_entry_id').val();
                    swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this! If you delete this",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function () {
                        window.location.href = "/invoice/delete-credit/"+id;
                    })
                })


                    $("#popup").click(function(e){
                        e.preventDefault();
                        axios.post(this.href)
                            .then(function (response) {
                                var row=document.getElementById('stockEntry');
                                row.innerHTML=response.data;


                            })
                            .catch(function (error) {
                                console.log(error);
                            });

                        axios.get(this.href)
                            .then(function (response) {

                              if(response.data.status){


                                  $("#create-item").modal("show");
                                  $("#popup").hide();
                                  setTimeout(function () {
                                      location.reload();
                                  }, 15000)


                              }else{

                                  $("#message-item").modal("show");
                                  $("#popup").hide();
                                  $("#draft").hide();
                                  $("#nav_in_without_href").hide();
                                  $("#nav_in_with_href").show();


                              }

                            })
                            .catch(function (error) {
                                console.log(error);
                            });


                    });


                function _(el) {
                    return document.getElementById(el);
                }

                function uploadFile(){
                    _("progressBar").style.display = "block";
                    var file = _("file1").files[0];
                    var size= file.size/1024/1024;
                    if(size>10){
                        _("status").innerHTML = "file size not allowed";
                        _("status").style.color = "red";
                        return false;
                    }
                    _("status").style.color = "black";

                    // alert(file.name+" | "+file.size+" | "+file.type);
                    var formdata = new FormData();
                    formdata.append("file1", file);
                    var ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.addEventListener("load", completeHandler, false);
                    ajax.addEventListener("error", errorHandler, false);
                    ajax.addEventListener("abort", abortHandler, false);
                    ajax.open("POST", window.location.href);
                    ajax.send(formdata);
                }

                function progressHandler(event) {
                    _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
                    var percent = (event.loaded / event.total) * 100;
                    _("progressBar").value = Math.round(percent);
                     _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
                }

                function completeHandler(event) {
                    // _("status").innerHTML = event.target.responseText;

                 //   UIkit.modal.alert(event.target.responseText)
                    _("progressBar").value = 100;
                    _("progressBar").style.color = "blue";
                    _("status").innerHTML = event.target.responseText;
                }

                function errorHandler(event) {
                    //  _("status").innerHTML = "Upload Failed";
                    alert("Upload Failed");
                    _("progressBar").style.display = "none";
                }

                function abortHandler(event) {
                    // _("status").innerHTML = "Upload Aborted";
                    alert("Upload Aborted");
                    _("progressBar").style.display = "none";
                }
            </script>
@endsection
