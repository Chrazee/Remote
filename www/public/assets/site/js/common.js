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
