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
      <h3 class="text-center"><b>TAMBAH JAWATAN</b></h3>
    </div>

    <div class="card-body">

      <form class="theme-form mega-form" method="POST" action="{{ route('tambah-jawatan') }}" enctype="multipart/form-data">
        {{csrf_field()}}
        @if(session()->has('message'))
          <div class="alert alert-danger outline-2x">
            {{ @session()->get('message') }}
          </div>
        @endif
        @if (session('status'))
          <div class="alert alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            <b>{{ session('status') }}</b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>
        @endif

        <div class="form-group">
          <label class="col-form-label"><b>NAMA JAWATAN</b></label>
          <input class="form-control" type="text" name="nama_jawatan" placeholder="NAMA PENUH JAWATAN" value="">
        </div>

        <div class="col-md-12 text-center">
          <button type="submit" name="hantar" value="hantar" class="btn btn-primary btn-sm rounded">
            <i class="fa fa-send"></i> Hantar
          </button>

          <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
            <i class="fa fa-refresh"></i> Tetapan Semula
          </button><br>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
