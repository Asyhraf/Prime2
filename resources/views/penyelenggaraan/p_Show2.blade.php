@extends('layouts.customtheme')

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <div class="col-md-9">                      
                            Anggota Pentadbiran
                            <i class="menu-icon fa fa-angle-right"></i>
                            <strong class="card-title">                        
                            Paparan Maklumat Arkib Data
                            </strong>    
                        </div>

                        <div class="col-md-3 float-right">                      
                            <a href="{{ route('p_carianAhliMesyuarat') }}" class="btn btn-primary">Anggota Pentadbiran</a>
                        </div>
                    </div>

                    <div class="card-body card-block">
                        <!--show validation error message here -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>                    
                        </div>
                        @endif

                        <div class="col-md-12">
                        
                        
                        <script src="{{ asset('/resources/dropzone/dist/dropzone.js') }}"></script>
                        @forelse($ahli_mesyuarat as $counter => $ahli)

                        <!-- -------------------------- NAMA & GAMBAR----------------------- --->                            
                        <div class="form-row">
                                <!--Nama Pernuh Beserta Gelaran-->
                                <div class="form-group col-md-10 font-weight-bold">
                                <h2>{{ $ahli_mesyuarat->nama_ahli }}</h2>
                                {{ $ahli->Jawatan->nama_jawatan }}<br>
                                @if($ahli->adr_status==1)
                                    @forelse($kodparlimens as $counter3 => $kodparlimen)
                                        @if($butiranperibadi->kod_parlimen==$kodparlimen->id)
                                        <span class="badge badge-primary">ADR [{{ $kodparlimen->parlimen }}]</span>
                                        @endif
                                    @empty
                                    @endforelse
                                @endif
                        @endforelse
                                @if($butiranperibadi->adn_status==1)
                                    <span class="badge badge-success">ADN [Senator]</span>
                                @endif                              
                                </div> 

                                <!--Gambar -->
                                <div class="form-group col-md-2 font-weight-bold">
                                @if($butiranperibadi->gambar =="")  
                                <img class="img-thumbnail" id="gambar_preview" width="100" height="150" src='{{ asset("/images/tiadagambar.png?timestamp=$custom_timestamp") }}'>       
                                @else  
                                <img class="img-thumbnail" id="gambar_preview" width="100" height="150" src='{{ asset("/images/$butiranperibadi->gambar?timestamp=$custom_timestamp") }}'>  
                                @endif
                                                                                                                                        
                                </div> 
                            </div>  

                            <!-- -------------------------- MAKLUMAT ASAS ----------------------- --->

                            <div class="form-row">
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

                            <div class="form-row">
                                <!--Nama Surat Menyurat-->
                                <div class="form-group col-md-6 font-weight-bold">
                                <label for="nama">Nama Surat Menyurat</label>
                                <input disabled type="text" name="nama" class="form-control" id="nama" value="{{ $butiranperibadi->nama }}">
                                </div>

                                <!--Nama Surat Menyurat-->
                                <div class="form-group col-md-6 font-weight-bold">
                                <label for="nama_kad_pengenalan">Nama Dalam Kad Pengenalan</label>
                                <input disabled type="text" name="nama_kad_pengenalan" class="form-control" id="nama_kad_pengenalan" value="{{ $butiranperibadi->nama_kad_pengenalan }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <!--Nombor Kad Pengenalan-->
                                <div class="form-group col-md-3 font-weight-bold">
                                <label for="nombor_kad_pengenalan">No. Kad Pengenalan</label>                                
                                <input disabled type="text" name="nombor_kad_pengenalan" class="form-control" id="nombor_kad_pengenalan" maxlength="12" value="{{ $butiranperibadi->nombor_kad_pengenalan }}">
                                </div>                               

                                <!--Agama-->
                                <div class="form-group col-md-3 font-weight-bold">
                                <label for="kod_agama">Agama</label><br>
                                @forelse($kodagamas as $counter3 => $kodagama)
                                <input disabled type="text" name="kod_agama" class="form-control" id="kod_agama"  value="{{ $kodagama->agama }}">
                                @empty
                                <input disabled type="text" name="kod_agama" class="form-control" id="kod_agama"  value="">
                                @endforelse
                                </div>

                                <!--Jantina-->
                                <div class="form-group col-md-3 font-weight-bold">
                                <label for="kod_jantina">Jantina</label>
                                @forelse($kodjantinas as $counter4 => $kodjantina)
                                <input disabled type="text" name="kod_jantina" class="form-control" id="kod_agama"  value="{{ $kodjantina->jantina }}">
                                @empty
                                <input disabled type="text" name="kod_jantina" class="form-control" id="kod_agama"  value="">
                                @endforelse  
                                </div>

                                <!--Status Perkahwinan-->
                                <div class="form-group col-md-3 font-weight-bold">
                                <label for="kod_status_perkahwinan">Status Perkahwinan</label>                                
                                @forelse($kodstatusperkahwinans as $counter5 => $kodstatusperkahwinan)
                                <input disabled type="text" name="kod_status_perkahwinan" class="form-control" id="kod_agama"  value="{{ $kodstatusperkahwinan->status_perkahwinan }}">
                                @empty
                                <input disabled type="text" name="kod_status_perkahwinan" class="form-control" id="kod_agama"  value="">
                                @endforelse                                    
                                </select>
                                </div>       
                            </div>

                            <div class="form-row">
                                <!--Nama Pasangan-->
                                <div class="form-group col-md-12 font-weight-bold">
                                <label for="nama_pasangan">Nama Penuh Pasangan Beserta Gelaran (Sekiranya ada)</label>
                                <input disabled type="text" name="nama_pasangan" class="form-control" id="nama_pasangan" value="{{ $butiranperibadi->nama_pasangan }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Bintang -->
                                <div class="form-group col-md-12 font-weight-bold">
                                <label for="bintang">Bintang</label>
                                <input disabled type="text" name="bintang" class="form-control" id="bintang" value="{{ $butiranperibadi->bintang }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <!--Bintang Luar-->
                                <div class="form-group col-md-12 font-weight-bold">
                                <label for="bintang_luar">Bintang (Penganugerahan Luar Negara)</label>
                                <input disabled type="text" name="bintang_luar" class="form-control" id="bintang_luar" value="{{ $butiranperibadi->bintang_luar }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <!--Kod Kelulusan Akademik-->
                                <div class="form-group col-md-5 font-weight-bold">
                                <label for="kod_kelulusan_akademik">Kelulusan Akademik</label>                                
                                @forelse($kodkelulusanakademiks as $counter6 => $kodkelulusanakademik)
                                <input disabled type="text" name="kod_kelulusan_akademik" class="form-control" id="kod_kelulusan_akademik"  value="{{ $kodkelulusanakademik->kelulusan_akademik }}">
                                @empty
                                <input disabled type="text" name="kod_kelulusan_akademik" class="form-control" id="kod_kelulusan_akademik"  value="">
                                @endforelse  
                                </div>   

                                <!--Butiran Kelulusan Akademik-->
                                <div class="form-group col-md-7 font-weight-bold">
                                <label for="butiran_kelulusan_akademik">Butiran Kelulusan Akademik</label>                                
                                <input disabled type="text" name="butiran_kelulusan_akademik" class="form-control" id="butiran_kelulusan_akademik" value="{{ $butiranperibadi->butiran_kelulusan_akademik }}">
                                </div>  
                            </div>

                            <!-- -------------------------- MAKLUMAT PERHUBUNGAN ----------------------- --->

                            <div class="form-row">
                                <!--Nama Pernuh Beserta Gelaran-->
                                <div class="form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                Maklumat Perhubungan                                                                                                
                                </div> 
                            </div>  

                            <div class="form-row">
                            <!--Alamat 1-->
                                <div class="form-group col-md-12 font-weight-bold">
                                <label for="alamat_1">Alamat Rumah</label>                                
                                <input disabled type="text" name="alamat_1" class="form-control" id="alamat_1" value="{{ $butiranperibadi->alamat_1 }}">
                                </div>  
                            </div>

                            <div class="form-row">
                                <!--Alamat 2-->
                                <div class="form-group col-md-12 font-weight-bold">                                                                
                                <input disabled type="text" name="alamat_2" class="form-control" id="alamat_2" value="{{ $butiranperibadi->alamat_2 }}">
                                </div>  
                            </div>

                            <div class="form-row">
                                <!--Poskod-->
                                <div class="form-group col-md-2 font-weight-bold">
                                <label for="alamat_poskod">Poskod</label>                                
                                <input disabled type="text" name="alamat_poskod" maxlength="6" class="form-control" id="alamat_poskod" value="{{ $butiranperibadi->alamat_poskod }}">
                                </div> 

                                <!--Bandar-->
                                <div class="form-group col-md-6 font-weight-bold">
                                <label for="alamat_bandar">Bandar</label>                                
                                <input disabled type="text" name="alamat_bandar" class="form-control" id="alamat_bandar" value="{{ $butiranperibadi->alamat_bandar }}">
                                </div> 

                                <!--Kod Negeri-->
                                <div class="form-group col-md-4 font-weight-bold">
                                <label for="kod_negeri_alamat">Negeri</label>                                
                                @forelse($kodnegeris as $counter9 => $kodnegeri)
                                <input disabled type="text" name="kod_negeri_alamat" class="form-control" id="kod_negeri_alamat"  value="{{ $kodnegeri->nama_negeri }}">
                                @empty
                                <input disabled type="text" name="kod_negeri_alamat" class="form-control" id="kod_negeri_alamat"  value="">
                                @endforelse 
                                </div>                                  
                            </div>

                            <div class="form-row">
                                <!--Telefon Rumah-->
                                <div class="form-group col-md-3 font-weight-bold">
                                <label for="telefon_rumah">Telefon Rumah</label>                                
                                <input disabled type="text" name="telefon_rumah" class="form-control" id="telefon_rumah" value="{{ $butiranperibadi->telefon_rumah }}">
                                </div>  

                                <!--Telefon Bimbit-->
                                <div class="form-group col-md-3 font-weight-bold">
                                <label for="telefon_bimbit">Telefon Bimbit</label>                                
                                <input disabled type="text" name="telefon_bimbit" class="form-control" id="telefon_bimbit" value="{{ $butiranperibadi->telefon_bimbit }}">
                                </div>  

                                <!--Telefon Pejabat-->
                                <div class="form-group col-md-3 font-weight-bold">
                                <label for="telefon_pejabat">Telefon Pejabat</label>                                
                                <input disabled type="text" name="telefon_pejabat" class="form-control" id="telefon_pejabat" value="{{ $butiranperibadi->telefon_pejabat }}">
                                </div>  

                                <!--Telefon Faks-->
                                <div class="form-group col-md-3 font-weight-bold">
                                <label for="telefon_faks">Faks</label>                                
                                <input disabled type="text" name="telefon_faks" class="form-control" id="telefon_faks" value="{{ $butiranperibadi->telefon_faks }}">
                                </div>  
                            </div>
							
							<div class="form-row">
                                <!--Telefon Pegawai -->
                                <div class="form-group col-md-6 font-weight-bold">
                                    <label for="telefon_pegawai">Telefon Pegawai Khas / SUSK </label>                                
                                    <input disabled type="text" name="telefon_pegawai" class="form-control" id="telefon_pegawai" value="{{ $butiranperibadi->telefon_pegawai }}">
                                    </div> 
                                </div>
								
								<!--Emel -->
                                <div class="form-group col-md-6 font-weight-bold">
                                    <label for="emel">E-mail </label>                                
                                    <input disabled type="text" name="emel" class="form-control" id="emel" value="{{ $butiranperibadi->emel }}">
                                    </div> 
                                </div>
                            </div>

                            <!-- -------------------- MAKLUMAT PARTI POLITIK --------------------- --->

                            <div class="form-row">
                                <!--Maklumat Parti Politik-->
                                <div class="form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                Maklumat Parti Politik                                                                                                   
                                </div> 
                            </div>

                            <div class="form-row">
                                <!-- Kod Parti -->
                                <div class="form-group col-md-7 font-weight-bold">
                                <label for="kod_parti">Parti</label>                                
                                @forelse($kodpartis as $counter7 => $kodparti)
                                <input disabled type="text" name="kod_parti" class="form-control" id="kod_parti" value="{{ $kodparti->parti }} ({{ $kodparti->parti_singkatan }})">
                                @empty
                                <input disabled type="text" name="kod_parti" class="form-control" id="kod_parti" value="">
                                @endforelse                                      
                                </div> 
                            
                                <!-- Kod Parti Komponen -->
                                <div class="form-group col-md-5 font-weight-bold">
                                <label for="kod_parti_komponen">Parti Komponen</label>                                
                                @forelse($kodpartikomponens as $counter8 => $kodpartikomponen)
                                <input disabled type="text" name="kod_parti_komponen" class="form-control" id="kod_parti_komponen" value="{{ $kodpartikomponen->parti_komponen }} ({{ $kodpartikomponen->parti_komponen_singkatan }})">
                                @empty
                                <input disabled type="text" name="kod_parti_komponen" class="form-control" id="kod_parti_komponen" value="">
                                @endforelse                                     
                                </div>  
                            </div>

                            <div class="form-row">
                                <!-- Jawatan Dalam Parti -->
                                <div class="form-group col-md-7 font-weight-bold">
                                <label for="kod_parti_jawatan">Jawatan Dalam Parti</label>                                
                                @forelse($kodpartijawatans as $counter7 => $kodpartijawatan)
                                <input disabled type="text" name="kod_parti_jawatan" class="form-control" id="kod_parti_jawatan" value="{{ $kodpartijawatan->jawatan }}">
                                @empty
                                <input disabled type="text" name="kod_parti_jawatan" class="form-control" id="kod_parti_jawatan" value="">
                                @endforelse                                    
                                </div> 

                                <!-- Kekananan Dalam Parti -->
                                <div class="form-group col-md-5 font-weight-bold">
                                <label for="kekananan_dalam_parti">Kekananan Dalam Parti</label>
                                <input disabled type="text" name="kekananan_dalam_parti" class="form-control" id="kekananan_dalam_parti" value="{{ $butiranperibadi->kekananan_dalam_parti }}">                                
                                </div> 
                                                             
                            </div>

                            <!-- -------------------- MAKLUMAT KATEGORI PELANTIKAN --------------------- --->

                            <div class="form-row">
                                <!--Maklumat Pelantikan-->
                                <div class="form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                Maklumat Kategori Pelantikan                                                                                                             
                                </div> 
                            </div>  

                            <div class="form-row">
                                <!--Status Ahli Dewan Rakyat (ADR)-->
                                <div class="form-group col-md-4 font-weight-bold">                                
                                <label for="adr_status">
                                Ahli Dewan Rakyat ?</label>                                
                                </div>  

                                <!--Status Ahli Dewan Rakyat (ADR)-->
                                <div class="form-group col-md-1 font-weight-bold">                        
                                <input disabled name="adr_status" class="form-group-input" type="checkbox" id="adr_status" value="1" {{ ($butiranperibadi->adr_status==1) ? "checked" : "" }}>
                                Ya
                                </div> 

                                <!--Kawasan Parlimen-->
                                <div class="form-group col-md-7 font-weight-bold">                        
                                @forelse($kodparlimens as $counter10 => $kodparlimen)
                                <input disabled type="text" name="kod_parlimen" class="form-control" id="kod_dun" value="{{ $kodparlimen->parlimen }}">
                                @empty
                                <input disabled type="text" name="kod_parlimen" class="form-control" id="kod_dun" value="">
                                @endforelse                                    
                                </div>                                                               
                            </div>

                            <hr></hr> 

                            <div class="form-row">
                                <!-- Ahli Dewan Undangan Negeri (ADUN)-->
                                <div class="form-group col-md-4 font-weight-bold">                                
                                <label for="adr_status">
                                Ahli Dewan Undangan Negeri ?</label>                                
                                </div>  

                                <!--Status Ahli Dewan Rakyat (ADUN)-->
                                <div class="form-group col-md-1 font-weight-bold">                        
                                <input disabled name="dun_status" class="form-group-input" type="checkbox" id="dun_status" value="1" {{ ($butiranperibadi->dun_status==1) ? "checked" : "" }}>
                                Ya
                                </div> 

                                <!--Kawasan Dewan Undangan Negeri-->
                                <div class="form-group col-md-7 font-weight-bold">                        
                                @forelse($kodduns as $counter11 => $koddun)
                                <input disabled type="text" name="kod_dun" class="form-control" id="kod_dun" value="{{ $koddun->dewan_undangan_negeri }}">
                                @empty
                                <input disabled type="text" name="kod_dun" class="form-control" id="kod_dun" value="">
                                @endforelse                                    
                                </div>                        
                            </div>  

                            <hr></hr> 

                            <div class="form-row">
                                <!-- Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-4 font-weight-bold">                                
                                <label for="adn_status">
                                Ahli Dewan Negara ?</label>                                
                                </div>  

                                <!--Status Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-8 font-weight-bold">                        
                                <input disabled name="adn_status" class="form-group-input" type="checkbox" id="adn_status" value="1" {{ ($butiranperibadi->adn_status==1) ? "checked" : "" }}>
                                Ya
                                </div> 
                            </div>

                            <div class="form-row">
                                <!--Lantikan Pertama Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-4 font-weight-bold">                        
                                Lantikan Pertama
                                </div>

                                <!--Tarikh Mula Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-3 font-weight-bold">                        
                                <input disabled type="text" id="adn1_tarikh_mula" name="adn1_tarikh_mula" class="form-control" value="{{ $butiranperibadi->adn1_tarikh_mula }}">                                
                                </div>

                                <!--Tarikh Mula Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-1 font-weight-bold">                        
                                hingga
                                </div>
                                
                                <!--Tarikh Tamat Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-3 font-weight-bold">                        
                                <input disabled type="text" id="adn1_tarikh_tamat" name="adn1_tarikh_tamat" class="form-control" value="{{ $butiranperibadi->adn1_tarikh_tamat }}">                                
                                </div> 
                            </div>

                            <div class="form-row">
                                <!--Lantikan Kedua Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-4 font-weight-bold">                        
                                Lantikan Kedua
                                </div>

                                <!--Tarikh Mula Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-3 font-weight-bold">                        
                                <input disabled type="text" id="adn2_tarikh_mula" name="adn2_tarikh_mula" class="form-control" value="{{ $butiranperibadi->adn2_tarikh_mula }}">                                
                                </div>

                                <!--Tarikh Mula Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-1 font-weight-bold">                        
                                hingga
                                </div>
                                
                                <!--Tarikh Tamat Ahli Dewan Negara (ADN)-->
                                <div class="form-group col-md-3 font-weight-bold">                        
                                <input disabled type="text" id="adn2_tarikh_tamat" name="adn2_tarikh_tamat" class="form-control" value="{{ $butiranperibadi->adn2_tarikh_tamat }}">                                
                                </div> 
                            </div>

                            <!-- -------------------- MAKLUMAT PELANTIKAN JAWATAN --------------------- --->

                            <div class="form-row">
                                <!--Maklumat Pelantikan-->
                                <div class="form-group col-md-12 font-weight-bold p-2 mb-2 bg-info text-white">
                                Maklumat Pelantikan Jawatan                                                                                                             
                                </div> 
                            </div>  

                            <div class="form-row">
                                <!-- Jawatan -->
                                <div class="form-group col-md-4 font-weight-bold">
                                <label for="kod_jawatan">Jawatan</label>                                
                                @forelse($kodjawatans as $counter13 => $kodjawatan)
                                <input disabled type="text" name="kod_jawatan" class="form-control" id="kod_jawatan" value="{{ $kodjawatan->jawatan }}">
                                @empty
                                <input disabled type="text" name="kod_jawatan" class="form-control" id="kod_jawatan" value="">
                                @endforelse                                    
                                </div>   

                                <!-- Jawatan Penuh -->
                                <div class="form-group col-md-6 font-weight-bold">
                                <label for="jawatan_penuh">Jawatan Penuh</label>                                
                                <input disabled type="text" name="jawatan_penuh" class="form-control" id="jawatan_penuh" value="{{ $butiranperibadi->jawatan_penuh }}">
                                </div>  

                                <!-- Jawatan Kekananan -->
                                <div class="form-group col-md-2 font-weight-bold">
                                <label for="jawatan_kekananan">Kekananan</label>                                
                                <input disabled type="text" name="jawatan_kekananan" class="form-control" id="jawatan_kekananan" value="{{ $butiranperibadi->jawatan_kekananan }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Kementerian 1 -->
                                <div class="form-group col-md-12 font-weight-bold">
                                <label for="kod_kementerian">Kementerian 1</label>                                
                                @forelse($kodkementerians as $counter14 => $kodkementerian)
                                <input disabled type="text" name="kod_kementerian" class="form-control" id="kod_kementerian" value="{{ $kodkementerian->kementerian }} ({{ $kodkementerian->kementerian_singkatan }})">
                                @empty
                                <input disabled type="text" name="kod_kementerian" class="form-control" id="kod_kementerian" value="">
                                @endforelse                                    
                                </div> 
                            </div>  

                            <div class="form-row">
                                <!-- Kementerian 2 -->
                                <div class="form-group col-md-12 font-weight-bold">
                                <label for="kod_kementerian2">Kementerian 2 (Sekiranya ada)</label> 
                                @forelse($kodkementerians2 as $counter15 => $kodkementerian2)                                   
                                <input disabled type="text" name="kod_kementerian2" class="form-control" id="kod_kementerian2" value="{{ $kodkementerian2->kementerian }} ({{ $kodkementerian2->kementerian_singkatan }})">
                                @empty
                                <input disabled type="text" name="kod_kementerian2" class="form-control" id="kod_kementerian2" value="">
                                @endforelse                                    
                                </div>   
                               
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">                        
                        <a href="{{ route('arkibbutiranperibadi_salindata',$butiranperibadi->id)}}" type="reset" class="btn btn-primary">
                        Salin Arkib Data Ke Sistem
                        </a>                                        
                    </div>
                    

                </div>                
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.js') }}"></script>

<script type="text/javascript">
jQuery(document).ready(function ()
{
        jQuery('select[name="kod_parti"]').on('change',function(){
        var kod_parti = jQuery(this).val();
        if(kod_parti)
        {                                                                              
            jQuery.ajax({
                url : '/butiranperibadi/partikomponen/' +kod_parti,
                type : "GET",
                dataType : "json",                                
                success:function(data)
                {                     
                    console.log(data);
                    jQuery('select[name="kod_parti_komponen"]').empty();
                    jQuery.each(data, function(key,value){                        
                    $('select[name="kod_parti_komponen"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                },
                error: function(jqxhr, status, exception) {
                    alert('Exception:', exception);
                }
            });
        }
        else
        {
            $('select[name="kod_parti"]').empty();
        }
        });
});
</script>

<script type="text/javascript">
    $(function () {
        $("#adr_status").click(function () {
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
    $(function () {
        $("#dun_status").click(function () {
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
