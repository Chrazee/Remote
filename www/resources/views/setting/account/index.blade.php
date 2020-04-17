@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card card-cascade wider">
                <div class="view view-cascade gradient-card-header bg-primary narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="white-text mx-3 mb-0 py-3">
                        @component('includes.breadcrumb', ['title' => $title])@endcomponent
                    </h6>
                </div>
                <div class="px-4 py-2">
                    <form class="form account-form" method="post">
                        @include('includes.preloader')
                        @include('includes.errorBag')
                        @include('includes.authorizeFields')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="username">{{ucfirst(Lang::get('common.username'))}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="username" value="{{$account->username}}" data-original="{{$account->username}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="device_token">{{ucfirst(Lang::get('common.device_token'))}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="device_token" value="{{$account->device_token}}" data-original="{{$account->device_token}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="email">{{ucfirst(Lang::get('common.email_address'))}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" id="email" name="email" value="{{$account->email}}" data-original="{{$account->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="password">{{ucfirst(Lang::get('common.set_new_password'))}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" id="password" name="password" data-original="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="password_confirmation">{{ucfirst(Lang::get('common.set_new_password_again'))}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" data-original="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="favorite_group_id">{{ucfirst(Lang::get('common.favorite_group'))}}</label>
                            <div class="col-sm-10">
                                <select name="favorite_group_id" class="browser-default custom-select" id="favorite_group_id" data-original="{{$userSetting['favorite_group_id']}}">
                                    <option value="">Not set</option>
                                    @foreach($groups as $item)
                                        @if($userSetting['favorite_group_id'] != null && $userSetting['favorite_group_id'] == $item->id)
                                            <option selected value="{{$item->id}}">{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-outline-dark-green btn-rounded btn-md px-3 action-save" disabled>
                                    <i class="fas fa-check"></i> {{Lang::get('common.save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function() {
                            $('.account-form').ajaxSubmit({
                                url: '{{route('settings.account.update', Auth::user()->id)}}',
                                redirect: '{{route('settings.account')}}'
                            });
                            $('.account-form').validateOriginalInputValue();
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
