@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><b>STATISTIK KEHADIRAN AHLI MESYUARAT</b></h3>
        </div>

        <div class="card-body">
            <form class="form" action="{{ route('lap_Statistik')}}">
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

            @if($jenis_mesyuarat == null)
            @elseif($eventCount == null)
            <hr class="mt-4 mb-2"><br>
            <h6 style="text-align: center">
                <b>Tiada sebarang ahli mesyuarat {{ $jenis_mesyuarat }} didaftarkan dan disahkan pada tahun {{ $tahun }}</b>.
            </h6>

            @else
            <hr class="mt-4 mb-2"><br>
            <h6 style="text-align: center">
                Bilangan keseluruhan mesyuarat {{ $jenis_mesyuarat }} sepanjang <b><u>Tahun {{ $tahun }} </u></b> yang disimpan di dalam<br>
                Takwim Mesyuarat adalah sebanyak <b><u>{{ $eventCount }} kali</u></b>.
            </h6>
            <br>

            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">

                <thead>
                    <tr>
                        <th width="5%" style="text-align: center">Bil.</th>
                        <th width="65%" style="text-align: center">Ahli Mesyuarat</th>
                        <th width="15%" style="text-align: center">Bilangan Ketidakhadiran</th>
                        <th width="15%" style="text-align: center">Peratusan Ketidakhadiran</th>
                    </tr>
                </thead>

                @forelse($ahli_mesyuarat as $counter => $ahli)
                <tr>
                    @for($i=0; $i < count($ketidakhadiranCount2); $i++) @if($i==$counter) <td style="text-align: center">{{ $i+1 }}</td>

                        <td>
                            <strong>{{$ahli->nama_ahli}}</strong><br>
                            <span>{{$ahli->nama_jawatan}}</span>
                            @if(!empty($ahli->nama_kementerian))
                            <br><span>{{ $ahli->nama_kementerian }} ({{ $ahli->singkatan_kementerian }})</span>
                            @endif
                        </td>
                        <td align="center"><strong>{{ $ketidakhadiranCount2[$i] }}/{{ $jumlahJemputan[$i] }}</strong></td>

                        <td align="center"><strong>{{ round($peratusan[$i], 2) }} %</strong></td>

                        @endif
                        @endfor
                        @empty
                <tr>
                    <td colspan="4">Tiada Rekod </td>
                </tr>
                @endforelse
                </tr>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
