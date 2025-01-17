@extends('layouts.customtheme')

@section('content')

<!DOCTYPE html>
<html>

<head>
  <title>Takwim</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\jquery-3.1.1.min.js"></script>
  <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\moment.min.js"></script>
  <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\fullcalendar-3.9.0.js"></script>
  <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\toastr.js"></script>
  <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\jquery-1.12.1.js"></script>
  <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\jquery-1.12.4.js"></script>
  <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\sweetalert-2.1.2.min.js"></script>
  <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\sweetalert-1.1.3.min.js"></script>


  <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.min.css')}}">



  <style>
    #dialog {
      display: none;
    }

    .closeon {
      color: black;
      position: absolute;
      border: 1px solid black;
      top: 0;
      right: 0;
      width: 13px;
      height: 13px;
      text-align: center;
      border-radius: 40%;
      font-size: 10px;
      cursor: pointer;
      background-color: #FFF
    }

    .closeBtn {
      color: black;
      position: absolute;
      border: 1px solid black;
      top: 0;
      right: 0;
      width: 13px;
      height: 13px;
      text-align: center;
      border-radius: 50%;
      font-size: 10px;
      cursor: pointer;
      background-color: #FFF
    }

    i {
      color: white;
    }
  </style>
</head>

<body>
  <div class="animated fadeIn">
    <div class="card">

      <form class="theme-form mega-form" method="POST">
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

        <div class="card-header">
          <h3 class="text-center"><b>MAKLUMAT WAKIL KEHADIRAN MESYUARAT</b></h3>
        </div>

        <div class="card-body">

          @csrf
          <div class="form-group">
            <label><b>CATATAN (JIKA TIDAK HADIR):</b></label>
            @if($wakil->catatan == null)
            <input disabled type="text" name="catatan" class="form-control" id="catatan" maxlength="12" value="Tiada Maklumat">
            @else
            <input disabled type="text" name="catatan" class="form-control" id="catatan" maxlength="12" value="{{ $wakil->catatan }}">
            @endif
          </div>

          <div class="form-group">
            <label><b>NAMA WAKIL</b></label>
            @if($wakil->wakil_oleh == null)
            <input disabled type="text" name="wakil_oleh" class="form-control" id="wakil_oleh" maxlength="12" value="Tiada Maklumat">
            @else
            <input disabled type="text" name="wakil_oleh" class="form-control" id="wakil_oleh" maxlength="12" value="{{ $wakil->wakil_oleh }}">
            @endif
          </div>

          <div class="form-group">
            <label><b>JAWATAN WAKIL</b></label>
            @if($wakil->jawatan_wakil == null)
            <input disabled type="text" name="jawatan_wakil" class="form-control" id="jawatan_wakil" maxlength="12" value="Tiada Maklumat">
            @else
            <input disabled type="text" name="jawatan_wakil" class="form-control" id="jawatan_wakil" maxlength="12" value="{{ $wakil->jawatan_wakil }}">
            @endif
          </div>

          <div class="form-group">
            <label><b>GRED WAKIL</b></label>
            @if($wakil->id_gred_wakil == null)
            <input disabled type="text" name="id_gred_wakil" class="form-control" id="id_gred_wakil" maxlength="12" value="Tiada Maklumat">
            @else
            <input disabled type="text" name="id_gred_wakil" class="form-control" id="id_gred_wakil" maxlength="12" value="{{ $wakil->GredWakil->nama_gred }}">
            @endif
          </div>

          <div class="form-group">
            <label><b>TARIKH LANTIKAN KE GRED SEMASA (WAKIL)</b></label>
            @if($wakil->tarikh_lantikan_wakil == null)
            <input disabled type="text" name="tarikh_lantikan_wakil" class="form-control" id="tarikh_lantikan_wakil" maxlength="12" value="Tiada Maklumat">
            @else
            <input disabled type="text" name="tarikh_lantikan_wakil" class="form-control" id="tarikh_lantikan_wakil" maxlength="12" value="{{ date('d/m/Y', strtotime($wakil->tarikh_lantikan_wakil)) }}">
            @endif
          </div>

          <div class="form-group">
            <label><b>STATUS JAWATAN (WAKIL)</b></label>
            @if($wakil->id_status_jawatan == null)
            <input disabled type="text" name="id_status_jawatan" class="form-control" id="id_status_jawatan" maxlength="12" value="Tiada Maklumat">
            @else
            <input disabled type="text" name="id_status_jawatan" class="form-control" id="id_status_jawatan" maxlength="12" value="{{ $wakil->StatusJawatanWakil->nama_status_jawatan }}">
            @endif
          </div>

          <div class="form-group">
            <label><b>NAMA PEGAWAI KEMASKINI KEHADIRAN</b></label>
            @if($wakil->pegawai_kemaskini == null)
            <input disabled type="text" name="pegawai_kemaskini" class="form-control" id="pegawai_kemaskini" maxlength="12" value="Tiada Maklumat">
            @else
            <input disabled type="text" name="pegawai_kemaskini" class="form-control" id="pegawai_kemaskini" maxlength="12" value="{{ $wakil->pegawai_kemaskini }}">
            @endif
          </div>

          <div class="form-group">
            <label><b>NO. TEL. PEGAWAI KEMASKINI KEHADIRAN</b></label>
            @if($wakil->no_tel_pegawai_kemaskini == null)
            <input disabled type="text" name="no_tel_pegawai_kemaskini" class="form-control" id="no_tel_pegawai_kemaskini" maxlength="12" value="Tiada Maklumat">
            @else
            <input disabled type="text" name="no_tel_pegawai_kemaskini" class="form-control" id="no_tel_pegawai_kemaskini" maxlength="12" value="{{ $wakil->no_tel_pegawai_kemaskini }}">
            @endif
          </div>


          <div class="row">
            <a href="javascript:history.back()" title="Kembali" class="btn btn-info btn-sm rounded">
              <i class="fa fa-backward"></i> Kembali
            </a>
          </div>

        </div>
      </form>
    </div>
  </div>
</body>

</html>
@endsection