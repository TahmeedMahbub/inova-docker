<div class="uk-modal" id="chooseVariationWithAttributeValues" role="dialog">
    <div class="uk-modal-dialog" style="margin: 0 auto; top: 40%">
        
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Add Attribute Value</h3>
        </div>

        {{ Form::open(['id' => 'add_attribute_value_form' ]) }}
        
            <div class="uk-modal-body">
                <div class="md-card-content">
                    <div class="uk-overflow-container">                    
                    </div>
                </div>
            </div>
            
            <div class="uk-modal-footer uk-text-right">
                <button type="button" id="choose_variation_with_attribute_values_modal_close" class="md-btn md-btn-flat uk-modal-close">Cancel</button>
                <button id="addVariationSubmitBtn" class="md-btn md-btn-flat md-btn-flat-primary submitbtn uk-modal-close">Confirm</button>
            </div>

        {{ Form::close() }}
    </div>
</div>