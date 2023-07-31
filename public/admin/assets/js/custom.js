var item_selected = null;
var customer_id = null;
var row = null;

//contact category shows when click on +create contact link
$('#submitBtn').click(function () {

    var contact_category_id = $('#contact_category_id :selected').val();
    var display_name = $("#display_name").val();
    var phone_number_1 = $("#phone_number_1").val();

    $.ajax({
        type: 'post',
        url: '/api/contact/store',
        data: {
            contact_category_id: contact_category_id,
            display_name: display_name,
            phone_number_1: phone_number_1
        },
        success: function (data) {
            $(customer_id).append($('<option>', {
                value: data.id,
                text: data.display_name,
                'selected': 'selected'
            }));
            $('#addContact').hide();
        }
    });
});


//display name shows when click on +create contact link    
function openContactModal(e) {
    if($(e).attr('id').match(/(\d+)/g) !== null){
        customer_id = '#customer_id_' + $(e).attr('id').match(/(\d+)/g)[0];
    }else{
        customer_id = '#customer_id';
    }
    $.ajax({
        type: 'get',
        url: '/api/contact/get-contact-category',
        success: function (data) {
            $('#contact_category_id').empty();
            $.each(data.category, function (i, tmp) {
                $('#contact_category_id').append($('<option>', {
                    value: data.category[i].value,
                    text: data.category[i].text
                }));
            });
        }
    });

    $.ajax({

        type: 'get',
        url: '/api/contact/get-display-name',
        success: function (data) {
            $("#display_name").val(data.display_name);
        }
    });

}

//Removes previous item informations and adds new item informations to the items_chosen array
function itemChanged(e, type) {
    var row = $(e).attr('id').match(/(\d+)/g)[0];
    $('#variation_badge_container_' + row).remove();
    $('.free_entry_tr_' + row).remove()
    if ($('.getFreeEntryRow tr').length > 0) {
        $('#free_entry_header').show(400);
        $('#free_entry_details').show(800);
    } else {
        $('#free_entry_details').hide(400);
        $('#free_entry_header').hide(800);
    }
    var item_id = $(e).val();
    if (item_id != '') {
        var url = window.location.origin + "/api/account-chart/get-account-chart";
        if (ajax_data[item_id].item_category_id == 3 && type == 'purchase') {
            $.ajax({
                type: "get",
                url: url,
                success: function (response) {
                    $('#depreciation_rate_' + row).show(400);
                    $('#account_id_' + row).val(response.id).change();
                }
            });
        } else if (type == 'purchase') {
            $('#depreciation_rate_' + row).hide(400);
            $('#depreciation_rate_' + row).val('');
            $('#account_id_' + row).val(26).change();
        }
        items_chosen[row] = structuredClone(ajax_data[item_id]);
        items_chosen[row]['variation_id'] = '';
        items_chosen[row]['variations'] = [];
        url = window.location.origin + "/api/offers/get-offer/:id";
        url = url.replace(':id', item_id);
        $.ajax({
            type: "get",
            url: url,
            success: function (data) {
                items_chosen[row]['offers'] = [];
                $.each(data.offers, function (indexInArray, valueOfElement) {
                    items_chosen[row]['offers'][valueOfElement.id] = valueOfElement;
                });
            }
        });
        checkOffer(row);
    }
}

//Loads variations of selected item and displays in choose variation modal
function chooseVariationBtnClicked(e, type) {

    row = $(e).attr('id').match(/\d+/)[0];
    if ($('#item_id_' + row).val() == '') {
        setTimeout(() => {
            $('#chooseVariation .md-card-content').empty();
            $('#chooseVariation .md-card-content').append('<h4 class="uk-text-center">No Variations Found</h4>');
        }, 200);
        setTimeout(() => {
            $('#choose_variation_modal_close').trigger("click");
        }, 400);
        UIkit.notify({
            message: 'Please select a product first',
            status: 'danger',
            timeout: 2000,
            pos: 'top-right'
        });
        item_selected = null;
    } else {
        item_selected = $('#item_id_' + row).val();
        var selected_variation = $('input:radio[name=select_variation]:checked').attr('id');
        $.ajax({
            type: 'get',
            url: '/api/inventory/check-variation/' + item_selected,
            success: function (element) {
                $('#chooseVariation .md-card-content').empty();
                element.variations.forEach(function (value, index) {
                    var variation_section = '';
                    element.variation_attribute_values[value.id].forEach(function (value1, index1) {
                        var attribute_id = element.attribute_values[value1.attribute_values_id]['attribute_id'];
                        var attribute_value = element.attribute_values[value1.attribute_values_id]['value'];
                        var attribute_name = element.attributes[attribute_id];
                        variation_section += '<div class="uk-width-1-3 uk-margin-small-top uk-text-center">' +
                            '<h5><span style="font-weight: 900">' + attribute_name + ': </span> ' + attribute_value + '</h5>' +
                            '</div>';
                    });
                    $('#chooseVariation .md-card-content').append(
                        '<div class="uk-grid">\n' +
                        '<div class="uk-width-1-2">' +
                        '<div class="item-variation-' + index + '" style=" padding:10px;height: 40px; color: white; background-color: #2991fa;" id="variation_name_' + value.id + '">\n' + value.variation_name + '\n</div>\n' +
                        '</div>\n' +
                        '<div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative; background:#2991fa ">\n' +
                        '<div id="variation_check_container_' + index + '" style="position: absolute; right: 10px; height: 40px; ">\n' +
                        '<input type="radio" name="select_variation" id="select_variation_' + index + '" style=" margin-top: -1px; height: 25px; width: 20px;"/>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '<div class="uk-grid" id="variation_details_' + index + '">' +
                        variation_section +
                        '<br>' +
                        '<div class="uk-width-1-1">' +
                        '<hr>' +
                        '</div>' +
                        '<br>' +
                        '<div class="uk-width-1-2 uk-margin-small-top">' +
                        '<h4><span style="font-weight: 900"> SKU:</span> ' + value.sku + '</h4>' +
                        '</div>' +
                        '<div class="uk-width-1-2 uk-margin-small-top">' +
                        (type == 'purchase' ?
                            '<h4 class="variation_price"><span style="font-weight: 900"> Purchase Price:</span> ' + (value.variation_purchase_rate == null ? 0 : value.variation_purchase_rate) + '</h4>' :
                            (type == 'sales' ?
                                '<h4 class="variation_price"><span style="font-weight: 900"> Sale Price:</span> ' + (value.variation_sales_rate == null ? 0 : value.variation_sales_rate) + '</h4>' :
                                '')) +
                        '</div>' +
                        '</div>'
                    );
                    items_chosen[row]['variations'][value.id] = value;
                });
                $('#' + selected_variation).prop('checked', true);
            },
            error: function (data) {
                $('#chooseVariation .md-card-content').empty();
                $('#chooseVariation .md-card-content').append('<h4 class="uk-text-center">No Variations Found</h4>');
            }
        });
    }
}

//chosen variation is shown as badge and added to the items_chosen array
$('#variationSubmitBtn').click(function () {
    var item_row = row;
    var numb = $('input:radio[name=select_variation]:checked').attr('id').match(/\d+/)[0];
    var item_id = $('#item_id_' + row).val();
    $('.free_entry_tr_' + row).remove()
    if ($('.getFreeEntryRow tr').length > 0) {
        $('#free_entry_header').show(400);
        $('#free_entry_details').show(800);
    } else {
        $('#free_entry_details').hide(400);
        $('#free_entry_header').hide(800);
    }
    var variation_id = $('.item-variation-' + numb).attr('id').match(/\d+/)[0];
    $('#selected_variation_' + row).val(variation_id);
    var amount = $('#variation_details_' + numb + ' .variation_price').length != 0 ? $('#variation_details_' + numb + ' .variation_price').text().match(/\d+/)[0] : 0;
    if (typeof calculateActualAmount !== 'undefined' && $.isFunction(calculateActualAmount)) {
        $('#rate_' + row).val(amount);
        calculateActualAmount(row);
    }
    var variation_name = $('#variation_details_' + numb).prev().children().children().text();
    $('#variation_badge_container_' + row).remove();
    $('#item_id_' + row).parent().parent().append(
        '<div class="uk-text-center" id="variation_badge_container_' + row + '">\n' +
        '<span class="uk-badge uk-text-nowrap" id="variation_badge_' + row + '">Selected Variation: ' + variation_name + '</span>\n' +
        '</div>\n'
    );
    items_chosen[row]['variation_id'] = variation_id;
    calculatePcsToCtn('#item_id_' + row);
    if ($(".getFreeEntryRow").length != 0) {
        url = window.location.origin + "/api/offers/get-offer/:id/:variation_id";
        url = url.replace(':id', item_id);
        url = url.replace(':variation_id', variation_id);
        $.ajax({
            type: "get",
            url: url,
            success: function (data) {
                items_chosen[item_row]['offers'] = [];
                $.each(data.offers, function (indexInArray, valueOfElement) {
                    items_chosen[item_row]['offers'][valueOfElement.id] = valueOfElement;
                });
            }
        });
        checkOffer(item_row);
    }
    row = null;
});

//Checks valid offers for the selected item
function checkOffer(row) {
    var item_id = $('#item_id_' + row).val();
    var serial = $('.getFreeEntryRow tr:last>td:first-child>span').text() == '' ? 1 : parseInt($('.getFreeEntryRow tr:last>td:first-child>span').text()) + 1;
    if (item_id != '') {
        $.each(items_chosen[row]['offers'], function (indexInArray, itemOffer) {
            if (typeof itemOffer != 'undefined' && $('#selected_variation_' + row).val() == itemOffer['item_variation_id'] && $('#quantity_pcs_' + row).val() >= itemOffer['base_quantity']) {
                if ($('.free_entry_tr_' + row).length == 0) {
                    $('.getFreeEntryRow').append(
                        '<tr class="free_entry_tr_' + row + '">\n' +
                            '<td style="padding-top: 25px">\n' +
                                '<span>' + serial + '</span>\n' +
                            '</td>\n' +
                            '<td style="padding-top: 25px">\n' +
                                '<select name="offer_details_id[' + row + ']" class="form-control single_select2" id="offer_details_id_' + row + '" onchange="offerSelected(this)">\n' +
                                    '<option value="' + itemOffer.id + '" id="offer_option_' + row + '_' + itemOffer.id + '">' +
                                    ajax_data[item_id]['item_name'] + '(' + ajax_data[item_id]['barcode_no'] + ') - ' + itemOffer.start_date + ' - ' + itemOffer.end_date +
                                    '</option>\n' +
                                '</select>\n' +
                            '</td>\n' +
                            '<td style="padding-top: 25px">\n' +
                                '<select name="base_item_id[' + row + ']" class="form-control single_select2" id="base_item_id_' + row + '">\n' +
                                    '<option value="' + itemOffer.item_id + '"> ' + ajax_data[itemOffer.item_id]['item_name'] + ' </option>\n' +
                                '</select>\n' +
                                '<div class="uk-text-center uk-margin-small-top" id="variation_badge_container_' + row + '">\n' +
                                    '<span class="uk-badge uk-text-nowrap" id="variation_badge_' + row + '">Selected Variation: ' + items_chosen[row]['variations'][itemOffer.item_variation_id]['variation_name'] + '</span>\n' +
                                '</div>\n'+
                            '</td>\n' +
                            '<td style="padding-top: 25px">\n' +
                                '<select name="free_item_id[' + row + ']" class="form-control single_select2" id="free_item_id_' + row + '">\n' +
                                (itemOffer.free_item_id != null ?
                                    '<option value="' + itemOffer.free_item_id + '">' + ajax_data[itemOffer.free_item_id]['item_name'] + '</option>\n' :
                                    '<option value="">Select Free Item</option>\n'
                                ) +
                                '</select>\n' +
                                '<div class="uk-text-center uk-margin-small-top" id="free_variation_badge_container_' + row + '">\n' +
                                (itemOffer.free_item_id != null ?
                                    '<span class="uk-badge uk-text-nowrap" id="free_variation_badge_' + row + '">Selected Variation: ' + items_chosen[row]['variations'][itemOffer.free_item_variation_id]['variation_name'] + '</span>\n':
                                    ''
                                ) +
                                '</div>\n'+
                                '<input id="selected_free_variation_'+row+'" name="selected_free_variation[]" type="number" style="display: none" value='+(itemOffer.free_item_id != null ? itemOffer.free_item_variation_id : "")+'></div>\n'+
                            '</td>\n' +
                            '<td>\n' +
                                '<input type="text" class="md-input" name="free_item_quantity[' + row + ']" oninput="calculateFreeEntry(' + row + ')" id="free_item_quantity_id_' + row + '" value="' + (itemOffer.free_quantity == null ? 0 : itemOffer.free_quantity * Math.floor($('#quantity_pcs_' + row).val() / itemOffer['base_quantity'])) + '">\n' +
                            '</td>\n' +
                            '<td>\n' +
                                '<div style="position: relative">' +
                                    '<input type="text" class="md-input" name="offer_amount[' + row + ']" oninput="calculateFreeEntry(' + row + ')" id="offer_amount_id_' + row + '" value="' + (itemOffer.cashback_amount == null ? 0 : itemOffer.cashback_amount * Math.floor($('#quantity_pcs_' + row).val() / itemOffer['base_quantity'])) + '">\n' +
                                        '<select name="offer_amount_type[' + row + ']" style="position: absolute; top: 0; right: 0; margin-top: 10px; border: none" id="offer_amount_type_id_' + row + '">' +
                                            '<option value="">Type</option>' +
                                            '<option value="0" ' + (itemOffer.cashback_type == 1 ? 'selected' : '') + '>Tk</option>' +
                                            '<option value="1" ' + (itemOffer.cashback_type == 2 ? 'selected' : '') + '>%</option>' +
                                        '</select>' +
                                '</div>' +
                            '</td>\n' +
                        '</tr>'
                    );
                    $('.single_select2').select2();

                } else if ($(' #offer_details_id_' + row + ' #offer_option_' + row + '_' + itemOffer.id).length == 0) {
                    $('#offer_details_id_' + row).append(
                        '<option value="' + itemOffer.id + '" id="offer_option_' + row + '_' + itemOffer.id + '">' +
                        ajax_data[item_id]['item_name'] + '(' + ajax_data[item_id]['barcode_no'] + ') - ' + itemOffer.start_date + ' - ' + itemOffer.end_date +
                        '</option>\n'
                    );
                }
            } else if (typeof itemOffer != 'undefined' && $('#quantity_pcs_' + row).val() < itemOffer['base_quantity']) {
                $('#offer_details_id_' + row + ' #offer_option_' + row + '_' + itemOffer.id).prop('selected', false);
                $('#offer_details_id_' + row + ' #offer_option_' + row + '_' + itemOffer.id).remove();
            }
        });
    }
    if ($('#offer_details_id_' + row + ' option').length == 0) {
        $('.free_entry_tr_' + row).remove();
    }
    if ($('.getFreeEntryRow tr').length > 0) {
        $('#free_entry_header').show(400);
        $('#free_entry_details').show(800);
    } else {
        $('#free_entry_details').hide(400);
        $('#free_entry_header').hide(800);
    }
}

function removeSection(e) {
    $(e).parent().parent().parent().remove();
}

//Responsive payment section starts
$("#check_payment").on("click", function () {
    if ($(this).is(":checked")) {
        $("#payment_details").show(800);
    } else {
        $("#payment_details").hide(800);
    }
});

$("#check_payment_advance").on("click", function () {
    if ($(this).is(":checked")) {
        $("#advance_details").show(800);
    } else {
        $("#advance_details").hide(800);
    }
    if ($('#check_payment_advance').is(":checked") || $('#check_payment_vendor_credit').is(":checked")) {
        $("#available_balance").show(2000);
    } else if (!$('#check_payment_advance').is(":checked") && !$('#check_payment_vendor_credit').is(":checked")) {
        $("#available_balance").hide(800);
    }
});

$("#check_payment_vendor_credit").on("click", function () {
    if ($(this).is(":checked")) {
        $("#vendor_credit_details").show(800);
    } else {
        $("#vendor_credit_details").hide(800);
    }
    if ($('#check_payment_advance').is(":checked") || $('#check_payment_vendor_credit').is(":checked")) {
        $("#available_balance").show(2000);
    } else if (!$('#check_payment_advance').is(":checked") && !$('#check_payment_vendor_credit').is(":checked")) {
        $("#available_balance").hide(800);
    }
});

$("#payment_amount").on("input", function () {
    var total_amount = parseInt($("#total_amount").text());
    if ($(this).val() > total_amount) {
        $(this).val(total_amount);
        return true;
    }
    if ($(this).val() < 0) {
        $(this).val(0);
        return true;
    }
});

//Responsive payment section ends

//Shows depreciation section if 
$("#payment_account").on("change", function () {
    var id = parseInt($(this).val());
    if (id != 3) {
        $("#show").show(900);
        return 0;
    }
    if (id == 3) {
        $("#show").hide(900);
        return 0;
    }
});

//Calculate item quantity from carton to pcs
function calculateCtnToPcs(e) {
    row = $(e).attr('id').match(/\d+/)[0];
    if ($('#item_id_' + row).val() == '') {
        UIkit.notify({
            message: 'Please select a product first',
            status: 'danger',
            timeout: 2000,
            pos: 'top-right'
        });
        item_selected = null;
    } else {
        item_selected = $('#item_id_' + row).val();
        $('#quantity_pcs_' + row).val(
            (items_chosen[row]['variations'].length === 0 || items_chosen[row]['variation_id'] == '' || items_chosen[row]['variations'][items_chosen[row]['variation_id']].carton_size == 0 ?
            (ajax_data[item_selected]['carton_size'] == 0 ? 0 : ($(e).val() * ajax_data[item_selected]['carton_size'])) :
            $(e).val() * items_chosen[row]['variations'][items_chosen[row]['variation_id']].carton_size).toFixed(3)
        );
        if (typeof calculateActualAmount !== 'undefined' && $.isFunction(calculateActualAmount)) {
            calculateActualAmount(row);
        }
    }
}

//Calculate item quantity from pcs to carton
function calculatePcsToCtn(e) {
    row = $(e).attr('id').match(/\d+/)[0];
    if ($('#item_id_' + row).val() == '') {
        UIkit.notify({
            message: 'Please select a product first',
            status: 'danger',
            timeout: 2000,
            pos: 'top-right'
        });
        item_selected = null;
    } else {
        item_selected = $('#item_id_' + row).val();
        $('#quantity_ctn_' + row).val(
            items_chosen[row]['variations'].length === 0 || items_chosen[row]['variation_id'] == '' || items_chosen[row]['variations'][items_chosen[row]['variation_id']].carton_size == 0 ?
            (ajax_data[item_selected]['carton_size'] == 0 ? 0 : ($('#quantity_pcs_' + row).val() / ajax_data[item_selected]['carton_size'])).toFixed(3) :
            ($('#quantity_pcs_' + row).val() / items_chosen[row]['variations'][items_chosen[row]['variation_id']].carton_size).toFixed(3)
        );
    }
}

//Loads informations of selected offer
function offerSelected(e) {
    var row = $(e).attr('id').match(/(\d+)/g)[0];
    var offer_details_id = $(e).val();
    $('#base_item_id_' + row).empty();
    $('#base_item_id_' + row).append(
        '<option value="' + items_chosen[row]['offers'][offer_details_id]['item_id'] + '"> ' + ajax_data[items_chosen[row]['offers'][offer_details_id]['item_id']]['item_name'] + ' </option>\n'
    );
    $('#free_item_id_' + row).empty();
    $('#free_variation_badge_' + row).remove();
    if (items_chosen[row]['offers'][offer_details_id]['free_item_id'] != null) {
        $('#free_item_id_' + row).append(
            '<option value="' + items_chosen[row]['offers'][offer_details_id]['free_item_id'] + '">' + ajax_data[items_chosen[row]['offers'][offer_details_id]['free_item_id']]['item_name'] + '</option>\n'
        );
        $('#free_variation_badge_container_' + row).append(
            '<span class="uk-badge uk-text-nowrap" id="free_variation_badge_' + row + '">Selected Variation: ' + items_chosen[row]['variations'][items_chosen[row]['offers'][offer_details_id]['free_item_variation_id']]['variation_name'] + '</span>\n'
        );
        $('#selected_free_variation_'+row).val(items_chosen[row]['offers'][offer_details_id]['free_item_variation_id']);
    } else {
        $('#free_item_id_' + row).append(
            '<option value="">Select Free Product</option>\n'
        );
        $('#selected_free_variation_'+row).val("");
    }
    $('#free_item_quantity_id_' + row).val(items_chosen[row]['offers'][offer_details_id]['free_quantity'] == null ? 0 : items_chosen[row]['offers'][offer_details_id]['free_quantity'] * Math.floor($('#quantity_pcs_' + row).val() / items_chosen[row]['offers'][offer_details_id]['base_quantity']));
    $('#offer_amount_id_' + row).val(items_chosen[row]['offers'][offer_details_id]['cashback_amount'] ? items_chosen[row]['offers'][offer_details_id]['cashback_amount'] * Math.floor($('#quantity_pcs_' + row).val() / items_chosen[row]['offers'][offer_details_id]['base_quantity']) : 0);
    if (items_chosen[row]['offers'][offer_details_id]['cashback_type'] == null) {
        $('#offer_amount_type_id_' + row).val('');
    } else {
        $('#offer_amount_type_id_' + row).val(items_chosen[row]['offers'][offer_details_id]['cashback_type']);
    }
    $('#offer_amount_type_id_' + row).change();
}

//Responsive payment section ends

function rowRemoved(row) {
    $('.free_entry_tr_' + row).remove()
    if ($('.getFreeEntryRow tr').length > 0) {
        $('#free_entry_header').show(400);
        $('#free_entry_details').show(800);
    } else {
        $('#free_entry_details').hide(400);
        $('#free_entry_header').hide(800);
    }
}

function addVariationBtnClicked(e) {

    row = $(e).attr('id').match(/\d+/)[0];
    if ($('#item_id_' + row).val() == '' || $('#item_id_' + row).val() == null) {
        setTimeout(() => {
            $('#chooseVariationWithAttributeValues .md-card-content .uk-overflow-container').empty();
            $('#chooseVariationWithAttributeValues .md-card-content .uk-overflow-container').append('<h4 class="uk-text-center">No Variations Found</h4>');
        }, 200);
        setTimeout(() => {
            $('#choose_variation_with_attribute_values_modal_close').trigger("click");
        }, 400);
        UIkit.notify({
            message: 'Please select a product first',
            status: 'danger',
            timeout: 2000,
            pos: 'top-right'
        });
    } else {
        item_selected = $('#item_id_' + row).val();
        $.ajax({
            type: "get",
            url: "/api/attributes/attribute-and-value-list/",
            success: function (response) {
                $('#chooseVariationWithAttributeValues .md-card-content .uk-overflow-container').empty();
                response.forEach(function (value, index) {
                    var attribute_value_section = '<option value="">Add Custom Value</option>';
                    value.attribute_values.forEach(function (value1, index1) {
                        var value_id = value1.id;
                        var value_name = value1.value;
                        attribute_value_section += '<option value="' + value_id + '">' + value_name + '</option>';
                    });
                    $('#chooseVariationWithAttributeValues .md-card-content .uk-overflow-container').append(
                        `<div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4 uk-vertical-align">
                            <label class="uk-vertical-align-middle" for="attribute_value_id` + index + `">` + value.name + `</label>
                        </div>
                        <div class="uk-width-medium-3-4">
                            <select id="attribute_` + index + `" class="select2-single-search-dropdown" onchange="attributeValueChanged(` + index + `)" name="attribute_value_id[]" required>
                                ` + attribute_value_section + `
                            </select>
                            <input type="hidden" name="attribute_id[]" value="` + value.id + `" />
                            <div class="md-input-wrapper uk-margin-small-top">
                                <label for="new_attr_val_">Add Attribute Value</label>
                                <input class="md-input" type="text" id="new_attr_val_` + index + `" name="new_attr_val[]">
                                <span class="md-input-bar "></span>
                            </div>
                        </div>
                    </div>`
                    );
                });
                $('.select2-single-search-dropdown').select2();
            }
        });
    }
}

function attributeValueChanged(row) {
    if ($('#attribute_' + row).val() != '') {
        $('#new_attr_val_' + row).parent().hide(400);
        $('#new_attr_val_' + row).val($('#attribute_' + row + ' option:selected').html());
    } else {
        $('#new_attr_val_' + row).val('');
        $('#new_attr_val_' + row).parent().show(400);
    }
}

$('#addVariationSubmitBtn').on('click', function () {
    var item_row = row;
    var item_id = $('#item_id_' + item_row).val();
    $.ajax({
        type: "post",
        url: "/api/attributes/dynamic-attribute-value-check-store/" + item_id,
        data: $('form#add_attribute_value_form').serialize(),
        success: function (response) {
            $('#selected_variation_' + item_row).val(response.id);
            $('#variation_badge_container_' + item_row).remove();
            $('#item_id_' + item_row).parent().parent().append(
                '<div class="uk-text-center" id="variation_badge_container_' + item_row + '">\n' +
                '<span class="uk-badge uk-text-nowrap" id="variation_badge_' + item_row + '">Selected Variation: ' + response.variation_name + '</span>\n' +
                '</div>\n'
            );
            items_chosen[item_row]['variation_id'] = response.id;
            items_chosen[item_row]['variations'][response.id] = response;
            
            var amount = typeof(response.variation_sales_rate) === 'undefined' ? 0 : response.variation_sales_rate;
            if (typeof calculateActualAmount !== 'undefined' && $.isFunction(calculateActualAmount)) {
                $('#rate_' + item_row).val(amount);
                calculateActualAmount(item_row);
            }
        }
    });
    row = null;
});
// // for unit 
// function unitChange(e)
// { 
    
//     var row = $(e).attr('id').match(/(\d+)/g)[0];
//     var unit_id = $(e).val();
//     $.ajax({
//         type: "get",
//         url: "/unit/getdata/" + unit_id,
//         success: function (response) {

//             var qty =$('#quantity_pcs_'+row).val();
       
//         var qty_get= qty*response.unit.basic_unit_conversion;
//         $('#quantity_pcs_'+row).val(qty_get);
//         }
//     });

//     // var qty =$('#quantity_'+row).val();
//     // console.log(qty);
//     // var unit_id=$(e).val();
   


// }