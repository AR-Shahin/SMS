@extends('layouts.app')
@section('title', 'Admin Login')

@section('app_content')
<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
          <h4><em>Admin <span class="text-info">Login</span></em></h4>
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') ? old('email') : 'admin@mail.com' }}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email') <span class="invalid-feedback"
                        role="alert"><strong>{{ $message }}</strong></span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input value="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password') <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong></span> @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Sign In <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </form>


            <p class="mb-1">
              <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
              <a href="register.html" class="text-center">Register a new membership</a>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
</div>
@stop
