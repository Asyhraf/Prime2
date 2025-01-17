<!DOCTYPE html>
<html>

<head>
    <title>Takwim</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <style>
        #dialog {
            display: none;
        }
    </style>
</head>
<br><br>

<body>
    <div class="container">
        <div class="mb-5">
            <button class="btn btn-danger rounded" id="addEventButton"><i class="fa fa-calendar-check-o"></i> Kemaskini Mesyuarat </button>

        </div>
        <div id='calendar'></div>

        <script>
            swal("Hello World");
        </script>
    </div>

    <!-- day click dialog-->
    <div id="dialog">
        <div id="dialog-body">
            <form id="dayclick" method="post" action="{{route('eventStore')}}">
                @csrf
                <div class="form-group">
                    <label><b>TAJUK MESYUARAT</b></label>
                    <select name="title" id="title" style="width: 610px !important; min-width: 610px; max-width: 610px; min-height:35px;">
                        <optgroup label="Mesyuarat:">
                            <option disabled>────────────────────────────────────────</option>
                            <option value="Mesyuarat Ketua Setiausaha Kementerian dan Ketua Perkhidmatan">Ketua Setiausaha Kementerian dan Ketua Perkhidmatan</option>
                            <option value="Mesyuarat Jawatankuasa Perhubungan Antara Kerajaan Persekutuan dan Kerajaan Negeri">Jawatankuasa Perhubungan Antara Kerajaan Persekutuan dan Kerajaan Negeri</option>
                            <option value="Mesyuarat Ketua Jabatan Persekutuan">Ketua Jabatan Persekutuan</option>
                            <option value="Mesyuarat Ketua Eksekutif Badan Berkanin Persekutuan">Ketua Eksekutif Badan Berkanin Persekutuan</option>
                            <option value="Mesyuarat Menteri Besar dan Ketua Menteri">Menteri Besar dan Ketua Menteri</option>
                            <option value="Mesyuarat Majlis Jemaah Menteri">Ahli Jemaah Menteri</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><b>TARIKH MESYUARAT</b></label>
                    <input type="text" id="start" class="form-control" name="start" placeholder="Tarikh Mesyuarat">
                </div>

                <div class="form-group">
                    <label><b>LOKASI MESYUARAT</b></label>
                    <input type="text" id="location" class="form-control" name="location" placeholder="Lokasi Mesyuarat">
                </div>

                <div class="form-group">
                    <div><label><b>BILANGAN MESYUARAT</b></label></div>
                    Bilangan:
                    <select name="meeting_numbers" id="meeting_numbers" style="width: 150px !important; min-width: 150px; max-width: 150px; min-height:35px;">
                        <optgroup label="Bilangan:">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </optgroup>
                    </select>
                    Tahun:
                    <select name="year" id="year" style="width: 150px !important; min-width: 150px; max-width: 150px; min-height:35px;">
                        <optgroup label="Tahun:">
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-group">
                    <label><b>Background Colour</b></label>
                    <input type="color" name="color" class="form-control">
                </div>

                <div class="form-group">
                    <label><b>Text Colour</b></label>
                    <input type="color" name="textColor" class="form-control">
                </div>

                <input type="hidden" id="eventId" name="event_id">

                <div class="form-group">
                    <button type="submit" class="btn btn-success rounded"><i class="fa fa-calendar-check-o"></i> Kemaskini Mesyuarat</button>
                </div>
            </form>
        </div>
    </div>

    <!--day click dialog end-->

    <!-- jquery -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- moment js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <!-- Bootstrap Javascript bundle -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"></script> -->
    <!-- Jquery UI Js -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Full calendar js -->
    <script src="{{asset('js/fullcalendar.js')}}"></script>
    <!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script> -->


    <script>
        jQuery(document).ready(function($) {
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

            $('#addEventButton').on('click', function() {
                $('#dialog').dialog({
                    title: 'TAMBAH MAKLUMAT MESYUARAT',
                    width: 650,
                    height: 630,
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
            })

            var calendar = $('#calendar').fullCalendar({
                selectable: true,
                height: 650,
                showNonCurrentDates: false,
                editable: false,
                defaultView: 'month',
                yearColumns: 3,
                displayEventTime: false,
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'year,month,basicWeek,basicDay'
                },
                events: "{{route('allEvent')}}",
                dayClick: function(date, event, view) {
                    $('#start').val(convert(date));
                    $('#dialog').dialog({
                        title: 'TAMBAH MAKLUMAT MESYUARAT',
                        width: 650,
                        height: 630,
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
                select: function(start) {
                    $('#start').val(convert(start));
                    $('#dialog').dialog({
                        title: 'TAMBAH MAKLUMAT MESYUARAT',
                        width: 650,
                        height: 630,
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

                eventClick: function(event) {
                    $('#title').val(event.title);
                    $('#start').val(convert(event.start));
                    $('#color').val(convert(event.color));
                    $('#textColor').val(convert(event.textColor));
                    $('#year').val(convert(event.year));
                    $('#meeting_numbers').val(convert(event.meeting_numbers));
                    $('#location').val(convert(event.location));
                    $('#dialog').dialog({
                        title: 'KEMASKINI MESYUARAT',
                        width: 650,
                        height: 630,
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
                }

            });

        });
    </script>

    <script>
        @include('sweetalert::alert')
    </script>

</body>

</html>