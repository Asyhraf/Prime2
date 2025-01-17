@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
  <div class="card">

    <div class="card-header">
      <h3 class="text-center"><b>KEMASKINI PENGGUNA APLIKASI</b></h3>
    </div>

    {{csrf_field()}}
    @foreach($errors ->all() as $errors)
    <div class="alert alert-danger">
      <ul>
        <li>{{ $errors }}</li>
      </ul>
    </div>
    @endforeach
    @if(session ('status'))
    <div class="alert alert-sucess" role="alert">
      {{ session ('status')}}
    </div>
    @endif

    <div class="card-body">

      <form method="POST" action="{{ route('p_editPengguna.edit',$user->id) }}">
        {{csrf_field()}}
        @method('PATCH')

        <div class="form-group row">
          <label for="name" class="col-md-3 col-form-label text-md-right text-uppercase"><b>{{ __('Nama Penuh') }}</b></label>

          <div class="col-md-8">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>
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
            <input id="ic" type="text" class="form-control @error('ic') is-invalid @enderror" name="ic" value="{{ $user->ic }}" required autocomplete="ic" autofocus onkeypress="return Validate(event, 'lblErrorIC')">

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
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

            <small class="text-muted"> Contoh: pengguna@kabinet.gov.my</small>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="jawatan" class="col-md-3 col-form-label text-md-right text-uppercase"><b>{{ __('Jawatan') }}</b></label>

          <div class="col-md-8">
            <input id="jawatan" type="txt" class="form-control" name="jawatan" placeholder="Jawatan" value="{{ $user->jawatan }}" required autocomplete="jawatan">
          </div>
        </div>

        <div class="form-group row">
          <label for="no_telefon" class="col-md-3 col-form-label text-md-right text-uppercase"><b>{{ __('No. Telefon') }}</b></label>

          <div class="col-md-8">
            <input id="no_telefon" type="txt" class="form-control" name="no_telefon" placeholder="No Telefon" value="{{ $user->no_telefon }}" required autocomplete="no_telefon" onkeypress="return Validate(event, 'lblErrorPhone')">
            <small class="text-muted"> Contoh: 0123456789</small><br>
            <small class="text-muted"><strong><span id="lblErrorPhone" style="color: red"></span></strong></small>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-1"></div>

          <div class="col-md-2" style="text-align: right;">
            <label for="unit" class="col-form-label text-uppercase"><b>{{ __('Unit') }}</b></label>
          </div>

          <div class="col-md-4">
            <select class="form-control" name="unit" id="unit" class="form-control" required>
              @forelse ($ref_unit as $unit)
              <option {{ ($user->unit == $unit->id_unit) ? "selected" : "" }} value="{{ $unit->id_unit }}">{{ $unit->nama_unit }}</option>
              @empty
              <option value="0"></option>
              @endforelse
            </select>
          </div>

          <div class="col-md-2" style="text-align: right;">
            <label for="status" class="col-form-label text-uppercase"><b>{{ __('Status') }}</b></label>
          </div>

          <div class="col-md-2">
            <select name="status" id="status" class="form-control" style="width:100%; min-height:35px;">
              <option value="1" {{ $user->status == "1" ? "selected" : "" }}>Aktif</option>
              <option value="0" {{ $user->status == "0" ? "selected" : "" }}>Tidak Aktif</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-1"></div>

          <div class="col-md-2" style="text-align: right;">
            <label for="tajuk_mesyuarat" class="col-form-label text-uppercase"><b>{{ __('Jenis Mesyurat') }}</b></label>
          </div>

          <div class="col-md-3">
            <div class="animate-chk">
              <div class="row">
                <div class="col">
                  @foreach ($ref_tajuk_mesyuarat as $tajuk_mesyuarat)
                  <label class="d-block" for="chk-ani" style="margin-top: 0.5rem;">
                    <input style="width:9%;" class="checkbox_animated" id="tajuk_mesyuarat" type="checkbox" name="tajuk_mesyuarat[]" value="{{ $tajuk_mesyuarat->id_tajuk }}" @if($user_tajuk_mesyuarat->contains('id_tajuk', $tajuk_mesyuarat->id_tajuk)) checked @endif /> {{ $tajuk_mesyuarat->ringkasan }}
                  </label>
                  @endforeach
                </div>
              </div>
            </div>
            <div>
              <button class="btn btn-sm btn-primary rounded" title="Pilih Semua" type="button" onclick="selectAllCheckboxes()">Pilih Semua</button> &nbsp;
              <button class="btn btn-sm btn-warning rounded" title="Reset" type="button" onclick="resetCheckboxes()">Reset</button>
            </div>
          </div>

          <div class="col-md-2" style="text-align: right;">
            <label for="role_pengguna" class="col-form-label text-uppercase"><b>{{ __('Peranan Pengguna') }}</b></label>
          </div>

          <div class="col-md-3">
            <div class="animate-chk">
              <div class="row">
                <div class="col">
                  @foreach ($ref_peranan_pengguna as $peranan)
                  <label class="d-block" for="chk-ani" style="margin-top: 0.5rem;">
                    <input style="width:9%;" class="checkbox_animated" id="role_pengguna" type="checkbox" name="role_pengguna[]" value="{{ $peranan->id_peranan }}" @foreach ($user_role_pengguna as $id_user) @if ($id_user->id_peranan == $peranan->id_peranan) checked
                    @endif
                    @endforeach
                    > {{ $peranan->nama_peranan }}
                  </label>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr class="mt-4 mb-4">
        <div class="col-md-12 text-center">
          <button type="submit" name="hantar" value="hantar" title="Hantar" class="btn btn-primary btn-sm rounded">
            <i class="fa fa-send"></i> Hantar
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