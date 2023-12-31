@extends('layouts.main')

@section('title', 'Expense')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{url('app/moneyout/bill/bill.module.js')}}"></script>
    <script src="{{url('app/moneyout/bill/expenseEdit.controller.js')}}"></script>
@endsection
@section('styles')
<style media="screen">
span.select2-container{
z-index: 30!important;
}
.dwn_btn{
  background-color: #1976d2; /* Green */
  border: none;
  color: white;
  padding: 4px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  float:right;
  border-radius: 2px;
}
.dwn_btn a{
  color: white;
}
input{
    margin-top: 15px;
}
</style>
@section('content')
    <div class="uk-grid" ng-controller="ExpenseEditController">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('expense_update', ['id' => $expense->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">

                        <input type="hidden" ng-init="expense_id='asdfg'" value="{{$expense->id}}" name="expense_id" ng-model="expense_id">

                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Expense</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div style="margin-top: 8px" class="uk-width-medium-1-4">
                                      <label  for="Number">EXP Number </label>
                                       <input type="text" name="" class="md-input" value="{{ 'EXP - '.str_pad($expense->expense_number,6,'0',STR_PAD_LEFT) }}" disabled>
                                    </div>
                                    <div style="margin-top: 8px" class="uk-width-medium-1-4">
                                      <label class="uk-vertical-align-middle" for="expense_date">Expense Date</label>
                                        <!-- <label for="expense_date">Select date</label> -->
                                        <input class="md-input" type="text" id="expense_date" name="expense_date" value="{{ date("d-m-Y", strtotime($expense->date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                      <label class="uk-vertical-align-middle" for="customer_name">Expense Account</label> <br>
                                        <select class="md-input select2-single-search-dropdown"  title="Select Customer" id="account_id" name="account_id" required>
                                            <option value="">Select Account</option>
                                            @foreach($accounts as $account)
                                                <option value="{{ $account->id }}" {{ $account->id == $expense->account_id ? "selected='selected'" : '' }}>{{ $account->account_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="margin-top: 8px" class="uk-width-medium-1-4">
                                      <!-- <label class="uk-vertical-align-middle" for="amount">Amount</label> -->
                                        <label for="amount">Enter Amount</label>
                                        <input class="md-input" type="text" id="amount" ng-model="amount" name="amount" value="{{ $expense->amount }}" ng-keyup="calculateTax()" />
                                        @if($errors->first('amount'))
                                            <div class="uk-text-danger">Amount is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-4">
                                      <label class="uk-vertical-align-middle" for="customer_name">Select Tax</label> <br>
                                        <select id="tax_id"
                                                class="tax_id md-input select2-single-search-dropdown"
                                                name="tax_id"
                                                ng-model="tax_id"
                                                ng-change="calculateTax()" required>

                                        </select>
                                        <!-- Tax Amount = @{{ total_tax | number : 2}} BDT -->
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                      <label class="uk-vertical-align-middle" for="customer_name">Amount Is</label> <br>
                                        <select
                                                id="amount_is"
                                                class="amount_is md-input select2-single-search-dropdown"
                                                name="amount_is"
                                                ng-model="amount_is"
                                                ng-change="calculateTax()"
                                                required>
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="project_id">Project</label> <br>
                                        <select id="project_id"
                                            class="project_contact_id md-input select2-single-search-dropdown"
                                            name="project_contact_id">
                                            <option value="">Select Project</option>
                                            @foreach ($projects as $project)
                                                <option value="{{$project->id}}" {{$project->id == $expense->project_contact_id ? "selected" : '' }}>{{$project->display_name}}</option>                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                      <label class="uk-vertical-align-middle" for="deposite_to">Paid Through</label> <br>
                                        <select
                                                id="paid_through_id"
                                                class="paid_through_id md-input select2-single-search-dropdown"
                                                name="paid_through_id"
                                                ng-model="paid_through_id"
                                                ng-change="getAccountType()"
                                                onchange="paymentTypeChanged()"
                                                required>
                                        </select>
                                    </div>
                                    @if($errors->first('payment_mode_id'))
                                        <div class="uk-text-danger">Deposite is required.</div>
                                    @endif
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-4">
                                      <label class="uk-vertical-align-middle" for="customer_name">Paid To</label> <br>
                                        <select class="md-input select2-single-search-dropdown" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="customer_id" name="customer_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $customer->id == $expense->vendor_id ? "selected='selected'" : '' }} >{{ $customer->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div style="margin-top: 9px" class="uk-width-medium-1-4">
                                    <label for="reference">Enter Reference Number</label>
                                    <input class="md-input" type="text" id="reference" name="reference" value="{{ $expense->reference }}" />
                                </div>
                                
                                <div class="uk-width-medium-1-4" id="cheque_number_container" style="{{ $expense->paid_through_id == 3 ? 'display:none' : '' }}">
                                    <label for="cheque_number">Cheque Number</label> <br>
                                    <select name="cheque_number" id="cheque_number" class="md-input select2-single-search-dropdown">
                                        <option value="">Select a bank first!</option>
                                        @foreach ($cheque_numbers as $cheque_number)
                                            <option value="{{$cheque_number}}" {{ $expense->cheque_number == $cheque_number ? 'selected' : '' }}>{{$cheque_number}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('cheque_number'))
                                        <span class="uk-text-danger">{{ $errors->first('cheque_number') }}</span>
                                    @endif
                                </div>

                                <div class="uk-width-medium-1-4" id="issue_date_container" style="{{ $expense->paid_through_id == 3 ? 'display:none' : '' }}">
                                    <label for="issue_date">Issue Date</label>
                                    <input class="md-input" type="text" id="issue_date"
                                        name="issue_date" value="{{ $expense->issue_date }}" data-uk-datepicker="{format:'DD-MM-YYYY'}"/>
                                    @if ($errors->has('issue_date'))
                                        <span class="uk-text-danger">{{ $errors->first('issue_date') }}</span>
                                    @endif
                                </div>
                            </div>
                                    <div style="margin-top: 30px" ng-if="account_type!=3" class="uk-width-medium-4-5" id="show">
                                        <label for="reference">Optional(Cash) Requeired(Undeposited Fund)</label>
                                        <input class="md-input" type="text" id="reference" name="bank_info" value="{{$expense->bank_info}}" />
                                        @if($errors->first('bank_info'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>
                                    <div style="margin-top: 50px" ng-if="account_type!=3" class="uk-width-medium-1-5" id="show">
                                        <input type="checkbox"
                                               @if($expense->invoice_show == "on")
                                               checked="checked"
                                               @endif
                                               id="invoice_show" name="invoice_show" />
                                        <label for="switch_demo_1" class="inline-label" id="show_invoice">Show In Invoice</label>
                                        @if($errors->first('invoice_show'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>
                                    


                                </div>



                                        <div class="uk-grid hidden" data-uk-grid-margin >
                                            <div class="uk-width-medium-1-1">
                                                <label for="user_edit_uname_control">Attach Files: </label>
                                                <span>
                                                    @if($expense->file_url)
                                                        <a download href="{{ url($expense->file_url) }}">download attachment </a>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="uk-width-medium-1-1">
                                                <div class="uk-form-file uk-text-primary"
                                                     style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                                    <p style="margin: 4px;">Uplaod File</p>
                                                    <input  onchange="uploadLavel()" id="form-file" type="file" name="file1" class="dropify">
                                                </div>
                                            </div>
                                            <p id="upload_name"></p>
                                        </div>


                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note">Customer note</label>
                                                <textarea class="md-input" id="customer_note" name="customer_note"> {{ $expense->note }}</textarea>
                                            </div>
                                        </div>
                                        <div class="uk-grid" data-uk-grid-margin>
                                              <div class="uk-width-medium-1-1">
                                                  <div class="md-card">
                                                      <div class="md-card-content">
                                                        @if($expense->file_url)
                                                        <button class="dwn_btn"><a text-decoration: none;" class='button' download href="{{ url($expense->file_url) }}">download attachment </a></button>
                                                        @endif
                                                          <h3 class="heading_a uk-margin-small-bottom">
                                                              Upload File
                                                          </h3>
                                                          <input class="dropify" type="file" name="file1" id="input-file-a" />

                                                      </div>

                                                  </div>
                                              </div>
                                          </div>

                                </div>

                                <hr>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        @if($expense->save==1)
                                            <button type="submit" class="md-btn md-btn-primary" name="save">Save</button>
                                        @else

                                            <button type="submit" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" name="submit">Submit</button>
                                        @endif
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
        function paymentTypeChanged(){
            if($('#paid_through_id option:selected').val() != 3){
                var url = "{{ route('available_cheque_number', ['id' => ':id']) }}";
                url = url.replace(':id', $('#paid_through_id option:selected').val());
                $.ajax({
                    type: "get",
                    url: url,
                    success: function (response) {
                        console.log(response.data);
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

        function uploadLavel()
        {
            var fullPath = document.getElementById('form-file').value;
            var upload_file_name_ = document.getElementById('upload_name');
            if (fullPath) {
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }

                upload_file_name_.innerHTML  = filename;

            }
        }
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_expense').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
