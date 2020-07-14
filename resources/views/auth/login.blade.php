@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                @include('flash._notify')
                                <h3 class="login-heading mb-4">Welcome back!</h3>
                                <form method="post" action="{{ route('user.login.submit') }}">
                                    @csrf
                                    <div class="form-label-group">
                                        <input type="email" id="inputEmail" class="form-control"
                                               placeholder="Email address" required autofocus name="email" value="{{ old('email') }}">
                                        <label for="inputEmail">Email address</label>
                                    </div>

                                    <div class="form-label-group">
                                        <input type="password" id="inputPassword" class="form-control"
                                               placeholder="Password" required name="password">
                                        <label for="inputPassword">Password</label>
                                    </div>

                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                                        <label class="custom-control-label" for="customCheck1">Remember password</label>
                                    </div>
                                    <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2 btn-primary" type="submit">Sign in</button>
                                </form>
                                <a class="btn btn-lg btn-info btn-block btn-login btn-primary
                                     text-uppercase font-weight-bold mb-2" type="submit" href="{{ route('user.register') }}">
                                    Don't have an account? Register here
                                </a>
                                <div class="text-center"><a class="small text text-heading" href="{{ route('user.reset.password') }}">Forgot password?</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
