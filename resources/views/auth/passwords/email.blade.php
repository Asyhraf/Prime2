@extends('layouts.loginv5')

@section('content')
<div class="limiter">
        <div class="container-login100" style="background-image: url('{{asset('loginv5/images/3.jpg') }} ')">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
            <!-- <form method="POST" action="{{ route('login') }}" class="login100-form validate-form flex-sb flex-w"> -->
            @csrf            
                <span class="login100-form-title p-b-53">
                    <b>Reset Password<b>
                </span>	

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div> -->

                        <div class="container-login100-form-btn m-t-17">
                                <!-- <button type="submit" class="btn btn-primary"> -->
                                <button type="submit" class="login100-form-btn">
                                    {{ __('Send') }}
                                </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
