@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Register an Account</div>
            <div class="card-body">
                <form class="" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                    <label for="firstName">Nam</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="form-label-group">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            <label for="inputEmail">Email address</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <label for="inputPassword">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    <label for="confirmPassword">Confirm password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary btn-block" href="login.html">Register</a>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="{{route('login')}}">Already Have a account? Login Page</a>
                    <a class="d-block small" href="{{route('password.request')}}">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
