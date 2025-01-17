@extends('layouts.customtheme')

@section('content')

<style>
    #myBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        border: none;
        outline: none;
        background-color: royalblue;
        color: white;
        cursor: pointer;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 25px;
        text-align: center;
        line-height: 50px;
    }

    #myBtn:hover {
        background-color: #fa8072;
    }
</style>

<div class="container-fluid p-0">
    <div class="card">

        <div class="col-12 text-right">
            <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                <i class="fa fa-backward"></i> Kembali
            </a>
        </div>

        <div class="card-header">
            <h3 class="text-center text-uppercase"><b>Senarai Panggilan Ahli Mesyuarat<br>{{ $event->TajukMesyuarat->nama_tajuk }}</b></h3>
            <h3 class="text-center text-uppercase">
                <b>Bil. {{ $event->meeting_numbers }} Tahun {{ $event->year }}
                Pada {{ date('d/m/Y', strtotime($event->start)) }}</b>
            </h3>
        </div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <span class="badge badge-pill badge-success">Success</span>
                <b>{{ session('status') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up"></i></button>

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="bootstrap-data-table-export">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center">Bil</th>
                            <th width="75%" style="text-align: left">Nama dan Jawatan</th>
                            <th width="20%" style="text-align: center">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($ahliMesyuarat as $ahli)
                        <tr>
                            <td style='text-align:center'>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $ahli->nama_ahli }}</strong><br>
                                <span>{{ $ahli->nama_jawatan }}</span><br>
                                @if(!empty($ahli->nama_kementerian))
                                <span>{{ $ahli->nama_kementerian }}</span>
                                @endif
                            </td>

                            <td style='text-align:center'>
                                <a title="Blast Email Mesyuarat {{ $event->title }}" class="btn btn-primary btn-sm rounded" href="{{ route('emel.mbkm', ['id' => $event->id, 'id_ahli' => $ahli->id_ahli]) }}">
                                    <i class="fa fa-envelope"></i> EMAIL
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style='text-align:center'>Tiada Maklumat Ahli Mesyuarat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
@endsection
