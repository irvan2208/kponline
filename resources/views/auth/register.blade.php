@extends('layouts.app')

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
<div class="register-box-body">
<p class="login-box-msg">Register a new membership</p>
        <form role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('npm') ? ' has-error' : '' }} has-feedback">
                    <input placeholder="Nomor Pokok Mahasiswa"  id="npm" type="text" class="form-control" data-inputmask="'mask': ['99-99-999']" data-mask="data-mask" value="{{ old('npm') }}"  required autofocus>
                    <input placeholder="Nomor Pokok Mahasiswa"  id="npmhide" type="hidden" class="form-control" name="npm" value="{{ old('npm') }}"  required autofocus>


                    @if ($errors->has('npm'))
                        <span class="help-block">
                            <strong>{{ $errors->first('npm') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                    <input id="name" placeholder="Full name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('nama'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif

                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                    <input id="email" placeholder="Email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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

            <div class="form-group has-feedback">
                    <input placeholder="Re-type Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Daftar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection