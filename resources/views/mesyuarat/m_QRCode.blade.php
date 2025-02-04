@extends('layouts.rekod')
@section('title', 'e-PRIME 2.0')

@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg shadow-showcase text-center b-dark">
                <div class="card-header bg-light text-center">
                    <img width="10%" src="{{ asset('assets/images/jata-negara.png') }}"/>
                    <h4 class="text-uppercase pt-2">
                    <b>Aplikasi Pengurusan Pra-Mesyuarat<br>PRIME 2.0</b>
                    </h4>
                </div>
                <div class="card-body b-t-dark">
                    <h5 class="text-uppercase">
                        <b>
                            Pengesahan Kehadiran Mesyuarat {{ $event->title }}
                            <br>Bil. {{ $event->meeting_numbers }} / {{ $event->year }}
                            <br>pada {{ date('d/m/Y', strtotime($event->start)) }}
                        </b>
                    </h5>
                    <div class="table-responsive">
                        <form class="theme-form mega-form" name="formkehadiranqr" action="{{ route('pra_kehadiran', [$ahli_mesyuarat->id_ahli, $event->id] ) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <table class="display dataTable table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center">
                                            <h6 class="text-uppercase"><strong>{{ $ahli_mesyuarat->nama_ahli }}</strong>
                                            @if(!empty($butiranQR->nama_kementerian) || !empty($butiranQR->singkatan_kementerian))
                                            <br><b><span class="text-uppercase">{{ $butiranQR->nama_kementerian }} ({{ $butiranQR->singkatan_kementerian }})</span></b>
                                            @endif
                                            @if(!empty($butiranQR->nama_jawatan))
                                            <br>
                                            <span class="text-uppercase">{{ $butiranQR->nama_jawatan }}</span>
                                            @endif
                                            @if(!empty($butiranQR->nama_gred))
                                            <br>
                                            <span class="text-uppercase">{{ $butiranQR->nama_gred }}</span></h6>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-2" valign="top">
                                            <div class="form-group-row" style="text-align:left">
                                                <strong><h6><span style="color: red;">*</span> CATATAN - Kemaskini Jawatan dan Gred (Sekiranya Perlu)</h6></strong>
                                                <textarea class="form-control" name="nota_kemaskini" id="nota_kemaskini" cols="3" rows="3">{{ optional($butiranQR)->nota_kemaskini }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="bg-light">
                                        <th class="p-2" style="width: 50%;"><b>KEHADIRAN</b></th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>
                                                <div class="form-group m-b-2" style="display: flex; justify-content: center; align-items: center;">
                                                    <label class="col-form-label" for="hadir" style="margin-right: 10px;">HADIR</label>
                                                    <input style="margin-right: 20px;" type="radio" id="yes" name="kehadiran" value="Y" onclick="hideInputDiv()" {{ optional($butiranQR)->kehadiran == 'Y' ? 'checked' : '' }}>
                                                    <label class="col-form-label" for="tidakHadir" style="margin-right: 10px;">TIDAK HADIR</label>
                                                    <input type="radio" id="no" name="kehadiran" value="N" onclick="showInputDiv()" {{ optional($butiranQR)->kehadiran == 'N' ? 'checked' : '' }}>
                                                </div>
                                            </strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-2" style="text-align:left" valign="top">
                                            <div id="yaHADIR" style="display: none;">
                                                <strong>NAMA PEGAWAI KEMASKINI KEHADIRAN</strong>
                                                <input class="form-control" type="text" name="pegawai_kemaskini_Y" placeholder="NAMA" value="{{ optional($butiranQR)->pegawai_kemaskini }}"><br>
                                                <strong>NO. TEL. PEGAWAI KEMASKINI KEHADIRAN</strong>
                                                <input class="form-control" type="text" id="no_tel_pegawai_kemaskini" name="no_tel_pegawai_kemaskini_Y" placeholder="NO. TEL." value="{{ $butiranQR->no_tel_pegawai_kemaskini ?? '' }}" onkeypress="return Validate(event)">
                                                <small class="text-muted">Contoh: 0123456789</small><br>
                                                <small class="text-muted"><strong><span id="lblError" style="color: red"></span></strong></small>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-2" style="text-align:left" valign="top">
                                            <div id="myDIV" style="display: none;">
                                                <strong>CATATAN (JIKA TIDAK HADIR):</strong>
                                                <textarea class="form-control" name="catatan" cols="3" rows="3">{{ optional($butiranQR)->catatan }}</textarea><br>
                                                <strong>NAMA WAKIL</strong>
                                                <input class="form-control" type="text" name="wakil_oleh" placeholder="NAMA WAKIL" value="{{ optional($butiranQR)->wakil_oleh }}"><br>
                                                <strong>JAWATAN WAKIL</strong>
                                                <input class="form-control" type="text" name="jawatan_wakil" placeholder="JAWATAN WAKIL" value="{{ optional($butiranQR)->jawatan_wakil }}"><br>
                                                <strong>GRED WAKIL</strong>
                                                <select class="form-control" name="id_gred_wakil" id="id_gred_wakil">
                                                    <option label="PILIH GRED WAKIL"></option>
                                                    @if (isset($butiranQR->id_gred_wakil))
                                                    <option selected value="{{ $butiranQR->id_gred_wakil }}">{{ $butiranQR->GredWakil->nama_gred }}</option>
                                                    @endif
                                                    <optgroup label="____________________________________________________________________">
                                                        @foreach ($kekananan_gred as $gred)
                                                        <option value="{{ $gred->id_gred }}">{{ $gred->nama_gred }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select><br>
                                                <strong>TARIKH LANTIKAN KE GRED SEMASA (WAKIL)</strong>
                                                <input type="date" class="form-control" name="tarikh_lantikan_wakil" value="{{ $butiranQR->tarikh_lantikan_wakil ?? '' }}"><br>

                                                <strong>STATUS JAWATAN (WAKIL)</strong>
                                                <select class="form-control" name="id_status_jawatan" id="id_status_jawatan">
                                                    <option class="text-uppercase" label="PILIH STATUS JAWATAN"></option>
                                                    @if (isset($butiranQR->id_status_jawatan))
                                                    <option class="text-uppercase" selected value="{{ $butiranQR->StatusJawatanWakil->id_status_jawatan }}">{{ $butiranQR->StatusJawatanWakil->nama_status_jawatan }}</option>
                                                    @endif
                                                    <optgroup label="____________________________________________________________________">
                                                        @foreach ($ref_status_jawatan as $ahli_events)
                                                        <option class="text-uppercase" value="{{ $ahli_events->id_status_jawatan }}">{{ $ahli_events->nama_status_jawatan }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select><br>

                                                <strong>NAMA PEGAWAI KEMASKINI KEHADIRAN</strong>
                                                <input class="form-control" type="text" name="pegawai_kemaskini" placeholder="NAMA PEGAWAI KEMASKINI KEHADIRAN" value="{{ optional($butiranQR)->pegawai_kemaskini }}"><br>
                                                <strong>NO. TEL. PEGAWAI KEMASKINI KEHADIRAN</strong>
                                                <input class="form-control" type="text" id="no_tel_pegawai_kemaskini" name="no_tel_pegawai_kemaskini" placeholder="NO. TEL. PEGAWAI KEMASKINI KEHADIRAN" value="{{ $butiranQR->no_tel_pegawai_kemaskini ?? '' }}" onkeypress="return Validate(event)">
                                                <small class="text-muted">Contoh: 0123456789</small><br>
                                                <small class="text-muted"><strong><span id="lblError" style="color: red"></span></strong></small>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                                <!-- Guna @can untuk mengawal akses kepada borang ini -->
                                @can('access-qr-code', [session('session_id_ahli'), session('session_meeting_id')])
                                    <div class="form-group m-b-0" style="text-align: center">
                                        <button type="submit" name="hantar" value="hantar" class="btn btn-primary btn-sm rounded">
                                            <i class="fa fa-send"></i> Hantar
                                        </button>
                                        <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
                                            <i class="fa fa-refresh"></i> Tetapan Semula
                                        </button>
                                    </div>
                                @else
                                    <div class="alert alert-warning text-center mt-3">
                                        <strong>Anda tidak mempunyai kebenaran untuk mengakses fungsi ini.</strong>
                                    </div>
                                @endcan

                            {{-- <div class="form-group m-b-0" style="text-align: center">
                                <button type="submit" name="hantar" value="hantar" class="btn btn-primary btn-sm rounded">
                                    <i class="fa fa-send"></i> Hantar
                                </button>
                                <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
                                    <i class="fa fa-refresh"></i> Tetapan Semula
                                </button>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    function showInputDiv() {
        document.getElementById('myDIV').style.display = "block";
        document.getElementById('yaHADIR').style.display = "none";
    }

    function hideInputDiv() {
        document.getElementById('myDIV').style.display = "none";
        document.getElementById('yaHADIR').style.display = "block";
    }

    function Validate(e) {
        var keyCode = e.keyCode || e.which;
        var lblError = document.getElementById("lblError");
        lblError.innerHTML = "";
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            lblError.innerHTML = "Hanya Nombor Sahaja Dibenarkan!";
        }
        return isValid;
    }

    // Hide or show input div based on the initial value of 'kehadiran'
    $(document).ready(function() {
        var kehadiran = "{{ $butiranQR ? $butiranQR->kehadiran : 'null' }}";
        if (kehadiran === 'N') {
            showInputDiv();  // Show myDIV and hide yaHADIR
        } else if (kehadiran === 'Y') {
            hideInputDiv();  // Show yaHADIR and hide myDIV
        }
    });
</script>


@endsection
