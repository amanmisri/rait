@extends('public.layout')

@section('title', trans('user::auth.register'))

@section('content')
    <div class="register-wrapper clearfix">
        <div class="col-lg-6 col-md-7 col-sm-10">
            <div class="row">
                @include('public.partials.notification')

                <form method="POST" action="{{ route('register.post') }}">
                    {{ csrf_field() }}

                    <div class="box-wrapper register-form">
                        <div class="box-header">
                            <h4>{{ trans('user::auth.register') }}</h4>
                        </div>

                        <div class="form-inner clearfix">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                                    <label for="first-name">{{ trans('user::auth.first_name') }}<span>*</span></label>

                                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" id="first-name" autofocus>

                                    {!! $errors->first('first_name','<span class="error-message">:message</span>') !!}
                                </div>

                                <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                                    <label for="last-name">{{ trans('user::auth.last_name') }}<span>*</span></label>

                                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" id="last-name">

                                    {!! $errors->first('last_name','<span class="error-message">:message</span>') !!}
                                </div>

                                <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                                    <label for="email">{{ trans('user::auth.email') }}<span>*</span></label>

                                    <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email">

                                    {!! $errors->first('email','<span class="error-message">:message</span>') !!}
                                </div>

                                <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
                                    <label for="password">{{ trans('user::auth.password') }}<span>*</span></label>

                                    <input type="password" name="password" class="form-control" id="password">

                                    {!! $errors->first('password','<span class="error-message">:message</span>') !!}
                                </div>

                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error': '' }}">
                                    <label for="confirm-password">{{ trans('user::auth.password_confirmation') }}<span>*</span></label>

                                    <input type="password" name="password_confirmation" class="form-control" id="confirm-password">

                                    {!! $errors->first('password_confirmation', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="checkbox">
                                <input type="checkbox" name="privacy_policy" id="privacy">

                                <label for="privacy">
                                    {{ trans('user::auth.i_agree_to_the') }} <a href="{{ $privacyPageURL }}">{{ trans('user::auth.privacy_policy') }}</a>
                                </label>

                                {!! $errors->first('privacy_policy','<span class="error-message">:message</span>') !!}
                            </div>

                            <button type="submit" class="btn btn-primary btn-register pull-right" data-loading>
                                {{ trans('user::auth.register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
