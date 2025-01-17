@extends('layouts.customtheme')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U-Shape Seating Arrangement</title>
    <style>
        .seating-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin: auto;
            padding-top: 20px;
            font-size: 11px;
            height: auto;
        }

        /* Row container for top, side, and bottom rows */
        .row-container {
            display: flex;
            width: 100%;
            justify-content: center;
        }

        /* Side columns */
        .side-column-left {
            display: flex;
            flex-direction: column;
            margin: 10px;
            align-items: flex-end;
            width: 50%;
        }

        .side-column-right {
            display: flex;
            flex-direction: column;
            margin: 10px;
            width: 50%;
        }

        /* Top and Bottom rows */
        .top-row, .bottom-row {
            display: flex;
            justify-content: center;
            flex-direction: column-reverse;
            align-items: center;
            font-size: 12px;
            width: 100%; /* Adjust width as needed */
        }

        /* Seat and content styling */
        .seat-wrapper {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .seat {
            width: 40px;
            height: 40px;
            background-color: #ee0b0b;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            font-weight: bold;
            margin: 10px;
        }

        .content-1 {
            flex-direction: column;
            font-size: 12px;
            margin: 10px;
            text-align: right;
        }
        .content-2 {
            flex-direction: column;
            font-size: 12px;
            margin: 10px;
        }
        .badge {
            background-color: #333;
            color: white;
            padding: 2px 4px;
            border-radius: 3px;
            margin-top: 5px;
            font-weight: bold;
            font-size: 11px;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        /* Hide sidebars, topbars, and any other elements you don’t want in print */
        @media print {
            /* Hide elements by class or ID */
            .left-panel, .header, .footer, .non-printable, .cetakkembali {
                display: none !important;
            }
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: royalblue;
            color: white;
            cursor: pointer;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 25px;
            text-align: center;
            line-height: 50px;
        }

        #myBtn:hover {
            background-color: #fa8072;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="cetakkembali">
            <div class="form-group row">
                <div class="col-6 text-left">
                    <button class="btn btn-success btn-sm rounded" onclick="window.print()" title="Cetak Susun Atur">
                        <i class="fa fa-print"></i> Cetak Susun Atur
                    </button>
                </div>

                <div class="col-6 text-right">
                    <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="card-header">
            <h3 class="text-center text-uppercase"><b>Susun Atur Kedudukan<br>{{ $event->TajukMesyuarat->nama_tajuk }}</b></h3>
            <h3 class="text-center text-uppercase"><b>Bil. {{ $event->meeting_numbers }} Tahun {{ $event->year }}
                @if ($event->pindaan == "Y")
                <span>Pindaan Ke : {{ $event->pindaan_ke }}</span>
                @endif
                Pada {{ date('d/m/Y', strtotime($event->start)) }}</b></h3>
        </div>

        <div class="card-body">
            <div class="seating-container">
                <!-- Top row -->
                <div class="top-row">
                    @foreach ($top as $attendee)
                        <div class="seat">
                            {{ $attendee->susunan }}
                        </div>
                        <div class="text-center">
                            <strong>({{ $attendee->kekananan_mesy_manual }}) {{ $attendee->nama_ahli }}</strong><br>
                            <span>{{ $attendee->nama_jawatan }}</span><br>
                            @if(!empty($attendee->nama_kementerian))
                                <span>{{ $attendee->nama_kementerian }}</span>
                            @endif
                            @if($attendee->kehadiran !== 'Y')
                                <br>
                                <span class="badge badge-dark"><strong>Diwakili Oleh :</strong></span><br>
                                <span class="text-uppercase"><strong>{{ $attendee->wakil_oleh }}</strong></span><br>
                                <span>{{ $attendee->jawatan_wakil }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="row-container">
                    <!-- Left column -->
                    <div class="side-column-left">
                        @foreach ($left as $attendee)
                            <div class="seat-wrapper">
                                <div class="content-1">
                                    <strong>({{ $attendee->kekananan_mesy_manual }}) {{ $attendee->nama_ahli }}</strong><br>
                                    <span>{{ $attendee->nama_jawatan }}</span><br>
                                    @if(!empty($attendee->nama_kementerian))
                                        <span>{{ $attendee->nama_kementerian }}</span>
                                    @endif
                                    @if($attendee->kehadiran !== 'Y')
                                        <br>
                                        <span class="badge"><strong>Diwakili Oleh :</strong></span><br>
                                        <span class="text-uppercase"><strong>{{ $attendee->wakil_oleh }}</strong></span><br>
                                        <span>{{ $attendee->jawatan_wakil }}</span>
                                    @endif
                                </div>
                                <div class="seat">
                                    {{ $attendee->susunan }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Right column -->
                    <div class="side-column-right">
                        @foreach ($right as $attendee)
                            <div class="seat-wrapper">
                                <div class="seat">
                                    {{ $attendee->susunan }}
                                </div>
                                <div class="content-2">
                                    <strong>({{ $attendee->kekananan_mesy_manual }}) {{ $attendee->nama_ahli }}</strong><br>
                                    <span>{{ $attendee->nama_jawatan }}</span><br>
                                    @if(!empty($attendee->nama_kementerian))
                                        <span>{{ $attendee->nama_kementerian }}</span>
                                    @endif
                                    @if($attendee->kehadiran !== 'Y')
                                        <br>
                                        <span class="badge"><strong>Diwakili Oleh :</strong></span><br>
                                        <span class="text-uppercase"><strong>{{ $attendee->wakil_oleh }}</strong></span><br>
                                        <span>{{ $attendee->jawatan_wakil }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
    </div>
</body>

<script>
    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
</html>

@endsection
