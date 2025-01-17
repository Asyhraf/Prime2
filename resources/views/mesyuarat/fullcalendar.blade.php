@extends('layouts.customtheme')
@section('content')

<!DOCTYPE html>
<html>

<head>
    <title>Takwim</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Load jQuery and other libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->
    <!-- <script src="{{ asset('loginv5/vendor/jquery/toastr.js') }}"></script>
    <script src="{{ asset('loginv5/vendor/jquery/sweetalert-2.1.2.min.js') }}"></script>
    <script src="{{ asset('loginv5/vendor/jquery/jquery-3.1.1.min.js') }}"></script> -->


    <!-- Link to CSS stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link href="https://fonts.googleapis.com/css?family=Poppins-Regular"> -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        /* Your custom styles */
        #dialog {
            display: none;
        }

        .closeon,
        .closeBtn {
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
            background-color: #FFF;
        }

        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            /* Preferred icon size */
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;

            /* Support for all WebKit browsers. */
            -webkit-font-smoothing: antialiased;
            /* Support for Safari and Chrome. */
            text-rendering: optimizeLegibility;

            /* Support for Firefox. */
            -moz-osx-font-smoothing: grayscale;

            /* Support for IE. */
            font-feature-settings: 'liga';
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

            /* Hide elements by class or ID */
            .left-panel, .header, .footer {
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

        .fc-day-header,
        .fc-week-number {
            text-transform: uppercase;
            font-size: 15px;
            font-family: 'Poppins-Regular';
            font-weight: bold;
            color: #212529;
            background-color: #FAFAFA;
            padding: 12px 0px !important;
            text-decoration: none;
        }

        .fc-day-header a,
        .fc-week-number a {
            text-decoration: none !important;
            color: #505363;
        }

        /* Center event titles in the month view */
        .fc-month-view .fc-event .fc-title {
            text-align: center;
            display: block; /* Ensures that the text behaves like a block element, allowing centering */
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

        .fc .fc-axis {
            vertical-align: middle;
            padding: 0 4px;
            white-space: nowrap;
            font-size: 10px;
            color: #505362;
            text-transform: uppercase;
            text-align: center !important;
            background-color: #fafafa;
        }

        .fc-unthemed .fc-event .fc-content,
        .fc-unthemed .fc-event-dot .fc-content {
            padding: 5px 20px 5px 22px;
            font-family: 'Poppins-Regular';
            margin-left: -1px;
            height: 100%;
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

        .hover-event-tooltip {
            position: absolute;
            z-index: 1060;
            background-color: #FFFFFF;
            /* color: white; */
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            display: none;
            white-space: nowrap;
            border-radius: 6px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        }

        .popover-title {
            padding: 8px 14px;
            margin: 0;
            font-size: 14px;
            /* background-color: #f7f7f7; */
            border-bottom: 1px solid #ebebeb;
            border-radius: 5px 5px 0 0;
        }

        .popover-content {
            padding: 9px 14px;
        }

        #calendar {
            width: 100%;
            height: auto; /* Makes it scale proportionally */
            max-width: 1200px; /* Limit the maximum width */
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            #calendar {
                max-width: 100%; /* Full width for tablets */
                height: auto; /* Ensure it resizes properly */
            }
        }

        @media (max-width: 576px) {
            #calendar {
                max-width: 100%; /* Full width for smaller screens */
            }
        }
    </style>
</head>

<body>
    <div class="card">

        <div class="card-header">
            <div class="col-2"></div>
            <div class="col-8">
                <h3 class="text-center"><b>PORTAL MESYUARAT & AKTIVITI</b></h3>
            </div>
            <div class="col-2 text-right pr-0">
                <button class="btn btn-primary btn-sm rounded" data-toggle="collapse" data-target="#collapseicon" aria-expanded="true" aria-controls="#collapseicon">Filter <i class="fa fa-chevron-down"></i></button>
            </div>
        </div>

        <div class="card-body">

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <span class="badge badge-pill badge-success">Success</span>
                <b>{{ session('status') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            <div>
                <div class="collapse" id="collapseicon" aria-labelledby="collapseicon">
                    <div class="filter b-grey">
                        <div class="form-group col-12 pl-0 text-right">
                            <label for="ShowWeekends" class="form-label" style="font-size: 12pt;">
                                Kalendar Hujung Minggu
                            </label>
                            <input id="ShowWeekends" class="showHideWeekend" type="checkbox" checked>
                        </div>
                        <div class="col-12 text-right">
                            <h7><b>Mesyuarat / Aktiviti</b></h7>
                            <div class="event_filter_wrapper d-flex flex-wrap">
                                <!-- Repeat this block for each filter option -->
                                @foreach(['KSUKP', 'JKPPN', 'KJP', 'KEBBP', 'MBKM', 'Cuti AM', 'Cuti Persekolahan', 'Dewan Rakyat', 'Dewan Negara', 'MRR'] as $filter)
                                <div class="form-group-row mb-2">
                                    <label for="event_{{ strtolower(str_replace(' ', '_', $filter)) }}" class="checkbox-inline" style="font-size: 12pt;">{{ $filter }}</label>
                                    <input id="event_{{ strtolower(str_replace(' ', '_', $filter)) }}" class="filter" type="checkbox" value="{{ $filter }}" checked />
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar -->
                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <div class="col-12" id="calendar"></div>
                </div>
            </div>

            <div id="wrapper">
                <div id="loading"></div>
                <div class="print-visible" id="calendar"></div>
            </div>
        </div>

        <!-- day click dialog-->
        <div id="dialog">
            <div id="dialog-body">
                <form id="dayclick" method="post" action="{{route('eventStore')}}">
                    @csrf

                    <!-- CSS Styles -->
                    <style>
                        #aktivitiHide2,
                        #locationHide,
                        #agendaHide,
                        #linkhadirHide,
                        #meeting_numberHide,
                        #actHide,
                        #status_PindaanHide {
                            display: none;
                        }
                    </style>

                    <!-- JavaScript -->
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            // Handle title change
                            $(".color").change(handleTitleChange);

                            // Ensure the "All Day" checkbox is unchecked by default
                            $('#allDay').prop('checked', false);

                            // Handle 'All Day' checkbox
                            $('.allDayNewEvent').change(function() {
                                const isChecked = $(this).is(':checked');
                                $('#start, #end, #time1, #time2').prop('disabled', isChecked);
                            });

                            // Handle Pindaan toggle
                            $('input[name="pindaan"]').change(togglePindaan);
                        });

                        function handleTitleChange() {
                            const selectedOption = $(".color option:selected");
                            $('#color').val(selectedOption.data('color') || '#000000');
                            $('#textColor').val(selectedOption.data('textColor') || '#000000');
                            $('#aktiviti').val(selectedOption.data('aktiviti') || '');
                            $('#aktivitiHide2').val(selectedOption.data('aktiviti2') || '');

                            const showFields = ["KSUKP", "JKPPN", "KJP", "KEBBP", "MBKM", "MRR"].includes(selectedOption.val());
                            $("#aktivitiHide2, #locationHide, #agendaHide, #linkhadirHide, #meeting_numberHide, #status_PindaanHide").toggle(showFields);
                        }

                        function togglePindaan() {
                            const isPindaanYes = $('#radioYes').is(':checked');
                            $('#myDIV').toggle(isPindaanYes);
                            $('#statuspin').prop('disabled', !isPindaanYes).prop('checked', isPindaanYes);
                            if (!isPindaanYes) {
                                $('#pindaan_ke').val(''); // Clear pindaan_ke selection
                            }
                        }
                    </script>

                    <div class="form-group mt-2">
                        <label><b>TAJUK</b></label>
                        <select class="color form-control" name="title" id="title" onchange="handleTitleChange()">
                            <option label="PILIH MESYUARAT / AKTIVITI" selected></option>
                            <optgroup label="____________________________________________________________________">
                                @forelse ($ref_tajuk_mesyuarat as $counter => $tajuk)
                                <option value="{{ $tajuk->ringkasan }}"
                                    data-color="{{ $tajuk->color }}"
                                    data-textColor="{{ $tajuk->textColor }}"
                                    data-aktiviti="{{ $tajuk->Activity->nama_aktiviti }}"
                                    data-aktiviti2="{{ $tajuk->aktiviti }}">
                                    {{ $tajuk->nama_tajuk }}
                                </option>
                                @empty
                                <option>No options available</option>
                                @endforelse
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group" id="actHide">
                        <label><b>JENIS AKTIVITI</b></label>
                        <input type="text" id="aktiviti" class="form-control" name="aktiviti" placeholder="{{ $tajuk->Activity->nama_aktiviti }}">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label" for="allDay"><b>SEPANJANG HARI ?</b></label>&nbsp;&nbsp;&nbsp;
                            <input class='allDayNewEvent' type="checkbox" id="allDay" name="allDay"></label>
                        </div>
                    </div>

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
                                    <label class="col-form-label" for="radioYes">Ya</label>
                                    <input style="width:9%;" type="radio" id="radioYes" name="pindaan" value="Y" onclick="togglePindaan()">
                                    <label class="col-form-label" for="radioNo">Tidak</label>
                                    <input style="width:9%;" type="radio" id="radioNo" name="pindaan" value="N" onclick="togglePindaan()" checked>
                                </div>
                            </div>

                            <div class="col-md-9" id="myDIV" style="display: none;">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="col-form-label">Pindaan Ke :</label>
                                        <select class="custom-select" name="pindaan_ke" id="pindaan_ke" style="width:50%;">
                                            <option label="Berapa"></option>
                                            <optgroup label="_____">
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="statuspin" class="col-form-label"><b>Sahkan Pindaan</b></label>
                                        <input type="checkbox" id="statuspin" name="statuspin" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label><b>WARNA</b></label>
                            <input class="form-control" id="color" type="color" name="color" value="#000000">
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>WARNA TULISAN</b></label>
                            <input class="form-control" id="textColor" type="color" name="textColor" value="#000000">
                        </div>
                    </div>

                    <input type="hidden" id="eventId" name="event_id">

                    <!-- Buttons for Form Actions -->
                    <div class="form-group">
                        <button id="saveEvent" type="submit" class="btn btn-success rounded">
                            <i class="fa fa-calendar-plus-o"></i> Tambah
                        </button>

                        <button id="deleteEvent" type="button" class="btn btn-danger rounded" style="display: none;">
                            <i class="fa fa-calendar-times-o"></i> Padam
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--day click dialog end-->

        <!-- JavaScript -->
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/moment.js')}}"></script>
        <script src="{{asset('js/fullcalendar.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script> -->

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                // Initialize FullCalendar
                $('#calendar').fullCalendar({
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
                            titleFormat: 'D MMMM YYYY'
                        },
                        agendaDay: {
                            columnFormat: 'dddd',
                            eventLimit: false,
                            titleFormat: 'D MMMM YYYY'
                        },
                        listWeek: {
                            columnFormat: 'ddd D/M',
                            eventLimit: false,
                            titleFormat: 'D MMMM YYYY'
                        }
                    },
                    customButtons: {
                        printButton: {
                            icon: 'print',
                            click: function() {
                                window.print();
                            }
                        }
                    },
                    locale: 'en-GB',
                    timezone: 'local',
                    showNonCurrentDates: false,
                    allDaySlot: true,
                    selectable: true,
                    selectHelper: true,
                    editable: true, // Allows editing (dragging, resizing)
                    droppable: true, // Allows external elements to be dropped
                    eventLimit: true,
                    navLinks: true,
                    minTime: '07:00:00',
                    maxTime: '23:00:00',
                    events: "{{ route('allEvent') }}", // Load events via AJAX

                    loading: function(bool) {
                        //alert('events are being rendered');
                    },

                    // Event Rendering
                    eventRender: function(event, element, view) {
                        var startTimeEventInfo = event.time1 ? moment(event.time1, 'HH:mm:ss').format('h:mm A') : '';
                        var endTimeEventInfo = event.time2 ? moment(event.time2, 'HH:mm:ss').format('h:mm A') : startTimeEventInfo;

                        var displayEventDate = event.allDay ? "All Day" : startTimeEventInfo + " - " + endTimeEventInfo;
                        // element.find('.fc-time, .fc-list-item-time').text(displayEventDate);

                        // Only show time if not in month view
                        if (view.name === 'month') {
                            // Hide time in month view
                            element.find('.fc-time').text(''); // Remove time in month view
                            element.find('.fc-title').css('font-weight', 'bold'); // Make the title bold in month view
                        } else {
                            element.find('.fc-time, .fc-list-item-time').text(displayEventDate); // Show time in other views
                        }

                        // Optionally, if you want to show custom tooltip on hover
                        element.hover(function() {
                            // Build the tooltip content
                            var tooltipContent = '<div class="hover-event-tooltip">' +
                                '<h5 class="popover-title" style="background-color: ' + event.color + ';">' +
                                '<strong>' + event.title + '</strong>' +
                                '</h5>' +
                                '<div class="popover-content">' +
                                'Masa: ' + displayEventDate + '<br>';

                            // Check if event.aktiviti is 'Mesyuarat', and only then include Bil. and Lokasi
                            if (event.aktiviti === 'Mesyuarat') {
                                tooltipContent += 'Bil. : ' + event.meeting_numbers + '/' + event.year + '<br>';

                                // Display Pindaan Ke if statuspin is 1
                                if (event.statuspin === 1) {
                                    tooltipContent += 'Pindaan Ke : ' + event.pindaan_ke + '<br>';
                                }

                                tooltipContent += 'Lokasi : ' + event.location;
                            }

                            tooltipContent += '</div></div>';

                            // Show the tooltip
                            $(tooltipContent).appendTo('body').fadeIn('fast');

                        }, function() {
                            // Remove the tooltip on mouseout
                            $('.hover-event-tooltip').remove();
                        });

                        // Adjust tooltip position on mouse move
                        element.mousemove(function(e) {
                            $('.hover-event-tooltip').css({
                                top: e.pageY + 10 + "px",
                                left: e.pageX + 10 + "px"
                            });
                        });


                        // Determine if the event should be shown based on the selected filters
                        var show_title = $('input:checkbox.filter:checked').map(function() {
                            return $(this).val();
                        }).get().indexOf(event.title) >= 0;

                        return show_title;
                    },

                    // Day Click: Open dialog to add new event
                    dayClick: function(date, jsEvent, view) {
                        resetDialog();
                        $('#start').val(date.format('YYYY-MM-DD'));
                        $('#end').val(date.format('YYYY-MM-DD'));

                        // Check if the 'allDay' checkbox is checked
                        $('#allDay').change(function() {
                            if ($(this).is(':checked')) {
                                // If allDay is checked, set default all-day times
                                $('#time1').val('00:00');
                                $('#time2').val('23:59');
                            } else {
                                // If not all-day, set default current time and +1 hour for time1 and time2
                                var currentTime = setCurrentTime();
                                $('#time1').val(currentTime);
                                $('#time2').val(addOneHour(currentTime));
                            }
                        });

                        // Set default time on page load (assuming not all day)
                        var currentTime = setCurrentTime();
                        $('#time1').val(currentTime);
                        $('#time2').val(addOneHour(currentTime));

                        openDialog('TAMBAH MESYUARAT / AKTIVITI');
                    },

                    // Handle selection of multiple days: Open dialog to add new event
                    select: function(start, end, jsEvent, view) {
                        resetDialog();
                        $('#start').val(moment(start).format('YYYY-MM-DD'));
                        $('#end').val(moment(end).subtract(1, 'days').format('YYYY-MM-DD'));

                        if ($('#allDay').is(':checked')) {
                            // If allDay is checked, set the entire day from 00:00 to 23:59
                            $('#time1').val('00:00');
                            $('#time2').val('23:59');
                        } else {
                            // Set default times when not an all-day event
                            $('#time1').val(setCurrentTime());
                            $('#time2').val(addOneHour(setCurrentTime()));
                        }
                        openDialog('TAMBAH MESYUARAT / AKTIVITI');
                    },

                    // Event Click: Open dialog to edit or delete event
                    eventClick: function(event, jsEvent, view) {
                        resetDialog();

                        if (!event.end) event.end = event.start;

                        $('#allDay').prop('checked', event.allDay === 1); // Set checkbox based on allDay value
                        $('#eventId').val(event.id);
                        $('#title').val(event.title || '');
                        $('#start').val(event.start ? moment(event.start).format('YYYY-MM-DD') : ''); // Format start date
                        $('#end').val(event.end ? moment(event.end).subtract(event.allDay ? 1 : 0, 'days').format('YYYY-MM-DD') : ''); // Subtract a day if allDay is true
                        $('#time1').val(event.time1 || '');
                        $('#time2').val(event.time2 || '');
                        $('#meeting_numbers').val(event.meeting_numbers || '');
                        $('#location').val(event.location || '');
                        $('#agenda').val(event.agenda || '');
                        $('#year').val(event.year || '');
                        $('#color').val(event.color || '');
                        $('#aktiviti').val(event.aktiviti || '');
                        $('#textColor').val(event.textColor || '');
                        // Populate form fields
                        $('#radioYes').prop('checked', event.pindaan === 'Y');
                        $('#radioNo').prop('checked', event.pindaan === 'N');
                        $('#pindaan_ke').val(event.pindaan_ke || '');
                        $('#statuspin').prop('checked', event.pindaan === 'Y');
                        // Trigger togglePindaan to update the UI
                        togglePindaan();
                        $('#saveEvent').html('<i class="fa fa-calendar-check-o"></i> Kemaskini');
                        $('#deleteEvent').show();
                        openDialog('KEMASKINI MESYUARAT / AKTIVITI');

                        // Handle allDay checkbox change
                        $('#allDay').change(function() {
                            if ($(this).is(':checked')) {
                                let endDate = $('#end').val();
                                let startDate = $('#start').val();
                                if (endDate && moment(endDate).isSameOrAfter(startDate)) {
                                    $('#end').val(moment(endDate).subtract(1, 'days').format('YYYY-MM-DD'));
                                }
                            }
                        });
                    },

                    // Callback when an event is dragged and dropped to a new date
                    eventDrop: function(event, delta, revertFunc) {
                        // Prepare event data to send for update
                        var eventData = {
                            id: event.id,
                            title: event.title,
                            aktiviti: event.aktiviti,
                            start: event.start.format('YYYY-MM-DD'),
                            end: event.end ? event.end.format('YYYY-MM-DD') : event.start.format('YYYY-MM-DD'),
                            time1: event.time1 || '', // Assuming time1 is stored in the event object
                            time2: event.time2 || '', // Assuming time2 is stored in the event object
                            allDay: event.allDay ? 1 : 0,
                            meeting_numbers: event.meeting_numbers,
                            year: event.year,
                            location: event.location,
                            agenda: event.agenda,
                            color: event.color,
                            textColor: event.textColor,
                            pindaan: event.pindaan,
                            pindaan_ke: event.pindaan_ke,
                            statuspin: event.statuspin,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        };

                        // AJAX request to update the event date
                        $.ajax({
                            url: "{{ route('eventUpdate') }}", // Your update route
                            type: 'PUT',
                            data: eventData,
                            success: function(response) {
                                alert('Mesyuarat/Aktiviti berjaya dikemaskini!');
                            },
                            error: function(xhr, status, error) {
                                alert('Ralat. Sila cuba lagi.');
                                revertFunc(); // Revert the event to its original position if an error occurs
                            }
                        });
                    }
                });

                // Handle checkbox change
                $('input:checkbox.filter').change(function() {
                    $('#calendar').fullCalendar('rerenderEvents');
                });

                // Handle weekend visibility checkbox
                $('.showHideWeekend').change(function() {
                    var showWeekends = $(this).is(':checked');
                    $('#calendar').fullCalendar('option', {
                        hiddenDays: showWeekends ? [] : [0, 6] // 0 = Sunday, 6 = Saturday
                    });
                });

                // Function to reset dialog form
                function resetDialog() {
                    $('#dayclick')[0].reset();
                    $('#eventId').val('');
                    // $('#saveEvent').text('Tambah');
                    $('#saveEvent').html('<i class="fa fa-calendar-plus-o"></i> Tambah');
                    $('#deleteEvent').hide();
                }

                // Function to open dialog
                function openDialog(title) {
                    $('#dialog').dialog({
                        title: title,
                        width: 'auto',
                        height: 'auto',
                        modal: true,
                        draggable: true, // Allow dragging if desired
                        resizable: true, // Prevent resizing if that's causing issues
                        close: function() { // Reset dialog when closed
                            resetDialog();
                        }
                    });
                }

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

                function formatEventTimes(event) {
                    // Assume `event.time1` and `event.time2` are stored in 'HH:mm' format in the database
                    var startDateTime = moment(event.startDate + 'T' + event.time1, 'YYYY-MM-DDTHH:mm').toISOString();
                    var endDateTime = moment(event.startDate + 'T' + event.time2, 'YYYY-MM-DDTHH:mm').toISOString();
                }

                // Store or Update Event
                $('#saveEvent').click(function(e) {
                    e.preventDefault();

                    // Gather event data from the form
                    var eventData = {
                        id: $('#eventId').val(), // ID field to check if it's an update or create operation
                        title: $('#title').val(),
                        start: $('#start').val(),
                        end: $('#end').val(),
                        time1: $('#time1').val(),
                        time2: $('#time2').val(),
                        location: $('#location').val(),
                        agenda: $('#agenda').val(),
                        meeting_numbers: $('#meeting_numbers').val(),
                        year: $('#year').val(),
                        color: $('#color').val(),
                        textColor: $('#textColor').val(),
                        aktiviti: $('#aktiviti').val(),
                        pindaan: $('input[name="pindaan"]:checked').val(),
                        pindaan_ke: $('#pindaan_ke').val(),
                        statuspin: $('#statuspin').val(),
                        allDay: $('#allDay').is(':checked') ? 1 : 0, // Convert checkbox state to 1 or 0
                        _token: $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included
                    };

                    // Determine the URL and HTTP method based on whether we are creating or updating
                    var url = "{{ route('eventStore') }}"; // Default route for storing events
                    var method = 'POST'; // Default method for creating a new event

                    if (eventData.id) {
                        // If 'id' is present, change to update operation
                        url = "{{ route('eventUpdate') }}"; // Update to your actual update route
                        method = 'PUT';
                    }

                    // Ajax call to store or update the event
                    $.ajax({
                        url: url,
                        type: method,
                        data: eventData,
                        success: function(response) {
                            // Refresh events on the calendar
                            $('#calendar').fullCalendar('refetchEvents');
                            // Close the dialog
                            $('#dialog').dialog('close');
                            // Optionally display a success message
                            alert(response.status);
                            $('#eventForm')[0].reset();
                        },
                        error: function(xhr, status, error) {
                            // Handle errors (e.g., validation errors)
                            console.error('Error:', error);
                            console.error('Status:', status);
                            console.error('Response:', xhr.responseText);
                            alert('An error occurred while saving the event.');
                        }
                    });
                });

                // Delete Event
                $('#deleteEvent').click(function() {
                    var eventId = $('#eventId').val();
                    if (confirm('Anda pasti mahu memadam mesyuarat ini?')) {
                        $.ajax({
                            url: "{{ route('eventDelete') }}",
                            type: 'DELETE',
                            data: {
                                id: eventId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $('#calendar').fullCalendar('removeEvents', eventId);
                                $('#dialog').dialog('close');
                            }
                        });
                    }
                });

            });
        </script>

    </div>
</body>
</html>

@endsection
