@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">

        <div class="card-header">
            <h3 class="text-center"><b>TAMBAH PENGGUNA</b></h3>
        </div>

        <div class="card-body">

            @if(session ('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <span class="badge badge-pill badge-success">Success</span>
                <b>{{ session ('status')}}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right text-uppercase"><b>{{ __('Nama Penuh') }}</b></label>

                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus required>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ic" class="col-md-3 col-form-label text-md-right text-uppercase"><b>{{ __('No. Kad Pengenalan') }}</b></label>

                    <div class="col-md-8">
                        <input id="ic" type="text" class="form-control @error('ic') is-invalid @enderror" name="ic" value="{{ old('ic') }}" required autocomplete="ic" onkeypress="return Validate(event, 'lblErrorIC')">

                        <small class="text-muted"> Contoh: 952636102536</small><br>
                        @error('ic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small class="text-muted"><strong><span id="lblErrorIC" style="color: red"></span></strong></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label text-md-right text-uppercase"><b>{{ __('E-Mail') }}</b></label>

                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" required>

                        <small class="text-muted"> Contoh: pengguna@kabinet.gov.my</small>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3" style="text-align: right">
                        <label for="jawatan" class="col-form-label text-uppercase"><b>{{ __('Jawatan') }}</b></label>
                    </div>

                    <div class="col-md-8">
                        <input id="jawatan" type="text" class="form-control" name="jawatan" value="{{ old('jawatan') }}" required autocomplete="jawatan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_telefon" class="col-md-3 col-form-label text-md-right text-uppercase"><b>{{ __('No. Telefon') }}</b></label>

                    <div class="col-md-8">
                        <input id="no_telefon" type="text" class="form-control" name="no_telefon" value="{{ old('no_telefon') }}" required autocomplete="no_telefon" onkeypress="return Validate(event, 'lblErrorPhone')">
                        <small class="text-muted"> Contoh: 0123456789</small><br>
                        <small class="text-muted"><strong><span id="lblErrorPhone" style="color: red"></span></strong></small>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-1"></div>

                    <div class="col-md-2" style="text-align: right;">
                        <label for="unit" class="col-form-label text-uppercase"><b>{{ __('Unit') }}</b></label>
                    </div>

                    <div class="col-md-3">
                        <select class="form-control" name="unit" id="unit" value="{{ old('unit') }}" required>
                            <option value=""><b>- PILIH UNIT -</b></option>
                            @forelse ($ref_unit as $unit)
                            <option value="{{ $unit->id_unit }}" class="text-uppercase">{{ $unit->nama_unit }}</option>
                            @empty
                            <option value="0" class="text-uppercase"></option>
                            @endforelse
                        </select>
                    </div>

                    <div class="col-md-2" style="text-align: right;">
                        <label for="status" class="col-form-label text-uppercase"><b>{{ __('Status') }}</b></label>
                    </div>

                    <div class="col-md-3">
                        <select class="form-control" name="status" id="status" required>
                            <option value=""><b>- PILIH STATUS -</b></option>
                            <option value="1" class="text-uppercase">Aktif</option>
                            <option value="0" class="text-uppercase">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-1"></div>

                    {{-- <div class="col-md-2" style="text-align: right;">
                        <label for="tajuk_mesyuarat" class="col-form-label text-uppercase"><b>{{ __('Jenis Mesyurat') }}</b></label>
                    </div> --}}

                    {{-- <div class="col-md-3">
                        <div class="animate-chk">
                            <div class="row">
                                <div class="col">
                                    @foreach ($ref_tajuk_mesyuarat as $tajuk_mesyuarat)
                                    @if (!in_array($tajuk_mesyuarat->id_tajuk, [2, 3, 4, 6, 7, 8, 9, 10]))
                                    <label class="d-block" for="chk-ani" style="margin-top: 0.5rem;">
                                        <input style="width:9%;" class="checkbox_animated" id="tajuk_mesyuarat" type="checkbox" name="tajuk_mesyuarat[]" value="{{ $tajuk_mesyuarat->id_tajuk }}"> {{ $tajuk_mesyuarat->ringkasan }}
                                    </label>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-primary rounded" title="Pilih Semua" type="button" onclick="selectAllCheckboxes()">Pilih Semua</button> &nbsp;
                            <button class="btn btn-sm btn-warning rounded" title="Reset" type="button" onclick="resetCheckboxes()">Reset</button>
                        </div>
                    </div> --}}

                    <div class="col-md-2" style="text-align: right;">
                        <label for="role_pengguna" class="col-form-label text-uppercase"><b>{{ __('Peranan Pengguna') }}</b></label>
                    </div>

                    <div class="col-md-3">
                        <div class="animate-chk">
                            <div class="row">
                                <div class="col">
                                    @foreach ($ref_peranan_pengguna as $peranan)
                                    <label class="d-block text-uppercase" for="chk-ani" style="margin-top: 0.5rem;">
                                        <input style="width:9%;" class="checkbox_animated" id="role_pengguna" type="checkbox" name="role_pengguna[]" value="{{ $peranan->id_peranan }}"> {{ $peranan->nama_peranan }}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <hr class="mt-4 mb-4">
                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label text-md-right text-uppercase"><b>{{ __('Kata Laluan') }}</b></label>

                    <div class="col-md-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-3 col-form-label text-md-right text-uppercase"><b>{{ __('Sahkan Kata Laluan') }}</b></label>

                    <div class="col-md-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <hr class="mt-4 mb-4">
                <div class="col-md-12 text-center">
                    <button type="submit" name="hantar" title="Daftar Pengguna" value="hantar" class="btn btn-primary btn-sm rounded">
                        <i class="fa fa-user"></i> Daftar Pengguna
                    </button>
                    <button type="reset" name="reset" title="Tetapan Semula" value="reset" class="btn btn-danger btn-sm rounded">
                        <i class="fa fa-refresh"></i> Tetapan Semula
                    </button>
                    <a href="javascript:history.back()" title="Kembali" class="btn btn-info btn-sm rounded">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    function selectAllCheckboxes() {
        var checkboxes = document.querySelectorAll('input[name="tajuk_mesyuarat[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = true;
        });
    }

    function resetCheckboxes() {
        var checkboxes = document.querySelectorAll('input[name="tajuk_mesyuarat[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
    }
</script>

<script>
    var checkboxes = document.querySelectorAll('input[name="tajuk_mesyuarat[]"]');
    var form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        var checked = false;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checked = true;
                break;
            }
        }

        if (!checked) {
            event.preventDefault(); // Prevent form submission
            alert('Please select at least one option.');
        }
    });
</script>

<script type="text/javascript">
    function Validate(e, lblErrorID) {
        var keyCode = e.keyCode || e.which;
        var lblError = document.getElementById(lblErrorID);
        lblError.innerHTML = "";

        // Regex for Valid Characters i.e. Numbers.
        var regex = /^[0-9]+$/;

        // Validate TextBox value against the Regex.
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            if (lblErrorID === "lblErrorPhone") {
                lblError.innerHTML = "Nombor telefon mesti mengandungi nombor sahaja.";
            } else if (lblErrorID === "lblErrorIC") {
                lblError.innerHTML = "No. Kad Pengenalan mesti mengandungi nombor sahaja.";
            }
        }

        return isValid;
    }
</script>

@endsection
