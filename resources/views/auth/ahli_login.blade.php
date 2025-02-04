@extends('layouts.loginv5')

@section('content')
    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('loginv5/images/4.jpg') }}');">
            <div class="wrap-login100">
                <!-- Display Form for Ahli Mesyuarat Login -->
                <form method="POST" action="{{ route('ahli.login.submit') }}" class="login100-form validate-form">
                    @csrf

                    <!-- Hidden input to store the ahli_id -->
                    <input type="hidden" name="id_ahli" value="{{ $id_ahli }}">

                    <!-- Hidden input to store the event_id, if provided -->
                    @if ($id)
                    <input type="hidden" name="id" value="{{ $id }}">
                    @endif

                    <div class="card-header">
                        <span class="login100-form-title">
                            <img src="{{ asset('landpage/images/logo2.png') }}" alt="Logo"><br>
                            <b>PENGESAHAN KEHADIRAN APLIKASI PRIME 2.0</b>
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6 p-l-40 p-r-40">
                                <!-- Input for IC Number -->
                                <input type="text" name="no_ic" class="form-control" placeholder="Enter your IC Number" required>
                                @if ($errors->has('no_ic'))
                                    <span class="text-danger">{{ $errors->first('no_ic') }}</span>
                                @endif
                                <button type="submit" class="btn btn-primary mt-3">Login</button>
                            </div>

                            <div class="col-md-6">
                                <!-- Informational Section -->
                                <div class="postit">
                                    <b>Aplikasi Pengurusan Pra-Mesyuarat</b>
                                    <p>
                                        Aplikasi Pengurusan Pra-Mesyuarat merupakan sistem yang dibangunkan bagi membolehkan urus setia
                                        membuat persediaan untuk pengurusan pra-mesyuarat seperti penetapan takwim, penyelenggaraan keahlian,
                                        pengesahan kehadiran mesyuarat dan sebagainya.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <small>
                            Bahagian Kabinet, Perlembagaan dan Perhubungan Antara Kerajaan (BKPP)<br>
                            Jabatan Perdana Menteri (JPM)
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

