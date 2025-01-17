@extends('layouts.customtheme')
@section('content')

<div class="animated fadeIn">
    <div class="card">

        <div class="form-group row">
            <div class="col col-md-6 text-left">
                <form action="{{ route('p_CetakanJawatan') }}">
                    <button class="btn btn-success btn-sm rounded" type="submit" text-align="left" title="Cetak Senarai Jawatan">
                        <i class="fa fa-print"></i> Cetak Senarai Jawatan
                    </button>
                </form>
            </div>

            <div class="col col-md-6 text-right">
                <form action="{{ route('p_TambahJawatan') }}">
                    <button class="btn btn-primary btn-sm rounded" type="submit" title="Tambah Jawatan">
                        <i class="fa fa-plus"></i> Tambah Jawatan
                    </button>
                </form>
            </div>
        </div>

        <div class="card-header">
            <h3 class="text-center"><b>SENARAI JAWATAN</b></h3>
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
                        <th width="60%" style="text-align: center">Nama Jawatan</th>
                        <th width="35%" style="text-align: center">Tindakan</th>
                    </tr>
                </thead>


                @forelse($ref_jawatan as $counter => $jawatan)
                <?php $counter++; ?>
                <tr>
                    <td style="text-align: center">{{ $counter }}</td>

                    <td><strong>{{ $jawatan->nama_jawatan }}</strong></td>

                    <td style="text-align: center">
                        <form action="{{ route('padam_jawatan',$jawatan->id_jawatan) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk menghapuskan jawatan {{$jawatan->nama_jawatan}} ini?');" style="display: inline-block;">
                            @csrf
                            <!-- Ubahsuai/ Kemaskini maklumat Ahli -->
                            <a title="Kemaskini" class="btn btn-warning btn-sm rounded-circle" href="{{ route('ubahsuai_jawatan',$jawatan->id_jawatan) }}" alt="edit"><i data-feather="edit" alt="edit">
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
                    <td colspan="3">Tiada Rekod </td>
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
