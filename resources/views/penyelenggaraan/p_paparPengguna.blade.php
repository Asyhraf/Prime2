@extends('layouts.customtheme')

@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <br />
                    <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>Maklumat Pengguna Sistem</i></h1>
                   
                <br />

                <div class="card mb-4">
            <div class="card-header">
                <i class="fa fa-table"></i>
                Maklumat Pengguna Sistem - {{ $user->name }}
            </div>

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
                                    <th style="text-align: center"><font color="#FFFFFF">PERKARA</font></th>
                                    <th style="text-align: center"><font color="#FFFFFF">BUTIRAN</font></th>
                                    
                                </tr>
                            </thead>
                          
                                    <tr>
                                        <tbody>
                                        <tr style= "background-color:#FFFFFF">
                                        <th style="text-align: center"><strong>NAMA</strong></th>
                                        <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr style= "background-color:#FFFFFF">
                                        <th style="text-align: center"><strong>EMAIL</strong></th>
                                        <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr style= "background-color:#FFFFFF">
                                        <th style="text-align: center"><strong>UNIT</strong></th>
                                        <td>{{ $user->Unit->nama_unit }}</td>
                                        </tr>
                                        <tr style= "background-color:#FFFFFF">
                                        <th style="text-align: center"><strong>PERANAN</strong></th>
                                        <td>{{ $user->Peranan->nama_peranan }}</td>
                                        </tr>
                                     
                                        </form>
                                        </td>

                                    </tr>  
                    </table>
                </tbody>
                </div>
            </div>
        </div>
    </div>
</div>

<form class="p-3 mb-2" action="{{ route('p_editPengguna.edit',$user->id) }}">
    <input class="btn btn-primary" type="submit" value="Ubah Maklumat">
</form>


<table id="bootstrap-data-table-export" class="p-3 mb-2">
        Data terakhir dikemaskini oleh <b>{{ $user->dikemaskini_oleh }}</b> pada <b>{{ $user->updated_at }}</b>.
</table><br>


@endsection

