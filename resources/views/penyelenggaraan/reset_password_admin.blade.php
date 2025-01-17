@extends('layouts.loginv5')

@section('content')
<div class="limiter">
    <div class="container-reset" style="background-image: url('{{asset('loginv5/images/3.jpg') }} ')">
        <div class="wrap-reset">
            <!-- <form method="POST" action="{{ route('login') }}" class="login100-form validate-form flex-sb flex-w"> -->
            @csrf
            <span class="login100-form-title">
                <div class="card shadow-lg b-primary">
                    <div class="card-header-reset">
                        <b>
                            <h5>Maklumat Pengguna</h5>
                        </b>
                    </div>
                    <div class="card-body-reset">
                        <div class="user-detail">
                            <p>
                                Nama: &nbsp; {{$user->name}} <br>
                                Email: &nbsp; {{ $user->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </span>

            <div class="card b-primary m-t-10">
                <form method="POST" action="{{ route('edit-password-pengguna-admin',$user->id)}}">
                    <div class="card-body shadow-lg ">
                        @csrf
                        <div class="row-reset justify-content-center">
                            <div class="form-group">
                                <label for="password" class="col-form-label">{{ __('Kata Laluan') }} &nbsp;&nbsp; <i class="fa fa-lock"></i></label>
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kata Laluan" required autocomplete="new-password">
                                    <div class="input-group-addon" id="togglePassword" style="cursor: pointer" onclick="myFunction1();">
                                        <i class="fa fa-eye" id="show_eye1"></i>
                                        <i class="fa fa-eye-slash d-none" id="hide_eye1"></i>
                                    </div>
                                </div>
                                @error('password')
                                <div class="alert p-0">
                                    <p class="text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row-reset justify-content-center">
                            <div class="form-group">
                                <label for="password-confirm" class="col-form-label">{{ __('Sahkan Kata Laluan') }} &nbsp;&nbsp; <i class="fa fa-lock"></i></label>
                                <div class="input-group">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="Sahkan Kata Laluan" name="password_confirmation" required autocomplete="new-password">
                                    <div class="input-group-addon" id="togglePassword" style="cursor: pointer" onclick="myFunction2();">
                                        <i class="fa fa-eye" id="show_eye2"></i>
                                        <i class="fa fa-eye-slash d-none" id="hide_eye2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="card-footer form-group text-center">
                                <button type="submit" title="Kemaskini Kata Laluan" class="btn btn-primary btn-sm rounded">
                                    <i class="fa fa-dot-circle-o"></i> Kemaskini Kata Laluan
                                </button>

                                <a href="javascript:history.back()" title="Kembali" class="btn btn-info btn-sm rounded">
                                    <i class="fa fa-backward"></i> Kembali
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

<script>
    function myFunction1() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye1");
        var hide_eye = document.getElementById("hide_eye1");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";

        }
    }

    function myFunction2() {
        var x = document.getElementById("password-confirm");
        var show_eye = document.getElementById("show_eye2");
        var hide_eye = document.getElementById("hide_eye2");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";

        }
    }
</script>