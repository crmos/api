@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Reset Password</div>
            <div class="card-body">
                <div class="text-center mb-4">
                    @if (session('status'))
                        <h4>
                            {{ session('status') }}
                        </h4>
                        @else
                        <h4>Forgot your password?</h4>
                        <p>Enter your email address and we will send you instructions on how to reset your password.</p>
                    @endif
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-label-group">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            <label for="inputEmail">Enter email address</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" href="login.html">Reset Password</button>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="{{route('register')}}">Register an Account</a>
                    <a class="d-block small" href="{{route('login')}}">Login Page</a>
                </div>
            </div>
        </div>
    </div>
@endsection
