@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><b>KEKANANAN REKOD</b></h3>
        </div>

        <div class="card-body">
            <form class="form" action="{{ route('p_SemakSenaraiAhli') }}">
                <label class="col-form-label"><b>JENIS MESYUARAT</b></label><br>
                <div class="form-group">
                    <input style="width:3%;" type="radio" id="mesyuarat_ksukp" name="title" value="KSUKP">
                    <label for="ksukp">KSUKP</label><br>
                    <input style="width:3%;" type="radio" id="mesyuarat_mbkm" name="title" value="MBKM">
                    <label for="mbkm">MBKM</label><br>
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

            @if($eventTitle == null)
            @else

            <hr class="mt-4 mb-4">
            <div class="card-header">
                <h3 class="text-center"><b>SENARAI KEKANANAN AHLI</b></h3>
                <h3 class="text-center text-uppercase"><b>{{ $eventTitle->TajukMesyuarat->nama_tajuk }} ({{ $eventTitle->title }})</b></h3>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-6" style="padding-right: 5px;">
                    <form action="{{ route('updateKekananan') }}" method="POST">
                        @csrf
                        <table class="table table-striped table-bordered" id="bootstrap-data-table-export">
                            <thead>
                                <tr style="background-color:#FA8072">
                                    <th width="5%" style="text-align: center">Bil</th>
                                    <th width="35%" style="text-align: center">Maklumat Menteri</th>
                                    <th width="10%" style="text-align: center">Kekananan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ahliMesyuarat as $counter => $ahli)
                                <?php $counter++; ?>
                                <tr>
                                    <td style="text-align: center">{{ $counter  }}</td>
                                    <td>
                                        <small>({{ $ahli->kekananan_mesy_manual }})</small>
                                        {{ $ahli->nama_ahli }}
                                        </strong><br>
                                        <span class="badge badge-warning">{{ $ahli->nama_jawatan }}</span><br>
                                        @if(!empty($ahli->nama_kementerian))
                                        @php
                                        $kementerian_lines = explode(',', $ahli->nama_kementerian);
                                        @endphp
                                        @foreach ($kementerian_lines as $line)
                                        <span class="badge badge-info">{{ $line }}{{ $loop->last ? '' : ',' }}</span>
                                        @endforeach
                                        @else
                                        <span class="badge badge-danger">Tiada Maklumat Kementerian</span>
                                        @endif
                                        <br><small>
                                            @php
                                            $alamat_lines = explode("\n", $ahli->alamat); // Split the address into lines
                                            $num_lines = count($alamat_lines);
                                            @endphp
                                            @foreach ($alamat_lines as $line_key => $line)
                                            @if ($line_key == $num_lines - 1) <!-- Check if it's the last line -->
                                            <strong>{{ e($line) }}</strong> <!-- Make it bold -->
                                            @else
                                            {{ e($line) }} <!-- Normal text -->
                                            @endif
                                            <br> <!-- Ensure each line is on a new line -->
                                            @endforeach
                                        </small>
                                        <span class="badge badge-light" style="background-color: hotpink; color: black;">
                                            <i class="ti ti-envelope"></i> &nbsp; {{ $ahli->emel }}
                                        </span>
                                        <br>
                                        <span class="badge badge-light" style="background-color: darkviolet; color: white;">
                                            <i class="ti ti-mobile"></i> &nbsp; {{ $ahli->no_hp_peribadi }}
                                        </span>
                                    </td>
                                    <td>
                                        <input type="hidden" name="ahli[{{ $ahli->id_ahli }}][id]" value="{{ $ahli->id_ahli }}">
                                        <select class="form-control digits" name="ahli[{{ $ahli->id_ahli }}][kekananan_mesy_manual]" id="kekananan_mesy_manual">
                                            @for ($k = 1; $k <= 200; $k++) 
                                            <option value="{{ $k }}" @if ($k==$ahli->kekananan_mesy_manual) selected @endif>{{ $k }}</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-12 text-center">
                            <button type="submit" name="hantar" value="hantar" class="btn btn-primary btn-sm rounded">
                                <i class="fa fa-send"></i> Hantar
                            </button>
                            <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
                                <i class="fa fa-refresh"></i> Tetapan Semula
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-6" style="padding-left: 5px;">
                    <form action="{{ route('updateKekananan') }}" method="POST">
                        @csrf
                        <table class="table table-striped table-bordered" id="bootstrap-data-table-export2">
                            <thead>
                                <tr style="background-color:#FA8072">
                                    <th width="5%" style="text-align: center">Bil</th>
                                    <th width="35%" style="text-align: center">Maklumat Menteri</th>
                                    <th width="10%" style="text-align: center">Kekananan</th>
                                </tr>
                            </thead>                        
                            <tbody>
                                @foreach($ahliMesyuarat as $counter => $ahli)
                                <?php $counter++; ?>
                                <tr>
                                    <td style="text-align: center">{{ $counter  }}</td>
                                    <td>
                                        <small>({{ $ahli->kekananan_mesy_manual }})</small>
                                        {{ $ahli->nama_ahli }}
                                        </strong><br>
                                        <span class="badge badge-warning">{{ $ahli->nama_jawatan }}</span><br>
                                        @if(!empty($ahli->nama_kementerian))
                                        @php
                                        $kementerian_lines = explode(',', $ahli->nama_kementerian);
                                        @endphp
                                        @foreach ($kementerian_lines as $line)
                                        <span class="badge badge-info">{{ $line }}{{ $loop->last ? '' : ',' }}</span>
                                        @endforeach
                                        @else
                                        <span class="badge badge-danger">Tiada Maklumat Kementerian</span>
                                        @endif
                                        <br><small>
                                            @php
                                            $alamat_lines = explode("\n", $ahli->alamat); // Split the address into lines
                                            $num_lines = count($alamat_lines);
                                            @endphp
                                            @foreach ($alamat_lines as $line_key => $line)
                                            @if ($line_key == $num_lines - 1) <!-- Check if it's the last line -->
                                            <strong>{{ e($line) }}</strong> <!-- Make it bold -->
                                            @else
                                            {{ e($line) }} <!-- Normal text -->
                                            @endif
                                            <br> <!-- Ensure each line is on a new line -->
                                            @endforeach
                                        </small>
                                        <span class="badge badge-light" style="background-color: hotpink; color: black;">
                                            <i class="ti ti-envelope"></i> &nbsp; {{ $ahli->emel }}
                                        </span>
                                        <br>
                                        <span class="badge badge-light" style="background-color: darkviolet; color: white;">
                                            <i class="ti ti-mobile"></i> &nbsp; {{ $ahli->no_hp_peribadi }}
                                        </span>
                                    </td>
                                    <td>
                                        <input type="hidden" name="ahli[{{ $ahli->id_ahli }}][id]" value="{{ $ahli->id_ahli }}">
                                        <select class="form-control digits" name="ahli[{{ $ahli->id_ahli }}][kekananan_mesy_manual]" id="kekananan_mesy_manual">
                                            @for ($k = 1; $k <= 200; $k++) 
                                            <option value="{{ $k }}" @if ($k==$ahli->kekananan_mesy_manual) selected @endif>{{ $k }}</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>                    
                        </table>
                        <div class="col-md-12 text-center">
                            <button type="submit" name="hantar" value="hantar" class="btn btn-primary btn-sm rounded">
                                <i class="fa fa-send"></i> Hantar
                            </button>
                            <button type="reset" name="reset" value="reset" class="btn btn-danger btn-sm rounded">
                                <i class="fa fa-refresh"></i> Tetapan Semula
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            @endif
            
        </div>
    </div>
</div>

@endsection
