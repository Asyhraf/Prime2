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
      <h3 class="text-center"><b>DAFTAR AHLI MESYUARAT</b></h3> 
    </div>            
              
    <form class="theme-form mega-form" method="POST" action="{{ route('DaftarAhli') }}" enctype="multipart/form-data">
    {{csrf_field()}}
        
    <div class="card-body">
          
      <!-- Gelaran -->   
      <div class="form-group row">
        <div class="col-2">
          <label class="col-form-label"><b>GELARAN</b></label>
        </div>

        <div class="col-2">            
          <select class="form-control text-uppercase" name="gelaran" id="gelaran">
          <option label="- SILA PILIH -"></option>                   
            @foreach ($kod_gelaran as $gelaran)
              <option class="text-uppercase" value="{{ $gelaran->id_gelaran }}">{{ $gelaran->gelaran }}</option>
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

      <div class="col-md-12 text-center">
        <button type="submit" name="hantar" value="hantar" class="btn btn-primary btn-sm rounded">
          <i class="fa fa-send"></i> Daftar
        </button>

        <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
          <i class="fa fa-refresh"></i> Tetapan Semula
        </button>
      </div>

    </div>
      
    </form>
  </div> <!-- end card --> 
</div> 

@endsection