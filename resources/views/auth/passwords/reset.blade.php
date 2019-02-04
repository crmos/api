@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Reset Password</div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <h4>Reset password?</h4>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="form-label-group">
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ $email or old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            <label for="inputEmail">Enter email address</label>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="form-label-group">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            <label for="inputEmail">Password</label>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="form-label-group">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                            <label for="inputEmail">Confirm Password</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="{{route('register')}}">Register an Account</a>
                    <a class="d-block small" href="{{route('login')}}">Login Page</a>
                </div>
            </div>
        </div>
    </div>


@endsection
