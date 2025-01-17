@extends('layouts.customtheme')

@section('content')


<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <br/>
                    <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>Senarai Kehadiran Ahli Mesyuarat</i></h1>
                    <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>{{ $event->TajukMesyuarat->nama_tajuk }} ({{ $event->title }})</i></h1>
                    <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>BILANGAN {{ $event->meeting_numbers }}/ {{ $event->year }} PADA {{ date('d/m/Y', strtotime($event->start)) }}</i></h1>
                <br/>
                <!-- <div class="card">
                    <div class="card-body">  
                    </div> 
                </div> -->

                <div class="card">
                    <div class="card-body">

                        <body>
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
                                <b>{{ session ('status')}}</b>
                            </div>
                            @endif
                    
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr style= "background-color:#212F3D">
                                        <th width="1%" style="text-align: center"><font color="#FFFFFF">Bil.</font></th>
                                        <th width="5%" style="text-align: center"><strong><font color="#FFFFFF">Jawatan Dan Nama</font></strong></th>
                                        <th width="2%" style="text-align: center"><b><strong><font color="#FFFFFF">Gred</font></strong></b></th>
                                        <th width="10%" style="text-align: center"><b><strong><font color="#FFFFFF">Kehadiran</font></strong></b></th>
                                        
                                </tr>
                                </thead>

                                @forelse($ahli_mesyuarat as $counter => $ahli)
                                <?php $counter++; ?>
                                
                                <form class="theme-form mega-form" method="POST">
                                {{csrf_field()}}
                                <tr>
                                        <td>{{ $counter }}</td>
                                        <td align="center"><strong>({{$ahli->nama_ahli}})</strong><br>{{$ahli->Jawatan->nama_jawatan}}</td>
                                        <td align="center">{{$ahli->Gred->nama_gred}} <br> {{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }}</td>
                
                                        <td><strong>
                                            <div class="form-group">
                                                <label class="col-form-label" for="hadir">HADIR</label>
                                                <input style="width:9%;" type="radio" id="yes" name="kehadiran[{{$counter}}]" value="Y" checked>
                                                
                                                <label class="col-form-label" for="tidakHadir">TIDAK HADIR</label>
                                                <input style="width:9%;" type="radio" id="no" name="kehadiran[{{$counter}}]" value="N"> 
                                            </div>
                                            <div id="mycode">
                                                Catatan (Jika Tidak Hadir):
                                                <textarea class="form-control" name="catatan[{{$counter}}]" id="" cols="5" rows="5" placeholder=""></textarea><br>
                                                Wakil
                                                <select class="form-control" name="wakil_oleh" id="wakil_oleh" value="wakil_oleh">
                                                <option label="PERWAKILAN"></option>
                                            </div>
                                        </strong></td>  
                                </tr>
                                    
                                    @empty
                                    <tr>
                                        <td colspan="3">Tiada Rekod </td>
                                    </tr>
                                    @endforelse
                                    
                                    <th colspan="6"><button class="btn btn-primary" type="submit" name="hantar" class="button" value="hantar">Hantar</button> 
                                    <button class="btn btn-secondary" type="reset" name="reset" class="button" value="reset">Tetapan Semula</button><br></th>
                            </table>
                </body>
            </div>
        </div>
    </div>
</div>


@endsection

