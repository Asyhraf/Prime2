@extends('layouts.customtheme')

@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-10">
                            Anggota Pentadbiran
                            <i class="menu-icon fa fa-angle-right"></i>
                            <strong class="card-title">
                                Paparan Maklumat
                            </strong>
                        </div>

                        <div class="col-md-2 float-right">
                            <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                                <i class="fa fa-backward"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card-body card-block">
                        @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-square-o"></i> <b>{{ session()->get('message') }}</b>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="col-md-12">

                            <script src="{{ asset('/resources/dropzone/dist/dropzone.js') }}"></script>

                            <!-- -------------------------- NAMA & GAMBAR----------------------- --->

                            <div class="form-row col-12">
                                <!--Nama Pernuh Beserta Gelaran-->
                                <div class="form-group col-md-10 font-weight-bold">

                                    <h3>
                                        @if(!empty($pentadbiran->kodgelaran->gelaran))
                                        {{ $pentadbiran->kodgelaran->gelaran }}
                                        @endif

                                        {{ $pentadbiran->senator }}

                                        @if(!empty($pentadbiran->kodgelarandarjah->gelaran_darjah))
                                        {{ $pentadbiran->kodgelarandarjah->gelaran_darjah }}
                                        @endif

                                        {{ $pentadbiran->gelaran_professional }}
                                        {{ $pentadbiran->nama }}
                                    </h3>

                                    @if($pentadbiran->jawatan_penuh!="")
                                    <span class="badge badge-warning">{{ $pentadbiran->jawatan_penuh }}</span><br>
                                    @endif

                                    @if(!empty($pentadbiran->kodparlimen->parlimen))
                                    <span class="badge badge-primary">ADR [{{ $pentadbiran->kodparlimen->parlimen }}]</span>
                                    @endif

                                    @if(!empty($pentadbiran->koddun->dewan_undangan_negeri))
                                    <span class="badge badge-success">DUN [{{ $pentadbiran->koddun->dewan_undangan_negeri }}]</span>
                                    @endif

                                    @if(!empty($pentadbiran->senator))
                                    <span class="badge badge-success">ADN [Senator]
                                        @if(!empty($pentadbiran->kodjenislantikansenator->jenis_lantikan))
                                        {{ $pentadbiran->kodjenislantikansenator->jenis_lantikan }}
                                        @endif
                                    </span>
                                    @endif

                                    @if(!empty($pentadbiran->kodpartikomponen->parti_komponen_gambar))
                                    <?php $gambar_parti_komponen = $pentadbiran->kodpartikomponen->parti_komponen_gambar; ?>
                                    <br><img class="img-thumbnail" id="gambar_preview" width="40" height="25" src='{{ asset("/images_parti/$gambar_parti_komponen") }}'>
                                    @endif

                                    @if(!empty($pentadbiran->kodpartikomponen->parti_komponen))
                                    <span class="badge badge-light">{{ $pentadbiran->kodpartikomponen->parti_komponen }}
                                        ({{ $pentadbiran->kodpartikomponen->parti_komponen_singkatan }})</span>
                                    @endif
                                </div>

                                <!--Gambar -->
                                <div class="form-group col-md-2 font-weight-bold">
                                    @if(!empty($pentadbiran->gambar))
                                    <img class="img-thumbnail float-right" id="gambar_preview" width="100" height="150" src='{{ asset("/images/$pentadbiran->gambar?timestamp=$custom_timestamp") }}'>
                                    @else
                                    <img class="img-thumbnail float-right" id="gambar_preview" width="100" height="150" src='{{ asset("/images/tiadagambar.jpg") }}'>
                                    @endif
                                </div>
                            </div>

                            <!-- -------------------------- MAKLUMAT ASAS ----------------------- --->

                            <div class="form-row col-12">
                                <!--Nama Pernuh Beserta Gelaran-->
                                <div class="form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                    Maklumat Asas
                                </div>
                            </div>

                            <style>
                                input[type=text]:disabled {
                                    background: #FFF2F0;
                                    border-color: #FFF2F0;
                                }
                            </style>

                            <div class="form-row col-12">
                                <!--Nama Surat Menyurat-->
                                <div class="form-group col-md-6 font-weight-bold">
                                    <label for="nama">Nama Surat Menyurat</label>
                                    <input disabled type="text" name="nama" class="form-control" id="nama" value="{{ $pentadbiran->nama }}">
                                </div>

                                <!--Nama Surat Menyurat-->
                                <div class="form-group col-md-6 font-weight-bold">
                                    <label for="nama_kad_pengenalan">Nama Dalam Kad Pengenalan</label>
                                    <input disabled type="text" name="nama_kad_pengenalan" class="form-control" id="nama_kad_pengenalan" value="{{ $pentadbiran->nama_kad_pengenalan }}">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Nombor Kad Pengenalan-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <label for="nombor_kad_pengenalan">No. Kad Pengenalan</label>
                                    <input disabled type="text" name="nombor_kad_pengenalan" class="form-control" id="nombor_kad_pengenalan" maxlength="12" value="{{ $pentadbiran->nombor_kad_pengenalan }}">
                                </div>

                                <!--Agama-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <label for="kod_agama">Agama</label>
                                    @if(!empty($pentadbiran->kodagama->agama))
                                    <input disabled type="text" name="kod_agama" class="form-control" id="kod_agama" value="{{ $pentadbiran->kodagama->agama }}">
                                    @else
                                    <input disabled type="text" name="kod_agama" class="form-control" id="kod_agama" value="">
                                    @endif
                                </div>

                                <!--Jantina-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <label for="kod_jantina">Jantina</label>
                                    @if(!empty($pentadbiran->kodjantina->jantina))
                                    <input disabled type="text" name="kod_jantina" class="form-control" id="kod_agama" value="{{ $pentadbiran->kodjantina->jantina }}">
                                    @else
                                    <input disabled type="text" name="kod_jantina" class="form-control" id="kod_agama" value="">
                                    @endif

                                </div>

                                <!--Status Perkahwinan-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <label for="kod_status_perkahwinan">Status Perkahwinan</label>
                                    @if(!empty($pentadbiran->kodstatusperkahwinan->status_perkahwinan))
                                    <input disabled type="text" name="kod_status_perkahwinan" class="form-control" id="kod_agama" value="{{ $pentadbiran->kodstatusperkahwinan->status_perkahwinan }}">
                                    @else
                                    <input disabled type="text" name="kod_status_perkahwinan" class="form-control" id="kod_agama" value="">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!-- Tarikh Lahir -->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <label for="tarikh_lahir">Tarikh Lahir</label>
                                    @if(!empty($pentadbiran->tarikh_lahir))
                                    <input disabled type="text" id="tarikh_lahir" name="tarikh_lahir" class="form-control" value="{{ date('d/m/Y', strtotime($pentadbiran->tarikh_lahir))  }}">
                                    @else
                                    <input disabled type="text" id="tarikh_lahir" name="tarikh_lahir" class="form-control" value="">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Nama Pasangan-->
                                <div class="form-group col-md-12 font-weight-bold">
                                    <label for="nama_pasangan">Nama Penuh Pasangan Beserta Gelaran (Sekiranya ada)</label>
                                    <input disabled type="text" name="nama_pasangan" class="form-control" id="nama_pasangan" value="{{ $pentadbiran->nama_pasangan }}">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!-- Bintang -->
                                <div class="form-group col-md-12 font-weight-bold">
                                    <label for="bintang">Bintang</label>
                                    <input disabled type="text" name="bintang" class="form-control" id="bintang" value="{{ $pentadbiran->bintang }}">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Bintang Luar-->
                                <div class="form-group col-md-12 font-weight-bold">
                                    <label for="bintang_luar">Bintang (Penganugerahan Luar Negara)</label>
                                    <input disabled type="text" name="bintang_luar" class="form-control" id="bintang_luar" value="{{ $pentadbiran->bintang_luar }}">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Kod Kelulusan Akademik-->
                                <div class="form-group col-md-5 font-weight-bold">
                                    <label for="kod_kelulusan_akademik">Kelulusan Akademik</label>
                                    @if(!empty($pentadbiran->kodkelulusanakademik->kelulusan_akademik))
                                    <input disabled type="text" name="kod_kelulusan_akademik" class="form-control" id="kod_kelulusan_akademik" value="{{ $pentadbiran->kodkelulusanakademik->kelulusan_akademik }}">
                                    @else
                                    <input disabled type="text" name="kod_kelulusan_akademik" class="form-control" id="kod_kelulusan_akademik" value="">
                                    @endif
                                </div>

                                <!--Butiran Kelulusan Akademik-->
                                <div class="form-group col-md-7 font-weight-bold">
                                    <label for="butiran_kelulusan_akademik">Butiran Kelulusan Akademik</label>
                                    <input disabled type="text" name="butiran_kelulusan_akademik" class="form-control" id="butiran_kelulusan_akademik" value="{{ $pentadbiran->butiran_kelulusan_akademik }}">
                                </div>
                            </div>

                            <!-- -------------------------- MAKLUMAT PERHUBUNGAN ----------------------- --->

                            <div class="form-row col-12">
                                <!--Nama Pernuh Beserta Gelaran-->
                                <div class="form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                    Maklumat Perhubungan
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Alamat 1-->
                                <div class="form-group col-md-12 font-weight-bold">
                                    <label for="alamat_1">Alamat Rumah</label>
                                    <input disabled type="text" name="alamat_1" class="form-control" id="alamat_1" value="{{ $pentadbiran->alamat_1 }}">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Alamat 2-->
                                <div class="form-group col-md-12 font-weight-bold">
                                    <input disabled type="text" name="alamat_2" class="form-control" id="alamat_2" value="{{ $pentadbiran->alamat_2 }}">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Poskod-->
                                <div class="form-group col-md-2 font-weight-bold">
                                    <label for="alamat_poskod">Poskod</label>
                                    <input disabled type="text" name="alamat_poskod" maxlength="6" class="form-control" id="alamat_poskod" value="{{ $pentadbiran->alamat_poskod }}">
                                </div>

                                <!--Bandar-->
                                <div class="form-group col-md-6 font-weight-bold">
                                    <label for="alamat_bandar">Bandar</label>
                                    <input disabled type="text" name="alamat_bandar" class="form-control" id="alamat_bandar" value="{{ $pentadbiran->alamat_bandar }}">
                                </div>

                                <!--Kod Negeri-->
                                <div class="form-group col-md-4 font-weight-bold">
                                    <label for="kod_negeri_alamat">Negeri</label>
                                    @if(!empty($pentadbiran->kodnegeri->nama_negeri))
                                    <input disabled type="text" name="kod_negeri_alamat" class="form-control" id="kod_negeri_alamat" value="{{ $pentadbiran->kodnegeri->nama_negeri }}">
                                    @else
                                    <input disabled type="text" name="kod_negeri_alamat" class="form-control" id="kod_negeri_alamat" value="">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Telefon Rumah-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <label for="telefon_rumah">Telefon Rumah</label>
                                    <input disabled type="text" name="telefon_rumah" class="form-control" id="telefon_rumah" value="{{ $pentadbiran->telefon_rumah }}">
                                </div>

                                <!--Telefon Bimbit-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <label for="telefon_bimbit">Telefon Bimbit</label>
                                    <input disabled type="text" name="telefon_bimbit" class="form-control" id="telefon_bimbit" value="{{ $pentadbiran->telefon_bimbit }}">
                                </div>

                                <!--Telefon Pejabat-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <label for="telefon_pejabat">Telefon Pejabat</label>
                                    <input disabled type="text" name="telefon_pejabat" class="form-control" id="telefon_pejabat" value="{{ $pentadbiran->telefon_pejabat }}">
                                </div>

                                <!--Telefon Faks-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <label for="telefon_faks">Faks</label>
                                    <input disabled type="text" name="telefon_faks" class="form-control" id="telefon_faks" value="{{ $pentadbiran->telefon_faks }}">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Telefon Pegawai -->
                                <div class="form-group col-md-6 font-weight-bold">
                                    <label for="telefon_pegawai">Telefon Pegawai Khas / SUSK </label>
                                    <input disabled type="text" name="telefon_pegawai" class="form-control" id="telefon_pegawai" value="{{ $pentadbiran->telefon_pegawai }}">
                                </div>

                                <!--Emel -->
                                <div class="form-group col-md-6 font-weight-bold">
                                    <label for="emel">Alamat E-mel </label>
                                    <input disabled type="text" name="emel" class="form-control" id="emel" value="{{ $pentadbiran->emel }}">
                                </div>
                            </div>

                            <!-- -------------------- MAKLUMAT PARTI POLITIK --------------------- --->

                            <div class="form-row col-12">
                                <!--Maklumat Parti Politik-->
                                <div class="form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                    Maklumat Parti Politik
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!-- Kod Parti -->
                                <div class="form-group col-md-7 font-weight-bold">
                                    <label for="kod_parti">Parti</label>
                                    @if(!empty($pentadbiran->kodparti->parti))
                                    <input disabled type="text" name="kod_parti" class="form-control" id="kod_parti" value="{{ $pentadbiran->kodparti->parti }} ({{ $pentadbiran->kodparti->parti_singkatan }})">
                                    @else
                                    <input disabled type="text" name="kod_parti" class="form-control" id="kod_parti" value="">
                                    @endif
                                </div>

                                <!-- Kod Parti Komponen -->
                                <div class="form-group col-md-5 font-weight-bold">
                                    <label for="kod_parti_komponen">Parti Komponen</label>
                                    @if(!empty($pentadbiran->kodpartikomponen->parti_komponen))
                                    <input disabled type="text" name="kod_parti_komponen" class="form-control" id="kod_parti_komponen" value="{{ $pentadbiran->kodpartikomponen->parti_komponen }} ({{ $pentadbiran->kodpartikomponen->parti_komponen_singkatan }})">
                                    @else
                                    <input disabled type="text" name="kod_parti_komponen" class="form-control" id="kod_parti_komponen" value="">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!-- Jawatan Dalam Parti -->
                                <div class="form-group col-md-7 font-weight-bold">
                                    <label for="kod_parti_jawatan">Jawatan Dalam Parti</label>
                                    @if(!empty($pentadbiran->kodpartijawatan->jawatan))
                                    <input disabled type="text" name="kod_parti_jawatan" class="form-control" id="kod_parti_jawatan" value="{{ $pentadbiran->kodpartijawatan->jawatan }}">
                                    @else
                                    <input disabled type="text" name="kod_parti_jawatan" class="form-control" id="kod_parti_jawatan" value="">
                                    @endif
                                </div>

                                <!-- Kekananan Dalam Parti -->
                                <div class="form-group col-md-5 font-weight-bold">
                                    <label for="kekananan_dalam_parti">Kekananan Dalam Parti</label>
                                    <input disabled type="text" name="kekananan_dalam_parti" class="form-control" id="kekananan_dalam_parti" value="{{ $pentadbiran->kekananan_dalam_parti }}">
                                </div>

                            </div>

                            <!-- -------------------- MAKLUMAT KATEGORI PELANTIKAN --------------------- --->

                            <div class="form-row col-12">
                                <!--Maklumat Pelantikan-->
                                <div class="form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                    Maklumat Kategori Pelantikan
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Status Ahli Dewan Rakyat (ADR)-->
                                <div class="form-group col-md-4 font-weight-bold">
                                    <label for="adr_status">
                                        Ahli Dewan Rakyat ?</label>
                                </div>

                                <!--Status Ahli Dewan Rakyat (ADR)-->
                                <div class="form-group col-md-1 font-weight-bold">
                                    <input disabled name="adr_status" class="form-group-input" type="checkbox" id="adr_status" value="1" {{ ($pentadbiran->adr_status==1) ? "checked" : "" }}>
                                    Ya
                                </div>

                                <!--Kawasan Parlimen-->
                                <div class="form-group col-md-7 font-weight-bold">
                                    @if($pentadbiran->adr_status==1)
                                    <input disabled type="text" name="kod_parlimen" class="form-control" id="kod_parlimen" value="[{{ $pentadbiran->kodparlimen->kodnegeri->nama_negeri }}] {{ $pentadbiran->kodparlimen->parlimen }}">
                                    @else
                                    <input disabled type="text" name="kod_parlimen" class="form-control" id="kod_parlimen" value="">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <div class="form-group col-md-12 font-weight-bold">
                                    <hr>
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!-- Ahli Dewan Undangan Negeri (ADUN)-->
                                <div class="form-group col-md-4 font-weight-bold">
                                    <label for="adr_status">
                                        Ahli Dewan Undangan Negeri ?</label>
                                </div>

                                <!--Status Ahli Dewan Rakyat (ADUN)-->
                                <div class="form-group col-md-1 font-weight-bold">
                                    <input disabled name="dun_status" class="form-group-input" type="checkbox" id="dun_status" value="1" {{ ($pentadbiran->dun_status==1) ? "checked" : "" }}>
                                    Ya
                                </div>

                                <!--Kawasan Dewan Undangan Negeri-->
                                <div class="form-group col-md-7 font-weight-bold">
                                    @if($pentadbiran->dun_status==1)
                                    <input disabled type="text" name="kod_dun" class="form-control" id="kod_dun" value="[{{ $pentadbiran->koddun->kodnegeri->nama_negeri }}] {{ $pentadbiran->koddun->dewan_undangan_negeri }}">
                                    @else
                                    <input disabled type="text" name="kod_dun" class="form-control" id="kod_dun" value="">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <div class="form-group col-md-12 font-weight-bold">
                                    <hr>
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!-- Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-4 font-weight-bold">
                                    <label for="adn_status">
                                        Ahli Dewan Negara ?</label>
                                </div>

                                <!--Status Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-1 font-weight-bold">
                                    <input name="adn_status" class="form-group-input" type="checkbox" id="adn_status" value="1" {{ ($pentadbiran->adn_status==1) ? "checked" : "" }} disabled>
                                    Ya
                                </div>

                                <!-- Kekananan (ADN)-->
                                <div class="form-group col-md-2 font-weight-bold">
                                    Kekananan
                                </div>

                                <div class="form-group col-md-2 font-weight-bold">
                                    <input type="text" name="adn_kekananan" class="form-control" id="adn_kekananan" value="{{ $pentadbiran->adn_kekananan }}" disabled>
                                </div>

                                <div class="form-group col-md-2 font-weight-bold">
                                </div>
                            </div>

                            <div class="form-row col-12">

                                <!-- Kategori Jenis Lantikan Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-4 font-weight-bold">
                                    <label for="adn_status">
                                        Jenis Lantikan ADN</label>
                                </div>

                                <!--Jenis Lantikan (ADN)-->
                                <div class="form-group col-md-8 font-weight-bold">
                                    @if(!empty($pentadbiran->kodjenislantikansenator->jenis_lantikan))
                                    <input disabled type="text" name="jenis_lantikan" class="form-control" id="jenis_lantikan" value="{{ $pentadbiran->kodjenislantikansenator->jenis_lantikan }} ({{ $pentadbiran->kodjenislantikansenator->jenis_lantikan }})">
                                    @else
                                    <input disabled type="text" name="jenis_lantikan" class="form-control" id="jenis_lantikan" value="">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Lantikan Pertama Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-4 font-weight-bold">
                                    Lantikan Pertama
                                </div>

                                <!--Tarikh Mula Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <input disabled type="text" id="adn1_tarikh_mula" name="adn1_tarikh_mula" class="form-control" value="{{ $pentadbiran->adn1_tarikh_mula }}">
                                </div>

                                <!--Tarikh Mula Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-1 font-weight-bold">
                                    hingga
                                </div>

                                <!--Tarikh Tamat Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <input disabled type="text" id="adn1_tarikh_tamat" name="adn1_tarikh_tamat" class="form-control" value="{{ $pentadbiran->adn1_tarikh_tamat }}">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!--Lantikan Kedua Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-4 font-weight-bold">
                                    Lantikan Kedua
                                </div>

                                <!--Tarikh Mula Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <input disabled type="text" id="adn2_tarikh_mula" name="adn2_tarikh_mula" class="form-control" value="{{ $pentadbiran->adn2_tarikh_mula }}">
                                </div>

                                <!--Tarikh Mula Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-1 font-weight-bold">
                                    hingga
                                </div>

                                <!--Tarikh Tamat Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-3 font-weight-bold">
                                    <input disabled type="text" id="adn2_tarikh_tamat" name="adn2_tarikh_tamat" class="form-control" value="{{ $pentadbiran->adn2_tarikh_tamat }}">
                                </div>
                            </div>

                            <!-- -------------------- MAKLUMAT PELANTIKAN JAWATAN --------------------- --->

                            <div class="form-row col-12">
                                <!--Maklumat Pelantikan-->
                                <div class="form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                    Maklumat Pelantikan Jawatan
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!-- Jawatan -->
                                <div class="form-group col-md-4 font-weight-bold">
                                    <label for="kod_jawatan">Jawatan</label>
                                    @if(!empty($pentadbiran->kodjawatan->jawatan))
                                    <input disabled type="text" name="kod_jawatan" class="form-control" id="kod_jawatan" value="{{ $pentadbiran->kodjawatan->jawatan }}">
                                    @else
                                    <input disabled type="text" name="kod_jawatan" class="form-control" id="kod_jawatan" value="">
                                    @endif
                                </div>

                                <!-- Jawatan Penuh -->
                                <div class="form-group col-md-6 font-weight-bold">
                                    <label for="jawatan_penuh">Jawatan Penuh</label>
                                    <input disabled type="text" name="jawatan_penuh" class="form-control" id="jawatan_penuh" value="{{ $pentadbiran->jawatan_penuh }}">
                                </div>

                                <!-- Jawatan Kekananan -->
                                <div class="form-group col-md-2 font-weight-bold">
                                    <label for="jawatan_kekananan">Kekananan</label>
                                    <input disabled type="text" name="jawatan_kekananan" class="form-control" id="jawatan_kekananan" value="{{ $pentadbiran->jawatan_kekananan }}">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <!-- Kementerian 1 -->
                                <div class="form-group col-md-12 font-weight-bold">
                                    <label for="kod_kementerian">Kementerian 1</label>
                                    @if(!empty($pentadbiran->kodkementerian->kementerian))
                                    <input disabled type="text" name="kod_kementerian" class="form-control" id="kod_kementerian" value="{{ $pentadbiran->kodkementerian->kementerian }} ({{ $pentadbiran->kodkementerian->kementerian_singkatan }})">
                                    @else
                                    <input disabled type="text" name="kod_kementerian" class="form-control" id="kod_kementerian" value="">
                                    @endif
                                </div>

                                <div class="form-row col-md-12">
                                    <!-- Kementerian 2 -->
                                    <div class="form-group col-md-12 font-weight-bold">
                                        <label for="kod_kementerian2">Kementerian 2 (Sekiranya ada)</label>
                                        @if(!empty($pentadbiran->kodkementerian2->kementerian))
                                        <input disabled type="text" name="kod_kementerian2" class="form-control" id="kod_kementerian2" value="{{ $pentadbiran->kodkementerian2->kementerian }} ({{ $pentadbiran->kodkementerian2->kementerian_singkatan }})">
                                        @else
                                        <input disabled type="text" name="kod_kementerian2" class="form-control" id="kod_kementerian2" value="">
                                        @endif
                                    </div>
                                </div>


                                <div class="form-row col-md-12">
                                    <!-- Tarikh Lantikan -->
                                    <div class="form-group col-md-3 font-weight-bold">
                                        <label for="tarikh_lantikan">Tarikh Lantikan</label>
                                        @if(!empty($pentadbiran->tarikh_lantikan))
                                        <input disabled type="text" id="tarikh_lantikan" name="tarikh_lantikan" class="form-control" value="{{ date('d/m/Y', strtotime($pentadbiran->tarikh_lantikan))  }}">
                                        @else
                                        <input disabled type="text" id="tarikh_lantikan" name="tarikh_lantikan" class="form-control" value="">
                                        @endif
                                    </div>
                                </div>

                                <!-- -------------------- LAIN-LAIN CATATAN --------------------- --->

                                <div class="form-row col-md-12"">
                                <!--Maklumat Pelantikan-->
                                <div class=" form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                    Lain-Lain Catatan
                                </div>
                            </div>

                            <div class="form-row col-md-12"">
                                <!-- Tarikh Lantikan -->
                                <div class=" form-group col-md-12 font-weight-bold">
                                <textarea disabled class="form-control" rows="10" name="catatan">{{ $pentadbiran->catatan }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.js') }}"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('select[name="kod_parti"]').on('change', function() {
            var kod_parti = jQuery(this).val();
            if (kod_parti) {
                jQuery.ajax({
                    url: '/butiranperibadi/partikomponen/' + kod_parti,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="kod_parti_komponen"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="kod_parti_komponen"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                    error: function(jqxhr, status, exception) {
                        alert('Exception:', exception);
                    }
                });
            } else {
                $('select[name="kod_parti"]').empty();
            }
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $("#adr_status").click(function() {
            if ($(this).is(":checked")) {
                $("#kod_parlimen").removeAttr("disabled");
                $("#kod_parlimen").focus();
            } else {
                $("#kod_parlimen").attr("disabled", "disabled");
            }
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $("#dun_status").click(function() {
            if ($(this).is(":checked")) {
                $("#kod_dun").removeAttr("disabled");
                $("#kod_dun").focus();
            } else {
                $("#kod_dun").attr("disabled", "disabled");
            }
        });
    });
</script>



@endsection