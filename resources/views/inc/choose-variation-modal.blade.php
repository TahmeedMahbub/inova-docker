@if (isset($attributes) && isset($item_variations))
    <div class="uk-modal" id="chooseVariation" role="dialog">
        <div class="uk-modal-dialog">

            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Choose Variation</h3>
            </div>

            <div class="uk-modal-body uk-overflow-container">
                <div class="md-card-content">
                    {{-- <div class="uk-grid">
                        <div class="uk-width-1-2">
                            <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa;" id="variation_name_0">
                                Demo Name 1
                            </div>
                        </div>
                        <div class="uk-width-1-2"
                            style="padding: 10px; height: 40px; position:relative; background:#2991fa ">
                            <div id="variation_check_container_0" style="position: absolute; right: 10px; height: 40px; ">
                                <input {{ old('select_variation')?"checked":'' }} type="radio"
                                    name="select_variation" id="select_variation_0"
                                    style=" margin-top: -1px; height: 25px; width: 20px;" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" id="variation_details_0">
                        <div class="uk-width-1-3 uk-margin-small-top uk-text-center">
                            <h5><span style="font-weight: 900"> Size:</span> Large</h5>
                        </div>
                        <br>
                        <div class="uk-width-1-1">
                            <hr>
                        </div>
                        <br>
                        <div class="uk-width-1-2 uk-margin-small-top">
                            <h4><span style="font-weight: 900"> SKU:</span> 0000001</h4>
                        </div>
                        <div class="uk-width-1-2 uk-margin-small-top">
                            <h4><span style="font-weight: 900"> Sales Price:</span> 1200</h4>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($attributes as $key => $attribute)
                            <div class="col-md-6 col-sm-12 uk-margin-small-top">
                                <label for="" class="uk-vertical-align-middle label_attributes" id="label_attribute_id_0">Demo Name</label>
                                <select class="form-control choose_variation" onchange="">
                                    <option value="">Select a Value</option>
                                    @foreach ($attribute_values[$attribute->id] as $attribute_value)
                                        <option value="">Select an Option</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>

            <div class="uk-modal-footer">
                <div class="uk-text-right">
                    <button type="button" id="choose_variation_modal_close" class="md-btn md-btn-flat uk-modal-close">Cancel</button>
                    <button id="variationSubmitBtn" type="submit"
                        class="md-btn md-btn-flat md-btn-flat-primary submitbtn uk-modal-close">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endif
