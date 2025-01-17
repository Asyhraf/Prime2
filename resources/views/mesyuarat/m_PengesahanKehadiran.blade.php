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

<div class="animated fadeIn">
    <div class="card">

        <div class="col-12 text-right">
            <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                <i class="fa fa-backward"></i> Kembali
            </a>
        </div>
        <div class="card-header">
            <h3 class="text-center"><b>SENARAI KEHADIRAN AHLI MESYUARAT</b></h3>
            <h3 class="text-center text-uppercase"><b>{{ $event->TajukMesyuarat->nama_tajuk  }} ({{ $event->title }})</b></h3>
            <h3 class="text-center">
                <b>
                    BILANGAN {{ $event->meeting_numbers }} / {{ $event->year }}
                    PADA {{ date('d/m/Y', strtotime($event->start)) }}
                </b>
            </h3>
        </div>

        <div class="card-body">
            @foreach ($errors->all() as $errors)
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $errors }}</li>
                </ul>
            </div>
            @endforeach
            @if (session('status'))
            <div class="alert alert-success">
                <b>{{ session('status') }}</b>
            </div>
            @endif

            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up"></i></button>

            <form class="theme-form mega-form" name="formkehadiran" method="POST" action="{{ route('m_PengesahanKehadiranAhli', ['id' => $event->id]) }}">
                {{ csrf_field() }}

                <table id="bootstrap-data-table-export1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center">Bil</th>
                            <th width="40%" style="text-align: center">Jawatan Dan Nama</th>
                            <th width="15%" style="text-align: center">Gred</th>
                            <th width="40%" style="text-align: center">Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>

                        <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\toogle.js"></script>
                        <script type="text/javascript" src="toogle.js"></script>

                        @forelse($ahli_event as $counter => $ahli)
                        <?php $counter++; ?>
                        <tr>
                            <td style="text-align: center">{{ $counter }}</td>
                            <td>
                                <strong>
                                    {{ $ahli->nama_ahli }}
                                    <br>{{ $ahli->nama_jawatan }}
                                </strong>
                                @if(!empty($ahli->nama_kementerian))
                                <br><strong>{{ $ahli->nama_kementerian }}</strong>
                                @endif
                            </td>

                            <td style="text-align: center">
                                <strong>
                                @if(!empty($ahli->nama_gred))
                                {{ $ahli->nama_gred }}<br>
                                {{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }}
                                @else
                                <span class="badge badge-danger">Tiada Maklumat Gred</span>
                                @endif
                                </strong>
                            </td>

                            <td>
                                <strong>
                                    <div class="form-group" style="text-align: center">
                                        <label class="col-form-label" for="radioYes{{ $counter }}">HADIR</label>
                                        <input style="width:9%;" type="radio" id="radioYes{{ $counter }}" name="kehadiran[{{ $counter }}]" onclick="hideInputDiv({{ $counter }})" value="Y" {{ $ahli->kehadiran == 'Y' ? 'checked' : '' }}>
                                        <label class="col-form-label" for="radioNo{{ $counter }}">TIDAK HADIR</label>
                                        <input style="width:9%;" type="radio" id="radioNo{{ $counter }}" name="kehadiran[{{ $counter }}]" onclick="addmentor({{ $counter }})" value="N" {{ $ahli->kehadiran == 'N' ? 'checked' : '' }}>
                                    </div>

                                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                    <script>
                                        function addmentor(index) {

                                            document.getElementById('myDIV' + index).style.display = "block";
                                        }

                                        function hideInputDiv(index) {
                                            document.getElementById('myDIV' + index).style.display = "none";
                                        }
                                    </script>

                                    @if ($ahli->kehadiran == 'N')
                                    <div id="myDIV{{ $counter }}">
                                        CATATAN (JIKA TIDAK HADIR):
                                        <textarea class="form-control" name="catatan[{{ $counter }}]" id="" cols="3" rows="3">{{ $ahli->catatan }}</textarea><br>

                                        NAMA WAKIL
                                        <input class="form-control" type="text" name="wakil_oleh[{{ $counter }}]" placeholder="NAMA PENUH WAKIL" value="{{ $ahli->wakil_oleh }}"><br>

                                        JAWATAN WAKIL
                                        <input class="form-control" type="text" name="jawatan_wakil[{{ $counter }}]" placeholder="JAWATAN WAKIL" value="{{ $ahli->jawatan_wakil }}"><br>

                                        GRED WAKIL
                                        <select class="form-control" name="id_gred_wakil[{{ $counter }}]" id="id_gred_wakil" value="id_gred_wakil">
                                            <option label="PILIH GRED WAKIL"></option>
                                            @if ($ahli->id_gred_wakil == null)
                                            @else
                                            <option selected value="{{ $ahli->GredWakil->id_gred }}">{{ $ahli->GredWakil->nama_gred }}</option>
                                            @endif
                                            <optgroup label="____________________________________________________________________">
                                                @foreach ($kekananan_gred as $ahli_mesyuarats)
                                                <option value="{{ $ahli_mesyuarats->id_gred }}">{{ $ahli_mesyuarats->nama_gred }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select><br>

                                        TARIKH LANTIKAN KE GRED SEMASA (WAKIL)
                                        <input class="form-control" type="date" name="tarikh_lantikan_wakil'[{{ $counter }}]" value="{{ $ahli->tarikh_lantikan_wakil }}" placeholder="">
                                        <br>

                                        STATUS JAWATAN (WAKIL)
                                        <select class="form-control" name="id_status_jawatan[{{ $counter }}]" id="id_status_jawatan" value="{{ $ahli->id_status_jawatan }}">
                                            <option label="PILIH STATUS JAWATAN">
                                                @if ($ahli->id_status_jawatan == null)
                                                @else
                                            <option selected value="{{ $ahli->StatusJawatanWakil->id_status_jawatan }}">{{ $ahli->StatusJawatanWakil->nama_status_jawatan }}</option>
                                            @endif
                                            <optgroup label="____________________________________________________________________">
                                                @foreach ($ref_status_jawatan as $ahli_events)
                                                <option value="{{ $ahli_events->id_status_jawatan }}">{{ $ahli_events->nama_status_jawatan }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select><br>
                                    </div>
                                    @else
                                    <div id="myDIV{{ $counter }}" style="display: none;">
                                        CATATAN (JIKA TIDAK HADIR):
                                        <textarea class="form-control" name="catatan[{{ $counter }}]" id="" cols="3" rows="3">{{ $ahli->catatan }}</textarea><br>

                                        NAMA WAKIL
                                        <input class="form-control" type="text" name="wakil_oleh[{{ $counter }}]" placeholder="NAMA PENUH WAKIL" value="{{ $ahli->wakil_oleh }}"><br>

                                        JAWATAN WAKIL
                                        <input class="form-control" type="text" name="jawatan_wakil[{{ $counter }}]" placeholder="JAWATAN WAKIL" value="{{ $ahli->jawatan_wakil }}"><br>

                                        GRED WAKIL
                                        <select class="form-control" name="id_gred_wakil[{{ $counter }}]" id="id_gred_wakil" value="id_gred_wakil">
                                            <option label="PILIH GRED WAKIL"></option>
                                            @if ($ahli->id_gred_wakil == null)
                                            @else
                                            <option selected value="{{ $ahli->GredWakil->id_gred }}">{{ $ahli->GredWakil->nama_gred }}</option>
                                            @endif
                                            <optgroup label="____________________________________________________________________">
                                                @foreach ($kekananan_gred as $ahli_event)
                                                <option value="{{ $ahli_event->id_gred }}">{{ $ahli_event->nama_gred }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select><br>

                                        TARIKH LANTIKAN KE GRED SEMASA (WAKIL)
                                        <input class="form-control" type="date" name="tarikh_lantikan_wakil[{{ $counter }}]" value="{{ $ahli->tarikh_lantikan_wakil }}" placeholder="">
                                        <br>

                                        STATUS JAWATAN (WAKIL)
                                        <select class="form-control" name="id_status_jawatan[{{ $counter }}]" id="id_status_jawatan" value="id_status_jawatan">
                                            <option label="PILIH STATUS JAWATAN"></option>
                                            @if ($ahli->id_status_jawatan == null)
                                            @else
                                            <option selected value="{{ $ahli->StatusJawatanWakil->id_status_jawatan }}">{{ $ahli->StatusJawatanWakil->nama_status_jawatan }}</option>
                                            @endif
                                            <optgroup label="____________________________________________________________________">
                                                @foreach ($ref_status_jawatan as $ahli_event)
                                                <option value="{{ $ahli_event->id_status_jawatan }}">{{ $ahli_event->nama_status_jawatan }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select><br>
                                    </div>
                                    @endif
                                </strong>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4">Tiada Rekod </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="col-md-12 text-center">
                    <label for="status">SAHKAN KEHADIRAN</label>&nbsp;<input type="checkbox" id="status" name="status" value="1" checked><br><br>
                    <button type="submit" class="btn btn-primary btn-sm rounded"><i class="fa fa-send"></i> Hantar</button>
                    <button type="reset" class="btn btn-danger btn-sm rounded"><i class="fa fa-refresh"></i> Tetapan Semula</button>
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
