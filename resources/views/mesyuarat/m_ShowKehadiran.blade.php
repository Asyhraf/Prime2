@extends('layouts.customtheme')

@section('content')


<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <br />
                <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>Senarai Kehadiran Ahli Mesyuarat</i></h1>
                <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>{{ $event->TajukMesyuarat->nama_tajuk }} ({{ $event->title }})</i></h1>
                <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>BILANGAN {{ $event->meeting_numbers }}/ {{ $event->year }} PADA {{ date('d/m/Y', strtotime($event->start)) }}</i></h1>
                <br />



                <!-- <head> -->
                <!-- <script>
                        function text(x)
                        {
                            if (x == 0) document.getElementById("mycode").style.display = "block";
                            else document.getElementById("mycode").style.display = "none";
                            return;
                        }
                    </script> -->


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
                        <div class="alert alert-sucess" role="alert">
                            {{ session ('status')}}
                        </div>
                        @endif

                        <strong>
                            <hr style="border-color:black; border-style:solid;">
                        </strong>

                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered" style="display:none">

                            <div class="row">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-body">

                                                <div class="form-group col-xl-1" align="center">
                                                    <label class="col-form-label"><strong>Bil</strong></< /label>
                                                </div>

                                                <div class="form-group col-xl-4" align="center">
                                                    <label class="col-form-label"><strong>Nama dan Jawatan</strong></label>
                                                </div>

                                                <div class="form-group col-xl-2" align="center">
                                                    <label class="col-form-label"><strong>Gred</strong></< /label>
                                                </div>

                                                <div class="form-group col-xl-5">
                                                    <label class="col-form-label"><strong>Kehadiran</strong></< /label>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @forelse($ahli_mesyuarat as $counter => $ahli)
                            <?php $counter++; ?>

                            <strong>
                                <hr style="border-color:black; border-style:solid;">
                            </strong>

                            <div class="row">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-body">

                                                <div class="form-group col-xl-1" align="center">
                                                    <label class="col-form-label">{{ $counter }}</label>
                                                </div>

                                                <div class="form-group col-xl-4" align="center">
                                                    <label class="col-form-label"><strong>{{$ahli->nama_ahli}} </strong><br> <span class="badge badge-warning">{{$ahli->Jawatan->nama_jawatan}}</span></label>
                                                </div>

                                                <div class="form-group col-xl-2" align="center">
                                                    <label class="col-form-label">{{ $ahli->Gred->nama_gred }}</label>
                                                </div>

                                                <script>
                                                    function text(x) {
                                                        if (x == 0) document.getElementById("mycode").style.display = "block";
                                                        else document.getElementById("mycode").style.display = "none";
                                                        return;
                                                    }
                                                </script>

                                                <div class="form-group col-xl-5">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="html">HADIR</label>
                                                        <input style="width:9%;" type="radio" id="yes" name="kehadiran" value="Y" onclick="text(1)">

                                                        <label class="col-form-label" for="css">TIDAK HADIR</label>
                                                        <input style="width:9%;" type="radio" id="no" name="kehadiran" value="N" onclick="text(0)" checked>
                                                    </div>

                                                    <div id="mycode">
                                                        Catatan (Jika Tidak Hadir):
                                                        <textarea class="form-control" name="catatan" id="" cols="5" rows="5" placeholder=""></textarea><br>
                                                        Wakil
                                                        <select class="form-control" name="wakil_oleh" id="wakil_oleh" value="wakil_oleh">
                                                            <option label="PERWAKILAN"></option>
                                                    </div>
                                                </div>

                                                <div><strong>
                                                        <hr style="border-color:black; border-style:solid;">
                                                    </strong>
                                                    <div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <tr>
                                        @empty
                                    <tr>
                                        <td colspan="3">Tiada Rekod </td>
                                    </tr>
                                    @endforelse
                                    </tr>


                        </table><br>
                        <strong>
                            <hr style="border-color:black; border-style:solid;">
                        </strong>
                        <button class="btn btn-primary" type="submit" name="hantar" class="button" value="hantar">Hantar</button>
                        <button class="btn btn-secondary" type="reset" name="reset" class="button" value="reset">Tetapan Semula</button><br>

                </div>
            </div>
        </div>
    </div>
    <!-- </head> -->


    @endsection