@extends('layouts.rekod')
@section('title', 'e-PRIME 2.0')
@section('styles')
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg shadow-showcase text-center b-dark">
                <div class="card-header ">
                    <h3 class="vertical-center">
                        <img class="img-100" src="{{asset('assets/images/jata-negara.png')}}" alt=""><br> <br>
                        Aplikasi Pengurusan Pra-Mesyuarat<br>PRIME 2.0
                    </h3>
                </div>
                <div class="card-footer bg-success b-t-dark">
                    <h1 class="display-1"><span><i data-feather="check-circle" width="150" height="150"></i></span> </h1>
                    <h5><b>Terima Kasih,<br>Kehadiran Berjaya Disimpan</b></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
@section('scripts')
@endsection
