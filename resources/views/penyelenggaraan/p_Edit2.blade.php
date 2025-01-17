@extends('layouts.customtheme')

@section('content')
    <div class="animated fadeIn">
        <div class="card">
            <div class="col-md-12 text-right">
                <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                    <i class="fa fa-backward"></i> Kembali
                </a>
            </div>
            <div class="card-header">
                <h3 class="text-center text-uppercase"><b>{{ $ahli_mesyuarat->nama_ahli }}</b></h3>
            </div>

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    <b>{{ session('status') }}</b>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <div class="card-body">
                <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="pills-butiranahli-tab" data-toggle="pill" href="#pills-butiranahli" role="tab" aria-controls="pills-butiranahli" aria-selected="true"><b>BUTIRAN AHLI</b></a></li>
                    <li class="nav-item"><a class="nav-link" id="pills-lantikanpersaraan-tab" data-toggle="pill" href="#pills-lantikanpersaraan" role="tab" aria-controls="pills-lantikanpersaraan" aria-selected="false"><b>LANTIKAN &
                                PERSARAAN</b></a></li>
                    <li class="nav-item"><a class="nav-link" id="pills-pegawaikhas-tab" data-toggle="pill" href="#pills-pegawaikhas" role="tab" aria-controls="pills-pegawaikhas" aria-selected="false"><b>PEGAWAI KHAS</b></a></li>
                    <li class="nav-item"><a class="nav-link" id="pills-setiausahapejabat-tab" data-toggle="pill" href="#pills-setiausahapejabat" role="tab" aria-controls="pills-setiausahapejabat" aria-selected="false"><b>SETIAUSAHA
                                PEJABAT</b></a></li>
                    <li class="nav-item"><a class="nav-link" id="pills-pbk-tab" data-toggle="pill" href="#pills-pbk" role="tab" aria-controls="pills-pbk" aria-selected="false"><b>PEMANDU/ BODYGUARD/ KENDERAAN</b></a></li>
                </ul>
                <div class="tab-content" id="pills-warningtabContent">
                    <!-- TAB BUTIRAN AHLI -->
                    <div class="tab-pane fade show active" id="pills-butiranahli" role="tabpanel" aria-labelledby="pills-butiranahli-tab">
                        <div class="card-body">

                            <form method="POST" action="{{ route('kemaskini_ButiranAhli', $ahli_mesyuarat->id_ahli) }}">
                                {{ csrf_field() }}

                                <!-- Jenis Mesyuarat  -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="col-form-label"><b>JENIS MESYUARAT</b></label><br>
                                    </div>

                                    <div class="col-9">
                                        @if ($butiran->mesyuarat_ksukp == '1')
                                            <input type="checkbox" class="onoffswitch-checkbox" id="mesyuarat_ksukp" name="mesyuarat_ksukp" value="1" checked>
                                        @else
                                            <input type="checkbox" id="mesyuarat_ksukp" name="mesyuarat_ksukp" value="1">
                                        @endif
                                        <label for="mesyuarat_ksukp" style="margin-top: 0.5rem; margin-left: 1rem;">KSUKP</label><br>

                                        @if ($butiran->mesyuarat_mbkm == '1')
                                            <input type="checkbox" class="onoffswitch-checkbox" id="mesyuarat_mbkm" name="mesyuarat_mbkm" value="1" checked>
                                        @else
                                            <input type="checkbox" id="mesyuarat_mbkm" name="mesyuarat_mbkm" value="1">
                                        @endif
                                        <label for="mesyuarat_mbkm" style="margin-left: 1rem;">MBKM</label><br>
                                    </div>
                                </div>

                                <!-- Gelaran -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="col-form-label"><b>GELARAN</b></label>
                                    </div>

                                    <div class="col-2">
                                        <select name="gelaran" id="id_gelaran" class="form-control text-uppercase">
                                            <option value="">- SILA PILIH -</option>
                                            @foreach ($kod_gelaran as $kod_gelarans)
                                                <option value="{{ $kod_gelarans->id_gelaran }}" {{ $gelaran && $gelaran->id_gelaran == $kod_gelarans->id_gelaran ? 'selected' : '' }}>
                                                    {{ $kod_gelarans->gelaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Nama Ahli -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="col-form-label"><b>NAMA AHLI</b></label>
                                    </div>

                                    <div class="col-9">
                                        <input class="form-control text-uppercase" type="text" name="nama_ahli" placeholder="NAMA PENUH" value="{{ $ahli_mesyuarat->nama_ahli }}">
                                    </div>
                                </div>

                                <!-- Kad Pengenalan Ahli -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="col-form-label"><b>NO. KAD PENGENALAN</b></label>
                                    </div>

                                    <div class="col-9">
                                        <input class="form-control" type="text" name="no_ic" placeholder="NO KAD PENGENALAN" value="{{ $butiran->no_ic }}">
                                    </div>
                                </div>

                                <!-- Jawatan Ahli  -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="jawatan" class="col-form-label"><b>JAWATAN</b></label>
                                    </div>
                                    <div class="col-9">
                                        <select name="jawatan" id="nama_jawatan" class="form-control text-uppercase">
                                            <option value="">- SILA PILIH -</option>
                                            @foreach ($ref_jawatan as $ref_jawatans)
                                                <option value="{{ $ref_jawatans->id_jawatan }}" {{ $jawatan && $jawatan->id_jawatan == $ref_jawatans->id_jawatan ? 'selected' : '' }}>
                                                    {{ $ref_jawatans->nama_jawatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <!-- Kementerian Ahli  -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="col-form-label"><b>KEMENTERIAN</b></label>
                                    </div>
                                    <div class="col-9">
                                        <select name="id_kementerian" id="nama_kementerian" class="form-control text-uppercase">
                                            <option value="">- SILA PILIH -</option>
                                            @foreach ($ref_kementerian as $ref_kementerians)
                                                <option value="{{ $ref_kementerians->id_kementerian }}" {{ $kementerian && $kementerian->id_kementerian == $ref_kementerians->id_kementerian ? 'selected' : '' }}>
                                                    {{ $ref_kementerians->nama_kementerian }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Alamat  -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="col-form-label"><b>ALAMAT</b></label><br>
                                    </div>
                                    <div class="col-9">
                                        <textarea class="form-control text-uppercase" name="alamat" id="" placeholder="ALAMAT" rows="4">{{ $butiran->alamat }}</textarea>
                                    </div>
                                </div>

                                <!-- Telefon Bimbit & Email  -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="col-form-label"><b>TEL BIMBIT ( PERIBADI )</b></label>
                                    </div>
                                    <div class="col-2">
                                        <input class="form-control" type="text" name="no_hp_peribadi" placeholder="TEL BIMBIT" value="{{ $butiran->no_hp_peribadi }}">
                                        <small class="text-muted"> Contoh: 0123456789</small>
                                    </div>
                                    <div class="col-auto">
                                        <label class="col-form-label"><b>EMEL</b></label>
                                    </div>
                                    <div class="col-5">
                                        <input class="form-control" type="text" name="emel" placeholder="EMEL" value="{{ $butiran->emel }}">
                                        <small class="text-muted"> Contoh: pengguna@kabinet.gov.my</small>
                                    </div>
                                </div>

                                <!-- Suami / Isteri  -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="col-form-label"><b>NAMA ISTERI / SUAMI</b></label>
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control text-uppercase" type="text" name="isteri_suami" placeholder="NAMA PENUH ISTERI / SUAMI" value="{{ $butiran->isteri_suami }}">
                                    </div>
                                </div>

                                <!-- Status Ahli  -->
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label class="col-form-label"><b>STATUS AHLI</b></label>
                                    </div>
                                    <div class="col-3">
                                        <select name="id_status_ahli" id="status_ahli" class="form-control text-uppercase">
                                            <option value="">- PILIH STATUS AHLI -</option>
                                            @foreach ($ref_status_ahli as $ref_status_ahlis)
                                                <option value="{{ $ref_status_ahlis->id_status_ahli }}" {{ ($status_ahli && $status_ahli->id_status_ahli == $ref_status_ahlis->id_status_ahli) ? 'selected' : '' }}>
                                                    {{ $ref_status_ahlis->nama_status_ahli }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-1" style="text-align: right;"></div>

                                    <div class="col-2" style="text-align: right;">
                                        <label class="col-form-label text-uppercase"><b>STATUS</b></label>
                                    </div>

                                    <div class="col-3">
                                        <select name="status" id="status" class="form-control" style="width:100%; min-height:35px;">
                                            <option value=""><b>- PILIH STATUS -</b></option>
                                            <option value="1" {{ isset($butiran) && $butiran->status == '1' ? 'selected' : '' }}>AKTIF</option>
                                            <option value="0" {{ isset($butiran) && $butiran->status == '0' ? 'selected' : '' }}>TIDAK AKTIF</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" name="hantar" value="hantar" class="btn btn-primary btn-sm rounded">
                                        <i class="fa fa-send"></i> Hantar
                                    </button>

                                    <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
                                        <i class="fa fa-refresh"></i> Tetapan Semula
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- END TAB BUTIRAN AHLI -->

                    <!-- TAB LANTIKAN & PERSARAAN -->
                    <div class="tab-pane fade" id="pills-lantikanpersaraan" role="tabpanel" aria-labelledby="pills-lantikanpersaraan-tab">
                        <div class="card-body">

                            <form method="POST" action="{{ route('kemaskini_LantikanPersaraan', $ahli_mesyuarat->id_ahli) }}">
                                {{ csrf_field() }}

                                <div class="b-grey">
                                    <h6><b>LANTIKAN SEMASA</b></h6>
                                    <hr class="mt-3 mb-3">
                                    <div class="row">
                                        <!--  Gred  -->
                                        <div class="col-1">
                                            <label class="col-form-label"><b>GRED</b></label>
                                        </div>
                                        <div class="col-auto">
                                            <select name="id_gred" id="nama_gred" class="form-control text-uppercase">
                                                <option value="">- SILA PILIH -</option>
                                                @foreach ($kekananan_gred as $kekananan_greds)
                                                    <option value="{{ $kekananan_greds->id_gred }}" {{ $gred && $gred->id_gred == $kekananan_greds->id_gred ? 'selected' : '' }}>
                                                        {{ $kekananan_greds->nama_gred }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </select>
                                        </div>

                                        <!-- Tarikh Gred Terkini  -->
                                        <div class="col-auto">
                                            <label class="col-form-label"><b>TARIKH GRED</b></label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-control text-uppercase" type="date" name="tarikh_lantikan" value="{{ $lantikan->tarikh_lantikan }}">
                                        </div>

                                        <!-- Kekananan  -->
                                        <div class="col-auto">
                                            <label class="col-form-label"><b>SUSUNAN KEKANANAN</b></label>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control" type="text" name="kekananan_mesy_manual" value="{{ $lantikan->kekananan_mesy_manual }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="b-grey">
                                    <h6><b>LANTIKAN KONTRAK</b></h6>
                                    <hr class="mt-3 mb-3">
                                    <!-- Tarikh Mula Kontrak  -->
                                    <div class="row">
                                        <div class="col-auto">
                                            <label class="col-form-label"><b>TARIKH MULA KONTRAK</b></label>
                                        </div>

                                        <div class="col-auto">
                                            <small>Lantikan Pertama</small><br>
                                            <input class="form-control text-uppercase" type="date" name="tarikh_mula_kontrak1" value="{{ $lantikan->tarikh_mula_kontrak1 }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="b-grey">
                                    <h6><b>PERSARAAN WAJIB</b></h6>
                                    <hr class="mt-3 mb-3">
                                    <div class="form-group row">
                                        <!-- Tarikh Bersara Wajib -->
                                        <div class="col-auto">
                                            <label class="col-form-label"><b>TARIKH BERSARA WAJIB</b></label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-control text-uppercase" type="date" name="tarikh_bersara" value="{{ $lantikan->tarikh_bersara }}">
                                        </div>

                                        <!-- Gred Jawatan Semasa Bersara -->
                                        <div class="col-auto">
                                            <label class="col-form-label"><b>GRED JAWATAN SEMASA BERSARA</b></label>
                                        </div>
                                        <div class="col-2">
                                            <select name="id_gred_bersara" id="gred_bersara" class="form-control text-uppercase">
                                                <option value="">- SILA PILIH -</option>
                                                @foreach ($kekananan_gred as $kekananan_greds)
                                                    <option value="{{ $kekananan_greds->id_gred }}" {{ $GredBersara && $GredBersara->id_gred == $kekananan_greds->id_gred ? 'selected' : '' }}>
                                                        {{ $kekananan_greds->nama_gred }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Tarikh Lantikan Gred Jawatan -->
                                    <div class="row">
                                        <div class="col-auto">
                                            <label class="col-form-label"><b>TARIKH LANTIKAN SEMASA BERSARA</b></label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-control text-uppercase" type="date" name="tarikh_lantikan_semasa_bersara" placeholder="" value="{{ $lantikan->tarikh_lantikan_semasa_bersara }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" name="hantar" value="hantar" class="btn btn-primary btn-sm rounded">
                                        <i class="fa fa-send"></i> Hantar
                                    </button>
                                    <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
                                        <i class="fa fa-refresh"></i> Tetapan Semula
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div> <!-- END TAB LANTIKAN & PERSARAAN -->

                    <!-- TAB PEGAWAI KHAS -->
                    <div class="tab-pane fade" id="pills-pegawaikhas" role="tabpanel" aria-labelledby="pills-pegawaikhas-tab">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-3 b-grey">
                                    <h6><b>PEGAWAI KHAS</b></h6>
                                    <hr class="mt-3 mb-3">
                                    <form class="theme-form mega-form" method="POST" action="{{ route('tambah_PegawaiKhas', $ahli_mesyuarat->id_ahli) }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <!-- Nama -->
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label class="col-form-label"><b>NAMA</b></label>
                                            </div>

                                            <div class="col-10">
                                                <input class="form-control text-uppercase" id="nama1" type="text" name="pegkhas_nama" placeholder="NAMA PENUH" value="">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label class="col-form-label"><b>EMEL</b></label>
                                            </div>

                                            <div class="col-10">
                                                <input class="form-control" id="emel1" type="text" name="pegkhas_emel" placeholder="EMEL" value="">
                                                <small class="text-muted"> Contoh: pengguna@kabinet.gov.my</small>
                                            </div>
                                        </div>

                                        <!-- Telefon Bimbit /  Pejabat -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label class="col-form-label"><b>TEL BIMBIT</b></label>
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control" id="bimbit1" type="text" name="pegkhas_hp" placeholder="TEL BIMBIT" value="">
                                                <small class="text-muted"> Contoh: 0123456789</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label class="col-form-label"><b>TEL PEJABAT</b></label>
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control telpej1" id="telpej1" type="text" name="pegkhas_telpej" placeholder="TEL PEJABAT" value="">
                                                <small class="text-muted"> Contoh: 0312345678</small>
                                            </div>
                                        </div>

                                        <!-- Faks -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label class="col-form-label"><b>NO FAKS</b></label>
                                            </div>

                                            <div class="col-7">
                                                <input class="form-control faks1" id="faks1" type="text" name="pegkhas_faks" placeholder="NO FAKS" value="">
                                            </div>
                                        </div>

                                        <div class="col-12 p-0 text-right">
                                            <button type="submit" id="tambah1" name="tambah" value="tambah" class="btn btn-primary btn-sm rounded tambah1">
                                                <i class="fa fa-plus"></i>&nbsp; Tambah
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-9">
                                    <h6><b>SENARAI PEGAWAI KHAS</b></h6>
                                    <hr class="mt-3 mb-3">

                                    <div class="form-group">
                                        <table id="tbl-pegkhas" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%; text-align: center;">Bil</th>
                                                    <th style="width: 25%; text-align: center;">Nama</th>
                                                    <th style="width: 25%; text-align: center;">EMel</th>
                                                    <th style="width: 15%; text-align: center;">Tel Bimbit</th>
                                                    <th style="width: 15%; text-align: center;">Tel Pejabat</th>
                                                    <th style="width: 10%; text-align: center;">No Faks</th>
                                                    <th style="width: 7%; text-align: center;">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($peg_khas as $pkhas)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-uppercase">{{ $pkhas->pegkhas_nama }}</td>
                                                        <td class="text-center">{{ $pkhas->pegkhas_emel }}</td>
                                                        <td class="text-center">{{ $pkhas->pegkhas_hp }}</td>
                                                        <td class="text-center">{{ $pkhas->pegkhas_telpej }}</td>
                                                        <td class="text-center">{{ $pkhas->pegkhas_faks }}</td>
                                                        <td class="text-center">
                                                            <form action="{{ route('padam_pegkhas', ['id_ahli' => $ahli_mesyuarat->id_ahli, 'id_pegkhas' => $pkhas->id_pegkhas]) }}" method="POST"
                                                                onsubmit="return confirm('Adakah anda pasti untuk menghapuskan rekod ini?');" style="display: inline-block;">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <button title="Padam Mesyuarat" class="btn btn-danger btn-sm rounded-circle" type="submit" value="">
                                                                    <i class="fa fa-trash" data-feather="user-x" alt="Padam"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7">Tiada Rekod </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div> <!-- END TAB PEGAWAI KHAS -->

                    <!-- TAB SETIAUSAHA PEJABAT -->
                    <div class="tab-pane fade" id="pills-setiausahapejabat" role="tabpanel" aria-labelledby="pills-setiausahapejabat-tab">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-3 b-grey">
                                    <form class="theme-form mega-form" method="POST" action="{{ route('tambah_Supej', $ahli_mesyuarat->id_ahli) }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <h6><b>SETIAUSAHA PEJABAT</b></h6>
                                        <hr class="mt-3 mb-3">

                                        <!-- Nama -->
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label class="col-form-label"><b>NAMA</b></label>
                                            </div>

                                            <div class="col-10">
                                                <input class="form-control text-uppercase supejnama" id="supejnama" type="text" name="supej_nama" placeholder="NAMA PENUH" value="">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label class="col-form-label"><b>EMEL</b></label>
                                            </div>

                                            <div class="col-10">
                                                <input class="form-control supejemel" id="supejemel" type="text" name="supej_emel" placeholder="E-MEL" value="">
                                                <small class="text-muted"> Contoh: pengguna@kabinet.gov.my</small>
                                            </div>
                                        </div>

                                        <!-- Telefon Bimbit /  Pejabat -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label class="col-form-label"><b>TEL BIMBIT</b></label>
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control supejbimbit" id="supejbimbit" type="text" name="supej_hp" placeholder="TEL BIMBIT" value="">
                                                <small class="text-muted"> Contoh: 0131234567</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label class="col-form-label"><b>TEL PEJABAT</b></label>
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control supejtelpej" id="supejtelpej" type="text" name="supej_telpej" placeholder="TEL PEJABAT" value="">
                                                <small class="text-muted"> Contoh: 0312345678</small>
                                            </div>
                                        </div>

                                        <!-- Faks -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label class="col-form-label"><b>NO FAKS</b></label>
                                            </div>

                                            <div class="col-7">
                                                <input class="form-control supejfaks" id="supejfaks" type="text" name="supej_faks" placeholder="FAKS" value="">
                                            </div>
                                        </div>

                                        <div class="col-12 p-0 text-right">
                                            <button type="submit" id="tambah1" name="tambah" value="tambah" class="btn btn-primary btn-sm rounded tambah1">
                                                <i class="fa fa-plus"></i>&nbsp; Tambah
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-9">
                                    <h6><b>SENARAI SETIAUSAHA PEJABAT</b></h6>
                                    <hr class="mt-3 mb-3">

                                    <div class="form-group">
                                        <table id="tbl-supej" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%; text-align: center;">Bil</th>
                                                    <th style="width: 25%; text-align: center;">Nama</th>
                                                    <th style="width: 25%; text-align: center;">EMel</th>
                                                    <th style="width: 15%; text-align: center;">Tel Bimbit</th>
                                                    <th style="width: 15%; text-align: center;">Tel Pejabat</th>
                                                    <th style="width: 10%; text-align: center;">No Faks</th>
                                                    <th style="width: 7%; text-align: center;">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($supej as $setiausaha)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-uppercase">{{ $setiausaha->supej_nama }}</td>
                                                        <td class="text-center">{{ $setiausaha->supej_emel }}</td>
                                                        <td class="text-center">{{ $setiausaha->supej_hp }}</td>
                                                        <td class="text-center">{{ $setiausaha->supej_telpej }}</td>
                                                        <td class="text-center">{{ $setiausaha->supej_faks }}</td>
                                                        <td class="text-center">
                                                            <form action="{{ route('padam_supej', ['id_ahli' => $ahli_mesyuarat->id_ahli, 'id_supej' => $setiausaha->id_supej]) }}" method="POST"
                                                                onsubmit="return confirm('Adakah anda pasti untuk menghapuskan rekod ini?');" style="display: inline-block;">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <button title="Padam Mesyuarat" class="btn btn-danger btn-sm rounded-circle" type="submit" value="">
                                                                    <i class="fa fa-trash" data-feather="user-x" alt="Padam"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7">Tiada Rekod </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div> <!-- TAB SETIAUSAHA PEJABAT -->

                    <!-- TAB PEMANDU/ BODYGUARD/ KENDERAAN -->
                    <div class="tab-pane fade" id="pills-pbk" role="tabpanel" aria-labelledby="pills-pbk-tab">
                        <div class="card-body">
                            <form class="theme-form mega-form" method="POST" action="{{ route('kemaskini_PemanduBguard', $ahli_mesyuarat->id_ahli) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <!-- PEMANDU -->
                                <div class="b-grey">
                                    <h6><b>PEMANDU</b></h6>
                                    <hr class="mt-3 mb-3">

                                    <!-- Nama -->
                                    <div class="form-group row">
                                        <div class="col-2">
                                            <label class="col-form-label"><b>NAMA</b></label>
                                        </div>

                                        <div class="col-9">
                                            <input class="form-control text-uppercase" type="text" name="pemandu_nama" placeholder="NAMA PENUH" value="{{ $pemandu_bguard->pemandu_nama }}">
                                        </div>
                                    </div>

                                    <!-- No Telefon Bimbit -->
                                    <div class="form-group row">
                                        <div class="col-2">
                                            <label class="col-form-label"><b>TEL BIMBIT</b></label>
                                        </div>

                                        <div class="col-3">
                                            <input class="form-control" type="text" name="pemandu_hp" placeholder="NO TEL BIMBIT" value="{{ $pemandu_bguard->pemandu_hp }}">
                                            <small class="text-muted"> Contoh: 0131234567</small>
                                        </div>
                                    </div>

                                    <!-- No Telefon Pejabat -->
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="col-form-label"><b>TEL PEJABAT</b></label>
                                        </div>

                                        <div class="col-3">
                                            <input class="form-control" type="text" name="pemandu_telpej" placeholder="NO TEL PEJABAT" value="{{ $pemandu_bguard->pemandu_telpej }}">
                                            <small class="text-muted"> Contoh: 0312345678</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- BODYGUARD -->
                                <div class="b-grey">
                                    <h6><b>BODYGUARD</b></h6>
                                    <hr class="mt-3 mb-3">

                                    <!-- Nama -->
                                    <div class="form-group row">
                                        <div class="col-2">
                                            <label class="col-form-label"><b>NAMA</b></label>
                                        </div>

                                        <div class="col-9">
                                            <input class="form-control text-uppercase" type="text" name="bguard_nama" placeholder="NAMA PENUH" value="{{ $pemandu_bguard->bguard_nama }}">
                                        </div>
                                    </div>

                                    <!-- No Telefon Bimbit -->
                                    <div class="form-group row">
                                        <div class="col-2">
                                            <label class="col-form-label"><b>TEL BIMBIT</b></label>
                                        </div>

                                        <div class="col-3">
                                            <input class="form-control" type="text" name="bguard_hp" placeholder="NO TEL BIMBIT" value="{{ $pemandu_bguard->bguard_hp }}">
                                            <small class="text-muted"> Contoh: 0131234567</small>
                                        </div>
                                    </div>

                                    <!-- No Telefon Pejabat -->
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="col-form-label"><b>TEL PEJABAT</b></label>
                                        </div>

                                        <div class="col-3">
                                            <input class="form-control" type="text" name="bguard_telpej" placeholder="NO TEL PEJABAT" value="{{ $pemandu_bguard->bguard_telpej }}">
                                            <small class="text-muted"> Contoh: 0312345678</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- No Plat Kenderaan -->
                                <div class="b-grey">
                                    <h6><b>KENDERAAN</b></h6>
                                    <hr class="mt-3 mb-3">

                                    <div class="row">
                                        <div class="col-2">
                                            <label class="col-form-label"><b>NO PLAT KENDERAAN</b></label>
                                        </div>

                                        <div class="col-3">
                                            <input class="form-control text-uppercase" type="text" name="no_plat" placeholder="NO PLAT" value="{{ $pemandu_bguard->no_plat }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" name="hantar" value="hantar" class="btn btn-primary btn-sm rounded">
                                        <i class="fa fa-send"></i> Hantar
                                    </button>

                                    <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
                                        <i class="fa fa-refresh"></i> Tetapan Semula
                                    </button>
                                </div>

                        </div>
                        </form>
                    </div> <!-- END TAB PEMANDU/ BODYGUARD/ KENDERAAN -->

                </div> <!-- end tab content -->
            </div> <!-- end card body -->


            <div class="col-12 m-15 text-center">
                Data terakhir dikemaskini oleh <b>{{ $ahli_mesyuarat->action_by }}</b> pada <b>{{ date('d/m/Y', strtotime($ahli_mesyuarat->updated_at)) }}</b>.
            </div>

        </div> <!-- end card -->
    </div>

@endsection
