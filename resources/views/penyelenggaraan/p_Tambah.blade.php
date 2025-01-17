@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">  
  <div class="card">
    <div class="card-header">
      <div class="col-md-12 text-right">
        <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
          <i class="fa fa-backward"></i> Kembali
        </a>
      </div>
      <h3 class="text-center"><b>TAMBAH AHLI MESYUARAT</b></h3> 
    </div>            
              
    <form class="theme-form mega-form" method="POST">
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
            
              <!-- Jenis Mesyuarat  -->
              <div class="form-group row">
                <div class="col-2">
                  <label class="col-form-label"><b>JENIS MESYUARAT</b></label><br>
                </div>

                <div class="col-9">
                  <input type="checkbox" id="mesyuarat_ksukp" name="mesyuarat_ksukp" value="1">
                  <label for="mesyuarat_ksukp" style="margin-top: 0.5rem; margin-left: 1rem;">KSUKP</label><br>
                  <!-- <input style="width:9%;" type="checkbox" id="mesyuarat_jkppn" name="mesyuarat_jkppn" value="1">
                  <label for="mesyuarat_jkppn">JKPPN</label><br>
                  <input style="width:9%;" type="checkbox" id="mesyuarat_kjp" name="mesyuarat_kjp" value="1">
                  <label for="mesyuarat_kjp">KJP</label><br>
                  <input style="width:9%;" type="checkbox" id="mesyuarat_kebbp" name="mesyuarat_kebbp" value="1"> 
                  <label for="mesyuarat_kebbp">KEBBP</label><br> -->
                  <input type="checkbox" id="mesyuarat_mbkm" name="mesyuarat_mbkm" value="1">
                  <label for="mesyuarat_mbkm" style="margin-left: 1rem;">MBKM</label><br>
                </div>
              </div>

              <!-- Gelaran -->   
              <div class="form-group row">
                <div class="col-2">
                  <label class="col-form-label"><b>GELARAN</b></label>
                </div>

                <div class="col-2">
                  {{ csrf_field() }}
                  <select class="form-control text-uppercase" name="gelaran" id="gelaran" value="gelaran">
                  <option label="- SILA PILIH -"></option>                   
                    @foreach ($kod_gelaran as $gelaran)
                      <option class="text-uppercase" value="{{ $gelaran->gelaran }}">{{ $gelaran->gelaran }}</option>
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
                  <input class="form-control text-uppercase" type="text" name="nama_ahli" placeholder="NAMA PENUH" value="">
                </div>
              </div>

              <!-- Jawatan Ahli  -->
              <div class="form-group row">
                <div class="col-2">
                  <label class="col-form-label"><b>JAWATAN</b></label>
                </div>
                <div class="col-9">
                  {{ csrf_field() }} 
                  <select class="form-control text-uppercase" name="jawatan" id="jawatan" value="jawatan">
                    <option label="- SILA PILIH -"></option>                  
                    @foreach ($ref_jawatan as $ahli_mesyuarats)
                      <option class="text-uppercase" value="{{ $ahli_mesyuarats->id_jawatan }}">{{ $ahli_mesyuarats->nama_jawatan }} </option>
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
                  {{ csrf_field() }}
                  <select class="form-control text-uppercase" name="id_kementerian" id="id_kementerian" value="id_kementerian">
                    <option label="- SILA PILIH -"></option>                   
                    @foreach ($ref_kementerian as $ahli_mesyuarats)
                      <option value="{{ $ahli_mesyuarats->id_kementerian }}">{{ $ahli_mesyuarats->nama_kementerian }} ({{ $ahli_mesyuarats->singkatan_kementerian }})</option>
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
                  <textarea class="form-control text-uppercase" name="alamat" id="" rows="4" placeholder="ALAMAT PENUH"></textarea>
                </div>
              </div>

              <!-- Telefon Bimbit & Email  -->
              <div class="form-group row">
                <div class="col-2">
                  <label class="col-form-label"><b>NO TEL BIMBIT ( PERIBADI )</b></label>
                </div>
                <div class="col-2">
                  <input class="form-control" type="text" name="no_hp_peribadi" placeholder="NO TELEFON" value="">
                  <small class="text-muted"> Contoh: 0123456789</small>
                </div>
                <div class="col-auto">
                  <label class="col-form-label"><b>E-MEL</b></label>
                </div>
                <div class="col-5">
                  <input class="form-control" type="text" name="emel" placeholder="E-MEL AHLI MESYUARAT" value="">
                  <small class="text-muted"> Contoh: pengguna@kabinet.gov.my</small>
                </div>
              </div>

              <!-- Suami / Isteri  -->
              <div class="form-group row">
                <div class="col-2">
                  <label class="col-form-label"><b>NAMA ISTERI / SUAMI</b></label>
                </div>
                <div class="col-9">
                  <input class="form-control" type="text" name="isteri_suami" placeholder="NAMA PENUH" value="">
                </div>               
              </div>

              <!-- Status Ahli  -->
              <div class="form-group row">
                <div class="col-2">
                  <label class="col-form-label"><b>STATUS AHLI</b></label>
                </div>
                <div class="col-3">
                  {{ csrf_field() }}
                  <select class="form-control text-uppercase" name="id_status_ahli" id="id_status_ahli" value="id_status_ahli">
                    <option label="- SILA PILIH -"></option> 
                    @foreach ($ref_status_ahli as $ahli_mesyuarats)
                      <option class="text-uppercase" value="{{ $ahli_mesyuarats->id_status_ahli }}">{{ $ahli_mesyuarats->nama_status_ahli }}</option>
                    @endforeach
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
                  <div class="col-auto">
                    {{ csrf_field() }}
                    <select class="form-control text-uppercase" name="id_gred" id="id_gred" value="id_gred">
                      <option label="- SILA PILIH -"></option>              
                      @foreach ($kekananan_gred as $ahli_mesyuarats)
                        <option value="{{ $ahli_mesyuarats->id_gred }}" class="text-uppercase">{{ $ahli_mesyuarats->nama_gred }}</option>
                      @endforeach
                    </select>
                  </div>

                  <!-- Tarikh Gred Terkini  --> 
                  <div class="col-auto">                     
                    <label class="col-form-label"><b>TARIKH GRED</b></label>
                  </div>
                  <div class="col-auto">
                    <input class="form-control text-uppercase" type="date" name="tarikh_lantikan" placeholder="" value="">
                  </div>
                  
                  <!-- Kekananan  -->
                  <div class="col-auto">
                    <label class="col-form-label"><b>SUSUNAN KEKANANAN</b></label>
                  </div>
                  <div class="col-2">
                    <input class="form-control" type="text" name="kekananan_mesy_manual" placeholder="SUSUNAN KEKANANAN" value="">
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
                    <input class="form-control text-uppercase" type="date" name="tarikh_mula_kontrak1" placeholder="" value="">
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
                    <input class="form-control text-uppercase" type="date" name="tarikh_bersara" placeholder="" value="">
                  </div>

                  <!-- Gred Jawatan Semasa Bersara -->
                  <div class="col-auto">
                    <label class="col-form-label"><b>GRED JAWATAN SEMASA BERSARA</b></label>
                  </div>
                  <div class="col-2">
                    {{ csrf_field() }}
                    <select class="form-control" name="id_gred" id="id_gred" value="id_gred">
                      <option label="- SILA PILIH -"></option>                
                      @foreach ($kekananan_gred as $ahli_mesyuarats)
                        <option value="{{ $ahli_mesyuarats->id_gred }}" class="text-uppercase">{{ $ahli_mesyuarats->nama_gred }}</option>
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
                    <input class="form-control text-uppercase" type="date" name="tarikh_lantikan_semasa_bersara" placeholder="" value="">
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
          </div> <!-- END TAB LANTIKAN & PERSARAAN -->

          <!-- TAB PEGAWAI KHAS -->
          <div class="tab-pane fade" id="pills-pegawaikhas" role="tabpanel" aria-labelledby="pills-pegawaikhas-tab">
            <div class="card-body"> 
              <div class="form-group row">
                <div class="col-3 b-grey">
                  <h6><b>PEGAWAI KHAS</b></h6>
                  <hr class="mt-3 mb-3">

                  <!-- Nama -->
                  <div class="form-group row">
                    <div class="col-2">
                      <label class="col-form-label"><b>NAMA</b></label>
                    </div>
                      
                    <div class="col-10">
                      <input class="form-control text-uppercase nama1" id="nama1" type="text" name="pegkhas_nama" placeholder="NAMA PENUH" value="">
                    </div> 
                  </div>

                  <!-- Email -->
                  <div class="form-group row">
                    <div class="col-2">
                      <label class="col-form-label"><b>EMEL</b></label>
                    </div>
                    
                    <div class="col-10">                    
                      <input class="form-control email1" id="emel1" type="text" name="pegkhas_emel" placeholder="E-MEL" value="">
                      <small class="text-muted"> Contoh: pengguna@kabinet.gov.my</small>                    
                    </div>
                  </div>

                  <!-- Telefon Bimbit /  Pejabat -->
                  <div class="form-group row">
                    <div class="col-6">
                      <label class="col-form-label"><b>NO TEL (BIMBIT)</b></label>
                      <input class="form-control bimbit1" id="bimbit1" type="text" name="pegkhas_telbimbit" placeholder="NO TEL (BIMBIT)" value="">
                      <small class="text-muted"> Contoh: 0123456789</small>
                    </div>
                    
                    <div class="col-6"> 
                      <label class="col-form-label"><b>NO TEL (PEJABAT)</b></label>   
                      <input class="form-control telpej1" id="telpej1" type="text" name="pegkhas_telpejabat" placeholder="NO TEL (PEJABAT)" value="">
                      <small class="text-muted"> Contoh: 0312345678</small>
                    </div>
                  </div>
                  
                  <!-- Faks -->
                  <div class="form-group row">
                    <div class="col-2">
                      <label class="col-form-label"><b>FAKS</b></label>
                    </div>
                    
                    <div class="col-10">                    
                      <input class="form-control faks1" id="faks1" type="text" name="pegkhas_faks" placeholder="FAKS" value="">
                    </div>
                  </div>

                  <div class="col-12 p-0 text-right">
                    <button type="button" id="tambah1" name="tambah" value="tambah" class="btn btn-primary btn-sm rounded tambah1">
                      <i class="fa fa-plus"></i>&nbsp; Tambah
                    </button>
                  </div>
                </div>

                <div class="col-9">
                  <h6><b>SENARAI PEGAWAI KHAS</b></h6>
                  <hr class="mt-3 mb-3">

                  <div class="form-group">
                    <table id="tbl-pegkhas" class="table table-striped table-bordered">
                        <thead>
                            <tr style="background-color:#fa8072">
                              <th style="width: 3%; text-align: center;">Bil</th>
                              <th style="width: 25%; text-align: center;">Nama</th>
                              <th style="width: 25%; text-align: center;">E-Mel</th>
                              <th style="width: 15%; text-align: center;">No Tel (Bimbit)</th>
                              <th style="width: 15%; text-align: center;">No Tel (Pejabat)</th>
                              <th style="width: 10%; text-align: center;">No Faks</th>
                              <th style="width: 7%; text-align: center;">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody> 
                                                 
                          <tr>
                            <td class="text-center"></td>
                            <td class="text-uppercase"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="">
                              <button title="Padam Mesyuarat" class="btn btn-danger btn-sm rounded-circle" type="submit" value="">
                                <i class="fa fa-trash" data-feather="user-x" alt="Padam"></i>
                              </button>
                            </td>
                          </tr>  
                                             
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
                    <div class="col-6">
                      <label class="col-form-label"><b>NO TEL (BIMBIT)</b></label>
                      <input class="form-control supejbimbit" id="supejbimbit" type="text" name="supej_bimbit" placeholder="NO TEL (BIMBIT)" value="">
                      <small class="text-muted"> Contoh: 0131234567</small>
                    </div>
                    
                    <div class="col-6"> 
                      <label class="col-form-label"><b>NO TEL (PEJABAT)</b></label>   
                      <input class="form-control supejtelpej" id="supejtelpej" type="text" name="supej_telpejabat" placeholder="NO TEL (PEJABAT)" value="">
                      <small class="text-muted"> Contoh: 0312345678</small>
                    </div>
                  </div>
                  
                  <!-- Faks -->
                  <div class="form-group row">
                    <div class="col-2">
                      <label class="col-form-label"><b>FAKS</b></label>
                    </div>
                    
                    <div class="col-10">                    
                      <input class="form-control supejfaks" id="supejfaks" type="text" name="supej_faks" placeholder="FAKS" value="">
                    </div>
                  </div>

                  <div class="col-12 p-0 text-right">
                    <button type="button" id="tambah1" name="tambah" value="tambah" class="btn btn-primary btn-sm rounded tambah1">
                      <i class="fa fa-plus"></i>&nbsp; Tambah
                    </button>
                  </div>
                </div>

                <div class="col-9">
                  <h6><b>SENARAI SETIAUSAHA PEJABAT</b></h6>
                  <hr class="mt-3 mb-3">

                  <div class="form-group">
                    <table id="tbl-supej" class="table table-striped table-bordered">
                        <thead>
                            <tr style="background-color:#fa8072">
                              <th style="width: 3%; text-align: center;">Bil</th>
                              <th style="width: 25%; text-align: center;">Nama</th>
                              <th style="width: 25%; text-align: center;">E-Mel</th>
                              <th style="width: 15%; text-align: center;">No Tel (Bimbit)</th>
                              <th style="width: 15%; text-align: center;">No Tel (Pejabat)</th>
                              <th style="width: 10%; text-align: center;">No Faks</th>
                              <th style="width: 7%; text-align: center;">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>                                                  
                          <tr>
                            <td class="text-center"></td>
                            <td class="text-uppercase"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="">
                              <button title="Padam Mesyuarat" class="btn btn-danger btn-sm rounded-circle" type="submit" value="">
                                <i class="fa fa-trash" data-feather="user-x" alt="Padam"></i>
                              </button>
                            </td>
                          </tr>                     
                        </tbody>
                        
                    </table>
                  </div>

                </div>
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
                  
                  <div class="col-9">                    
                    <input class="form-control text-uppercase" type="text" name="pemandu_nama" placeholder="NAMA PENUH" value="">
                  </div>
                </div>

                <!-- No Telefon Bimbit -->
                <div class="form-group row">
                  <div class="col-2">
                    <label class="col-form-label"><b>NO TEL (BIMBIT)</b></label>
                  </div>
                  
                  <div class="col-3">                    
                    <input class="form-control" type="text" name="pemandu_telbimbit" placeholder="NO TEL (BIMBIT)" value="">
                    <small class="text-muted"> Contoh: 0131234567</small>
                  </div>
                </div>
                
                <!-- No Telefon Pejabat -->
                <div class="row">
                  <div class="col-2">
                    <label class="col-form-label"><b>NO TEL (PEJABAT)</b></label>
                  </div>
                  
                  <div class="col-3">                    
                    <input class="form-control" type="text" name="pemandu_telpej" placeholder="NO TEL (PEJABAT)" value="">
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
                    <input class="form-control text-uppercase" type="text" name="bodyguard_nama" placeholder="NAMA PENUH" value="">
                  </div>
                </div>

                <!-- No Telefon Bimbit -->
                <div class="form-group row">
                  <div class="col-2">
                    <label class="col-form-label"><b>NO TEL (BIMBIT)</b></label>
                  </div>
                  
                  <div class="col-3">                    
                    <input class="form-control" type="text" name="bodyguard_telbimbit" placeholder="NO TEL (BIMBIT)" value="">
                    <small class="text-muted"> Contoh: 0131234567</small>
                  </div>
                </div>
                
                <!-- No Telefon Pejabat -->
                <div class="row">
                  <div class="col-2">
                    <label class="col-form-label"><b>NO TEL (PEJABAT)</b></label>
                  </div>
                  
                  <div class="col-3">                    
                    <input class="form-control" type="text" name="bodyguard_telpej" placeholder="NO TEL (PEJABAT)" value="">
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
                  <input class="form-control text-uppercase" type="text" name="no_plat" placeholder="NO PLAT KENDERAAN" value=""> 
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
          </div> <!-- END TAB PEMANDU/ BODYGUARD/ KENDERAAN -->
          
        </div> <!-- end tab content -->
      </div> <!-- end card body -->
    
    </form>
  </div> <!-- end card -->
</div> 

</script>

@endsection