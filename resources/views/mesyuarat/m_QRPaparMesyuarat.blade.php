@extends('layouts.customtheme')
@section('content')

<div class="animated fadeIn">

    <!-- <form action="{{ route('m_tambah') }}">
        <input class="btn btn-primary" type="submit" value="Tambah Mesyuarat" />
    </form><br> -->

    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><b>PENGESAHAN KEHADIRAN MESYUARAT QR CODE</b></h3>
        </div>

        <div class="card-body">

            <form class="form" action="{{ route('m_QRPapar')}}">

                <label class="col-form-label"><b>JENIS MESYUARAT</b></label><br>
                <div class="form-group">

                    <input style="width:3%;" type="radio" id="mesyuarat_ksukp" name="title" value="KSUKP">
                    <label for="ksukp">KSUKP</label><br>

                    <!-- <input style="width:3%;" type="radio" id="mesyuarat_jkppn" name="title" value="JKPPN">
                    <label for="jkppn">JKPPN</label><br>

                    <input style="width:3%;" type="radio" id="mesyuarat_kjp" name="title" value="KJP">
                    <label for="kjp">KJP</label><br>

                    <input style="width:3%;" type="radio" id="mesyuarat_kebbp" name="title" value="KEBBP">
                    <label for="kebbp">KEBBP</label><br> -->

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

            <body>
                @if($title == null)
                @else
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
                            <th width="52%" style="text-align: center">Mesyuarat</th>
                            <th width="13%" style="text-align: center">Bil. Mesyuarat</th>
                            <th width="15%" style="text-align: center">Cetak QR Code</th>
                            <th width="15%" style="text-align: center">Semakan Kehadiran</th>
                        </tr>
                    </thead>
                    @forelse($eventTitle as $counter => $event)
                    <?php $counter++; ?>

                    <tr>
                        <td align="center">{{ $counter }}</td>

                        <td><strong>{{ optional($event->TajukMesyuarat)->nama_tajuk }}</strong><br>
                            <span class="badge badge-warning">{{ $event->aktiviti }}</span> <br>
                            <span class="badge badge-info">{{ date('d/m/Y', strtotime($event->start)) }}
                                @if( $event->aktiviti !== "Mesyuarat")
                                - {{ date('d/m/Y', strtotime($event->end)) }}
                                @else
                                @endif
                            </span> <br>


                        <td align="center"><strong><span class="badge badge-warning">({{ $event->title }})</span> <br>
                                @if( $event->aktiviti == "Mesyuarat")
                                <span class="badge badge-danger">Bil. {{ $event->meeting_numbers }}/{{ $event->year }}</span></strong><br>


                        <td align="center">
                            <form>
                                @csrf
                                <a title="Cetak QR Code" class="btn btn-dark btn-sm rounded-circle" href="{{ route('CetakQR',$event->id) }}">
                                    <i class="fa fa-qrcode"></i></a>
                            </form>
                        </td>

                        <td align="center">

                            <form>
                                @csrf
                                <a title="Semak Kehadiran" class="btn btn-info btn-sm rounded" href="{{ route('SemakKehadiranQR',$event->id) }}">
                                    <i class="fa fa-check"></i>SEMAK</a>
                            </form>

                        </td>


                        @else
                        <td align="center">
                            <strong>-</strong>
                        </td>
                        <td align="center">
                            <strong>-</strong>
                        </td>
                        @endif
                    </tr>

                    @empty
                    <tr style="text-align:center">
                        <td colspan="5"><b>Tiada Rekod</b></td>
                    </tr>
                    @endforelse

                </table>
                @endif
            </body>
        </div>
    </div>
</div>

@endsection
