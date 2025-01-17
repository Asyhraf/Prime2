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
            <h3 class="text-center text-uppercase"><b>Senarai Ahli</b></h3>
            <h3 class="text-center text-uppercase"><b>{{ $tajuk_mesyuarat->nama_tajuk }}</b></h3>
        </div>

        <div class="card-body">

            <body>
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
                            <th width="5%" style="text-align: center"><strong>Bil</strong></th>
                            <th width="55%" style="text-align: center"><strong>Nama Dan Jawatan</strong></th>
                            <th width="20%" style="text-align: center"><strong>Gred</strong></th>
                            <th width="20%" style="text-align: center"><strong>Tarikh Bersara / Tamat Perkhidmatan</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ahli_mesyuarat as $ahli)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td style="text-align: left">
                                <strong>{{$ahli->nama_ahli}}</strong><br />
                                <span>{{$ahli->nama_jawatan}},</span>
                                @if(!empty($ahli->nama_kementerian))
                                <br><span>{{ $ahli->nama_kementerian }}</span>
                                @endif
                            </td>
                            <td style="text-align: center">
                                @if(!empty($ahli->nama_gred))
                                <span>{{$ahli->nama_gred}}</span><br>
                                <span>Tarikh Lantikan: {{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }}</span>
                                @else
                                <span class="badge badge-danger">Tiada Maklumat Gred</span>
                                @endif
                            </td>
                            <td style="text-align: center">
                                @if(!empty($ahli->tarikh_bersara))
                                <span>Tarikh Bersara: {{ date('d/m/Y', strtotime($ahli->tarikh_bersara)) }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @if($ahli_mesyuarat->isEmpty())
                        <tr>
                            <td colspan="4" style="text-align: center">Tiada Rekod</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

            </body>
        </div>
    </div>
</div>

@endsection
