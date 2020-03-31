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

/* counter */
(function($) {
    $.fn.countTo = function(options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null,  // callback method for when the element finishes updating
    };
})(jQuery);
