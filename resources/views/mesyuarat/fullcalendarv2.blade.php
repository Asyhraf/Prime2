@extends('layouts.customtheme')

@section('content')

@if($event -> isEmpty())
<p>Tiada Maklumat</p>
@else


<!DOCTYPE html>
<html>

<head>
    <title>Takwim</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\jquery-3.1.1.min.js"></script>
    <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\moment.min.js"></script>
    <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\fullcalendar-3.9.0.js"></script>
    <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\toastr.js"></script>
    <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\jquery-1.12.1.js"></script>
    <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\jquery-1.12.4.js"></script>
    <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\sweetalert-2.1.2.min.js"></script>
    <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\sweetalert-1.1.3.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdpn.io/cpe/boomboom/pen.js?key=pen.js-e12d565a-bcb4-81ac-4bde-00d2dbbf2a9a" crossorigin></script>

    <style>
        #dialog {
            display: none;
        }

        .closeon {
            color: black;
            position: absolute;
            border: 1px solid black;
            top: 0;
            right: 0;
            width: 13px;
            height: 13px;
            text-align: center;
            border-radius: 40%;
            font-size: 10px;
            cursor: pointer;
            background-color: #FFF
        }

        .closeBtn {
            color: black;
            position: absolute;
            border: 1px solid black;
            top: 0;
            right: 0;
            width: 13px;
            height: 13px;
            text-align: center;
            border-radius: 50%;
            font-size: 10px;
            cursor: pointer;
            background-color: #FFF
        }

        .fc-icon-print::before {
            font-family: 'Material Icons';
            content: " \e8ad";
            font-size: 24px;
        }

        @media print {
            .print-visible {
                display: inherit !important;
            }

            .hidden-print {
                display: none !important;
            }
        }

        .ui-widget {
            font-size: 15px;
            font-family: 'Poppins-Regular';
        }

        .ui-widget input,
        .ui-widget select,
        .ui-widget textarea,
        .ui-widget button {
            font-family: 'Poppins-Regular';
            font-size: 15px;
        }

        .fc-day-header {
            text-transform: uppercase;
            font-size: 15px;
            font-family: 'Poppins-Regular';
            font-weight: bold;
            color: #212529;
            background-color: #FAFAFA;
            padding: 12px 0px !important;
            text-decoration: none;
        }

        .fc-day-header a {
            text-decoration: none !important;
            color: #505363;
        }

        .fc-week-number {
            text-align: center;
            text-transform: uppercase;
            font-size: 15px;
            font-family: 'Poppins-Regular';
            font-weight: bold;
            color: #212529;
            padding: 12px 0px !important;
            background-color: #FAFAFA;
            text-decoration: none;
        }

        .fc-week-number a {
            text-decoration: none !important;
            color: #505363;
        }

        .filter {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .filter h7,
        .filter label {
            margin: 0 10px;
        }

        .event_filter_wrapper {
            display: flex;
            align-items: center;
        }

        .form-group-row {
            margin: 0;
            flex-grow: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            text-align: right;
        }

        .popoverTitleCalendar {
            width: 100%;
            height: 100%;
            padding: 15px 15px;
            font-family: 'Poppins-Regular';
            font-size: 13px;
            border-radius: 5px 5px 0 0;
        }

        .popoverInfoCalendar i {
            font-size: 14px;
            margin-right: 10px;
            line-height: inherit;
            color: #d3d4da;
        }

        .popoverInfoCalendar p {
            margin-bottom: 1px;
        }

        .popoverDescCalendar {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #E3E3E3;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .popover-title {
            background: transparent;
            font-weight: 600;
            padding: 0 !important;
            border: none;
        }

        .popover-content {
            padding: 15px 15px;
            font-family: 'Poppins-Regular';
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h3 class="text-center"><b>PORTAL MESYUARAT & AKTIVITI</b></h3>
            <hr class="mt-4 mb-4">

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <span class="badge badge-pill badge-success">Success</span>
                <b>{{ session('status') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            <div class="container">
                <div class="filter b-grey">
                    <div class="form-group col-12 text-right">
                        <label for="ShowWeekends" class="form-label" style="font-size: 12pt;">
                            Kalendar Hujung Minggu
                            <input class="showHideWeekend" type="checkbox" checked>
                        </label>
                        <div class="card-header"></div>
                    </div>
                    <div class="mb-4">
                        <label for="calendar_view" class="d-block text-center">Mesyuarat / Aktiviti :</label>
                        <div class="event_filter_wrapper d-flex justify-content-between flex-wrap">
                            <div class="form-group-row mb-2">
                                <input id="event_ksukp" class="filter" type="checkbox" value="KSUKP" checked />
                                <label for="event_ksukp" class="checkbox-inline" style="font-size: 12pt;">KSUKP</label>
                            </div>
                            <div class="form-group-row mb-2">
                                <input id="event_jkppn" class="filter" type="checkbox" value="JKPPN" checked />
                                <label for="event_jkppn" class="checkbox-inline" style="font-size: 12pt;">JKPPN</label>
                            </div>
                            <div class="form-group-row mb-2">
                                <input id="event_kjp" class="filter" type="checkbox" value="KJP" checked />
                                <label for="event_kjp" class="checkbox-inline" style="font-size: 12pt;">KJP</label>
                            </div>
                            <div class="form-group-row mb-2">
                                <input id="event_kebbp" class="filter" type="checkbox" value="KEBBP" checked />
                                <label for="event_kebbp" class="checkbox-inline" style="font-size: 12pt;">KEBBP</label>
                            </div>
                            <div class="form-group-row mb-2">
                                <input id="event_mbkm" class="filter" type="checkbox" value="MBKM" checked />
                                <label for="event_mbkm" class="checkbox-inline" style="font-size: 12pt;">MBKM</label>
                            </div>
                            <div class="form-group-row mb-2">
                                <input id="cuti_am" class="filter" type="checkbox" value="Cuti AM" checked />
                                <label for="cuti_am" class="checkbox-inline" style="font-size: 12pt;">Cuti AM</label>
                            </div>
                            <div class="form-group-row mb-2">
                                <input id="event_cuti_persekolahan" class="filter" type="checkbox" value="Cuti Persekolahan" checked />
                                <label for="event_cuti_persekolahan" class="checkbox-inline" style="font-size: 12pt;">Cuti Persekolahan</label>
                            </div>
                            <div class="form-group-row mb-2">
                                <input id="event_dewan_rakyat" class="filter" type="checkbox" value="Dewan Rakyat" checked />
                                <label for="event_dewan_rakyat" class="checkbox-inline" style="font-size: 12pt;">Dewan Rakyat</label>
                            </div>
                            <div class="form-group-row mb-2">
                                <input id="event_dewan_negara" class="filter" type="checkbox" value="Dewan Negara" checked />
                                <label for="event_dewan_negara" class="checkbox-inline" style="font-size: 12pt;">Dewan Negara</label>
                            </div>
                            <div class="form-group-row mb-2">
                                <input id="event_mrr" class="filter" type="checkbox" value="MRR" checked />
                                <label for="event_mrr" class="checkbox-inline" style="font-size: 12pt;">MRR</label>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Calendar -->
                <div id='calendar'></div>

                <div id="wrapper">
                    <div id="loading"></div>
                    <div class="print-visible" id="calendar"></div>
                </div>
            </div>
        </div>

        <!-- day click dialog-->
        <div id="dialog">
            <div id="dialog-body">
                <form id="dayclick" method="post" action="{{route('eventStore')}}">
                    @csrf

                    <div class="form-group mt-2">
                        <label><b>TAJUK</b></label>
                        <select class="color form-control" name="title" id="title" onchange="myFunction(this)">
                            <option label="PILIH MESYUARAT / AKTIVITI" selected></option>
                            <optgroup label="____________________________________________________________________">
                                @forelse ($ref_tajuk_mesyuarat as $counter => $tajuk)
                                <option value="{{ $tajuk->ringkasan }}" data-color="{{ $tajuk->color }}" data-aktiviti="{{ $tajuk->Activity->nama_aktiviti }}" data-aktiviti2="{{ $tajuk->aktiviti }}">{{ $tajuk->nama_tajuk }}</option><br>
                                @empty
                                <p>No </p>
                                @endforelse
                        </select>
                    </div>

                    <script src="{{asset('js/jquery.js')}}"></script>
                    <script src="C:\xampp\htdocs\prime2\public\loginv5\vendor\jquery\jquery-2.1.1.min.js"></script>

                    <!-- *** IMPORTANT *** -->
                    <!-- # = Id Selector
                . = Class Selector -->

                    <script>
                        $("#aktivitiHide2").hide();
                        $('.color').change(function() {

                            $('#color').val($(".color option:selected").data('color'));
                            $('#aktiviti').val($(".color option:selected").data('aktiviti'));
                            var jenisAktiviti = $('#aktivitiHide').val($(".color option:selected").data('aktiviti2'));


                            if ($(this).val() == "KSUKP" || $(this).val() == "JKPPN" || $(this).val() == "KJP" || $(this).val() == "KEBBP" || $(this).val() == "MBKM" || $(this).val() == "MRR") {
                                $("#aktivitiHide2").show();
                                $("#locationHide").show();
                                $("#agendaHide").show();
                                $("#linkhadirHide").show();
                                $("#meeting_numberHide").show();
                                $("#actHide").hide();
                                $("#status_PindaanHide").show();

                            } else {
                                $("#aktivitiHide2").hide();
                                $("#locationHide").hide();
                                $("#agendaHide").hide();
                                $("#linkhadirHide").hide();
                                $("#meeting_numberHide").hide();
                                $("#actHide").hide();
                                $("#status_PindaanHide").hide();
                            }
                        });
                    </script>

                    <style>
                        #aktivitiHide2 {
                            display: none
                        }

                        #locationHide {
                            display: none
                        }

                        #agendaHide {
                            display: none
                        }

                        #linkhadirHide {
                            display: none
                        }

                        #meeting_numberHide {
                            display: none
                        }

                        #actHide {
                            display: none
                        }

                        #status_PindaanHide {
                            display: none
                        }
                    </style>

                    <div class="form-group" id="actHide">
                        <label><b>JENIS AKTIVITI</b></label>
                        <input type="text" id="aktiviti" class="form-control" name="aktiviti" placeholder="{{ $tajuk->Activity->nama_aktiviti }}">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label" for="title"><b>SEPANJANG HARI ?</b></label>&nbsp;&nbsp;&nbsp;
                            <input class='allDayNewEvent' type="checkbox"></label>
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                    <div class="col-md-6">
                        <div class="form-group1">
                            <label class="col-form-label"><b>MULA</b></label>
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input type="text" placeholder="Mula Mesyuarat" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group1">
                            <label class="col-form-label"><b>TAMAT</b></label>
                            <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                <input type="text" placeholder="Tamat Mesyuarat" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
                                <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                    <div class="form-group row">
                        <div class="col-md-3">
                            <div class="form-group1">
                                <label class="col-form-label"><b>TARIKH MULA</b></label>
                                <input type="date" id="start" class="form-control" name="start" placeholder="Tarikh Mula Mesyuarat">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group1">
                                <label class="col-form-label"><b>TARIKH AKHIR</b></label>
                                <input type="date" id="end" class="form-control" name="end" placeholder="Tarikh Akhir Mesyuarat">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group1">
                                <label class="col-form-label"><b>MASA MULA</b></label>
                                <input type="time" id="time1" class="form-control" name="time1" placeholder="Masa Mesyuarat">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group1">
                                <label class="col-form-label"><b>MASA AKHIR</b></label>
                                <input type="time" id="time2" class="form-control" name="time2" placeholder="Masa Akhir Mesyuarat">
                            </div>
                        </div>
                    </div>

                    <p></p>
                    <div class="form-group" id="locationHide">
                        <label><b>LOKASI MESYUARAT</b></label>
                        <input type="text" id="location" class="form-control" name="location" placeholder="Lokasi Mesyuarat" value="Akan dimaklumkan kelak">
                    </div>

                    <div class="form-group" id="agendaHide">
                        <label><b>AGENDA MESYUARAT</b></label>
                        <input type="text" id="agenda" class="form-control" name="agenda" placeholder="Agenda Mesyuarat" value="Akan dimaklumkan kelak">
                    </div>

                    <div class="form-group" id="meeting_numberHide">
                        <label><b>BILANGAN MESYUARAT</b></label>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="col-form-label">Bilangan :</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="meeting_numbers" id="meeting_numbers">
                                    <option label="Sila pilih"></option>
                                    <optgroup label="_____________">
                                        <script>
                                            for (var i = 1; i <= 12; i++) {
                                                document.write('<option value="' + i + '">' + i + '</option>');
                                            }
                                        </script>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="col-form-label">Tahun :</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="year" id="year">
                                    <option label="Sila pilih"></option>
                                    <optgroup label="_____________">
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
                        </div>
                    </div>

                    <div class="form-group" id="status_PindaanHide">
                        <label><b>STATUS PINDAAN</b></label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group1">
                                    <label class="col-form-label" for="radioYes">Ya</label>&nbsp;
                                    <input style="width:9%;" type="radio" id="radioYes" name="pindaan" value="Y" onclick="addmentor()">&nbsp;
                                    <label class="col-form-label" for="radioNo">Tidak</label>&nbsp;
                                    <input style="width:9%;" type="radio" id="radioNo" name="pindaan" value="N" onclick="hideInputDiv()" checked>
                                </div>
                            </div>

                            <div class="col-md-9" id="myDIV" style="display: none;">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="col-form-label">Pindaan Ke :</label>
                                        <select class="custom-select" name="pindaan_ke" id="pindaan_ke" style="width:50%;">
                                            <option label="Berapa"></option>
                                            <optgroup label="_____">
                                                <script>
                                                    // Define the start and end of the range
                                                    var startNumber = 1;
                                                    var endNumber = 12;

                                                    // Loop through the range and generate options
                                                    for (var i = startNumber; i <= endNumber; i++) {
                                                        document.write('<option value="' + i + '">' + i + '</option>');
                                                    }
                                                </script>
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="statuspin" class="col-form-label"><b>Sahkan Pindaan</b></label>&nbsp;&nbsp;<input type="checkbox" id="statuspin" name="statuspin" value="1" checked>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

                    <script>
                        function addmentor() {

                            document.getElementById('myDIV').style.display = "block";
                        }

                        function hideInputDiv(index) {
                            document.getElementById('myDIV').style.display = "none";
                        }
                    </script>

                    <p></p>

                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label><b>WARNA</b></label>
                            <input class="form-control" id="color" type="color" name="color">
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>WARNA TULISAN</b></label>
                            <input class="form-control" type="color" name="textColor">
                        </div>
                    </div>

                    <input type="hidden" id="eventId" name="event_id">

                    <div class="form-group">
                        <button id="update" type="submit" class="btn btn-success rounded"><i class="fa fa-calendar-plus-o"></i> Tambah Mesyuarat </button>
                        <a class="btn btn-danger rounded" id="deleteEvent" href="" style="color:white;"><i class="fa fa-calendar-times-o"></i> Padam Mesyuarat</a>
                    </div>
                </form>
            </div>
        </div>


        <!--day click dialog end-->

        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/moment.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{asset('js/fullcalendar.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>

        <script>
            $(document).ready(function() {
                function convert(str) {
                    const d = new Date(str);
                    let month = '' + (d.getMonth() + 1);
                    let day = '' + d.getDate();
                    let year = d.getFullYear();
                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;
                    return [year, month, day].join('-');
                }

                // Assuming you have initialized your FullCalendar instance as shown below:
                var calendar = $('#calendar').fullCalendar({

                    eventRender: function(event, element, view) {
                        var startTimeEventInfo = moment(event.start).format('HH:mm A');
                        var endTimeEventInfo = moment(event.end).format('HH:mm A');
                        var displayEventDate;

                        if (event.allDay == false) {
                            displayEventDate = startTimeEventInfo + " - " + endTimeEventInfo;
                        } else {
                            displayEventDate = "All Day";
                        }

                        var show_title = true;

                        // Get the status of the "Mesyuarat / Aktiivti" checkboxes
                        var title = $('input:checkbox.filter:checked').map(function() {
                            return $(this).val();
                        }).get();

                        // Check if the event title matches any of the selected checkboxes
                        show_title = title.indexOf(event.title) >= 0;

                        return show_title;
                    },
                    selectable: true,
                    weekNumbers: true,
                    height: 720,
                    showNonCurrentDates: false,
                    editable: false,
                    defaultView: 'month',
                    yearColumns: 3,
                    eventLimit: 1,
                    navLinks: true,
                    displayEventTime: true,
                    header: {
                        left: 'today, prevYear, nextYear, printButton',
                        center: 'prev, title, next',
                        right: 'month,agendaWeek,agendaDay,listWeek'
                    },
                    views: {
                        month: {
                            columnFormat: 'dddd'
                        },
                        agendaWeek: {
                            columnFormat: 'ddd D/M',
                            eventLimit: false,
                            titleFormat: 'D MMM YYYY'
                        },
                        agendaDay: {
                            columnFormat: 'dddd',
                            eventLimit: false,
                            titleFormat: 'D MMM YYYY'
                        },
                        listWeek: {
                            columnFormat: 'ddd D/M',
                            eventLimit: false,
                            titleFormat: 'D MMM YYYY'
                        }
                    },
                    loading: function(bool) {
                        //alert('events are being rendered');
                    },
                    customButtons: {
                        printButton: {
                            icon: 'print',
                            click: function() {
                                window.print();
                            }
                        }
                    },

                    events: "{{route('allEvent')}}",
                    dayClick: function(date, jsEvent, view) {
                        var dateStr = convert(date);
                        $('#start').val(dateStr);
                        $('#end').val(dateStr);
                        $('#update').html('<i class="fa fa-calendar-plus-o"></i> Tambah Mesyuarat');
                        $('#deleteEvent').html('<i class="fa fa-calendar-times-o"></i> Padam Mesyuarat').hide();
                        $('#dialog').dialog({
                            title: 'TAMBAH MAKLUMAT AKTIVITI',
                            width: 'auto',
                            height: 'auto',
                            modal: true,
                            show: {
                                effect: 'clip',
                                duration: 350
                            },
                            hide: {
                                effect: 'clip',
                                duration: 250
                            }
                        });
                    },
                    select: function(start, end) {
                        var adjustedEnd = moment(end).format('YYYY-MM-DD');
                        $('#start').val(convert(start));
                        $('#end').val(adjustedEnd);
                        $('#update').html('<i class="fa fa-calendar-plus-o"></i> Tambah Mesyuarat');
                        $('#deleteEvent').html('<i class="fa fa-calendar-times-o"></i> Padam Mesyuarat').hide();
                        $('#dialog').dialog({
                            title: 'TAMBAH MAKLUMAT AKTIVITI',
                            width: 'auto',
                            height: 'auto',
                            modal: true,
                            show: {
                                effect: 'clip',
                                duration: 350
                            },
                            hide: {
                                effect: 'clip',
                                duration: 250
                            }
                        });
                    },
                    eventClick: function(event) {
                        if (!event.end) event.end = event.start;
                        $('#title').val(event.title);
                        $('#start').val(convert(event.start));
                        $('#end').val(convert(event.end));
                        $('#time1').val(event.time1);
                        $('#time2').val(event.time2);
                        $('#meeting_numbers').val(event.meeting_numbers);
                        $('#location').val(event.location);
                        $('#agenda').val(event.agenda);
                        $('#linkhadir').val(event.linkhadir);
                        $('#year').val(event.year);
                        $('#color').val(event.color);
                        $('#textColor').val(event.textColor);
                        $('#eventId').val(event.id);
                        $('#statuspin').val(event.statuspin);
                        $('#pindaan').val(event.pindaan);
                        $('#pindaan_ke').val(event.pindaan_ke);
                        $('#update').html('<i class="fa fa-calendar-check-o"></i> Kemaskini Mesyuarat');
                        $('#deleteEvent').html('<i class="fa fa-calendar-times-o"></i> Padam Mesyuarat').show();

                        var url = "{{url('/m_SelenggaraKalendar')}}";
                        $('#deleteEvent').attr('href', url + '/' + event._id);

                        $('#dialog').dialog({
                            title: 'KEMASKINI / PADAM MAKLUMAT AKTIVITI',
                            width: 'auto',
                            height: 'auto',
                            modal: true,
                            show: {
                                effect: 'clip',
                                duration: 350
                            },
                            hide: {
                                effect: 'clip',
                                duration: 250
                            }
                        });
                    },
                });

                // Event listener to re-render the calendar when a checkbox is changed
                $('input:checkbox.filter').on('change', function() {
                    $('#calendar').fullCalendar('rerenderEvents');
                });

                // Show current time in input fields
                function setCurrentTime() {
                    const now = new Date();
                    const hours = now.getHours().toString().padStart(2, '0');
                    const minutes = now.getMinutes().toString().padStart(2, '0');
                    return `${hours}:${minutes}`;
                }
                // Function to calculate the time 1 hour after the given time
                function addOneHour(time) {
                    const [hours, minutes] = time.split(':').map(Number);
                    const newTime = new Date();
                    newTime.setHours(hours + 1);
                    newTime.setMinutes(minutes);

                    const newHours = newTime.getHours().toString().padStart(2, '0');
                    const newMinutes = newTime.getMinutes().toString().padStart(2, '0');
                    return `${newHours}:${newMinutes}`;
                }

                // Set the values of time1 and time2 input fields
                const currentTime = setCurrentTime();
                $('#time1').val(currentTime);
                $('#time2').val(addOneHour(currentTime));

                // Show/hide end date input based on all-day checkbox
                $('.allDayNewEvent').on('change', function() {
                    $('#end, #time2').prop('disabled', $(this).is(':checked'));
                });

                // Set default view calendar
                var defaultCalendarView = $("#calendar_view").val();
                $('#calendar').fullCalendar('changeView', defaultCalendarView);

                $('#calendar_view').on('change', function() {
                    var defaultCalendarView = $("#calendar_view").val();
                    $('#calendar').fullCalendar('changeView', defaultCalendarView);
                });

            });

            //SHOW - HIDE WEEKENDS

            var activeInactiveWeekends = false;
            checkCalendarWeekends();

            $('.showHideWeekend').on('change', function() {
                checkCalendarWeekends();
            });

            function checkCalendarWeekends() {

                if ($('.showHideWeekend').is(':checked')) {
                    activeInactiveWeekends = true;
                    $('#calendar').fullCalendar('option', {
                        weekends: activeInactiveWeekends
                    });
                } else {
                    activeInactiveWeekends = false;
                    $('#calendar').fullCalendar('option', {
                        weekends: activeInactiveWeekends
                    });
                }

            }
        </script>
    </div>
</body>

</html>

@endif
@endsection