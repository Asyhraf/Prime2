@extends('layouts.customtheme')
@section('content')

<div class="animated fadeIn">

    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><b>PENGESAHAN KEHADIRAN MESYUARAT</b></h3>
        </div>

        <div class="card-body">
            <form class="form" action="{{ route('m_pengesahan') }}">

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

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <span class="badge badge-pill badge-success">Success</span>
                <b>{{ session('status') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            @if ($title == null)
            @else
            {{ csrf_field() }}

            <hr class="mt-4 mb-4">
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%" style="text-align: center">Bil</th>
                        <th width="43%" style="text-align: center">Mesyuarat</th>
                        <th width="10%" style="text-align: center">Tindakan</th>
                        <th width="15%" style="text-align: center">Cetakan Kehadiran</th>
                        <th width="15%" style="text-align: center">Semakan Kehadiran</th>
                    </tr>
                </thead>

                <!-- {{ $AhliEventID }} -->

                @forelse($eventTitle as $counter => $event)
                <?php $counter++; ?>

                <tr>
                    <td style="text-align: center">{{ $counter }}</td>
                    <td>
                        <strong>{{ optional($event->TajukMesyuarat)->nama_tajuk }} ( {{ $event->title }} )
                        <br><span>Bil. {{ $event->meeting_numbers }}/{{ $event->year }}</span>
                        @if ($event->pindaan == "Y")
                        <br><span class="badge badge-dark">Pindaan Ke : {{ $event->pindaan_ke }}</span>
                        @endif
                        <br><span>{{ date('d/m/Y', strtotime($event->start)) }}</span>
                        </strong>
                        @if ($event->status == 1)
                        <br><span class="badge badge-success">Kehadiran Telah Disahkan</span>
                        @endif
                    </td>

                    <td style="text-align: center">
                        <form action="{{ route('padam_mesyuarat', $event->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk menghapuskan rekod ini?');" style="display: inline-block;">
                            @csrf

                            @if ($event->status == 1)
                            @else
                            <!-- Pengesahan Kehadiran Ahli Mesyuarat -->
                            <a title="Pengesahan Kehadiran Ahli Mesyuarat" class="btn btn-info btn-sm rounded-circle" href="{{ route('m_PengesahanKehadiranAhli', $event->id) }}">
                                <i class="fa fa-calendar-check-o"></i></a>
                            @endif
                            <!-- Papar Ahli -->
                            <a title="Kemaskini Kehadiran Ahli Mesyuarat" class="btn btn-warning btn-sm rounded-circle" href="{{ route('kemaskini_kehadiran', $event->id) }}">
                                <i class="fa fa-edit"></i></a>

                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button title="Padam Mesyuarat" class="btn btn-danger btn-sm rounded-circle" type="submit" value=""><i class="fa fa-trash" data-feather="user-x" alt="Padam"></i></button>
                        </form>
                    </td>

                    <td style="text-align: center">
                        {{-- <button type="button" class="btn btn-outline-dark btn-sm rounded" onclick="window.location.href='{{ route('CetakQR', $event->id) }}'">
                            <i class="fa fa-qrcode"></i>QR CODE</button> --}}
                        <button type="button" class="btn btn-outline-dark btn-sm rounded" onclick="window.location.href='{{ route('mesyuarat1', ['m_CetakanKehadiran2', $event->id]) }}'">
                            <i class="fa fa-print"></i>HADIR</button>
                        <button type="button" class="btn btn-outline-dark btn-sm rounded" onclick="window.location.href='{{ route('mesyuarat', ['m_CetakanTidakKehadiran2', $event->id]) }}'">
                            <i class="fa fa-print"></i>TIDAK HADIR</button>
                    </td>

                    <td style="text-align: center">
                        <a title="Semak Kehadiran" class="btn btn-primary btn-sm rounded" href="{{ route('SemakKehadiranQR', $event->id) }}">
                            <i class="fa fa-check"></i>SEMAK</a>
                    </td>
                </tr>

                @empty
                <tr style="text-align:center">
                    <td colspan="5"><b>Tiada Rekod</b></td>
                </tr>
                @endforelse

            </table>
            @endif
        </div>
    </div>
</div>

@endsection
