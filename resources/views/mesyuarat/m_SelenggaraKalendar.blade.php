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
        <h3 class="text-center"><b>PORTAL MEMADAM MESYUARAT & AKTIVITI</b></h3>
      </div>

      <div class="card-body">
        @csrf
        <div class="form-group">
          <label><b>TAJUK MESYUARAT DAN AKTIVITI</b></label>
          <input disabled type="text" name="title" class="form-control text-uppercase" id="title" maxlength="12" value="{{ $event->TajukMesyuarat->nama_tajuk }}">
        </div>
        
        <div class="form-group">
          <label><b>TARIKH MULA</b></label>
          <input disabled type="text" name="start" class="form-control" id="start" maxlength="12" value="{{ date('d/m/Y', strtotime($event->start)) }}">
        </div>

        <div class="form-group">
          <label><b>TARIKH AKHIR</b></label>
          <input disabled type="text" name="end" class="form-control" id="end" maxlength="12" value="{{ date('d/m/Y', strtotime($event->end)) }}">
        </div>

        <div class="form-group">
          <label><b>MASA MULA</b></label>
          <input disabled type="text" name="time1" class="form-control text-uppercase" id="time1" maxlength="12" value="{{ $event_time1 ? $event_time1->format('h.i') . ' ' . ($event_time1->format('H') < 12 ? 'pagi' : ($event_time1->format('H') == 12 ? 'tengah hari' : ($event_time1->format('H') >= 13 ? 'petang' : ''))) : '' }}">
        </div>

        <div class="form-group">
          <label><b>MASA AKHIR</b></label>
          <input disabled type="text" name="time2" class="form-control text-uppercase" id="time2" maxlength="12" value="{{ $event_time2 ? $event_time2->format('h.i') . ' ' . ($event_time2->format('H') < 12 ? 'pagi' : ($event_time2->format('H') == 12 ? 'tengah hari' : ($event_time2->format('H') >= 13 ? 'petang' : ''))) : '' }}">
        </div>

        <div class="form-group">
          <label><b>LOKASI MESYUARAT</b></label>
          <input disabled type="text" name="location" class="form-control text-uppercase" id="location" maxlength="12" value="{{ $event->location }}">
        </div>

        <div class="col-md-12 text-center">
          <form method="POST" action="{{ route('padam_aktiviti', $event->id) }}" onsubmit="return confirm('Adakah anda pasti untuk menghapuskan rekod ini?');" style="display: inline-block;">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button title="Padam Mesyuarat" class="btn btn-danger btn-sm rounded" type="submit" value=""><data-feather="user-x" alt="Padam"><i class="fa fa-calendar-times-o"></i> Padam Mesyuarat</button>
          </form>
          <a title="Kembali" class="btn btn-info btn-sm rounded" href="{{ route('m_tambah')}}" style="color:white;"><i class="fa fa-backward"></i> Kembali</a>
        </div>        
      </div>

    </div>
  </div>
</body>

</html>


@endsection