@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><b>CETAKAN STICKER ALAMAT</b></h3>
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
                            <th width="55%" style="text-align: center">Nama Mesyuarat</th>
                            <th width="20%" style="text-align: center">Ringkasan</th>
                            <th width="20%" style="text-align: center">Cetakan Sticker Alamat</th>
                        </tr>
                    </thead>

                    @forelse($ref_tajuk_mesyuarat as $counter => $mesyuarat)

                    <?php $counter++; ?>
                    <tr>
                        <td style="text-align: center">{{ $counter }}</td>

                        <td>
                            <strong>{{ $mesyuarat->nama_tajuk }}</strong><br>
                        </td>

                        <td style="text-align: center">
                            <a class="badge" style="background-color: {{ $mesyuarat->color }}; font-size: 90%;">
                                <strong>{{ $mesyuarat->ringkasan }}</strong>
                            </a>
                        </td>

                        <td style="text-align: center">
                            <a title="Cetak Senarai Ahli Mesyuarat {{ $mesyuarat->ringkasan }}" class="btn btn-success btn-sm rounded-circle" href="{{ route( 'cetak_sticker', $mesyuarat->id_tajuk ) }}">
                                <i class="fa fa-print"></i></a>
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

@endsection
