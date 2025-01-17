@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 text-left">
                    <form action="{{ route('p_CetakMaklumatAhli', $ahli_mesyuarat->id_ahli) }}">
                        <button class="btn btn-success btn-sm rounded" type="submit" title="Cetak Maklumat Ahli">
                            <i class="fa fa-print"></i> Cetak Maklumat Ahli
                        </button>
                    </form>
                </div>

                <div class="col-6 text-right">
                    <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                </div>
            </div>

            <h3 class="text-center"><b>MAKLUMAT AHLI MESYUARAT</b></h3>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="pills-butiranahli-tab" data-toggle="pill" href="#pills-butiranahli" role="tab" aria-controls="pills-butiranahli" aria-selected="true"><b>BUTIRAN AHLI</b></a></li>
                <li class="nav-item"><a class="nav-link" id="pills-lantikanpersaraan-tab" data-toggle="pill" href="#pills-lantikanpersaraan" role="tab" aria-controls="pills-lantikanpersaraan" aria-selected="false"><b>LANTIKAN & PERSARAAN</b></a></li>
                <li class="nav-item"><a class="nav-link" id="pills-pegawaikhas-tab" data-toggle="pill" href="#pills-pegawaikhas" role="tab" aria-controls="pills-pegawaikhas" aria-selected="false"><b>PEGAWAI KHAS</b></a></li>
                <li class="nav-item"><a class="nav-link" id="pills-setiausahapejabat-tab" data-toggle="pill" href="#pills-setiausahapejabat" role="tab" aria-controls="pills-setiausahapejabat" aria-selected="false"><b>SETIAUSAHA PEJABAT</b></a></li>
                <li class="nav-item"><a class="nav-link" id="pills-pbk-tab" data-toggle="pill" href="#pills-pbk" role="tab" aria-controls="pills-pbk" aria-selected="false"><b>PEMANDU/ BODYGUARD/ KENDERAAN</b></a></li>
            </ul>
            <div class="tab-content" id="pills-warningtabContent">
                <!-- TAB BUTIRAN AHLI -->
                <div class="tab-pane fade show active" id="pills-butiranahli" role="tabpanel" aria-labelledby="pills-butiranahli-tab">
                    <div class="card-body">
                        <table width="100%" style="border-collapse:collapse; border-color:#000000; border:none; text-align:left;">
                            <tbody>
                                <!-- Jenis Mesyuarat  -->
                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left; vertical-align: top;">
                                        <label class="col-form-label"><b>JENIS MESYUARAT</b></label>
                                    </td>
                                    <td class="text-uppercase" width="20%" style="border:none; text-align:left;">
                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                            @if ( $butiran-> mesyuarat_ksukp == '1')
                                            KSUKP<br>
                                            @endif
                                            @if ( $butiran-> mesyuarat_mbkm == '1')
                                            MBKM<br>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr><td class="p-2"></td></tr>

                                <!-- Gelaran -->

                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left;">
                                        <label class="col-form-label"><b>GELARAN</b></label>
                                    </td>
                                    <td class="text-uppercase" width="20%" style="border:none; text-align:left;">
                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                            @if(!empty($gelaran->gelaran))
                                            {{ $gelaran->gelaran }}
                                            @else
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr><td class="p-2"></td></tr>

                                <!-- Nama Ahli -->
                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left;">
                                        <label class="col-form-label"><b>NAMA AHLI</b></label>
                                    </td>
                                    <td class="text-uppercase" width="60%" colspan="3" style="border:none; text-align:left;">
                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                            {{ $ahli_mesyuarat->nama_ahli }}
                                        </div>
                                    </td>
                                </tr>

                                <tr><td class="p-2"></td></tr>

                                <!-- Kad Pengenalan Ahli -->
                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left;">
                                        <label class="col-form-label"><b>NO. KAD PENGENALAN</b></label>
                                    </td>
                                    <td class="text-uppercase" width="60%" colspan="3" style="border:none; text-align:left;">
                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                            {{ $butiran->no_ic }}
                                        </div>
                                    </td>
                                </tr>

                                <tr><td class="p-2"></td></tr>

                                <!-- Jawatan Ahli  -->
                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left;">
                                        <label class="col-form-label"><b>JAWATAN</b></label>
                                    </td>
                                    <td class="text-uppercase" width="60%" colspan="3" style="border:none; text-align:left;">

                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                            @if(!empty($jawatan->nama_jawatan))
                                            {{ $jawatan->nama_jawatan }}
                                            @else
                                            @endif
                                        </div>

                                    </td>
                                </tr>

                                <tr><td class="p-2"></td></tr>
                                <!-- Kementerian Ahli  -->
                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left;">
                                        <label class="col-form-label"><b>KEMENTERIAN</b></label>
                                    </td>
                                    <td class="text-uppercase" width="60%" colspan="3" style="border:none; text-align:left;">
                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                            @if(!empty($kementerian->id_kementerian))
                                            {{ $kementerian->nama_kementerian }} ({{ $kementerian->singkatan_kementerian }})
                                            @else
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr><td class="p-2"></td></tr>
                                <!-- Alamat  -->
                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left; vertical-align: top;">
                                        <label class="col-form-label"><b>ALAMAT</b></label>
                                    </td>
                                    <td class="text-uppercase" width="60%" colspan="3" style="border:none; text-align:left;">
                                        <textarea class="form-control text-uppercase" name="alamat" id="" rows="4" style="background-color: #fff; border-radius: 8px;" disabled="">{{ $butiran->alamat }}</textarea>
                                    </td>
                                </tr>

                                <tr><td class="p-2"></td></tr>
                                <!-- Telefon Bimbit & Email  -->
                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left;">
                                        <label class="col-form-label"><b>NO TEL BIMBIT ( PERIBADI )</b></label>
                                    </td>
                                    <td class="text-uppercase" width="20%" style="border:none; text-align:left;">
                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                            {{ $butiran->no_hp_peribadi }}
                                        </div>
                                    </td>
                                    <td class="" width="15%" style="border:none; text-align:center;">
                                        <label class="col-form-label"><b>EMEL</b></label>
                                    </td>
                                    <td width="25%" style="border:none; text-align:left;">
                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                            {{ $butiran->emel }}
                                        </div>
                                    </td>
                                </tr>

                                <tr><td class="p-2"></td></tr>
                                <!-- Suami / Isteri  -->
                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left;">
                                        <label class="col-form-label"><b>NAMA ISTERI / SUAMI</b></label>
                                    </td>
                                    <td class="text-uppercase" width="60%" colspan="3" style="border:none; text-align:left;">
                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                            {{ $butiran->isteri_suami }}
                                        </div>
                                    </td>
                                </tr>

                                <tr><td class="p-2"></td></tr>
                                <!-- Status Ahli  -->
                                <tr>
                                    <td class="" width="20%" style="border:none; text-align:left;">
                                        <label class="col-form-label"><b>STATUS AHLI</b></label>
                                    </td>
                                    <td class="text-uppercase" width="20%" style="border:none; text-align:left;">
                                        <div class="b-grey m-0" style="padding: 8px 15px;">
                                        @if(!empty($status_ahli->nama_status_ahli))
                                        {{ $status_ahli->nama_status_ahli }}
                                        @else
                                        @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div> <!-- END TAB BUTIRAN AHLI -->

                <!-- TAB LANTIKAN & PERSARAAN -->
                <div class="tab-pane fade" id="pills-lantikanpersaraan" role="tabpanel" aria-labelledby="pills-lantikanpersaraan-tab">
                    <div class="card-body">

                        <div class="b-grey">
                            <h6><b>LANTIKAN SEMASA</b></h6>
                            <hr class="mt-3 mb-3">
                            <div class="row">
                                <!--  Gred  -->
                                <div class="col-1">
                                    <label class="col-form-label"><b>GRED</b></label>
                                </div>
                                <div class="col-auto text-uppercase">
                                    @if(!empty($gred->nama_gred))
                                    <input type="text" id="nama_gred" name="nama_gred" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="{{ $gred->nama_gred }}">
                                    @else
                                    <input type="text" id="nama_gred" name="nama_gred" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="">
                                    @endif
                                </div>

                                <!-- Tarikh Gred Terkini  -->
                                <div class="col-auto">
                                    <label class="col-form-label"><b>TARIKH GRED</b></label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="tarikh_lantikan" name="tarikh_lantikan" disabled="" class="form-control text-uppercase" style="background-color: #fff;"
                                    value="{{ $lantikan->tarikh_lantikan ? date('d/m/Y', strtotime($lantikan->tarikh_lantikan)) : '' }}">
                                </div>

                                <!-- Kekananan  -->
                                <div class="col-auto">
                                    <label class="col-form-label"><b>SUSUNAN KEKANANAN</b></label>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="kekananan_mesy_manual" name="kekananan_mesy_manual" disabled="" class="form-control text-uppercase" style="background-color: #fff;"
                                    value="{{ $lantikan->kekananan_mesy_manual }}">
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
                                    <input type="text" id="tarikh_mula_kontrak1" name="tarikh_mula_kontrak1" disabled="" class="form-control text-uppercase" style="background-color: #fff;"
                                    value="{{ $lantikan->tarikh_mula_kontrak1 ? date('d/m/Y', strtotime($lantikan->tarikh_mula_kontrak1)) : '' }}">
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
                                    <input type="text" id="tarikh_bersara" name="tarikh_bersara" disabled="" class="form-control text-uppercase" style="background-color: #fff;"
                                    value="{{ $lantikan->tarikh_bersara ? date('d/m/Y', strtotime($lantikan->tarikh_bersara)) : '' }}">
                                </div>

                                <!-- Gred Jawatan Semasa Bersara -->
                                <div class="col-auto">
                                    <label class="col-form-label"><b>GRED JAWATAN SEMASA BERSARA</b></label>
                                </div>
                                <div class="col-2 text-uppercase">
                                    @if(!empty($GredBersara->nama_gred))
                                    <input type="text" id="gred" name="gred" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="{{ $GredBersara->nama_gred }}">
                                    @else
                                    <input type="text" id="gred" name="gred" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="">
                                    @endif
                                </div>
                                </div>

                                <!-- Tarikh Lantikan Gred Jawatan -->
                                <div class="row">
                                <div class="col-auto">
                                    <label class="col-form-label"><b>TARIKH LANTIKAN SEMASA BERSARA</b></label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="tarikh_lantikan_semasa_bersara" name="tarikh_lantikan_semasa_bersara" disabled="" class="form-control text-uppercase" style="background-color: #fff;"
                                    value="{{ $lantikan->tarikh_lantikan_semasa_bersara ? date('d/m/Y', strtotime($lantikan->tarikh_lantikan_semasa_bersara)) : '' }}">
                                </div>
                            </div>

                        </div>

                    </div>
                </div> <!-- END TAB LANTIKAN & PERSARAAN -->

                <!-- TAB PEGAWAI KHAS -->
                <div class="tab-pane fade" id="pills-pegawaikhas" role="tabpanel" aria-labelledby="pills-pegawaikhas-tab">
                    <div class="card-body">
                        <div class="form-group row">

                            <h6 class="text-center"><b>SENARAI PEGAWAI KHAS</b></h6>
                            <hr class="mt-3 mb-3">

                            <table id="tbl-pegkhas" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;">Bil</th>
                                        <th style="width: 30%; text-align: center;">Nama</th>
                                        <th style="width: 25%; text-align: center;">Emel</th>
                                        <th style="width: 15%; text-align: center;">No Tel (Bimbit)</th>
                                        <th style="width: 15%; text-align: center;">No Tel (Pejabat)</th>
                                        <th style="width: 10%; text-align: center;">No Faks</th>
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
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Tiada Rekod </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- END TAB PEGAWAI KHAS -->

                <!-- TAB SETIAUSAHA PEJABAT -->
                <div class="tab-pane fade" id="pills-setiausahapejabat" role="tabpanel" aria-labelledby="pills-setiausahapejabat-tab">
                    <div class="card-body">
                        <div class="form-group row text-center">
                            <h6><b>SENARAI SETIAUSAHA PEJABAT</b></h6>
                            <hr class="mt-3 mb-3">

                            <table id="tbl-supej" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;">Bil</th>
                                        <th style="width: 30%; text-align: center;">Nama</th>
                                        <th style="width: 25%; text-align: center;">Emel</th>
                                        <th style="width: 15%; text-align: center;">No Tel (Bimbit)</th>
                                        <th style="width: 15%; text-align: center;">No Tel (Pejabat)</th>
                                        <th style="width: 10%; text-align: center;">No Faks</th>
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
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Tiada Rekod </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- END TAB SETIAUSAHA PEJABAT -->

                <!-- TAB PEMANDU/ BODYGUARD/ KENDERAAN -->
                <div class="tab-pane fade" id="pills-pbk" role="tabpanel" aria-labelledby="pills-pbk-tab">
                    <div class="card-body">

                        <!-- PEMANDU -->
                        <div class="b-grey">
                            <h6><b>PEMANDU</b></h6>
                            <hr class="mt-3 mb-3">

                            <!-- Nama -->
                            <div class="form-group row">
                                <div class="col-2">
                                    <label class="col-form-label"><b>NAMA</b></label>
                                </div>

                                <div class="col-9 text-uppercase">
                                <input type="text" id="pemandu_nama" name="pemandu_nama" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="{{ $pemandu_bguard->pemandu_nama }}">
                                </div>
                            </div>

                            <!-- No Telefon Bimbit -->
                            <div class="form-group row">
                                <div class="col-2">
                                    <label class="col-form-label"><b>NO TEL (BIMBIT)</b></label>
                                </div>

                                <div class="col-3">
                                    <input type="text" id="pemandu_hp" name="pemandu_hp" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="{{ $pemandu_bguard->pemandu_hp }}">
                                </div>
                            </div>

                            <!-- No Telefon Pejabat -->
                            <div class="row">
                            <div class="col-2">
                                <label class="col-form-label"><b>NO TEL (PEJABAT)</b></label>
                            </div>

                            <div class="col-3">
                                <input type="text" id="p_telpej" name="p_telpej" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="{{ $pemandu_bguard->pemandu_telpej }}">
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

                                <div class="col-9 text-uppercase">
                                    <input type="text" id="bguard_nama" name="bguard_nama" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="{{ $pemandu_bguard->bguard_nama }}">
                                </div>
                            </div>

                            <!-- No Telefon Bimbit -->
                            <div class="form-group row">
                                <div class="col-2">
                                    <label class="col-form-label"><b>NO TEL (BIMBIT)</b></label>
                                </div>

                                <div class="col-3">
                                    <input type="text" id="bguard_hp" name="bguard_hp" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="{{ $pemandu_bguard->bguard_hp }}">
                                </div>
                            </div>

                            <!-- No Telefon Pejabat -->
                            <div class="row">
                                <div class="col-2">
                                    <label class="col-form-label"><b>NO TEL (PEJABAT)</b></label>
                                </div>

                                <div class="col-3">
                                    <input class="form-control" type="text" name="bodyguard_telpej" style="background-color: #fff;" disabled="" value="{{ $pemandu_bguard->bguard_telpej }}">
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

                                <div class="col-3 text-uppercase">
                                <input type="text" id="no_plat" name="no_plat" disabled="" class="form-control text-uppercase" style="background-color: #fff;" value="{{ $pemandu_bguard->no_plat }}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- END TAB PEMANDU/ BODYGUARD/ KENDERAAN -->

            </div> <!-- end tab content -->
        </div> <!-- end card body -->

    </div> <!-- end card -->
</div>

</script>

@endsection
