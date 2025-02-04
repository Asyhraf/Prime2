@extends('layouts.customtheme')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editable Div Styling</title>
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

        i2 {
            color: black;
        }

        .editable-div {
            font-size: 14px;
            line-height: 1.5;
            background-color: #f9f9f9;
            padding: .375rem .75rem;
            border-radius: .25rem;
            border: 1px solid #ced4da;
            height: 500px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="animated fadeIn">
        <div class="card">
            <form class="theme-form mega-form" method="POST" action="{{ route('emailKSUKP') }}">
                @csrf

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    <b>{{ session('status') }}</b>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif

                <div class="card-header">
                    <h3 class="text-center"><b>PENGHANTARAN EMAIL</b></h3>
                </div>

                <div class="card-body card-block">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Emel</div>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $eventDetails->emel }}" style="background-color: #f9f9f9;" required readonly>
                            <div class="input-group-addon">
                                <i2 class="fa fa-envelope"></i2>
                            </div>
                        </div>
                        <small class="text-muted"> Contoh: pengguna@kabinet.gov.my</small>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Perkara</div>
                            <input type="text" id="subject" name="subject" class="form-control" value="Pengesahan Kehadiran {{ $event->TajukMesyuarat->nama_tajuk }} ({{ $event->title }}) Bilangan {{ $event->meeting_numbers }} Tahun {{ $event->year }}" style="background-color: #f9f9f9;" required readonly>
                            <div class="input-group-addon">
                                <i2 class="fa fa-pencil"></i2>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Mesej</div>
                            <div class="form-control editable-div" id="displaymessage" name="displaymessage" contenteditable="false">
                                <strong><u>PERINGATAN MESRA</u></strong>
                                <br>
                                <br>
                                Assalamualaikum dan Selamat Sejahtera<br><br>
                                YBhg. Tan Sri/Datuk Seri/Dato’ Seri/Dato’ Sri/Datuk/Dato’/Dr.,<br><br>
                                <strong>Pengesahan Kehadiran {{ $event->TajukMesyuarat->nama_tajuk }} ({{ $event->title }}) Bilangan
                                    {{ $event->meeting_numbers }} Tahun {{ $event->year }}</strong><br><br>
                                Mohon perhatian dan kerjasama Ahli {{ $event->TajukMesyuarat->nama_tajuk }} yang belum membuat pengesahan
                                kehadiran untuk mengesahkan kehadiran melalui pautan di bawah.<br><br>
                                <strong>
                                        {{-- <a href="http://127.0.0.1:8000/login/ahli?redirect=http://127.0.0.1:8000/m_QRCode/{{ $ahli->ahli_id }}/{{ $event->id }}" target="_blank">
                                        http://127.0.0.1:8000/m_QRCode/{{ $ahli->ahli_id }}/{{ $event->id }} --}}
                                        {{-- <a href="{{ route('ahli.login.form', ['event_id' => $event->id]) }}" target="_blank">
                                            Login for Event {{ $event->id }}
                                        </a>                                 --}}
                                        {{-- <a href="{{ url('/login/' . $ahli->ahli_id . '/' . $event->id . '?token=' . $token->access_token) }}" target="_blank">
                                            Daftar Masuk Borang Pengesahan Kehadiran. {{ $event->id }}
                                        </a> --}}


                                        <a href="{{ url('/login/' . $ahli->ahli_id . '/' . $event->id) }}" target="_blank">
                                            Klik Untuk Ke Halaman Pengesahan Kehadiran Mesyuarat: {{ $event->title }}
                                        </a>



                                </strong>
                                <br><br>
                                Sekian, terima kasih.<br><br><br>
                                <strong>"MALAYSIA MADANI"</strong><br><br>
                                <strong>"BERKHIDMAT UNTUK NEGARA"</strong><br><br>
                                Saya yang menjalankan amanah,<br><br>
                                <strong>URUS SETIA MESYUARAT KSUKP</strong>
                            </div>
                            <textarea class="form-control editable-div" id="message" name="message" rows="20" hidden>
                                    <strong><u>PERINGATAN MESRA</u></strong>
                                    <br><br>
                                    Assalamualaikum dan Selamat Sejahtera<br><br>
                                    YBhg. Tan Sri/Datuk Seri/Dato’ Seri/Dato’ Sri/Datuk/Dato’/Dr.,<br><br>
                                    <strong>PENGESAHAN KEHADIRAN {{ $event->TajukMesyuarat->nama_tajuk }} ({{ $event->title }}) BILANGAN
                                        {{ $event->meeting_numbers }} TAHUN {{ $event->year }}</strong><br><br>
                                    Mohon perhatian dan kerjasama Ahli {{ $event->TajukMesyuarat->nama_tajuk }} yang belum membuat pengesahan
                                    kehadiran untuk mengesahkan kehadiran melalui pautan<br><br>
                                    <strong>URL: http://broga.kabinet.gov.my/prime2.0/public/m_QRCode/{{ $ahli->ahli_id }}/{{ $event->id }}
                                    </strong><br><br>
                                    Sekian, terima kasih.<br><br><br>
                                    <strong>"MALAYSIA MADANI"</strong><br><br>
                                    <strong>"BERKHIDMAT UNTUK NEGARA"</strong><br><br>
                                    Saya yang menjalankan amanah,<br><br>
                                    <strong>URUS SETIA MESYUARAT KSUKP</strong>
                                </textarea>
                            <div class="input-group-addon">
                                <i2 class="fa fa-commenting"></i2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <a href="javascript:history.back()" title="Kembali" class="btn btn-info btn-sm rounded">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm rounded">
                        <i class="fa fa-send"></i> Hantar
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm rounded">
                        <i class="fa fa-refresh"></i> Tetapan Semula
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection
