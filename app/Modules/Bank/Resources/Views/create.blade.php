@extends('layouts.main')

@section('title', 'Bank Account')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('bank_store'), 'method' => 'POST', 'class' => 'user_edit_form','files' => 'true', 'enctype' => "multipart/form-data"]) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Bank Info</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="date">Date<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                            <input class="md-input" type="text" id="date" name="date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                            @if($errors->first('date'))
                                                <div class="uk-text-danger">Date is required.</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                          <label class="" for="customer_name">Account Type<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label> <br>
                                            <select  title="Select Customer" id="type" name="type" class="md-input select2-single-search-dropdown"  required>

                                                @if('Deposit'==$id)
                                                    <option value="Deposit" selected>Deposit</option>
                                                @elseif('Withdrawal'==$id)
                                                    <option value="Withdrawal" selected>Withdrawal</option>
                                                    @endif
                                            </select>
                                            @if($errors->first('type'))
                                               <div class="uk-text-danger">Type is required.</div>
                                            @endif
                                        </div>

                                        <div class="uk-width-medium-1-4">
                                          <label class="uk-vertical-align-middle" for="customer_name">Payment Mode<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label></br>
                                            <select  class="md-input select2-single-search-dropdown" title="Bank Name" id="ank_name_id" name="payment_mode" required>
                                                <option value="">Select</option>
                                                @foreach($payment_mode as $payment_mode_data)
                                                    <option value="{{ $payment_mode_data->id}}">{{ $payment_mode_data->account_name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->first('payment_mode'))
                                                <div class="uk-text-danger">Payment Mode is required.</div>
                                            @endif
                                        </div>

                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="customer_name">Bank Name<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup>  </label> <br>
                                            <select onchange="bankaccount(this)"  title="Bank Name" id="bank_name_id" name="bank_name_id" class="md-input select2-single-search-dropdown" onchange="paymentTypeChanged(); createNote();" required>
                                                <option value="">Select Bank Name</option>
                                                @foreach($bank_names as $bank_name)
                                                    <option   value="{{ $bank_name->id}}/{{ $bank_name->account_id}}">{{ $bank_name->display_name }} </option>
                                                @endforeach
                                            </select>
                                            @if($errors->first('bank_name_id'))
                                                <div class="uk-text-danger">Bank Name is required.</div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="total_amount">Total Amount<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                            <input class="md-input" type="text" id="total_amount" name="total_amount" oninput="createNote()" required/>
                                            @if($errors->first('total_amount'))
                                                <div class="uk-text-danger">Total Amount is required.</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label class="" for="particulars">Particulars<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                            <input class="md-input" type="text" id="particulars" name="particulars"   required/>
                                            @if($errors->first('particulars'))
                                                <div class="uk-text-danger">Particulars is required.</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-4" id="cheque_number_container" style="display:none;">
                                            <label for="cheque_number">Cheque Number</label> <br>
                                            <select name="cheque_number" id="cheque_number" class="md-input select2-single-search-dropdown" onchange="createNote()">
                                                <option value="">Select a bank first!</option>
                                            </select>
                                            @if ($errors->has('cheque_number'))
                                                <span class="uk-text-danger">{{ $errors->first('cheque_number') }}</span>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-4" id="issue_date_container" style="display:none;">
                                            <label class="uk-vertical-align-middle" for="issue_date">Issue Date</label>
                                            <input class="md-input" type="text" id="issue_date" name="issue_date" onchange="createNote()" data-uk-datepicker="{format:'DD-MM-YYYY'}" >
                                            @if($errors->first('issue_date'))
                                                <div class="uk-text-danger">Date is required.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-3-4">
                                            <label class="uk-vertical-align-middle" for="notes">Notes</label>
                                            <input class="md-input" type="text" id="notes" name="notes"   />
                                        </div>
                                        <div class="uk-width-1-4">
                                            <label class="uk-vertical-align-middle" for="notes"> File</label>
                                            <input id="form-file" name="file1" type="file">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        altair_forms.parsley_validation_config();
    </script>
    <script type="text/javascript">
    
    function createNote(){
            var issue_date      = $("#issue_date").val() || "";
            var amount          = $("#total_amount").val() || 0;
            var paid_through_id = $("#bank_name_id").val().split('/')[1] || 3;
            var cheque_number   = $("#cheque_number").val();
            var acc_name = "";
            $.ajax({
                type: "GET",
                url: "/api/manual-journal/account-by-id/"+paid_through_id,
                success: function (response1) {
                    acc_name = response1.account_name;
                    
                    if(paid_through_id == 3)
                    {
                        var note = "Amount: "+amount+" TK, Via Cash";
                    }
                    else if(cheque_number === undefined || cheque_number == null)
                    {
                        var note = "Amount: "+amount+" TK "+ (issue_date != "" ? " on "+issue_date : "" )+ ", Via "+acc_name;
                    }
                    else
                    {
                        var note = "Amount: "+amount+" TK, using Cheque Number: "+cheque_number + (issue_date != "" ? "  on "+issue_date : "" )+ ", from "+acc_name;
                    }
                    $("#notes").empty();
                    $("#notes").val(note);
                }
            });
        }

        function bankaccount(name) {
            var id =name.value.split('/')[1];
            var index= $('#account').find(":selected").index();
            $("select#account").prop('selectedIndex', 2);

            if(typeof id !== 'undefined' && id != 3){
                var url = "{{ route('available_cheque_number', ['id' => ':id']) }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function (response) {
                        $("#cheque_number").empty();
                        option_html = "";
                        $.each(response.data, function (index, chequePage) {
                            option_html += '<option value="'+chequePage+'">'+chequePage+'</option>';
                        });
                        $("#cheque_number").append(option_html);
                        
                        var amount          = $("#total_amount").val() || 0;
                        var paid_through_id = $("#bank_name_id").val().split('/')[1] || 3;
                        var issue_date      = $("#issue_date").val() || "";
                        var acc_name = "";
                        $.ajax({
                            type: "GET",
                            url: "/api/manual-journal/account-by-id/"+paid_through_id,
                            success: function (response1) {
                                acc_name = response1.account_name;
                                if(paid_through_id == 3)
                                {
                                    var note = "Amount: "+amount+" TK, Via Cash";
                                }
                                else if(Object.values(response.data)[0] === undefined || Object.values(response.data)[0] == null)
                                {
                                    var note = "Amount: "+amount+" TK, "+ (issue_date != "" ? " on "+issue_date : "" )+ " Via "+acc_name;
                                }
                                else
                                {
                                    var note = "Amount: "+amount+" TK, "+ (issue_date != "" ? " on "+issue_date : "" )+ " using Cheque Number: "+Object.values(response.data)[0]+", from "+acc_name;
                                }
                                
                                $("#notes").empty();
                                $("#notes").val(note);
                            }
                        });
                    }
                });
                $('#cheque_number_container, #issue_date_container').show(800);
                $('#cheque_number_container, #issue_date_container').attr('required', true);
            }else{
                $('#cheque_number_container, #issue_date_container').hide(800);
                $('#cheque_number_container, #issue_date_container').attr('required', false);
                $('#cheque_number_container input, #issue_date_container input').val('');
            }

        }

        $('#show_invoice').show();
        $('#bank_info').show();

        $('#bank_name_id').change(function(){
            $( "#bank_name_id option:selected").each(function(){
                if($(this).attr("value")=="3"){
                    $("#show_invoice").hide();
                    $("#bank_info").hide();
                }
                if($(this).attr("value")=="4"){
                    $("#show_invoice").show();
                    $("#bank_info").show();
                }
            });
        }).change();


    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        var bank  = '<?php    echo $id;   ?>';
        if( bank == "Deposit"){
          $('#sidebar_bank_bank').addClass('act_item');
        }
        else{
        $('#sidebar_bank_bank2').addClass('act_item');
        }
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>

@endsection
