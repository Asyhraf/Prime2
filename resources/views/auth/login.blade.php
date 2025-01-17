@extends('layouts.loginv5')

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image: url('{{asset('loginv5/images/4.jpg') }} ')">
        <div class="wrap-login100">
            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                @csrf
                <div class="card-header">
                    <span class="login100-form-title">
                        <img src="{{ asset('landpage/images/logo2.png') }}" alt="Logo"><br><b>APLIKASI PRIME 2.0</b>
                    </span>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6 p-l-40 p-r-40">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                @if(session()->has('message'))
                                <div class="alert alert-danger outline-2x">
                                    {{ @session()->get('message') }}
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="ic" class="col-form-label">{{ __('ID Pengguna (No MyKad)') }}</label>
                                    <div class="input-group">
                                        <input id="ic" type="ic" class="form-control @error('ic') is-invalid @enderror" name="ic" placeholder="No MyKad (eg : 850102101234)" value="{{ old('ic') }}" required autocomplete="off" autofocus>
                                        <div class="input-group-addon" id="inputGroupPrepend">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    @error('ic')
                                    <div class="alert p-0">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-form-label">{{ __('Kata Laluan') }}</label>
                                    <div class="input-group">
                                        <input name="password" type="password" value="" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Kata Laluan" value="{{ old('password') }}" required autocomplete="off" autofocus>
                                        <div class="input-group-addon" id="togglePassword" style="cursor: pointer" onclick="myFunction1();">
                                            <i class="fa fa-eye" id="show_eye"></i>
                                            <i class="fa fa-eye-slash d-none" id="hide_eye"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                    <div class="alert p-0">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>



                                <div class="container-login100-form-btn">

                                    <button type="submit" class="login100-form-btn">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                    <div class="col text-center">
                                        <a class="btn btn-link" href="{{ route('password.request') }}"></a>
                                    </div>
                                    @endif

                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <div class="postit">
                                <b>Aplikasi Pengurusan Pra-Mesyuarat</b>
                                <br></br>
                                <p>Aplikasi Pengurusan Pra-Mesyuarat merupakan sistem yang dibangunkan bagi membolehkan urus setia membuat persediaan untuk pengurusan pra-mesyuarat seperti penetapan takwim, penyelenggaraan keahlian, pengesahan kehadiran mesyuarat dan sebagainya.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <small>Bahagian Kabinet, Perlembagaan dan Perhubungan Antara Kerajaan (BKPP)<br>Jabatan Perdana Menteri (JPM)</br></small>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection

<script>
    function myFunction1() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
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
