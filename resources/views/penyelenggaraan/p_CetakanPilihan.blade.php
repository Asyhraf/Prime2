@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">

        <div class="card-header">
            <h3 class="text-center"><b>CETAKAN PILIHAN MESYUARAT</b></h3>
        </div>

        <div class="card-body">

            <form action="{{ route('cetakanlaporan') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="row form-group">
                    <div class="col col-md-4"><label for="tajuk" class=" form-control-label">Mesyuarat</label>
                    </div>

                    <div class="col-12 col-md-8">
                        <select name="tajuk" id="tajuk" name="tajuk" class="form-control">
                            @forelse($ref_tajuk_mesyuarat as $counter => $tajuk)
                            @if($tajuk->aktiviti == 1)
                            <option value="{{ $tajuk->id_tajuk }}">{{ $tajuk->nama_tajuk }}</option>
                            @endif
                            @empty
                            <option value=""></option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="row form-group">

                    <div class="col col-md-4"><label for="maklumat_cetakan" class=" form-control-label">Maklumat Cetakan</label>
                    </div>

                    <div class="col-12 col-md-8">

                        <ul style="list-style-type:none;">

                            <button class="btn btn-sm btn-primary rounded" title="Pilih Semua" type="button" onclick="checkAll()">Pilih Semua</button> &nbsp;
                            <button class="btn btn-sm btn-warning rounded" title="Reset" type="reset">Reset</button><br><br>

                            <li><input class="cb_element" type="checkbox" value="1" name="opt_alamat"> Alamat</li>
                            <li><input class="cb_element" type="checkbox" value="1" name="opt_noTel_emel"> No Tel & Emel</li>
                            <li><input class="cb_element" type="checkbox" value="1" name="opt_pegKhas"> Pegawai Khas</li>
                            <li><input class="cb_element" type="checkbox" value="1" name="opt_suPejnoTel_emel"> Setiausaha Pejabat, No Tel & Emel</li>
                            <li><input class="cb_element" type="checkbox" value="1" name="opt_pemandu_noPlat"> Pemandu & No Plat Kenderaan</li>
                            <li><input class="cb_element" type="checkbox" value="1" name="opt_gred_lantikan_bersara"> Gred, Tarikh Lantikan & Tarikh Bersara Wajib</li>

                        </ul>
                    </div>

                    <script type="text/javascript">
                        //create function of check/uncheck box
                        function checkAll() {
                            var inputs = document.querySelectorAll('.cb_element');
                            for (var i = 0; i < inputs.length; i++) {
                                inputs[i].checked = true;
                            }
                        }
                        window.onload = function() {
                            window.addEventListener('load', checkAll, false);
                        }
                    </script>

                    <div class="col col-md-4">
                    </div>

                    <div class="col col-md-8">
                        <button class="btn btn-success btn-sm rounded" type="submit" title="Cetak Senarai Jawatan">
                            <i class="fa fa-print"></i> Cetak Rekod
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
