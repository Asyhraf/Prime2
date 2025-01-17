@extends('layouts.customtheme')
@section('content')

<div class="animated fadeIn">
    <div class="card">
        <div class="card-header">
            <div class="form-group row">
                <div class="col-md-auto text-left">
                    <form action="{{ route('p_CetakSenaraiAhli') }}">
                        <button class="btn btn-success btn-sm rounded" type="submit" title="Cetak Senarai Ahli">
                            <i class="fa fa-print"></i> Cetak Senarai Ahli
                        </button>
                    </form>
                </div>

                <!-- <div class="col-md-auto text-left p-0">
                    <form action="{{ route('p_SemakSenaraiAhli') }}">
                        <button class="btn btn-danger btn-sm rounded" type="submit" title="Semakan Senarai Ahli">
                            <i class="fa fa-search"></i> Semakan Senarai Ahli
                        </button>
                    </form>
                </div> -->

                <div class="col-md-4 ml-auto text-right">
                    <form action="{{ route('TambahAhli') }}">
                        <button class="btn btn-primary btn-sm rounded" type="submit" title="Tambah Ahli Mesyuarat">
                            <i class="fa fa-users"></i> Tambah Ahli Mesyuarat
                        </button>
                    </form>
                </div>
            </div>

            <div>
                <h3 class="text-center"><b>SENARAI AHLI MESYUARAT</b></h3>
            </div>
        </div>

        <div class="card-body">

            <div class="form-group row">
                <div class="col-md-12">

                    <body>

                        @if(session ('status'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <span class="badge badge-pill badge-success">Success</span>
                            <b>{{ session ('status')}}</b>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endif

                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%" style="text-align: center">Bil</th>
                                    <th width="65%" style="text-align: center">Nama dan Jawatan</th>
                                    <th width="15%" style="text-align: center">Gred</th>
                                    <th width="15%" style="text-align: center">Tindakan</th>
                                </tr>
                            </thead>

                            @foreach($ahliMesyuarat as $ahli)
                            <tr>
                                <td style='text-align:center'>{{ $loop->iteration }}</td>

                                <td><strong>{{ $ahli->nama_ahli }}</strong><br>
                                    <span>{{ $ahli->nama_jawatan }}</span>
                                    @if(!empty($ahli->nama_kementerian))
                                        <br><span>{{ $ahli->nama_kementerian }}</span>
                                    @endif
                                </td>

                                <td style='text-align:center'>
                                    @if(!empty($ahli->nama_gred))
                                    <span>{{ $ahli->nama_gred }}</span><br>
                                    <span>Tarikh Lantikan: {{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }}</span>
                                    @else
                                    <span class="badge badge-danger">Tiada Maklumat Gred</span>
                                    @endif
                                </td>

                                <td style='text-align:center'>
                                    <form action="{{ route('padam_pengguna',$ahli->id_ahli) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk menghapuskan rekod ini?');" style="display: inline-block;">
                                        {{csrf_field()}}

                                        <!-- Papar Ahli -->
                                        <a title="Papar Ahli" class="btn btn-info btn-sm rounded-circle" style="color: #000000;" href="{{ route('papar_ahli',$ahli->id_ahli) }}">
                                            <i class="fa fa-eye"></i></a>

                                        <!-- Ubahsuai/ Kemaskini maklumat Ahli -->
                                        <a title="Kemaskini" class="btn btn-warning btn-sm rounded-circle" href="{{ route('kemaskini',$ahli->id_ahli) }}" alt="edit"><i data-feather="edit" alt="edit">
                                                <i class="fa fa-edit"></i></a>

                                        <!-- Padam Ahli -->
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button title="Padam" class="btn btn-danger btn-sm rounded-circle" type="submit" value=""><i class="fa fa-trash" data-feather="user-x" alt="Padam"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($ahliMesyuarat->isEmpty())
                            <tr>
                                <td colspan="4" style="text-align: center"><b>Tiada Rekod</b></td>
                            </tr>
                            @endif
                        </table>
                    </body>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
