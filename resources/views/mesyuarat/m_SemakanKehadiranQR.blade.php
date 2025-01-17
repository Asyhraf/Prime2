@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">

    <div class="card">

        <div class="col-12 text-right">
            <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                <i class="fa fa-backward"></i> Kembali
            </a>
        </div>

        <div class="card-header">
            <h3 class="text-center"><b>KEHADIRAN AHLI MESYUARAT (QR CODE)</b></h3>
            <h3 class="text-center text-uppercase"><b>{{ $event->TajukMesyuarat->nama_tajuk }} ({{ $event->title }})</b></h3>
            <h3 class="text-center">
                <b>
                    BILANGAN {{ $event->meeting_numbers }} / {{ $event->year }}
                    PADA {{ date('d/m/Y', strtotime($event->start)) }}
                </b>
            </h3>
        </div>

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
                        <tr>
                            <th width="5%" style="text-align: center">Bil</th>
                            <th width="48%" style="text-align: center">Nama dan Jawatan</th>
                            <th width="13%" style="text-align: center">Kehadiran</th>
                            <th width="17%" style="text-align: center">Nota Kemaskini</th>
                            <th width="17%" style="text-align: center">Catatan Ketidakhadiran</th>
                        </tr>
                    </thead>

                    @forelse($kehadiran as $counter => $hadir)
                    <?php $counter++; ?>
                    <tr>
                        <td style="text-align: center">{{ $counter }}</td>

                        <td style="text-align: left">
                            <strong>
                                {{$hadir->nama_ahli}}
                                <br>{{$hadir->nama_jawatan}}
                            </strong>
                            @if(!empty($hadir->nama_kementerian))
                            <br><strong>{{ $hadir->nama_kementerian }}</strong>
                            @endif
                        </td>

                        <td style='text-align:center'>
                            @if($hadir->kehadiran == 'Y')
                            <span class="badge badge-success">HADIR</span>
                            @elseif($hadir->kehadiran == 'N')
                            <span class="badge badge-danger">TIDAK HADIR</span>
                            <form>
                                @csrf
                                <a title="Wakil" class="btn btn-info btn-sm rounded" href="{{ route('papar_wakil', $hadir->id) }}">
                                    <i class="fa fa-user"></i> WAKIL
                                </a>
                            </form>
                            @elseif(is_null($hadir->kehadiran))
                            <span class="badge badge-warning">TIADA MAKLUMBALAS</span>
                            <form>
                                @csrf
                                @if($event->title == 'KSUKP')
                                <a title="Blast Email Mesyuarat {{ $event->title }}" class="btn btn-primary btn-sm rounded" href="{{ route('blast_email_ksukp', ['id' => $event->id, 'id_ahli' => $hadir->ahli_id]) }}">
                                    <i class="fa fa-envelope"></i> EMAIL
                                </a>
                                @elseif($event->title == 'MBKM')
                                <a title="Blast Email Mesyuarat {{ $event->title }}" class="btn btn-primary btn-sm rounded" href="{{ route('blast_email_mbkm', ['id' => $event->id, 'id_ahli' => $hadir->ahli_id]) }}">
                                    <i class="fa fa-envelope"></i> EMAIL
                                </a>
                                @endif
                            </form>
                            @endif
                        </td>

                        <td style="text-align: center"><strong>{{ $hadir->nota_kemaskini }}</strong></td>

                        <td style="text-align: center"><strong>{{ $hadir->catatan }}</strong></td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" style='text-align:center'>Tiada Rekod </td>
                    </tr>
                    @endforelse
                </table>
            </body>
        </div>
    </div>
</div>

@endsection
