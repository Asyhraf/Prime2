@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
  <div class="card">
    <div class="card-header">
      <h3 class="text-center"><b>BORANG JADUAL</b></h3>
    </div>

    <div class="card-body">
      <form class="form" action="{{ route('p_CetakanKawalanDokumen')}}">

        <label class="col-form-label"><b>JENIS MESYUARAT</b></label><br>
        <div class="form-group">

          <input style="width:3%;" type="radio" id="mesyuarat_ksukp" name="title" value="KSUKP">
          <label for="ksukp">KSUKP</label><br>

          <input style="width:3%;" type="radio" id="mesyuarat_mbkm" name="title" value="MBKM">
          <label for="mbkm">MBKM</label><br>
        </div>

        <label class="col-form-label"><b>BILANGAN MESYUARAT</b></label><br>
        <div class="form-group">
          <input class="form-control" name="bil" id="bil" cols="5" rows="5" value=""></input>
        </div>

        <label class="col-form-label"><b>TARIKH MESYUARAT</b></label><br>
        <div class="form-group">
          <input class="form-control" id="" name="tarikhSurat" type="date" cols="5" rows="5" value=""></inpput>
        </div>

        <label class="col-form-label"><b>BILANGAN RUJUKAN</b></label><br>
        <div class="form-group">
          <input class="form-control" name="bilRujukan" id="" cols="5" rows="5" value=""></input>
        </div>

        <label class="col-form-label"><b>PERKARA</b></label><br>
        <div class="form-group">
          <select class="custom-select" name="perkara" id="" style="min-height:35px;">
            <optgroup label="Perkara:">
              <option value="Edaran Folder Mesyuarat">Edaran Folder Mesyuarat</option>
              <option value="Edaran Minit Mesyuarat">Edaran Minit Mesyuarat</option>
          </select>
        </div>
        <br>
        <div class="form-group mb-0">
          <button class="btn btn-primary btn-sm rounded" name="papar" value="papar" type="submit" text-align="left" title="Cetak Kawalan Dokumen">
            <i class="fa fa-print"></i> Cetak Kawalan Dokumen
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection