<script>
    (function($) {
        $.fn.overlay = function(options) {
            var self = this;
            var defaults = {
                beforeSendText: 'retrieving data...',
            };

            self.settings = {};

            self.init = function() {
                self.settings = $.extend({}, defaults, options);
            };

            self.beforeSend = function() {
                $(self).show();
                $(self).find('.process-text').show();
                $(self).find('.try-again').hide();
                self.text(self.settings.beforeSendText);
            };

            self.onSuccess = function() {
                $(self).hide();
            };

            self.onError = function(message) {
                $(self).show();
                $(self).find('.process-text').show();
                $(self).find('.try-again').show();
                self.text(message);
            };

            self.text = function(content) {
                $(self).find('.process-text').html(content);
            };

            self.init();

            return self.each(function() {
                $(self).data('overlay', self);
            });
        };

        $.fn.makeRequest = function(options) {
            var self = this;
            var settings = $.extend({
                beforeSend: true,
                autoUpdateTime: null,
                action: 'get',
                parameters: {},
                responseHandler: function() {},
            }, options);

            var autoUpdate = false;
            var data = JSON.parse('{!! $data !!}');
            data.action = settings.action;
            data.parameters = settings.parameters;

            self.sendRequest = function(beforeSend = true) {
                var overlay = $('.module-overlay').overlay({
                    beforeSendText: '{{Lang::get('common.retrieving_data')}}',
                });

                $.ajax({
                    type: 'POST',
                    url: '{{route('device.request')}}',
                    data: data,
                    beforeSend: function() {
                        if(beforeSend) {
                            overlay.data('overlay').beforeSend();
                        }
                        autoUpdate = false;
                    },
                    success:function(response) {
                        if(response.status === true) {
                            overlay.data('overlay').onSuccess();
                            settings.responseHandler(response);
                            autoUpdate = true;
                        } else {
                            overlay.data('overlay').onError(response.message);
                            autoUpdate = false;
                        }
                    },
                    error: function(xhr) {
                        overlay.data('overlay').onError(xhr.responseJSON.message);
                        autoUpdate = false;
                    }
                });
            };

            self.sendRequest();

            // on refresh button click
            $('.refresh').click(function() {
                self.sendRequest(true);
            });

            // auto Update
            setInterval(function() {
                if(settings.autoUpdateTime !== null && autoUpdate) {
                    self.sendRequest(false);
                }
            }, settings.autoUpdateTime);
        };
    }(jQuery));
</script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body module-box">
                <div class="module-overlay" style="display: none;">
                    <div class="try-again" style="display: none;">
                        <button class="btn btn-rounded btn-outline-primary refresh">{{Lang::get('common.try_again')}}</button>
                    </div>
                    <div class="process-text" style="display: none;"></div>
                </div>
                {!! $module !!}
            </div>
        </div>
    </div>
</div>
