<!-- main sidebar  -->
@php
    $helper = new \App\Lib\Helpers;
@endphp
<aside id="sidebar_main">
    <div style="background-color: #fff; text-align: center;" class="sidebar_main_header">
        <div class="sidebar_logo">
            <a style="margin-left: 0px;" href="{{ url('dashboard') }}" class="sSidebar_hide sidebar_logo_large">
                <img class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15"
                    width="71" />
            </a>
        </div>
    </div>

    <div class="menu_section">
        <ul>
            <li id="sidebar_main_account" class="" title="Account">
                <a id="tiktok_account" href="#">
                    <span class="menu_icon"><i class="material-icons">&#x2100;</i></span>
                    <span class="menu_title">Account</span>
                </a>

                <ul>
                    <li id="sidebar_dashboard" class="" title="Dashboard">
                        <a href="{{ route('dashboard') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                            <span class="menu_title">Dashboard</span>
                        </a>
                    </li>

                    @if ($helper->hasModuleAccess(['contact', 'contact/category']))
                        <li id="sidebar_contact" class="" title="contacts">
                            <a href="{{ route('contact') }}">
                                <span class="menu_icon"><i class="material-icons">perm_contact_calendar</i></span>
                                <span class="menu_title">Contacts</span>
                            </a>
                        </li>
                    @endif

                    @if ($helper->hasModuleAccess(['inventory', 'inventory/category', 'inventory/subcategory', 'stock-transfer', 'attributes', 'offer']))
                        <li id="sidebar_inventory" class="" title="Services">
                            <a href="#">
                                <span class="menu_icon"><i class="material-icons">home</i></span>
                                <span class="menu_title">Inventory</span>
                            </a>
                            <ul>
                                @if ($helper->hasModuleAccess(['inventory', 'inventory/category', 'inventory/subcategory']))
                                    <li id="sidebar_inventory_inventory" class=""><a href="{{ route('inventory') }}">Product/Service </a></li>
                                    <li id="sidebar_inventory_asset" class=""><a href="{{ route('asset') }}">Asset </a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['stock-transfer']))
                                    <li id="sidebar_inventory_product_transfer" class=""><a href="{{ route('stock_transfer') }}">Stock Transfer</a></li>
                                @endif                                
                                @if ($helper->hasModuleAccess(['attributes']))
                                    <li id="sidebar_attributes" class=""><a href="{{ route('attributes') }}">Attributes</a></li>
                                @endif                                
                                @if ($helper->hasModuleAccess(['offer']))
                                    <li id="sidebar_offers" class=""><a href="{{ route('offers') }}">Offers</a></li>
                                @endif                                
                                @if ($helper->hasModuleAccess(['inventory']))
                                    <li id="sidebar_damage" class=""><a href="{{ route('damage') }}">Damage</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if ($helper->hasModuleAccess(['bill-of-material','product-track']))
                        <li id="sidebar_production" class="" title="Services">
                            <a href="#">
                                <span class="menu_icon"><i class="material-icons">add_shopping_cart</i></span>
                                <span class="menu_title">Production</span>
                            </a>
                            <ul>
                                @if ($helper->hasModuleAccess(['bill-of-material']))
                                    <li id="sidebar_bom" class=""><a href="{{ route('bom') }}">Bill Of Materials</a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['product-track']))
                                    <li id="sidebar_track" class=""><a href="{{ route('track') }}">Manufacture</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if ($helper->hasModuleAccess(['bank','check-book']))
                        <li id="sidebar_bank" class="" title="Account">
                            <a href="#">
                                <span class="menu_icon"><i class="material-icons">account_balance_wallet</i></span>
                                <span class="menu_title">Bank</span>
                            </a>
                            <ul>
                                @if ($helper->hasModuleAccess(['bank']))
                                    <li id="sidebar_bank_bank" class=""><a href="{!! route('bank_deposit') !!}">Deposit</a></li>
                                    <li id="sidebar_bank_bank2" class=""><a href="{!! route('bank_withdraw') !!}">Withdraw</a></li>
                                    <li id="sidebar_bank_report" class=""><a href="{{ url('bank/report') }}">Bank Report</a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['check-book']))
                                    <li id="sidebar_cheque_book" class=""><a href="{{ route('cheque_book') }}">Cheque Book</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if ($helper->hasModuleAccess(['income', 'invoice', 'payment-received', 'credit-note', 'estimate']))
                        <li id="sidebar_money_in" class="" title="Money In">
                            <a href="#" id="tiktok5">
                                <span class="menu_icon"><i class="material-icons">attach_money</i></span>
                                <span class="menu_title">Money In</span>
                            </a>
                            <ul>
                                @if ($helper->hasModuleAccess(['income']))
                                    <li id="sidebar_income" class=""><a href="{{ route('income') }}">Other Incomes</a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['invoice']))
                                    <li id="sidebar_invoice" class=""><a href="{{ route('invoice') }}">Primary Sales</a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['payment-received']))
                                    <li id="sidebar_payment_recieve" class=""><a href="{{ route('payment_received') }}">Money Received</a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['credit-note']))
                                    <li id="sidebar_credit_note" class=""><a href="{{ route('credit_note') }}">Sales Return</a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['estimate']))
                                    <li id="sidebar_estimate" class=""><a href="{{ route('estimate') }}">Quotation</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if ($helper->hasModuleAccess(['expense', 'bill', 'payment-made', 'vendor-credit']))
                        <li id="sidebar_money_out" class="" title="Money Out">
                            <a href="#" id="tiktok6">
                                <span class="menu_icon"><i class="material-icons">money_off</i></span>
                                <span class="menu_title">Money Out</span>
                            </a>
                            <ul>
                                @if ($helper->hasModuleAccess(['expense']))
                                    <li id="sidebar_expense" class=""><a href="{{ route('expense') }}">Other Expenses</a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['bill']))
                                    <li id="sidebar_bill" class=""><a href="{{ route('bill') }}">Purchases</a></li>
                                @endif
                                    <!-- <li id="serial_entry" class=""><a href="{{ route('serial_entry') }}">Serial Entry</a></li> -->
                                @if ($helper->hasModuleAccess(['payment-made']))
                                    <li id="sidebar_payment_made" class=""><a href="{{ route('payment_made') }}">Payments</a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['vendor-credit']))
                                    <li id="vendor_credit_index" class=""><a href="{{ url('vendor-credit') }}">Purchase Return</a></li>
                                @endif
                                    <!-- <li id="sidebar_sales_commission" class=""><a href="{{ route('sales_commission') }}">Sales Commission</a></li> -->
                            </ul>
                        </li>
                    @endif
                    
                    @if ($helper->hasModuleAccess(['account-chart', 'manual-journal']))
                        <li id="sidebar_account" class="" title="Accountant">
                            <a href="#">
                                <span class="menu_icon"><i class="material-icons">account_balance_wallet</i></span>
                                <span class="menu_title">Accountant</span>
                            </a>
                            <ul>
                                @if ($helper->hasModuleAccess(['account-chart']))
                                    <li id="sidebar_account_chart_of_accounts" class=""><a href="{{ route('account_chart') }}">Chart of Accounts</a></li>
                                @endif
                                @if ($helper->hasModuleAccess(['manual-journal']))
                                    <li id="sidebar_account_jurnal" class=""><a href="{{ route('journal') }}">Manual Journal</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if ($helper->hasModuleAccess(['report']))
                        <li id="sidebar_reports" class="" title="reports">
                            <a href="{{ url('report') }}">
                                <span class="menu_icon"><i class="material-icons">pie_chart</i></span>
                                <span class="menu_title">Reports</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</aside>
<!-- main sidebar end -->
