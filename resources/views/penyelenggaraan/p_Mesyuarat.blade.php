@extends('layouts.customtheme')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">

                <h3 class="text-center"><b>SENARAI MESYUARAT & AKTIVITI</b></h3>
                <hr class="mt-4 mb-4">

                <body>
                    @foreach($errors ->all() as $errors)
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $errors }}</li>
                        </ul>
                    </div>
                    @endforeach

                    <table id="bootstrap-data-table-export1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center">Bil</th>
                                <th width="53%" style="text-align: center">Nama Mesyuarat</th>
                                <th width="12%" style="text-align: center">Ringkasan</th>
                                <th width="15%" style="text-align: center">Jenis Aktiviti</th>
                                <th width="15%" style="text-align: center">Senarai Ahli Mesyuarat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ref_tajuk_mesyuarat as $counter => $mesyuarat)
                            <tr>
                                <td style="text-align: center">{{ $counter + 1 }}</td>
                                <td><strong>{{ $mesyuarat->nama_tajuk }}</strong></td>
                                <td style="text-align: center">
                                    <a class="badge" style="background-color: {{ $mesyuarat->color }}; font-size: 90%;">
                                        {{ $mesyuarat->ringkasan }}
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <strong>{{ $mesyuarat->Activity->nama_aktiviti }}</strong>
                                </td>
                                <td style="text-align: center">
                                    @if($mesyuarat->aktiviti == "1")
                                        <a title="Senarai Ahli Mesyuarat {{ $mesyuarat->ringkasan }}" class="btn btn-info btn-sm rounded-circle" style="color: #000000;" href="{{ route('p_SenaraiAhli', $mesyuarat->id_tajuk) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a title="Cetak Senarai Ahli Mesyuarat {{ $mesyuarat->ringkasan }}" class="btn btn-success btn-sm rounded-circle" href="{{ route('CetakMesyuaratAhli', $mesyuarat->id_tajuk) }}">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    @else
                                        <strong>-</strong>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Tiada Rekod</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </body>
            </div>
        </div>
    </div>
</div>

@endsection
