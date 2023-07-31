@extends('layouts.main')

@section('title', 'Manufacture')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Manufacture Details</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-2">
                                        <p><strong>Prod-number:</strong> PROD-{{ str_pad($manufacture->id, 6, "0", STR_PAD_LEFT) }}</p>
                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        <p><strong>Ref:</strong> {{ isset($manufacture->estimate) ? $manufacture->estimate->estimate_number : '' }}</p>
                                    </div>
                                    <div class="uk-width-medium-1-2 uk-margin-top">
                                        <p><strong>Start-date:</strong> {{ $manufacture->start_date}}</p>
                                    </div>
                                    <div class="uk-width-medium-1-2 uk-margin-top">
                                        <p><strong>End date:</strong> {{ $manufacture->end_date}}</p>
                                    </div>
                                </div>
                                <hr>
                                <strong class="uk-margin-top uk-display-block">Product to manufacture</strong>
                                <div class="md-card uk-margin-medium-bottom uk-margin-top">
                                    <div class="md-card-content">
                                        <div class="uk-overflow-container">
                                            <table class="uk-table uk-table-striped uk-table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="60%">Name</th>
                                                        <th width="20%">Pcs</th>
                                                        <th width="20%">Files</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($manufacture->manufactureEntries as $mf_entry)
                                                    <tr>
                                                      
                                                        <td>{{ !empty($mf_entry->variation_id) ? $mf_entry->item_variation->variation_name : $mf_entry->item->item_name }}</td>
                                                        <td>{{ $mf_entry->manufacture_quantity }}</td>
                                                        <td><a href="{{route('sop_all_file_show' ,['id' => $mf_entry->item->id])}}" target="_blank">SOP Files</a>&nbsp;&nbsp;&nbsp;<a href="{{route('design_all_file_show',['id' => $mf_entry->item->id])}}" target="_blank"> Design Files</a></td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-text-right">
                                    <button onclick="add_to_stock({{ $manufacture->id }})" class="md-btn md-btn-success add_to_stock {{ in_array('incomplete', $manufacture->manufacturePhases->pluck('status')->toArray()) || $manufacture->status == 'complete' ? 'disabled' : '' }}">
                                        {{ $manufacture->status == 'complete' ? 'Stock added' : 'Add to Stock' }}
                                    </button>
                                </div>
                                @foreach($manufacture->manufacturePhases as $phase_key => $manufacture_phase)
                                    <div class="md-card uk-margin-top phase_container">
                                        <div class="md-card-content">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-2">
                                                    <strong>{{ $manufacture_phase->phase_name }}</strong>
                                                </div>
                                                <div class="uk-width-medium-1-2 uk-text-right">
                                                    <p>
                                                        <input type="checkbox" onchange="statusChange(this)" class="custom_checkbox" name="mark_as_complete"
                                                            id="mark_as_complete_{{ $phase_key }}" {{ $manufacture_phase->status == 'complete' ? 'checked' : '' }} {{ $manufacture->status == 'complete' ? 'disabled' : '' }}/>
                                                        <input type="hidden" value="{{ $manufacture_phase->id }}">
                                                        <label for="mark_as_complete_{{ $phase_key }}">Mark as complete</label>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-3">
                                                    <div class="md-card">
                                                        <div class="md-card-content">
                                                            <strong>Raw meterial used</strong>
                                                            <table class="uk-table uk-table-striped uk-table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product</th>
                                                                        <th>Pcs</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @if (count($manufacture_phase->manufacturePhaseRawMaterials) == 0)
                                                                            <tr class="uk-text-center">
                                                                                <td colspan="3">No data found</td>
                                                                            </tr>
                                                                        @else
                                                                            @foreach ($manufacture_phase->manufacturePhaseRawMaterials as $raw_material)
                                                                                <tr>
                                                                                    <td>{{ !empty($raw_material->variation_id) ? $raw_material->item_variation->variation_name : $raw_material->item->item_name}}</td>
                                                                                    <td>{{ number_format($raw_material->quantity, 2) }}</td>
                                                                                </tr>                                                                        
                                                                            @endforeach
                                                                        @endif
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="uk-grid">
                                                                <div class="uk-width-1-2">
                                                                    <a href="{{ route('phase_raw_material_show', ['id' => $manufacture_phase->id]) }}"
                                                                        class="md-btn md-btn-wave waves-effect waves-button">View</a>
                                                                </div>
                                                                <div class="uk-width-1-2 uk-text-right">
                                                                    <a href="{{ route('phase_raw_material_create', ['id' => $manufacture_phase->id]) }}"
                                                                        class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light add_new {{ $manufacture_phase->status =='complete' || $manufacture->status == 'complete' ? 'disabled' : '' }}" {{ $manufacture_phase->status =='complete' || $manufacture->status == 'complete' ? 'disabled' : '' }}>Add
                                                                        new</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-3">
                                                    <div class="md-card">
                                                        <div class="md-card-content">
                                                            <strong>Disburse</strong>
                                                            <table class="uk-table uk-table-striped uk-table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product</th>
                                                                        <th>Pcs</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @if (count($manufacture_phase->manufacturePhaseDisburses) == 0)
                                                                            <tr class="uk-text-center">
                                                                                <td colspan="3">No data found</td>
                                                                            </tr>
                                                                        @else
                                                                            @foreach ($manufacture_phase->manufacturePhaseDisburses as $disburse)
                                                                                <tr>
                                                                                    <td>{{ !empty($disburse->variation_id) ? $disburse->item_variation->variation_name : $disburse->item->item_name }}</td>
                                                                                    <td>{{ number_format($disburse->quantity, 2) }}</td>
                                                                                </tr>                                                                        
                                                                            @endforeach
                                                                        @endif
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="uk-grid">
                                                                <div class="uk-width-1-2">
                                                                    <a href="{{ route('phase_disburse_show', ['id' => $manufacture_phase->id]) }}"
                                                                        class="md-btn md-btn-wave waves-effect waves-button">View</a>
                                                                </div>
                                                                <div class="uk-width-1-2 uk-text-right">
                                                                    <a href="{{ route('phase_disburse_create', ['id' => $manufacture_phase->id]) }}"
                                                                        class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light add_new {{ $manufacture_phase->status =='complete' || $manufacture->status == 'complete' ? 'disabled' : '' }}" {{ $manufacture_phase->status =='complete' || $manufacture->status == 'complete' ? 'disabled' : '' }}>Add
                                                                        new</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-3">
                                                    <div class="md-card">
                                                        <div class="md-card-content">
                                                            <strong>Receive from {{ $manufacture_phase->factory->display_name }}</strong>
                                                            <table class="uk-table uk-table-striped uk-table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product</th>
                                                                        <th>Ctn</th>
                                                                        <th>Pcs</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @if (count($manufacture_phase->manufacturePhaseReceivesFromFactory) == 0)
                                                                            <tr class="uk-text-center">
                                                                                <td colspan="3">No data found</td>
                                                                            </tr>
                                                                        @else
                                                                            @foreach ($manufacture_phase->manufacturePhaseReceivesFromFactory as $receive)
                                                                                <tr>
                                                                                    <td>{{ $receive->variation->variation_name }}</td>
                                                                                    <td>{{ number_format($receive->variation->carton_size == 0 ? ($receive->variation->item->carton_size == 0 ? 0 : $receive->quantity / $receive->variation->item->carton_size) : $receive->quantity / $receive->variation->carton_size, 2) }}</td>
                                                                                    <td>{{ number_format($receive->quantity, 2) }}</td>
                                                                                </tr>                                                                        
                                                                            @endforeach
                                                                        @endif
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="uk-grid">
                                                                <div class="uk-width-1-2">
                                                                    <a href="{{ route('phase_receive_show', ['id' => $manufacture_phase->id]) }}"
                                                                        class="md-btn md-btn-wave waves-effect waves-button">View</a>
                                                                </div>
                                                                <div class="uk-width-1-2 uk-text-right">
                                                                    <a href="{{ route('phase_receive_create', ['id' => $manufacture_phase->id]) }}"
                                                                        class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light add_new {{ $manufacture_phase->status =='complete' || $manufacture->status == 'complete' ? 'disabled' : '' }}" {{ $manufacture_phase->status =='complete' || $manufacture->status == 'complete' ? 'disabled' : '' }}>Add
                                                                        new</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.editorConfig = function(config) {
                    config.language = 'es';
                    config.uiColor = '#F7B42C';
                    config.height = 300;
                    config.toolbarCanCollapse = true;

                };
                CKEDITOR.replace('requirements');
                // CKEDITOR.replace('editor2');
                // CKEDITOR.replace('editor3');
                // CKEDITOR.replace('editor4');
            </script>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_track').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        })
    </script>

    <script>

        $('.custom_checkbox').change(function() {
            if ($('.custom_checkbox:checked').length === $('.custom_checkbox').length) {
                $('.add_to_stock').removeClass('disabled');
            } else {
                $('.add_to_stock').addClass('disabled');
            }
        });

        function statusChange(e){
            var id = $(e).next().val();
            var status = $(e).is(':checked') ? 'complete' : 'incomplete';
            $.ajax({
                url: "{{ route('update_phase_status') }}",
                type: "POST",
                data: {
                    id: id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.status == 'success') {
                        UIkit.notify({
                            message: data.message,
                            status: 'success',
                            timeout: 2000,
                            pos: 'top-right'
                        });
                        if($(e).is(':checked')){
                            $(e).closest('.phase_container').find('.add_new').addClass('disabled');
                        }else{
                            $(e).closest('.phase_container').find('.add_new').removeClass('disabled');
                        }
                    } else if(data.status == 'error') {
                        $(e).is(':checked') ? $(e).prop('checked', false) : $(e).prop('checked', true);
                        UIkit.notify({
                            message: data.message,
                            status: 'danger',
                            timeout: 2000,
                            pos: 'top-right'
                        });
                    } else {
                        $(e).is(':checked') ? $(e).prop('checked', false) : $(e).prop('checked', true);
                        UIkit.notify({
                            message: 'Something went wrong',
                            status: 'danger',
                            timeout: 2000,
                            pos: 'top-right'
                        });
                    }
                }
            });
        }

        function add_to_stock(e) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#7cb342',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add to stock!'
            }).then(function() {
                $.ajax({
                    url: "{{ route('add_to_stock') }}",
                    type: "post",
                    data: {
                        id: "{{ $manufacture->id }}",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            UIkit.notify({
                                message: data.message,
                                status: 'success',
                                timeout: 2000,
                                pos: 'top-right'
                            });
                            $('.add_to_stock, .custom_checkbox, .add_new').prop("disabled", true);
                            $('.add_to_stock, .add_new').addClass('disabled');
                        } else {
                            UIkit.notify({
                                message: data.message,
                                status: 'danger',
                                timeout: 2000,
                                pos: 'top-right'
                            });
                        }
                    }
                });
            });
        }
    </script>
@endsection
