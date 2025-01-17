@extends('layouts.customtheme')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editable Div Styling</title>
    <style>
        .editable-div {
            line-height: 1.5;
            background-color: #f9f9f9;
            padding: .375rem .75rem;
            border-radius: .25rem;
            border: 1px solid #ced4da;
            height: 500px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="animated fadeIn">
        <div class="card">
            <form class="theme-form mega-form" method="POST" action="{{ route('emel.panggilan.ksukp') }}">
                @csrf

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

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
                    <h3 class="text-center"><b>PENGHANTARAN EMAIL</b></h3>
                </div>

                <div class="card-body card-block">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Emel Penerima</div>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $eventDetails->emel }}" style="background-color: #f9f9f9;" required readonly>
                            <div class="input-group-addon">
                                <i2 class="fa fa-envelope"></i2>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Cc</div>
                            <input type="email" id="cc" name="cc" class="form-control" placeholder="CC emails" value="{{ $ccEmails }}" style="background-color: #f9f9f9;" readonly>
                            <div class="input-group-addon">
                                <i2 class="fa fa-envelope"></i2>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Cc</div>
                            <textarea
                                id="cc"
                                name="cc"
                                class="form-control"
                                placeholder="CC emails"
                                rows="1"
                                style="background-color: #f9f9f9;"
                            >{{ $ccEmails }}</textarea>
                            <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Bcc</div>
                            <textarea
                                id="bcc"
                                name="bcc"
                                class="form-control"
                                placeholder="Enter BCC emails separated by commas"
                                rows="2"
                                style="background-color: #f9f9f9;"
                            >munawati.yaacob@kabinet.gov.my, faisal.mohamad@kabinet.gov.my, ahmad_khairul@kabinet.gov.my, nurulhazreen@kabinet.gov.my, farouq.fuad@kabinet.gov.my</textarea>
                            <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <small class="text-muted">Optional: Add multiple Cc & Bcc emails separated by commas.</small>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Perkara</div>
                            <input type="text" id="subject" name="subject" class="form-control" value="{{ $event->TajukMesyuarat->nama_tajuk }} ({{ $event->title }}) Bilangan {{ $event->meeting_numbers }} Tahun {{ $event->year }}" style="background-color: #f9f9f9;" required readonly>
                            <div class="input-group-addon">
                                <i2 class="fa fa-pencil"></i2>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Mesej</div>
                            <div class="form-control editable-div" id="displaymessage" name="displaymessage" contenteditable="true">
                                <p style="text-align: justify">
                                    YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri./Datuk/Dato'/Dr.,<br><br>

                                    <u><strong>{{ $event->TajukMesyuarat->nama_tajuk }} Bilangan {{ $event->meeting_numbers }} Tahun {{ $event->year }}</strong></u><br><br>

                                    Dengan hormatnya dimaklumkan bahawa Mesyuarat Ketua Setiausaha Kementerian Dan
                                    Ketua Perkhidmatan Bilangan {{ $event->meeting_numbers }} Tahun {{ $event->year }}
                                    akan diadakan seperti ketetapan berikut:
                                </p>

                                <strong>
                                    <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: none; color: #878787;">
                                        <tbody>
                                            <tr>
                                                <td width="15%">Tarikh</td>
                                                <td width="5%" style="text-align: centre">:</td>
                                                <td width="80%">{{ $event_start->isoFormat('dddd, D MMMM YYYY') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Masa</td>
                                                <td style="text-align: centre">:</td>
                                                <td>
                                                    {{ $event_time1->format('h.i') }}
                                                    {{
                                                        $event_time1->hour < 11.59 ? 'pagi' :
                                                        ($event_time1->hour == 12 ? 'tengah hari' :
                                                        ($event_time1->hour >= 13 && $event_time1->hour < 18.59 ? 'petang' : 'malam'))
                                                    }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tempat</td>
                                                <td style="text-align: centre">:</td>
                                                <td>{{ ucwords(strtolower($event->location)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Agenda Mesyuarat</td>
                                                <td style="text-align: centre">:</td>
                                                <td>{{ $event->agenda }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </strong>

                                <br>
                                <p style="text-align: justify">
                                    2. &emsp;&emsp;Kerjasama YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri./Datuk/Dato'/Dr. dimohon untuk mengesahkan kehadiran melalui pautan<br>
                                    <b>URL: <u>http://broga.kabinet.gov.my/prime2.0/public/m_QRCode/{{ $ahli->ahli_id }}/{{ $event->id }}</u></b><br>
                                    sebelum <u><b>{{ $event_start->isoFormat('dddd, D MMMM YYYY') }}.</b></u>.
                                </p>

                                <p style="text-align: justify">
                                    3. &emsp;&emsp;Kerjasama YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri./Datuk/Dato'/Dr. dalam perkara ini amatlah dihargai.
                                </p>

                                <p>
                                    Sekian, terima kasih.<br><br>
                                    <strong>"MALAYSIA MADANI"</strong><br><br>
                                    <strong>"BERKHIDMAT UNTUK NEGARA"</strong><br><br>
                                    Saya yang menjalankan amanah,<br><br>
                                    <strong>URUS SETIA MESYUARAT KSUKP</strong>
                                </p>
                            </div>
                            <input type="hidden" id="message" name="message">

                            <div class="input-group-addon">
                                <i2 class="fa fa-commenting"></i2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <a href="javascript:history.back()" title="Kembali" class="btn btn-info btn-sm rounded">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm rounded">
                        <i class="fa fa-send"></i> Hantar
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm rounded">
                        <i class="fa fa-refresh"></i> Tetapan Semula
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function validateEmails(inputId) {
    const input = $(`#${inputId}`).val(); // Get input value
    const emails = input.split(',').map(email => email.trim()); // Split by commas and trim
    const invalidEmails = emails.filter(email => !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)); // Validate

        if (invalidEmails.length > 0) {
            alert(`Invalid email addresses found: ${invalidEmails.join(', ')}`);
            return false; // Prevent form submission
        }
            return true; // All emails are valid
    }

    $('form').submit(function (e) {
    // Synchronize the contenteditable div with the hidden input
    const messageContent = $('#displaymessage').html(); // Get the HTML content
    $('#message').val(messageContent);

    // Validate email fields
    if (!validateEmails('cc') || !validateEmails('bcc')) {
        e.preventDefault(); // Stop form submission if invalid emails
    }
});

</script>
@endsection
