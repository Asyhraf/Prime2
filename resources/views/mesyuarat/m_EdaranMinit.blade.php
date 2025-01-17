@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><b>SURAT EDARAN MINIT MESYUARAT</b></h3>
        </div>

        <div class="card-body">
            <form class="form" action="{{ route('m_EdaranMinit')}}">
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
            <hr class="mt-4 mb-2">
            <br>

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

                <hr class="mt-4 mb-4">
                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center">Bil</th>
                            <th width="15%" style="text-align: center">Tarikh</th>
                            <th width="50%" style="text-align: center">Nama Mesyuarat</th>
                            <th width="20%" style="text-align: center">Cetakan Dokumen</th>
                        </tr>
                    </thead>

                    @forelse($eventTitle as $counter => $event)
                    <?php $counter++; ?>
                    <tr>
                        <td style="text-align: center">{{ $counter }}</td>

                        <td style="text-align: center"><strong>{{ date('d/m/Y', strtotime($event->start)) }} </strong><br>

                        <td>
                            <strong>
                                {{ $event->TajukMesyuarat->nama_tajuk }} ( {{ $event->title }} )
                                <br><span>Bil. {{ $event->meeting_numbers }}/{{ $event->year }}</span>
                            </strong>
                        </td>

                        <td style="text-align: center">
                            @if($event->title == 'KSUKP')
                            <a title="Cetak Surat Edaran Minit Mesyuarat {{ $event->title }}" class="btn btn-success btn-sm rounded-circle" href="{{ route('m_CetakanEdaranMinit_ksukp',$event->id) }}">
                                <i class="fa fa-print"></i>
                            </a>
                            @elseif($event->title == 'MBKM')
                            <a title="Cetak Surat Edaran Minit Mesyuarat {{ $event->title }}" class="btn btn-success btn-sm rounded-circle" href="{{ route('m_CetakanEdaranMinit_mbkm',$event->id) }}">
                                <i class="fa fa-print"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Tiada Rekod </td>
                    </tr>
                    @endforelse
                </table>
            </body>

            @endif
        </div>
    </div>

</div>
@endsection
