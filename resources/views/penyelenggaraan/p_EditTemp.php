@extends('layouts.customtheme')

@section('content')

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <br />
        <h1 class="p-3 mb-2 bg-dark text-center text-white">{{ $ahli_mesyuarat->nama_ahli }}</h1>
        <br />

        <div class="container-fluid">
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
            <div class="alert alert-sucess">
              {{ session ('status')}}
            </div>
            @endif

            <div class="row">
              <div class="col-sm-12 col-xl-6">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-body">

                        <h5>PENGURUSAN AHLI MESYUARAT</h5>
                        <hr class="mt-4 mb-4">

                        <!-- Jenis Mesyuarat -->
                        <div class="form-group">
                          <label class="col-form-label">JENIS MESYUARAT</label><br><br>

                          <input style="width:9%;" type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                          <label for="vehicle1">KSUPK</label><br>

                          <input style="width:9%;" type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                          <label for="vehicle1">JKPPN</label><br>

                          <input style="width:9%;" type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                          <label for="vehicle1">KJP</label><br>

                          <input style="width:9%;" type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                          <label for="vehicle1">KEBPP</label><br>

                          <input style="width:9%;" type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                          <label for="vehicle1">MBKM</label><br>
                        </div><br>

                        <!-- Nama Ahli  -->
                        <div class="form-group">
                          <label class="col-form-label">NAMA AHLI</label>
                          <input class="form-control" type="text" name="nama_ahli" placeholder="" value="{{ $ahli_mesyuarat->nama_ahli }}" maxlength="70" size="70">
                        </div>

                        <!-- Jawatan Ahli  -->
                        <div class="form-group">
                          <label class="col-form-label">JAWATAN</label>
                          {{ csrf_field() }}
                          <?php $options = $ahli_mesyuarat->ahli_mesyuarat ?>
                          <select class="form-control" name="jawatan" id="jawatan" value="jawatan">
                            <optgroup label="Pilih Jawatan">
                              <option selected><b>{{ $ahli_mesyuarat->Jawatan->nama_jawatan }}</option>
                            <optgroup label="____________________________________________________________________">
                              @foreach ($ref_jawatan as $ahli_mesyuarats)
                              <option value="{{ $ahli_mesyuarats->jawatan }}">{{ $ahli_mesyuarats->nama_jawatan }} </option>
                              @endforeach
                          </select>


                          <!-- <select class="form-control" name="jawatan">
                                  <optgroup label="Pilih Jawatan">
                                  @foreach ($ref_jawatan as $ahli_mesyuarats)
                                    <option value="{{ $ahli_mesyuarats->jawatan }}" {{ ( $ahli_mesyuarat->ahli2 == $options) ? 'selected' : '' }}> {{ $ahli_mesyuarat->Jawatan->nama_jawatan }}</option>
                                  @endforeach
                                  </select> -->

                          <!-- <input class="form-control" type="text" id="jawatan" name="jawatan" placeholder="" value="{{ $ahli_mesyuarat->Jawatan->nama_jawatan }}"> -->
                        </div>

                        <!-- Kementerian Ahli  -->
                        <div class="form-group">
                          <label class="col-form-label">KEMENTERIAN</label>
                          <input class="form-control" type="text" name="id_kementerian" placeholder="" value="{{ $ahli_mesyuarat->Kementerian->nama_kementerian }} ({{ $ahli_mesyuarat->Kementerian->singkatan_kementerian }})">
                        </div>

                        <!-- Alamat  -->
                        <div class="form-group">
                          <label class="col-form-label">ALAMAT</label><br>
                          <textarea class="form-control" name="alamat" id="" cols="5" rows="5">{{ $ahli_mesyuarat->alamat }}</textarea>
                        </div>

                        <!-- Telefon Bimbit  -->
                        <div class="form-group">
                          <label class="col-form-label">NO TELEFON BIMBIT (PERIBADI)</label>
                          <input class="form-control" type="text" name="no_hp_peribadi" placeholder="" value="{{ $ahli_mesyuarat->no_hp_peribadi }}">
                        </div>

                        <!-- Email  -->
                        <div class="form-group">
                          <label class="col-form-label">EMAIL</label>
                          <input class="form-control" type="text" name="emel" placeholder="" value="{{ $ahli_mesyuarat->emel }}">
                        </div>

                        <!-- Suami / Isteri  -->
                        <div class="form-group">
                          <label class="col-form-label">NAMA ISTERI/SUAMI</label>
                          <input class="form-control" type="text" name="isteri_suami" placeholder="" value="{{ $ahli_mesyuarat->isteri_suami }}">
                        </div>

                        <!-- Status Ahli  -->
                        <div class="form-group">
                          <label class="col-form-label">STATUS AHLI</label>
                          <input class="form-control" type="text" name="nama_status_ahli" placeholder="" value="{{ $ahli_mesyuarat->Status_Ahli->nama_status_ahli }}">
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body">
                        <!-- <hr class="mt-4 mb-4"> -->
                        <h5>GRED DAN TARIKH LANTIKAN</h5>
                        <hr class="mt-4 mb-4">

                        <!-- Gred  -->
                        <div class="form-group">
                          <label class="col-form-label">GRED</label>
                          <input class="form-control" type="text" name="id_gred" placeholder="" value="{{ $ahli_mesyuarat->Gred->nama_gred }}">
                        </div>

                        <!-- Tarikh Gred Terkini  -->
                        <div class="form-group">
                          <label class="col-form-label">TARIKH GRED TERKINI</label>
                          <!-- <input class="form-control" type="text" name="tarikh_lantikan" placeholder="" value="{{ date('d/m/Y', strtotime($ahli_mesyuarat->tarikh_lantikan)) }}"> -->
                          <input class="form-control" type="text" name="tarikh_lantikan" placeholder="" value="{{ $ahli_mesyuarat->tarikh_lantikan }}">
                        </div>

                        <!-- Lantikan Kontrak  -->
                        <div class="form-group">
                          <label class="col-form-label">LANTIKAN kONTRAK</label>
                          <input class="form-control" type="text" name="no_hp_peribadi" placeholder="" value="{{ $ahli_mesyuarat->no_hp_peribadi }}">
                        </div>

                        <!-- Kekananan  -->
                        <div class="form-group">
                          <label class="col-form-label">KEKANANAN MENGIKUT SUSUNAN URUSETIA MESYUARAT</label>
                          <input class="form-control" type="text" name="kekananan_mesy_manual" placeholder="" value="{{ $ahli_mesyuarat->kekananan_mesy_manual }}">
                        </div>
                      </div>
                    </div>


                    <div class="card">
                      <div class="card-body">
                        <h5>LANTIKAN KONTRAK </h5>
                        <hr class="mt-4 mb-4">

                        <!-- Tarikh Mula Kontrak  -->
                        <div class="form-group">
                          <label class="col-form-label">TARIKH MULA KONTRAK</label><br>
                          <u>Lantikan Pertama</u><br>
                          <!-- <input class="form-control" type="text" name="tarikh_mula_kontrak1" placeholder="" value="{{ date('d/m/Y', strtotime($ahli_mesyuarat->tarikh_mula_kontrak1)) }}"> -->
                          <input class="form-control" type="text" name="tarikh_mula_kontrak1" placeholder="" value="{{ $ahli_mesyuarat->tarikh_mula_kontrak1 }}">
                        </div>

                        <!-- Gred Lantikan  -->
                        <div class="form-group">
                          <label class="col-form-label">GRED LANTIKAN</label>
                          <input class="form-control" type="text" name="nama" placeholder="" value="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-xl-6">
                <div class="row">
                  <div class="col-sm-12">

                    <div class="card">
                      <div class="card-body">
                        <h5>PERSARAAN WAJIB </h5>
                        <hr class="mt-4 mb-4">

                        <!-- Tarikh Bersara Wajib  -->
                        <div class="form-group">
                          <label class="col-form-label">TARIKH BERSARA WAJIB</label>
                          <!-- <input class="form-control" type="text" name="tarikh_bersara" placeholder="" value="{{ date('d/m/Y', strtotime($ahli_mesyuarat->tarikh_bersara)) }}"> -->
                          <input class="form-control" type="text" name="tarikh_bersara" placeholder="" value="{{ $ahli_mesyuarat->tarikh_bersara }}">
                        </div>

                        <!-- Gred Jawata Semasa Bersara  -->
                        <div class="form-group">
                          <label class="col-form-label">GRED JAWATAN SEMASA BERSARA</label>
                          <input class="form-control" type="text" name="id_gred" placeholder="" value="{{ $ahli_mesyuarat->Gred->nama_gred }}">
                        </div>

                        <!-- Tarikh Lantikan Gred Jawatan  -->
                        <div class="form-group">
                          <label class="col-form-label">TARIKH LANTIKAN GRED JAWATAN SEMASA BERSARA</label>
                          <!-- <input class="form-control" type="text" name="tarikh_lantikan_semasa_bersara" placeholder="" value="{{ date('d/m/Y', strtotime($ahli_mesyuarat->tarikh_lantikan_semasa_bersara)) }}"> -->
                          <input class="form-control" type="text" name="tarikh_lantikan_semasa_bersara" placeholder="" value="{{ $ahli_mesyuarat->tarikh_lantikan_semasa_bersara }}">
                        </div>
                      </div>
                    </div>



                    <div class="card">
                      <div class="card-body">
                        <h5>PEGAWAI KHAS </h5>
                        <hr class="mt-4 mb-4">

                        <!-- Nama  -->
                        <div class="form-group">
                          <label class="col-form-label">NAMA</label><br>
                          <input class="form-control" type="text" name="pegkhas_nama" placeholder="" value="{{ $ahli_mesyuarat->pegkhas_nama }}">
                        </div>

                        <!-- Email  -->
                        <div class="form-group">
                          <label class="col-form-label">EMAIL</label>
                          <input class="form-control" type="text" name="pegkhas_emel" placeholder="" value="{{ $ahli_mesyuarat->pegkhas_emel }}">
                        </div>

                        <!-- Telefon Bimbit/ Telefon/ Faks  -->
                        <div class="form-group">
                          <label class="col-form-label">TELEFON BIMBIT/ TELEFON/ FAKS</label>
                          <input class="form-control" type="text" name="pegkhas_telefon" placeholder="" value="{{ $ahli_mesyuarat->pegkhas_telefon }}">
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body">
                        <h5>SETIAUSAHA PEJABAT </h5>
                        <hr class="mt-4 mb-4">

                        <!-- Nama  -->
                        <div class="form-group">
                          <label class="col-form-label">NAMA</label><br>
                          <input class="form-control" type="text" name="supej_nama" placeholder="" value="{{ $ahli_mesyuarat->supej_nama }}">
                        </div>

                        <!-- Email  -->
                        <div class="form-group">
                          <label class="col-form-label">EMAIL</label>
                          <input class="form-control" type="text" name="supej_emel" placeholder="" value="{{ $ahli_mesyuarat->supej_emel }}">
                        </div>

                        <!-- Telefon Bimbit/ Telefon/ Faks  -->
                        <div class="form-group">
                          <label class="col-form-label">TELEFON BIMBIT/ TELEFON/ FAKS</label>
                          <input class="form-control" type="text" name="supej_telefon" placeholder="" value="{{ $ahli_mesyuarat->supej_telefon }}">
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body">
                        <h5>PEMANDU/ BODYGUARD/ KENDERAAN </h5>
                        <hr class="mt-4 mb-4">

                        <!-- Nama  -->
                        <div class="form-group">
                          <label class="col-form-label">NAMA</label><br>
                          <input class="form-control" type="text" name="pemandu_nama" placeholder="" value="{{ $ahli_mesyuarat->pemandu_nama }}">
                        </div>

                        <!-- Telefon Bimbit/ Telefon  -->
                        <div class="form-group">
                          <label class="col-form-label">TELEFON BIMBIT/ TELEFON</label>
                          <input class="form-control" type="text" name="pemandu_telefon" placeholder="" value="{{ $ahli_mesyuarat->pemandu_telefon }}">
                        </div>

                        <!-- No Plat Kenderaan  -->
                        <div class="form-group">
                          <label class="col-form-label">NO PLAT KENDERAAN</label>
                          <input class="form-control" type="text" name="no_plat" placeholder="" value="{{ $ahli_mesyuarat->no_plat }}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button class="btn btn-primary" type="submit" name="hantar" class="button" value="hantar">Hantar</button>
            <button class="btn btn-secondary" type="reset" name="reset" class="button" value="reset">Tetapan Semula</button><br>

            <br><br>
            <table id="bootstrap-data-table-export" class="p-3 mb-2">
              Data terakhir dikemaskini oleh <b>{{ $ahli_mesyuarat->dikemaskini_oleh }}</b> pada <b>{{ date('d/m/Y', strtotime($ahli_mesyuarat->updated_at)) }}</b>.
            </table><br>

        </div>
      </div>
    </div>
  </div>
</div>


@endsection