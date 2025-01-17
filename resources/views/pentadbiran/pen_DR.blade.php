@extends('layouts.customtheme')

@section('content')


@if($pentadbiran -> isEmpty())
    <p>Tiada Maklumat</p>
@else

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <br />
                    <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>Senarai Ahli Dewan Rakyat</i></h1>
                
                <br />

                <!-- <form action="{{ route("penyelenggaraanK", ["p_CetakanKementerian"]) }}">
                    <input class="btn btn-success" type="submit" value="Cetak Senarai Kementerian">
                </form><br> -->

               
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
                                    <th width="5%" style="text-align: center"><font color="#FFFFFF">Bil</font></th>
                                    <th width="10%" style="text-align: center"><font color="#FFFFFF">Gambar</font></th>
                                    <th width="65%" style="text-align: center"><font color="#FFFFFF">Nama</font></th>
                                    <th width="20%" style="text-align: center"><font color="#FFFFFF">Tindakan</font></th>
                                </tr>
                            </thead>
                            
                  
                                @forelse($pentadbiran as $counter => $pen)
                                <?php $counter++; ?>
                                <tr>
                                    <td align="center">{{ $counter }}</td>

                                    <td>
                                        @if($pen->gambar =="")  
                                        <img class="img-thumbnail" id="gambar_preview" width="80" height="120" src='{{ asset("/images/tiadagambar.jpg?timestamp=$custom_timestamp") }}'>       
                                        @else  
                                        <img class="img-thumbnail" id="gambar_preview" width="80" height="120" src='{{ asset("/images/$pen->gambar?timestamp=$custom_timestamp") }}'>
                                        @endif
                                    </td>

                                    <td>  
                                        <b>
                                        @if(!empty($pen->kodgelaran->gelaran))
                                        {{ $pen->kodgelaran->gelaran }}                    
                                        @endif

                                        {{ $pen->senator }} 
                                        
                                        @if(!empty($pen->kodgelarandarjah->gelaran_darjah))
                                            {{ $pen->kodgelarandarjah->gelaran_darjah }} 
                                        @endif
                                        
                                        {{ $pen->gelaran_professional }} 
                                        {{ $pen->nama }}
                                        </a>
                                        </b><br>

                                        @if($pen->jawatan_penuh!="")
                                            <span class="badge badge-warning">{{ $pen->jawatan_penuh }}</span><br>  
                                        @endif

                                        @if(!empty($pen->kodparlimen->parlimen))
                                            <span class="badge badge-primary">ADR [{{ $pen->kodparlimen->parlimen }}] [{{ $pen->kodparlimen->kodnegeri->nama_negeri }}]</span>
                                        @endif

                                        @if(!empty($pen->koddun->dewan_undangan_negeri))
                                            <span class="badge badge-success">DUN [{{ $pen->koddun->dewan_undangan_negeri }}] [{{ $pen->koddun->kodnegeri->nama_negeri }}]</span>
                                        @endif

                                        @if(!empty($pen->senator))
                                            <span class="badge badge-success">ADN [Senator] 
                                            @if(!empty($pen->kodjenislantikansenator->jenis_lantikan))
                                            {{ $pen->kodjenislantikansenator->jenis_lantikan }}
                                            </span>
                                                <!-- maklumat tarikh lantikan senator -->
                                                <?php 
                                                $tarikh_semasa = date('Y-m-d'); 
                                                if($tarikh_semasa > $pen->adn1_tarikh_tamat){ 
                                                    $status_adn1 = "Tamat Tempoh";
                                                }else{
                                                    $status_adn1 = "";    
                                                }

                                                if($tarikh_semasa > $pen->adn2_tarikh_tamat){ 
                                                    $status_adn2 = "Tamat Tempoh";
                                                }else{
                                                    $status_adn2 = "";    
                                                }
                                                
                                                ?>
                                                @if($pen->senator)                                                    
                                                    @if(!empty($pen->adn1_tarikh_mula) && !empty($pen->adn1_tarikh_tamat))
                                                    <br><span class="badge badge-info">Lantikan Pertama [{{ date('d.m.Y', strtotime($pen->adn1_tarikh_mula)) }} - {{ date('d.m.Y', strtotime($pen->adn1_tarikh_tamat)) }}]</span> 
                                                        @if(!empty($status_adn1))
                                                        <span class="badge badge-danger"><i class="fa fa-exclamation-triangle"></i> {{ $status_adn1 }}</span>
                                                        @endif
                                                    @endif
                                                    
                                                    @if(!empty($pen->adn2_tarikh_mula) && !empty($pen->adn2_tarikh_tamat))
                                                    <br><span class="badge badge-info">Lantikan Kedua [{{ date('d.m.Y', strtotime($pen->adn2_tarikh_mula)) }} - {{ date('d.m.Y', strtotime($pen->adn2_tarikh_tamat)) }}]</span>
                                                        @if(!empty($status_adn2))
                                                        <span class="badge badge-danger"><i class="fa fa-exclamation-triangle"></i> {{ $status_adn2 }}</span>
                                                        @endif
                                                    @endif

                                                @endif
                                                <!-- maklumat tarikh lantikan senator -->

                                            @endif

                                        @endif
                                        
                                        @if(!empty($pen->kodpartikomponen->parti_komponen_gambar)) 
                                        <?php $gambar_parti_komponen = $pen->kodpartikomponen->parti_komponen_gambar; ?>                                   
                                        <br><img class="img-thumbnail" id="gambar_preview" width="40" height="25" src='{{ asset("/images_parti/$gambar_parti_komponen") }}'>  
                                        @endif
                                
                                        @if(!empty($pen->kodpartikomponen->parti_komponen)) 
                                        <span class="badge badge-light">{{ $pen->kodpartikomponen->parti_komponen }} 
                                        ({{ $pen->kodpartikomponen->parti_komponen_singkatan }})</span>  
                                        @endif 

                                        </td>   
                                                               
                                    </td>

                                    <td align="center">
                                    <form action="{{ route('padam_AhliJemaahMenteri',$pen->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk menghapuskan jawatan {{$pen->nama_kad_pengenalan}} ini?');" style="display: inline-block;">
                                        @csrf 
                                        
                                        <!-- Papar Ahli -->
                                        <a title="Papar Maklumat" class="btn btn-warning btn-sm rounded-circle" href="{{ route('papar_jemaah',$pen->id) }}">
                                        <i class="fa fa-eye"></i></a>  


                                        <!-- Ubahsuai/ Kemaskini maklumat Ahli -->
                                        <!-- <a title="Kemaskini Maklumat" class="btn btn-info btn-sm rounded-circle" href="{{ route('kemaskini',$pen->id) }}" alt="edit"><i data-feather="edit" alt="edit">
                                        <i class="fa fa-edit"></i></a> -->
                                        
                                        <!-- Padam Ahli -->
                                        <!-- <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button title="Padam" class="btn btn-danger btn-sm rounded-circle" type="submit" value=""><i class="fa fa-trash" data-feather="user-x" alt="Padam"></i></button> -->
                                    </form>
                                    </td>

                                </tr>
                         
                            @empty
                                <tr>
                                    <td colspan="3">Tiada Rekod </td>
                                </tr>
                            @endforelse
                            
                    </table>
                </body>
            </div>
        </div>
    </div>
</div>
<b>SAH SEHINGGA: PARLIMEN DIBUBARKAN</b>

@endif



@endsection
