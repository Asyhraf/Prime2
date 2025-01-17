@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">

        <div class="form-group row">
            <div class="col col-md-6 text-left">
                <form action="{{ route('p_CetakanKementerian') }}">
                    <button class="btn btn-success btn-sm rounded" type="submit" title="Cetak Senarai Kementerian">
                        <i class="fa fa-print"></i> Cetak Senarai Kementerian
                    </button>
                </form>
            </div>

            <div class="col col-md-6 text-right">
                <form action="{{ route('p_TambahKementerian') }}">
                    <button class="btn btn-primary btn-sm rounded" type="submit" title="Tambah Kementerian">
                        <i class="fa fa-plus"></i> Tambah Kementerian
                    </button>
                </form>
            </div>
        </div>

        <div class="card-header">
            <h3 class="text-center text-uppercase"><b>Senarai Kementerian / Agensi / Jabatan</b></h3>
        </div>

        <div class="card-body">
            @foreach($errors ->all() as $errors)
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $errors }}</li>
                </ul>
            </div>
            @endforeach
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
                        <th width="55%" style="text-align: center">Nama Kementerian / Agensi / Jabatan</th>
                        <th width="30%" style="text-align: center">Singkatan Kementerian / Agensi / Jabatan</th>
                        <th width="10%" style="text-align: center">Tindakan</th>
                    </tr>
                </thead>


                @forelse($ref_kementerian as $counter => $kementerian)
                <?php $counter++; ?>
                <tr>
                    <td style="text-align: center">{{ $counter }}</td>

                    <td><strong>{{ $kementerian->nama_kementerian }}</strong></td>

                    <td style="text-align: center"><strong>{{ $kementerian->singkatan_kementerian }}</strong></td>

                    <td style="text-align: center">
                        <form action="{{ route('padam_kementerian',$kementerian->id_kementerian) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk menghapuskan jawatan {{$kementerian->nama_kementerian}} ini?');" style="display: inline-block;">
                            @csrf

                            <!-- Ubahsuai/ Kemaskini maklumat Ahli -->
                            <a title="Kemaskini" class="btn btn-warning btn-sm rounded-circle" href="{{ route('ubahsuai_kementerian',$kementerian->id_kementerian) }}" alt="edit"><i data-feather="edit" alt="edit">

                                    <i class="fa fa-edit"></i></a>

                            <!-- Padam Ahli -->
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button title="Padam" class="btn btn-danger btn-sm rounded-circle" type="submit" value=""><i class="fa fa-trash" data-feather="user-x" alt="Padam"></i></button>
                        </form>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="4">Tiada Rekod </td>
                </tr>
                @endforelse

            </table>

        </div>
        <div class="col-md-12 text-right">
            <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                <i class="fa fa-backward"></i> Kembali
            </a>
        </div>
    </div>
</div>

@endsection
