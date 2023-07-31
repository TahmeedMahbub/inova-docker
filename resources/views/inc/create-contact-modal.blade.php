<div class="uk-modal" id="addContact" role="dialog">
    <div class="uk-modal-dialog">
        
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Add Contact</h3>
        </div>
        
        <div class="uk-modal-body">
            <div class="md-card-content">
                <div class="uk-overflow-container">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align">
                            <label for="item_category_id" class="uk-vertical-align-middle">Category<span style="color: red;" class="asterisc">*</span></label>
                        </div>
                        <div class="uk-width-medium-2-5">
                            <select id="contact_category_id" class="form-control" name="contact_category_id" required></select>
                            
                            @if($errors->first('contact_category_id'))
                                <div class="uk-text-danger uk-margin-top">Category is Required.</div>
                            @endif

                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align">
                            <label class="uk-vertical-align-middle" for="display_name">Display Name<span style="color: red;" class="asterisc">*</span></label>
                        </div>
                        <div class="uk-width-medium-2-5">
                            <input class="md-input" type="text" id="display_name" name="display_name" value="{{old('display_name')}}" required/>
                            @if($errors->has('display_name'))
                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('display_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align">
                            <label class="uk-vertical-align-middle" for="phone_number_1">Contact No.<span style="color: red;" class="asterisc">*</span></label>
                        </div>
                        <div class="uk-width-medium-2-5">
                            <label for="item_name">Contact No.</label>
                            <input class="md-input" type="text" id="phone_number_1" name="phone_number_1" required/>
                            @if($errors->has('item_name'))
                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('phone_number_1') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="md-btn md-btn-flat uk-modal-close">Cancel</button>
            <button id="submitBtn" type="submit" class="md-btn md-btn-flat md-btn-flat-primary submitbtn uk-modal-close">Confirm</button>
        </div>

    </div>
</div>