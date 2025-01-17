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
            <h3 class="text-center text-uppercase"><b>Susun Atur Kedudukan<br>{{ $event->TajukMesyuarat->nama_tajuk }}</b></h3>
            <h3 class="text-center text-uppercase">
                <b>Bil. {{ $event->meeting_numbers }} Tahun {{ $event->year }}
                @if ($event->pindaan == "Y")
                <span>Pindaan Ke : {{ $event->pindaan_ke }}</span>
                @endif
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

            <form class="theme-form mega-form" method="POST" action="{{ route('update-kedudukan-MBKM', ['id' => $event->id]) }}">
            {{ csrf_field() }}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="bootstrap-data-table-export1">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center">Bil</th>
                                <th width="65%" style="text-align: left">Nama dan Jawatan</th>
                                <th width="15%" style="text-align: center">Gred</th>
                                <th width="15%" style="text-align: center">Susun Atur Kedudukan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($kehadiran as $ahli)
                            <tr>
                                <td style='text-align:center'>{{ $loop->iteration }}</td>

                                <td>
                                    @if($ahli->kehadiran == 'Y')
                                        <strong>({{ $ahli->kekananan_mesy_manual }}) {{ $ahli->nama_ahli }}</strong><br>
                                        <span>{{ $ahli->nama_jawatan }}</span><br>
                                        @if(!empty($ahli->nama_kementerian))
                                        <span>{{ $ahli->nama_kementerian }}</span>
                                        @else
                                        @endif
                                    @else
                                        <strong>({{ $ahli->kekananan_mesy_manual }}) {{ $ahli->nama_ahli }}</strong><br>
                                        <span>{{ $ahli->nama_jawatan }}</span><br>
                                        @if(!empty($ahli->nama_kementerian))
                                        <span>{{ $ahli->nama_kementerian }}</span><br>
                                        @else
                                        @endif
                                        <span class="badge badge-dark"><strong>Diwakili Oleh :</strong></span><br>
                                        <span class="text-uppercase"><strong>{{ $ahli->wakil_oleh }}</strong></span><br>
                                        <span>{{ $ahli->jawatan_wakil }}</span>
                                    @endif
                                </td>

                                <td style='text-align:center'>
                                    @if($ahli->kehadiran == 'Y')
                                        @if(!empty($ahli->nama_gred_lantikan))
                                        <span>{{ $ahli->nama_gred_lantikan }}</span><br>
                                        <span>Tarikh Lantikan: {{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }}</span>
                                        @else
                                        <span class="badge badge-danger">Tiada Maklumat Gred</span>
                                        @endif
                                    @else
                                        @if(!empty($ahli->nama_gred_lantikan))
                                        <span>{{ $ahli->nama_gred_lantikan }}</span><br>
                                        <span>Tarikh Lantikan: {{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }}</span><br>
                                        @else
                                        <span class="badge badge-danger">Tiada Maklumat Gred</span><br>
                                        @endif
                                        <span class="badge badge-dark"><strong>Gred Wakil :</strong></span><br>
                                        @if(!empty($ahli->nama_gred_wakil))
                                        <span>{{ $ahli->nama_gred_wakil }}</span><br>
                                        <span>Tarikh Lantikan: {{ date('d/m/Y', strtotime($ahli->tarikh_lantikan_wakil)) }}</span>
                                        @else
                                        <span class="badge badge-danger">Tiada Maklumat Gred</span>
                                        @endif
                                    @endif
                                </td>

                                <td style='text-align:center'>
                                    <input type="hidden" name="ahli[{{ $ahli->ahli_id }}][id]" value="{{ $ahli->ahli_id }}">
                                    <select class="form-control digits" name="ahli[{{ $ahli->ahli_id }}][susunan]" id="susunan" style="text-align: center">
                                        @for ($k = 1; $k <= 200; $k++)
                                        <option value="{{ $k }}"
                                            @if ((!empty($ahli->susunan) && $k == $ahli->susunan) || (empty($ahli->susunan) && $k == $loop->iteration))
                                                selected
                                            @endif>
                                            {{ $k }}
                                        </option>
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style='text-align:center'>Tiada Maklumat Kehadiran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" name="simpan" value="simpan" class="btn btn-primary btn-sm rounded">
                        <i class="fa fa-send"></i> Simpan
                    </button>
                    <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
                        <i class="fa fa-refresh"></i> Tetapan Semula
                    </button>
                </div>
            </form>
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
