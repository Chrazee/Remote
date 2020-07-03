require('./bootstrap');

(function($) {

    /* form original input value validator */
    $.fn.validateOriginalInputValue = function() {
        var self = this;
        var selection ='input:not([type=image],[type=button],[type=submit], [type=hidden]), textarea, select';

        self.check =  function() {
            var length = $(self).find(selection).length;
            var counter = 0;

            $(self).find(selection).each(function(index, value) {
                if($(value).val() == $(value).data('original')) {
                    counter++;
                }
            });

            if(counter === length) {
                $(self).find('.action-save').attr("disabled", "disabled");
            } else {
                $(self).find('.action-save').removeAttr("disabled");
            }
        };

        return self.each(function() {
            $(self).find(selection).on("change keyup paste input", self.check);
        });
    };

    /* error bag */
    $.fn.errorBag = function(options) {
        var self = this;
        var defaults = {
            icon: {
                danger: '<i class="far fa-hand-paper animated"></i>',
                success: '<i class="fas fa-check animated"></i>',
                warning: '<i class="fas fa-exclamation-triangle"></i>',
                info: '<i class="fas fa-exclamation-circle"></i>'
            },
        };
        self.settings = {};

        self.init = function() {
            self.settings = $.extend({}, defaults, options);
        };

        self.print = function(type, header, message = null) {
            self.clear();

            $(self).find(".alert-header .icon").html(self.settings.icon[type]);

            $(self).removeClass (function (index, className) {
                return (className.match (/(^|\s)alert-\S+/g) || []).join(' ');
            });
            $(self).addClass('alert-' + type);

            $(self).find(".alert-header .title").html(header);

            if(message !== null) {
                $.each(message, function(key, value) {
                    $(self).find(".alert-content ul.errors").append('<li>'+value+'</li>');
                });
            }

            $(self).fadeIn(500);
            $(self).find(" .alert-header .icon .animated").addClass('shake fast');
        };

        self.clear = function() {
            if($(self).is(":visible")) {
                $(self).fadeOut(250);
            } else {
                $(self).fadeOut(500);
            }
            $(self).find(".alert-content ul.errors").html('');
            $(self).find(".alert-header .icon .animated").removeClass('shake fast');
        };

        self.init();

        return this.each(function() {
            $(this).data('errorBag', self);
        });
    };

    /* form ajax submit */
    $.fn.ajaxSubmit = function(options) {
        var self = this;
        var settings = $.extend({
            url: "",
            redirect: "",
            refreshTIme: 2000,
            sleepTime: 800,
            withFile: false,
        }, options);

        return self.each(function() {
            $(self).find('.error-bag').errorBag(); // attach errorBag plugin

            $(self).on( "submit", function(event) {
                event.preventDefault();

                if(settings.withFile === true) {
                    $.ajaxSetup({
                        type: 'POST',
                        url: settings.url,
                        data:  new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                    });
                } else {
                    $.ajaxSetup({
                        type: 'POST',
                        url: settings.url,
                        data: $(self).serialize(),
                    });
                }

                $.ajax({
                    beforeSend: function() {
                        $(self).find(".preloader-container").removeClass('d-none');
                        $(self).find('.error-bag').data('errorBag').clear();
                        $(self).find(":input").prop("disabled", true);
                    },
                    success:function(response) {
                        $(self).find(".preloader-container").addClass('d-none');
                        $(self).find('.error-bag').data('errorBag').print('success', response.message);
                        $(self).find(":input").prop("disabled", true);
                        setTimeout(function() {
                            window.location.replace(settings.redirect);
                        }, settings.refreshTIme);
                    },
                    error: function(xhr) {
                        setTimeout(function() {
                            $(self).find(".preloader-container").addClass('d-none');
                            $(self).find('.error-bag').data('errorBag').print('danger', xhr.responseJSON.message, xhr.responseJSON.errors);
                            $(self).find(":input").prop("disabled", false);
                        }, settings.sleepTime);
                    }
                });
            });
        });
    };
}(jQuery));

/* initialize */
$(document).ready(function() {
    $('.update-form').validateOriginalInputValue();
    $('[data-toggle="tooltip"]').tooltip()
});


