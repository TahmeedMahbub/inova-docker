@extends('layouts.main')

@section('title', 'Bank Account')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
<style media="screen">
span.select2-container{
z-index: 30 !important;
}
.uk-badge a{
color:white
}
input{
 margin-top:10px;
}
input .file{
margin-top:-20px;
}
.getMultipleRow input,discount_type{
 margin-top:-10px;
}
.discount_type{
 margin-top:-10px;
}
</style>
@endsection
@section('content')
    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('bank_update',['id' => $bank->id]), 'method' => 'POST', 'class' => 'user_edit_form','files' => 'true', 'enctype' => "multipart/form-data"]) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Edit Bank Info</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                 <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="date">Date<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                            <input class="md-input" type="text" id="date" name="date" data-uk-datepicker="{format:'DD-MM-YYYY'}" required value="{{ date("d-m-Y",strtotime($bank->date)) }}">
                                        </div>
                                        @if($errors->first('payment_mode'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif

                                        <div class="uk-width-medium-1-4">
                                          <label  for="customer_name">Account Type<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label> <br>
                                            <select  title="Select Customer" id="type" name="type"  class="md-input select2-single-search-dropdown" required>
                                               @if($bank->type == 'Deposit')
                                               <option value="Deposit" selected>Deposit</option>
                                               @endif
                                               @if($bank->type == 'Withdrawal')
                                               <option value="Withdrawal" selected>Withdrawal</option>
                                               @endif
                                            </select>
                                        </div>
                                        @if($errors->first('type'))
                                            <div class="uk-text-danger">Type is required.</div>
                                        @endif
                                        
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="customer_name">Payment Mode<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label> <br>
                                            <select  title="Bank Name" id="ank_name_id" name="payment_mode"  class="md-input select2-single-search-dropdown" required>
                                                <option value="">Select</option>
                                                @foreach($payment_mode as $payment_mode_data)
                                                    @if($payment_mode_data->id == $bank->payment_mode_id)
                                                    <option value="{{ $payment_mode_data->id}}" selected>{{ $payment_mode_data->account_name }}</option>
                                                    @else
                                                    <option value="{{ $payment_mode_data->id}}">{{ $payment_mode_data->account_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->first('payment_mode'))
                                            <div class="uk-text-danger">Payment Mode is required.</div>
                                        @endif
                                        <div style="display: none;" class="uk-width-medium-1-4">
                                          <label class="uk-vertical-align-middle" for="customer_name">Account<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label> <br>
                                            <select  title="Bank Name" id="bank_name_id" name="account"  class="md-input select2-single-search-dropdown" required>
                                                <option value="">Select Bank Name</option>
                                                @foreach($accounts as $account)
                                                @if($bank->account_id == $account->id)
                                                <option value="{{ $account->id}}" selected>{{ $account->account_name }}</option>
                                                @else
                                                    <option value="{{ $account->id}}">{{ $account->account_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>

                                         @if($errors->first('account'))
                                                <div class="uk-text-danger">Account is required.</div>
                                        @endif
                                       </div>
                                        <div class="uk-width-medium-1-4">
                                          <label  for="customer_name">Bank Name<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label> <br>
                                            <select onchange="bankaccount(this)" title="Bank Name" id="bank_name_id" name="bank_name_id"  class="md-input select2-single-search-dropdown" required>
                                                <option value="">Select Bank Name</option>
                                                @foreach($bank_names as $bank_name)
                                                @if($bank->contact_id == $bank_name->id)
                                                <option value="{{ $bank_name->id}}/{{ $bank_name->account_id}}" selected>{{ $bank_name->display_name }}</option>
                                                @else
                                                <option value="{{ $bank_name->id}}/{{ $bank_name->account_id}}">{{ $bank_name->display_name }}</option>
                                                @endif

                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->first('account'))
                                                <div class="uk-text-danger">Account is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="total_amount">Total Amount<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                            <input class="md-input" type="text" id="total_amount" name="total_amount"   value="{{$bank->total_amount}}" required/>
                                        </div>
                                        @if($errors->first('total_amount'))
                                            <div class="uk-text-danger">Field is Required.</div>
                                        @endif

                                        <div class="uk-width-medium-1-4">
                                          <label  for="particulars">Particulars<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                            <input class="md-input" type="text" id="particulars" name="particulars"   value="{{$bank->particulars}}" required/>
                                        </div>
                                        @if($errors->first('payment_mode'))
                                            <div class="uk-text-danger">Payment Mode is required.</div>
                                        @endif

                                        @php
                                            $response = json_decode($available_cheque_numbers->getContent(), true);
                                            $cheques  = $response['data'];
                                        @endphp
                                        
                                        <div class="uk-width-medium-1-4" id="cheque_number_container" style="{{ $bank_name->account_id == 3 ? 'display:none;' : '' }}">
                                            <label for="cheque_number">Cheque Number</label> <br>
                                            <select name="cheque_number" id="cheque_number" class="md-input select2-single-search-dropdown">
                                                <option value="{{ $bank->cheque_number }}">{{ $bank->cheque_number }}</option>                                                
                                                @foreach ($cheques as $available_cheque_number)
                                                    <option value="{{ $available_cheque_number }}">{{ $available_cheque_number }}</option>                                                
                                                @endforeach
                                            </select>
                                            @if ($errors->has('cheque_number'))
                                                <span class="uk-text-danger">{{ $errors->first('cheque_number') }}</span>
                                            @endif
                                        </div>
                                        
                                        <div class="uk-width-medium-1-4" id="issue_date_container" style="{{ $bank_name->account_id == 3 ? 'display:none;' : '' }}">
                                            <label class="uk-vertical-align-middle" for="issue_date">Issue Date</label>
                                            <input class="md-input" type="text" id="issue_date" name="issue_date" value="{{ date("d-m-Y", strtotime($bank->issue_date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" >
                                            @if($errors->first('issue_date'))
                                                <div class="uk-text-danger">Date is required.</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-3-4">
                                          <label class="uk-vertical-align-middle" for="notes">Notes</label>
                                          <input class="md-input" type="text" id="notes" name="notes"  value="{{$bank->notes}}"  />
                                         </div>
                                        @if($errors->first('notes'))
                                            <div class="uk-text-danger">Field is Required.</div>
                                        @endif
                                         <div class="uk-width-medium-1-4">
                                         <label class="uk-vertical-align-middle" for="notes"> File</label>
                                         @if($bank->file_url)
                                             <a download href="{{ url($bank->file_url) }}"><p class="uk-badge uk-text-medium uk-margin-bottom uk-float-right">Download Attachment</p></a>
                                         @endif
                                           <input class="file" id="form-file" name="file1" type="file">
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

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
    <script type="text/javascript">


        function bankaccount(name) {
            var id =name.value.split('/')[1];
            // $('#bank_list').hide();
            var index= $('#account').find(":selected").index();
            $("select#account").prop('selectedIndex', 2);
           // console.log(index);

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

        $('#sidebar_main_account').addClass('current_section');
        var bank  = '<?php    echo $bank->type;   ?>';
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
