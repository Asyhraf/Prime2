@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">       
    <div class="card">

        <div class="card-header">
            <h3 class="text-center"><b>LAPORAN KEAHLIAN MESYUARAT</b></h3>
        </div>

        <div class="card-body">
            <form class="form" action="{{ route('lap_Keahlian')}}">

                <div class="row form-group">
                    <div class="col col-md-4">
                        <label for="tajuk" class="text-uppercase"><b>Mesyuarat</b></label>
                    </div>

                    <div class="col-12 col-md-8">
                        <select class="form-control" id="tajuk" name="tajuk">
                            <option value="" selected disabled>Pilih Mesyuarat</option>
                            @foreach ($ref_tajuk_mesyuarat as $key => $tajuk)
                            <option value="{{ $key }}"> {{ $tajuk }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-4">
                        <label for="year" class="text-uppercase"><b>Tahun Mesyuarat</b></label>
                    </div>

                    <div class="col-12 col-md-8">
                        <select class="custom-select" name="year" id="year">
                            <option>Pilih Tahun</option>
                            <script>
                                var currentYear = new Date().getFullYear();
                                for (var i = -3; i <= 1; i++) {
                                    var year = currentYear + i;
                                    document.write('<option value="' + year + '">' + year + '</option>');
                                }
                            </script>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-4">
                        <label for="ahli" class="text-uppercase"><b>Ahli Mesyuarat</b></label>
                    </div>

                    <div class="col-12 col-md-8">
                        <select class="form-control" id="ahli" name="ahli">
                        </select>

                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-4">
                        <label for="jawatan" class="text-uppercase"><b>Jawatan</b></label>
                    </div>

                    <div class="col-12 col-md-8">
                        <select class="form-control" id="jawatan" name="jawatan" style="appearance: none;">
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-4">
                        <label for="kementerian" class="text-uppercase"><b>Kementerian</b></label>
                    </div>

                    <div class="col-12 col-md-8">
                        <select class="form-control" id="kementerian" name="kementerian" style="appearance: none;">
                        </select>
                    </div>
                </div>

                <div class="row form-group">

                    <div class="col col-md-4">
                        <label for="maklumat_cetakan" class="form-control-label text-uppercase"><b>Maklumat Keahlian Mesyuarat</b></label>
                    </div>

                    <div class="col-12 col-md-8">
                        <ul style="list-style-type:none;">
                            <button class="btn btn-sm btn-primary rounded" title="Pilih Semua" type="button" onclick="checkAll()">Pilih Semua</button> &nbsp;
                            <button class="btn btn-sm btn-warning rounded" title="Reset" type="reset">Reset</button><br><br>

                            <li><input class="cb_element" type="checkbox" value="1" name="opt_bil_mesyuarat"> Bil Mesyuarat</li>
                            <li><input class="cb_element" type="checkbox" value="1" name="opt_kehadiran_mesyuarat"> Kehadiran Mesyuarat</li>
                            <li><input class="cb_element" type="checkbox" value="1" name="opt_kekananan_keahlian"> Kekananan Keahlian</li>
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

                    <div class="col-12 col-md-9 text-center">
                        <button class="btn btn-primary btn-sm rounded" type="submit" text-align="left" title="Papar">
                            <i class="fa fa-leanpub"></i> Papar
                        </button>
                    </div>
            </form>
        </div>
    </div>  
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // when tajuk dropdown changes
    $('#tajuk').change(function() {

        var tajukID = $(this).val();

        if (tajukID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getAhli') }}/" + tajukID,
                success: function(res) {

                    if (res) {

                        $("#ahli").empty();
                        $("#ahli").append('<option>Pilih Ahli Mesyuarat</option>');
                        $.each(res, function(key, value) {
                            $("#ahli").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#ahli").empty();
                    }
                }
            });
        } else {

            $("#ahli").empty();
            $("#jawatan").empty();
            $("#kementerian").empty();
        }
    });


    // when ahli dropdown changes
    $('#ahli').on('change', function() {

        var ahliID = $(this).val();

        if (ahliID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getJawatan') }}/" + ahliID,
                success: function(res) {

                    if (res) {
                        $("#jawatan").empty();
                        // $("#jawatan").append('<option>Pilih Jawatan</option>');
                        $.each(res, function(key, value) {
                            $("#jawatan").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#jawatan").empty();
                    }
                }
            });
        } else {

            $("#jawatan").empty();
        }
    });


    // when ahli dropdown changes
    $('#ahli').on('change', function() {

        var ahliID = $(this).val();

        if (ahliID) {
            $.ajax({
                type: "GET",
                url: "{{ url('getKementerian') }}/" + ahliID,
                success: function(res) {

                    if (res) {
                        $("#kementerian").empty();
                        // $("#kementerian").append('<option>Pilih Kementerian</option>');
                        $.each(res, function(key, value) {
                            $("#kementerian").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#kementerian").empty();
                    }
                }
            });
        } else {
            $("#kementerian").empty();
        }
    });
</script>

@endsection