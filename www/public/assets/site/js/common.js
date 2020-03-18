$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

/* button */
function setBtnDisabled(element, boolean) {
    if(boolean) {
        $(element).attr("disabled", "disabled");
    } else {
        $(element).removeAttr("disabled");
    }
}

function setBtnText(element, text) {
    $(element).html(text);
}

function setBtn(element, disabled = null, text = null) {
    if(disabled != null) {
        setBtnDisabled(element, disabled);
    }
    if(text != null) {
        setBtnText(element, text)
    }
}

/* error bag */
function setErrorBagAlert(element, alertType) {
    $(element).removeClass (function (index, className) {
        return (className.match (/(^|\s)alert-\S+/g) || []).join(' ');
    });
    $(element).addClass('alert-' + alertType);
}

function clearErrorBag(element) {
    $(element).html("<ul></ul>");
    $(element).hide();
}

function printErrorBag(element, array, bagAlert = null) {
    $(element).find("ul").html('');
    $(element).fadeIn(1000);
    $.each(array, function(key, value) {
        $(element).find("ul").append('<li>'+value+'</li>');
    });

    if(bagAlert != null) {
        setErrorBagAlert(element, bagAlert);
    }
}

/* modal preloader */
function showModalPreloader(inElement) {

    $(inElement + " .checkout-preloader-container").removeClass('d-none');
}

function hideModalPreloader(inElement) {
    $(inElement + " .checkout-preloader-container").addClass('d-none');
}

/* submit btn */
function submitBtnDisabled(inElement, boolean) {
    if(boolean) {
        $(inElement + " .submit-btn").attr("disabled", "disabled");
    } else {
        $(inElement + " .submit-btn").removeAttr("disabled");
    }
}

/* icon selector */
function setIconsToDefault(inElement) {
    $(inElement + ' .image-picker').val('-1');
    $(inElement + ' .collapse-icons').collapse('hide');
    $(inElement + ' .thumbnails.image_picker_selector li').each(function() {
        if($(this).children("div").hasClass('selected')) {
            $(this).children("div").removeClass('selected');
        }
    });
}


function iconSelector(inElement) {
    // set defaults
    $(inElement + " .icon-selector .collapse-default").collapse('show');

    // radios click
    $(inElement + " .icon-selector .default").click(function() {
        $('.icon-selector .collapse-default').collapse('show');
        $('.icon-selector .collapse-custom').collapse('hide');
    });
    $(inElement + " .icon-selector .custom").click(function() {
        $('.icon-selector .collapse-default').collapse('hide');
        $('.icon-selector .collapse-custom').collapse('show');
    });

    // initialize imagepicker(s)
    $(inElement + " .icon-selector .image-picker").imagepicker();
}

function iconSelectorValue(inElement) {
    var value = $(inElement + " .icon-selector .collapse-default select").val();

    if ($(inElement + " .icon-selector .custom").is(':checked')) {
        value = $(inElement + " .icon-selector .collapse-custom select").val();
    }
    return value;
}
