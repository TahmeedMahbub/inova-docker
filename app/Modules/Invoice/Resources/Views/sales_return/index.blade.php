@extends('layouts.main')

@section('title', 'Sales Return')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Sales Return</span></h2>
                            </div>
                        </div>
                        {!! Form::open(['url' => route('sales_return_update',$invoice->id), 'method' => 'POST','files' => true,'onsubmit' => 'return varify();']) !!}

                        @php
                            $i=1; $j=0;
                        @endphp


                        <div class="user_content">
                            <h3>INV-{{ $invoice->invoice_number }}</h3>
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Returned Quantity</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Returned Quantity</th>
                                    </tr>
                                    </tfoot>
                                    <tbody id="invoice_quantity">
                                        @foreach($invoice_entries as $all)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $all->item['barcode_no'] . ', ' . $all->item['item_name'] }}</td>
                                            <td id="quantity">{{ $all->quantity }}</td>
                                            <td>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="returned_quantity">Quantity</label>
                                                    <input class="md-input" type="text" id="returned_quantity" name="returned_quantity[]" oninput="quantity(this,{{ $j++ }});">
                                                </div>
                                            </td>
                                            <td hidden><input id="detail" name="invoice_entries_id[]" value="{{ $all->id }}" data-rate="{{ $all->rate }}" data-discount="{{ $all->discount }}" data-discount_type="{{ $all->discount_type }}"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <h4>Invoice Amount : {{ $invoice->total_amount }}</h4>
                            <h4>Payment Received :{{ $invoice->total_amount-$invoice->due_amount }}</h4>
                            <h4>Due Amount :{{ $invoice->due_amount }}</h4>
                            <br>
                            <input type="text" id="invoice_detail" data-adjustment="{{ $invoice->adjustment }}" data-shipping_charge="{{ $invoice->shipping_charge }}" data-pr_adjustment="{{ $invoice->pr_adjustment }}" data-total_amount="{{ $invoice->total_amount }}" data-tax_total="{{ $invoice->tax_total }}" data-due_amount="{{ $invoice->due_amount }}" hidden>
                            <div class="uk-grid uk-ma" data-uk-grid-margin>
                                <div class="uk-width-1-1 uk-float-left">
                                    <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                    <a href="{{ URL::previous() }}" class="md-btn md-btn-flat uk-modal-close">Close</a>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <div style="text-align: center;">
                            <h3 style="color: red;" id="msg"></h3>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#sidebar_invoice').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })

        function varify(){
            var total_amount = 0;
            var adjustment = $('#invoice_detail').data('adjustment');

            if(adjustment == ""){
                adjustment = 0;
            }

            var shipping_charge = $('#invoice_detail').data('shipping_charge');

            if(shipping_charge == ""){
                shipping_charge = 0;
            }

            var pr_adjustment = $('#invoice_detail').data('pr_adjustment');

            
            if(pr_adjustment == ""){
                pr_adjustment = 0;
            }

            var invoice_total_amount = $('#invoice_detail').data('total_amount');
            var due_amount = $('#invoice_detail').data('due_amount');
            var tax_total = $('#invoice_detail').data('tax_total');

            if(tax_total == ""){
                tax_total = 0;
            }

            var tax_main = ((tax_total * 100)/(invoice_total_amount - tax_total));

            $('#invoice_quantity tr').each(function() {
                var amount = 0;
                var quantity_optional = $(this).find("#quantity").html();   
                var return_quantity = $(this).find("#returned_quantity").val();
                if(return_quantity == ""){
                    return_quantity = 0;
                }  

                var quantity = (quantity_optional - return_quantity);

                var rate = $(this).find("#detail").data('rate');
                var discount = $(this).find("#detail").data('discount');

                if(discount == ""){
                    discount = 0;
                }

                var discount_type = $(this).find("#detail").data('discount_type');

                if(discount_type == 1){
                    amount = ((rate * quantity) - discount);
                }
                else if(discount_type == 0){
                    dis = ((rate * quantity * discount)/100);
                    amount = ((rate * quantity) - dis);
                }
                else{
                    amount = (rate * quantity);
                }

                total_amount = (total_amount + amount);
                
            });

            var tax = ((total_amount * tax_main)/100);

            var final_total = (total_amount + adjustment + shipping_charge + pr_adjustment + tax);

            var payment_receive = (invoice_total_amount - due_amount);

            if(final_total<payment_receive){
                $('#msg').html('Final total is less than payment receive');
                return false;
            }else{
                return true;
            }

        }

        function quantity(data,x){
            var item_quantity = parseInt(document.getElementById('invoice_quantity').rows[x].cells[2].innerHTML);
            var return_quantity = parseInt($(data).val());

            if(return_quantity>item_quantity){
                $(data).val(item_quantity);
            }
            if(return_quantity<item_quantity){
                $(data).val(return_quantity);
            }
            
        }
    </script>
@endsection
