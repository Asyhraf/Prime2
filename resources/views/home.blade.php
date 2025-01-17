@extends('layouts.customtheme')

@section('content')

<!DOCTYPE html>
<html>

<head>
    <title>Takwim</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

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
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            <b>{{ session('status') }}</b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif
        <div class="card-header">
            <div class="col-2"></div>
            <div class="col-8">
                <h3 class="text-center"><b>TAKWIM MESYUARAT PRIME 2.0</b></h3>
            </div>
            <div class="col-2 text-right pr-0">
                <button class="btn btn-primary btn-sm rounded" data-toggle="collapse" data-target="#collapseicon" aria-expanded="true" aria-controls="#collapseicon">Filter <i class="fa fa-chevron-down"></i></button>
            </div>
        </div>

        <div class="card-body">
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

            {{-- <script>
                swal("Selamat Datang!", "{{ Auth::user()->name }}", 'success', {
                    button: true,
                    button: "OK",
                    timer: 3000,
                    dangerMode: true,
                });
            </script> --}}
        </div>

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
                    selectable: false,
                    selectHelper: true,
                    editable: false, // Allows editing (dragging, resizing)
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
            });
        </script>

    </div>
</body>
</html>

@endsection
