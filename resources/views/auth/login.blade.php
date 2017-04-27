@extends('layouts.app')
@section('title','Parkir UIB Login')
@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}"><b>Parkiran </b>UIB</a>
      </div>
    <div class="login-box-body">
        <p class="login-box-msg">Login Dengan Data Portal</p> 
        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                <input id="email" type="text" class="form-control" name="login" value="{{ old('login') }}" placeholder="Masukkan NPM" autofocus required> 
                <!-- <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Your Email" required autofocus> --> 

                @if ($errors->has('email') or $errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">

                <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>

                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        Login
                    </button>
                </div>
            </div>
        </form>
        
    </div>
</div>
@endsection
