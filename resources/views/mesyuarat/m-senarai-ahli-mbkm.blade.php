@extends('layouts.customtheme')
@section('content')

<style>
    .add {
        /* display: flex; */
        align-items: center;
        /* justify-content: center; */
        /* flex-wrap: wrap; */
        margin: 20px;
        height: 115px;
    }
</style>

<div class="container-fluid p-0">
    <div class="card">

        <div class="col-12 text-right">
            <button class="btn btn-primary btn-sm rounded" data-toggle="collapse" data-target="#collapseicon" aria-expanded="true" aria-controls="#collapseicon">
                <i class="fa fa-users"></i> Tambah Ahli Mesyuarat
            </button>
        </div>

        {{-- <div class="col-12 text-right">
            <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                <i class="fa fa-backward"></i> Kembali
            </a>
        </div> --}}

        <div class="card-header">
            <h3 class="text-center text-uppercase"><b>Senarai Ahli Mesyuarat<br>{{ $event->TajukMesyuarat->nama_tajuk }}</b></h3>
            <h3 class="text-center text-uppercase">
                <b>Bil. {{ $event->meeting_numbers }} Tahun {{ $event->year }}
                Pada {{ date('d/m/Y', strtotime($event->start)) }}</b>
            </h3>
        </div>

        <div class="col-12">
            <div class="col-2">
            </div>
            <div class="col-8">
                <div class="collapse" id="collapseicon" aria-labelledby="collapseicon">
                    <div class="add b-grey">
                        <form method="POST" action="{{ route('tambah.ahli', $event->id) }}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <div class="col-2">
                                    <label class="col-form-label"><b>NAMA</b></label>
                                </div>

                                <div class="col-10">
                                    <select class="form-control text-uppercase" name="ahli" id="ahli">
                                    <option label="- SILA PILIH -"></option>
                                    @foreach ($ahliMesyuarat as $ahliM)
                                        <option class="text-uppercase" value="{{ $ahliM->id_ahli }}">{{ $ahliM->nama_ahli }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" id="tambah" name="tambah" value="tambah" class="btn btn-primary btn-sm rounded tambah">
                                    <i class="fa fa-plus"></i>&nbsp; Tambah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-2">
            </div>
        </div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <span class="badge badge-pill badge-success">Success</span>
                <b>{{ session('status') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
            @foreach($errors ->all() as $errors)
            <div class="alert alert-danger ">
                <ul>
                    <li>{{ $errors }}</li>
                </ul>
            </div>
            @endforeach

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="bootstrap-data-table-export">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center">Bil</th>
                            <th width="75%" style="text-align: left">Nama dan Jawatan</th>
                            <th width="20%" style="text-align: center">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($ahliEvent as $ahli)
                        <tr>
                            <td style='text-align:center'>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $ahli->nama_ahli }}</strong><br>
                                <span>{{ $ahli->nama_jawatan }}</span><br>
                                @if(!empty($ahli->nama_kementerian))
                                <span>{{ $ahli->nama_kementerian }}</span>
                                @endif
                            </td>

                            <td style='text-align:center'>
                                <form action="{{ route('padam.ahli', $ahli->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk menghapuskan rekod ini?');" style="display: inline-block;">
                                    @csrf

                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button title="Padam Ahli" class="btn btn-danger btn-sm rounded-circle" type="submit" value=""><i class="fa fa-trash" data-feather="user-x" alt="Padam"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style='text-align:center'>Tiada Maklumat Ahli Mesyuarat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
