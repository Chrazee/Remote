<div class="row">
    <div class="col-12">
        <div class="card">
            @include('includes.errorBag')
            <div class="card-body module-box">
                <div class="module-overlay" style="display: none;">
                    <div class="process-text">
                        {{Lang::get('common.retrieving_data')}}...
                    </div>
                    <div class="try-again" style="display: none;">
                        <button class="btn btn-rounded btn-outline-primary refresh">{{Lang::get('common.try_again')}}</button>
                    </div>
                </div>
                {!! $module !!}
            </div>
        </div>
    </div>
</div>
