@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{csrf_field()}}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="form-label-group">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            <label for="inputEmail">Email address</label>
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
                            <label for="inputPassword">Password</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Remember Password
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="{{ route('register') }}">Register an Account</a>
                    <a class="d-block small" href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
