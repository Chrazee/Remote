/* tooltip */
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

/* form */
function setFormInputDisabled(element, boolean) {
    if(boolean) {
        $(element + " :input").prop("disabled", true);
    } else {
        $(element + " :input").prop("disabled", false);
    }
}

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
function setErrorBagIcon(element, type) {
    var icon = '<i class="far fa-hand-paper animated"></i>';
    if(type === "danger") {
        icon = '<i class="far fa-hand-paper animated"></i>';
    } else if(type === "success") {
        icon = '<i class="fas fa-check animated"></i>';
    } else if(type === "warning") {
        icon = '<i class="fas fa-exclamation-triangle"></i>';
    } else if(type === "info") {
        icon = '<i class="fas fa-exclamation-circle"></i>';
    }

    $(element + " .alert-header .icon").html(icon);
}

function stopAnimationOnErrorBagIcon(element) {
    $(element + " .alert-header .icon .animated").removeClass('shake fast');
}
function startAnimationOnErrorBagIcon(element) {
    $(element + " .alert-header .icon .animated").addClass('shake fast');
}

function hideErrorBag(element) {
    stopAnimationOnErrorBagIcon(element);

    if($(element).is(":visible")) {
        $(element).fadeOut(100);
    } else {
        $(element).fadeOut(500);
    }
}
function showErrorBag(element) {
    $(element).fadeIn(500);
    startAnimationOnErrorBagIcon(element);
}

function setErrorBagAlert(element, alertType) {
    $(element).removeClass (function (index, className) {
        return (className.match (/(^|\s)alert-\S+/g) || []).join(' ');
    });
    $(element).addClass('alert-' + alertType);
}
function setErrorBagHeader(element, text) {
    $(element + " .alert-header .title").html(text);
}
function setErrorBagContent(element, content) {
    $.each(content, function(key, value) {
        $(element).find(".alert-content ul.errors").append('<li>'+value+'</li>');
    });
}

function printErrorBag(element, bagAlert = null, header = null, content = null) {
    setErrorBagIcon(element, bagAlert);
    showErrorBag(element);
    clearErrorBag(element);

    if(bagAlert != null) {
        setErrorBagAlert(element, bagAlert);
    }

    if(header != null) {
        setErrorBagHeader(element, header);
    }

    if(content != null) {
        setErrorBagContent(element, content);
    }
}

function clearErrorBag(element, hide = false) {
    $(element).find(".alert-content ul.errors").html('');
    if(hide) {
        hideErrorBag(element);
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

function iconSelectorById(inElement, iconId, defaultIconId) {
    if(iconId === defaultIconId) { // default
        // set radios
        $(inElement + "_iconRadioDefault").prop("checked", true);
        $(inElement + "_iconRadioCustom").prop("checked", false);
        // set collapses
        $(inElement + ' .icon-selector .collapse-default').collapse('show');
        $(inElement + ' .icon-selector .collapse-custom').collapse('hide');

        $(inElement + ' .icon-selector .collapse-default select').val(iconId);
        $(inElement + ' .icon-selector .collapse-custom select').val(defaultIconId);
    } else { // custom
        // set radios
        $(inElement + "_iconRadioDefault").prop("checked", false);
        $(inElement + "_iconRadioCustom").prop("checked", true);
        // set collapses
        $(inElement + ' .icon-selector .collapse-default').collapse('hide');
        $(inElement + ' .icon-selector .collapse-custom').collapse('show');
        // set selection value
        $(inElement + ' .icon-selector .collapse-custom select').val(iconId);
    }

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

/* data attributes */
function parseData(fromElement, toElement) {
    $.each(fromElement.data(), function(index, value) {
        $(toElement).attr('data-' + index, value);
    });
}
