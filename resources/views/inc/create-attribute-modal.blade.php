<div class="uk-modal" id="addAttribute" role="dialog">
    <div class="uk-modal-dialog" style="margin: 0 auto; top: 40%; overflow: auto">
        
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Add Attribute</h3>
        </div>
        
        <div class="uk-modal-body">
            <div class="md-card-content">
                <div class="uk-overflow-container">

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4 uk-vertical-align">
                            <label class="uk-vertical-align-middle" for="attribute_name">Attribute Name<span style="color: red;" class="asterisc">*</span></label>
                        </div>
                        <div class="uk-width-medium-3-4">
                            <input class="md-input" type="text" id="attribute_name" name="attribute_name" value="{{old('attribute_name')}}" required/>
                            @if($errors->has('attribute_name'))
                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('attribute_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div id="attr_value_container" class="uk-grid" style="max-height: 30vh; margin-top: 0; overflow: auto">
                        <div class="uk-width-medium-1-3 uk-margin-medium-top">
                            <div class="uk-input-group">
                                <label for="attributes_value_0">Value</label>
                                <input class="md-input" type="text" id="attribute_values_0" name="attribute_values[]" value="{{old('attribute_values')}}" required/>
                                <span class="uk-input-group-addon">
                                    <a href="#" class="btnSectionClone"
                                        onclick="addSection(this)" id="add_attr_value_btn_0"><i
                                            class="material-icons md-24">&#xE146;</i></a>
                                </span>
                            </div>
                            @if($errors->has('attribute_values.*'))
                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('attribute_values.*') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="md-btn md-btn-flat uk-modal-close">Cancel</button>
            <button id="submitAttributeBtn" type="submit" class="md-btn md-btn-flat md-btn-flat-primary submitbtn uk-modal-close">Confirm</button>
        </div>

    </div>
</div>

<script>
    function addSection(e) {
            $(e).addClass('btnSectionRemove').removeClass('btnSectionClone').attr('onclick', 'removeSection(this)').find(
                'i').text('delete');
            var x = $(e).attr('id').match(/(\d+)/g)[0];
            x++;
            var content =  `<div class="uk-width-medium-1-3 uk-margin-medium-top">
                                <div class="uk-input-group">
                                    <div class="md-input-wrapper">
                                        <label for="attributes_value_0">Value</label>
                                        <input class="md-input" type="text" id="attribute_values`+ x +`" name="attribute_values[]" value="{{old('attribute_values')}}" required/>
                                        <span class="md-input-bar"></span>
                                    </div>
                                    <span class="uk-input-group-addon">
                                        <a href="#" class="btnSectionClone"
                                            onclick="addSection(this)" id="add_attr_value_btn_`+ x +`"><i
                                                class="material-icons md-24">&#xE146;</i></a>
                                    </span>
                                </div>
                                @if($errors->has('attribute_values.*'))
                                    <div class="uk-text-danger uk-margin-top">{{ $errors->first('attribute_values.*') }}</div>
                                @endif
                            </div>`;
            $('#attr_value_container').append(content);
        }
</script>