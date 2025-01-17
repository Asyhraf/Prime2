@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><b>PANGGILAN MESYUARAT</b></h3>
        </div>

        <div class="card-body">
            <form class="form" action="{{ route('m_PanggilanMesyuarat')}}">
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
                    <button class="btn btn-primary btn-sm rounded" type="submit" text-align="left" title="Papar">
                        <i class="fa fa-leanpub"></i> Papar
                    </button>
                </div>
            </form>

            <br>

            @if($title == null)
            @else

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
            <hr class="mt-4 mb-4">
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%" style="text-align: center">Bil</th>
                        <th width="15%" style="text-align: center">Tarikh</th>
                        <th width="60%" style="text-align: center">Nama Mesyuarat</th>
                        <th width="20%" style="text-align: center">Tindakan</th>
                    </tr>
                </thead>

                @forelse($eventTitle as $event)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration}}</td>

                    <td style="text-align: center"><strong>{{ date('d/m/Y', strtotime($event->start)) }} </strong><br></td>

                    <td>
                        <strong>{{ $event->TajukMesyuarat->nama_tajuk }} ( {{ $event->title }} )<br>
                        Bil. {{ $event->meeting_numbers }}/{{ $event->year }}</strong>
                    </td>

                    <td style="text-align: center">
                        @if($event->title == 'KSUKP')
                        <a title="Kemaskini Senarai Ahli" class="btn btn-warning btn-sm rounded-circle" style="color: #000000;" href="{{ route('ahli.ksukp', $event->id) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a title="Emel Panggilan Mesyuarat {{ $event->title }}" class="btn btn-primary btn-sm rounded-circle" href="{{ route( 'panggilan.ksukp', $event->id) }}">
                            <i class="fa fa-envelope"></i>
                        </a>
                        @elseif($event->title == 'MBKM')
                        <a title="Kemaskini Senarai Ahli" class="btn btn-warning btn-sm rounded-circle" style="color: #000000;" href="{{ route('ahli.mbkm', $event->id) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a title="Emel Panggilan Mesyuarat {{ $event->title }}" class="btn btn-primary btn-sm rounded-circle" href="{{ route( 'panggilan.mbkm', $event->id) }}">
                            <i class="fa fa-envelope"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center"><strong>Tiada Rekod</strong></td>
                </tr>
                @endforelse

            </table>
            @endif
        </div>
    </div>
</div>
@endsection
