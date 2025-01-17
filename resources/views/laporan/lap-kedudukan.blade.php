@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">

        <div class="card-header">
            <h3 class="text-center text-uppercase"><b>SUSUN ATUR KEDUDUKAN AHLI MESYUARAT</b></h3>
        </div>

        <div class="card-body">
            <form class="form" action="{{ route('lap_Susunan')}}">
                {{csrf_field()}}
                <label class="col-form-label"><b>JENIS MESYUARAT</b></label><br>
                <div class="form-group">
                    <input style="width:3%;" type="radio" id="mesyuarat_ksukp" name="title" value="KSUKP">
                    <label for="ksukp">KSUKP</label><br>

                    <input style="width:3%;" type="radio" id="mesyuarat_mbkm" name="title" value="MBKM">
                    <label for="mbkm">MBKM</label><br>
                </div>

                <label class="col-form-label"><b>TAHUN MESYUARAT</b></label><br>
                <div class="form-group">
                    <select class="custom-select" name="year" id="year" style="width: 150px !important; min-width: 150px; max-width: 150px; min-height:35px;">
                        <optgroup label="Tahun:">
                            <script>
                                var currentYear = new Date().getFullYear();
                                for (var i = -3; i <= 1; i++) {
                                    var year = currentYear + i;
                                    document.write('<option value="' + year + '">' + year + '</option>');
                                }
                            </script>
                        </optgroup>
                    </select>
                </div>

                <div class="form-group mb-0">
                    <button class="btn btn-primary btn-sm rounded" name="papar" value="papar" type="submit" text-align="left" title="Papar">
                        <i class="fa fa-leanpub"></i> Papar
                    </button>
                </div>
            </form>

            <br>

            @if($tahun == null)
            @else
            <hr class="mt-4 mb-2"> <br>

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
                            <th width="5%" style="text-align: center">Bil</th>
                            <th width="10%" style="text-align: center">Tarikh</th>
                            <th width="55%" style="text-align: center">Nama Mesyuarat</th>
                            <th width="15%" style="text-align: center">Tindakan</th>
                        </tr>
                    </thead>

                    @forelse($eventTitle as $counter => $event)
                    <?php $counter++; ?>
                    <tr>
                        <td style="text-align: center">{{ $counter }}</td>

                        <td style="text-align: center"><strong>{{ date('d/m/Y', strtotime($event->start)) }} </strong><br>

                        <td>
                            <strong><span class="text-uppercase">{{ $event->TajukMesyuarat->nama_tajuk }}</span> ({{ $event->title }})<br>
                            <span>Bil. {{ $event->meeting_numbers }}/{{ $event->year }}</span></strong>
                            @if ($event->pindaan == "Y")
                            <br><span class="badge badge-dark">Pindaan Ke : {{ $event->pindaan_ke }}</span>
                            @endif
                        </td>

                        <td style="text-align: center">
                            @if( $event->title == 'KSUKP')
                            <a title="Kemaskini" class="btn btn-warning btn-sm rounded-circle" href="{{ route('ubah-kedudukan-KSUKP',$event->id) }}" alt="edit">
                                <i data-feather="edit" alt="edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a title="Papar Kedudukan Ahli {{ $event->title }}" class="btn btn-info btn-sm rounded-circle" href="{{ route('papar-kedudukan-KSUKP', $event->id) }}">
                                <i class="fa fa-th"></i>
                            </a>
                            @elseif($event->title == 'MBKM')
                            <a title="Kemaskini" class="btn btn-warning btn-sm rounded-circle" href="{{ route('ubah-kedudukan-MBKM',$event->id) }}" alt="edit">
                                <i data-feather="edit" alt="edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a title="Papar Kedudukan Ahli {{ $event->title }}" class="btn btn-success btn-sm rounded-circle" href="{{ route('papar-kedudukan-MBKM', $event->id) }}">
                                <i class="fa fa-th"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Tiada Rekod </td>
                    </tr>
                    @endforelse

                </table>
            </body>

            @endif

        </div>
    </div>
</div>
@endsection
