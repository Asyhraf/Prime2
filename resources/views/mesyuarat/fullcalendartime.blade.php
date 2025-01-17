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

        /* i {
            color: white;
        } */
    </style>


</head>
<br><br>


<body>
    <div class="container">
        <div class="mb-5">
            <br />
            <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>Portal Menambah Mesyuarat & Aktiviti</i></h1>
            <br />
        </div>
        <div id="calendar"></div>

        <form class="theme-form mega-form" method="POST">
            {{csrf_field()}}
            @foreach($errors ->all() as $errors)
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $errors }}</li>
                </ul>
            </div>
            @endforeach
            @if(session ('status'))
            <div class="alert alert-sucess" role="alert" align="center">
                <span class="badge badge-info">{{ session ('status')}}</span>
            </div>
            @endif
        </form>
    </div>

    <!-- day click dialog-->
    <div id="dialog">
        <div id="dialog-body">
            <form id="dayclick" method="post" action="{{route('eventStore')}}">
                @csrf


                <div class="form-group">
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


                        if ($(this).val() == "KSUKP" || $(this).val() == "JKPPN" || $(this).val() == "KJP" || $(this).val() == "KEBBP" || $(this).val() == "MBKM" || $(this).val() == "YAB MBKM") {
                            $("#aktivitiHide2").show();
                            $("#locationHide").show();
                            $("#agendaHide").show();
                            $("#linkhadirHide").show();
                            $("#meeting_numberHide").show();
                            $("#actHide").hide();

                        } else {
                            $("#aktivitiHide2").hide();
                            $("#locationHide").hide();
                            $("#agendaHide").hide();
                            $("#linkhadirHide").hide();
                            $("#meeting_numberHide").hide();
                            $("#actHide").hide();
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
                </style>

                <div class="form-group" id="actHide">
                    <label><b>JENIS AKTIVITI</b></label>
                    <input type="text" id="aktiviti" class="form-control" name="aktiviti" placeholder="{{ $tajuk->Activity->nama_aktiviti }}">
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="form-group1">
                            <label class="col-form-label"><b>TARIKH MULA</b></label>
                            <input type="date" id="start" class="form-control" name="start" placeholder="Tarikh Mesyuarat">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group1">
                            <label class="col-form-label"><b>TARIKH AKHIR</b></label>
                            <input type="date" id="end" class="form-control" name="end" placeholder="Tarikh Akhir Aktiviti">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group1">
                            <label class="col-form-label"><b>MASA</b></label>
                            <input type="time" id="time" class="form-control" name="time" placeholder="Masa Mesyuarat">
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
                                        for (var i = 0; i <= 10; i++) {
                                            var year = currentYear + i;
                                            document.write('<option value="' + year + '">' + year + '</option>');
                                        }
                                    </script>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

                <p></p>

                <div class="form-group" id="linkhadirHide">
                    <label><b>PAUTAN PENGESAHAN KEHADIRAN</b></label>
                    <small class="text-muted"> (Jika perlu - Contoh: https://xxxx)</small>
                    <input type="text" id="linkhadir" class="form-control" name="linkhadir" placeholder="Pautan Pengesahan Kehadiran" value="https://">
                </div>

                <!-- <div class="form-group" id="pautanmesyuaratHide">
                    <label><b>PAUTAN MESYUARAT</b></label>
                    <input type="text" id="pautanmesyuarat" class="form-control" name="location" placeholder="Pautan Mesyuarat" value="https://join.pmo.gov.my/">
                </div> -->

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

    <!-- jquery -->
    <script src="{{asset('js/jquery.min.js')}}"></script>

    <!-- moment js -->
    <script src="{{asset('js/moment.js')}}"></script>

    <!-- Jquery UI Js -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <!-- Full calendar js -->
    <script src="{{asset('js/fullcalendar.js')}}"></script>

    <script>
        // Get the current time in HH:mm format
        function getCurrentTime() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            return `${hours}:${minutes}`;
        }

        // Set the current time as the default value for the time input
        document.getElementById('time').value = getCurrentTime();
    </script>

    <script>
        $(document).ready(function($) {

            function convert(str) {
                const d = new Date(str);
                let month = '' + (d.getMonth() + 1);
                let day = '' + d.getDate();
                let year = d.getFullYear();
                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;
                let hour = '' + d.getUTCHours();
                let minutes = '' + d.getUTCMinutes();
                let seconds = '' + d.getUTCSeconds();
                if (hour.length < 2) hour = '0' + hour;
                if (minutes.length < 2) minutes = '0' + minutes;
                if (seconds.length < 2) seconds = '0' + seconds;
                // return [year,month,day].join('-')+'  '+[hour,minutes,seconds].join(':');
                return [year, month, day].join('-');
                // return [day,month,year].join('-')+' Jam: '+[hour,minutes,seconds].join(':');

            };

            // $('#addEventButton').on('click', function() {
            //     $('#dialog').dialog({
            //         title: 'TAMBAH MAKLUMAT AKTIVITI',
            //         width: 650,
            //         height: 'auto',
            //         modal: true,
            //         show: {
            //             effect: 'clip',
            //             duration: 350
            //         },
            //         hide: {
            //             effect: 'clip',
            //             duration: 250
            //         }
            //     })
            // })

            var calendar = $('#calendar').fullCalendar({
                selectable: true,
                height: 720,
                showNonCurrentDates: false,
                editable: true,
                defaultView: 'month',
                yearColumns: 3,
                displayEventTime: true,
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'Ayear,month,basicWeek,basicDay'
                },

                events: "{{route('allEvent')}}",
                dayClick: function(date, event, view) {
                    $('#start').val(convert(date));
                    $('#update').html('<i class="fa fa-calendar-plus-o"></i> Tambah Mesyuarat');
                    $('#deleteEvent').html('<i class="fa fa-calendar-times-o"></i> Padam Mesyuarat').hide();
                    $('#dialog').dialog({
                        title: 'TAMBAH MAKLUMAT AKTIVITI',
                        width: 650,
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
                    })
                },

                select: function(start, end) {
                    $('#title').val(event.title);
                    $('#start').val(convert(start));
                    $('#end').val(convert(end));
                    $('#color').val(event.color);
                    $('#update').html('<i class="fa fa-calendar-plus-o"></i> Tambah Mesyuarat');
                    $('#deleteEvent').html('<i class="fa fa-calendar-times-o"></i> Padam Mesyuarat').hide();
                    $('#dialog').dialog({
                        title: 'TAMBAH MAKLUMAT AKTIVITI',
                        width: 650,
                        height: 'auto',
                        modal: true,
                        show: {
                            effect: 'clip',
                            duration: 350
                        },
                        hide: {
                            effect: 'clip',
                            duration: 250
                        },
                    })
                },

                eventClick: function(event) {
                    console.log(event);
                    $('#title').val(event.title);
                    $('#start').val(convert(event.start));
                    $('#end').val(convert(event.end));
                    $('#meeting_numbers').val(event.meeting_numbers);
                    $('#location').val(event.location);
                    $('#agenda').val(event.agenda);
                    $('#linkhadir').val(event.linkhadir);
                    $('#year').val(event.year);
                    $('#color').val(event.color);
                    $('#textColor').val(event.textColor);
                    $('#eventId').val(event.id);
                    $('#update').html('<i class="fa fa-calendar-check-o"></i> Kemaskini Mesyuarat');
                    $('#deleteEvent').html('<i class="fa fa-calendar-times-o"></i> Padam Mesyuarat').show();

                    var url = "{{url('/m_SelenggaraKalendar')}}";
                    $('#deleteEvent').attr('href', url + '/' + event._id);

                    // var action="{{ route('padam_mesyuarat2') }}"
                    // $('#deleteEvent').attr('href',url+'/'+$event->id);
                    $('#dialog').dialog({
                        title: 'KEMASKINI / PADAM MAKLUMAT AKTIVITI',
                        width: 650,
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
                    })
                },
            });
        });
    </script>

</body>

</html>

@endif
@endsection