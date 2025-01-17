<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>

<head>
    <!--[if gte mso 9]-->
    <XML>
        <w:WordDocument>
            <w:View>Print</w:View>
            <w:Zoom>100</w:Zoom>
            <w:DoNotOptimizeForBrowser />
        </w:WordDocument>
    </xml>
    <!-- [endif]-->

    <style>
        p.MsoHeader,
        li.MsoHeader,
        div.MsoHeader {
            margin: 0in;
            margin-bottom: .0001pt;
            mso-pagination: widow-orphan;
            tab-stops: center 3.0in right 6.0in;
            font-size: 14.0pt;
            font-family: "Arial";
            mso-fareast-font-family: "Arial, Helvetica, sans-serif";
            mso-page-break-before: always;
            line-height: 100%;
        }

        p.MsoFooter,
        li.MsoFooter,
        div.MsoFooter {
            margin: 0in;
            margin-bottom: .0001pt;
            mso-pagination: widow-orphan;
            tab-stops: center 3.0in right 6.0in;
            font-size: 14.0pt;
            font-family: "Arial";
            mso-fareast-font-family: "Arial, Helvetica, sans-serif";
            mso-page-break-before: always;
            line-height: 100%;
        }

        .tab {
            display: inline-block;
            margin-left: 80px;
            align: center;
        }

        @page Section1 {
            font-family: Arial, Helvetica, sans-serif;
            size: 21cm 29.7cm;
            mso-page-orientation: potrait;
            mso-header-margin: 0cm;
            margin: 1.9cm 1.5cm 1cm 2.49cm;
            /*top-right-bottom-left*/
            mso-footer-margin: 1.83cm;
            mso-paper-source: 0;
            mso-footer: f1;
            align: justify;
        }

        div.Section1 {
            page: Section1;
        }

        table {
            border: none;
            border-collapse: collapse;
            font-family: Arial;
            font-size: 12pt;
            text-align: justify;
        }

        .style1 {
            font-family: Arial;
            font-size: 12pt;
            text-align: left;
        }

        body {
            vertical-align: top;
            text-align: justify;
            font-family: Arial;
            font-size: 12pt;
            line-height: 100%;

        }

        .pstyle2 {
            font-family: 'Arial';
            font-size: 18pt;
            font-weight: bold;
            text-align: center;
        }

        .title {
            font-family: 'Times New Roman';
            font-size: 15pt;
            font-weight: bold;
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .border-none {
            border: none;
        }

        .max-height {
            height: 800px;
        }
    </style>
</head>

@forelse($notis_mesyuarat as $counter => $notis)

<body>
    <div class="Section1">

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">BKPP.PR.600-13/2/1 Jld. 25 (xx) </td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri./Datuk/Dato'/Dr., </td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="justify">
                        <p><b>
                            MESYUARAT KETUA SETIAUSAHA KEMENTERIAN DAN KETUA PERKHIMATAN <br />
                            BILANGAN {{ $event->meeting_numbers }} TAHUN {{ $event->year }} SECARA SIDANG VIDEO</b>
                        </p><br />
                    </td>
                </tr>
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="text-align: justify;">
                        <p>Dengan hormatnya dimaklumkan bahawa Mesyuarat Ketua Setiausaha Kementerian Dan
                        Ketua Perkhidmatan Bilangan {{ $event->meeting_numbers }} Tahun {{ $event->year }}
                        <u><b>secara sidang video</b></u> akan diadakan seperti ketetapan yang berikut :</p><br />
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="b-0" width="100%" height="10%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 30px;">
                    <td width="13%" colspan="3" valign="left" style="text-align: left;"><b></b></td>
                    <td width="19%" colspan="2" valign="left" style="text-align: left;"><b>Tarikh</b></td>
                    <td width="4%" colspan="1" valign="center" style="text-align: center;"><b>:</td></b>
                    <td width="54%" colspan="3" valign="left" style="text-align: left;"><b>{{ $event_start->isoFormat('dddd, D MMMM YYYY') }}</td></b>
                    <td width="10%" colspan="3" valign="left" style="text-align: left;"><b></b></td><br />
                </tr>
                <tr style="height: 30px;">
                    <td width="13%" colspan="3" valign="left" style="text-align: left;"><b></b></td>
                    <td width="19%" colspan="2" valign="left" style="text-align: left;"><b>Masa</b></td>
                    <td width="4%" colspan="1" valign="center" style="text-align: center;"><b>:</td></b>
                    <td width="54%" colspan="3" valign="left" style="text-align: left;"><b>{{$event_time1->format('h.i')}}
                            {{
                        $event_time1->hour < 11.59 ? 'pagi' :
                        ($event_time1->hour == 12 ? 'tengah hari' :
                        ($event_time1->hour >= 13 && $event_time1->hour < 18.59 ? 'petang' : 'malam'))}}</td></b>
                    <td class="" width="10%" colspan="3" valign="left" style="text-align: left;"><b></b></td><br />
                </tr>
                <tr style="height: 30px;">
                    <td class="" width="13%" colspan="3" valign="left" style="text-align: left;"><b></b></td>
                    <td class="" width="19%" colspan="2" valign="left" style="text-align: left;"><b>Tempat</b></td>
                    <td class="" width="4%" colspan="1" valign="center" style="text-align: center;"><b>:</td></b>
                    <td class="" width="54%" colspan="3" valign="left" style="text-align: left;"><b>{{ $event->location }} </td></b>
                    <td class="" width="10%" colspan="3" valign="left" style="text-align: left;"><b></b></td><br />
                </tr>
                <tr style="height: 30px;">
                    <td class="" width="13%" colspan="3" valign="left" style="text-align: left;"><b></b></td>
                    <td class="" width="19%" colspan="2" valign="left" style="text-align: left;"><b>Agenda Mesyuarat</b></td>
                    <td class="" width="4%" colspan="1" valign="center" style="text-align: center;"><b>:</td></b>
                    <td class="" width="54%" colspan="3" valign="left" style="text-align: left;"><b>{{ $event->agenda }} </td></b>
                    <td class="" width="10%" colspan="3" valign="left" style="text-align: left;"><b></b></td><br />
                </tr>
            </tbody>
        </table>

        <p>
            <span>
                2.&emsp;&emsp;Kerjasama YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri./Datuk/Dato'/Dr. dimohon untuk mengesahkan kehadiran melalui pautan

                <u><b>http://broga.kabinet.gov.my/prime2.0/public/m_QRCode/{{ $notis->ahli_id }}/{{ $event->id }}</b></u>
                atau mengimbas kod QR yang disertakan sebelum <u><b>{{ $event_start->isoFormat('dddd, D MMMM YYYY') }} jam {{$event_time1->format('h.i')}}
                        {{
                        $event_time1->hour < 11.59 ? 'pagi' :
                        ($event_time1->hour == 12 ? 'tengah hari' :
                        ($event_time1->hour >= 13 && $event_time1->hour < 18.59 ? 'petang' : 'malam'))}}.</b></u>
            </span>
        </p>

        <p>
            <span>
                3.&emsp;&emsp;Bagi memastikan kelancaran mesyuarat, pihak YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Dr. dimohon untuk menekan pautan mesyuarat <u><b>https://join.pmo.gov.my </b></u> bermula jam <u><b>{{$event_time1->format('h.i')}}
                        {{
                        $event_time1->hour < 11.59 ? 'pagi' :
                        ($event_time1->hour == 12 ? 'tengah hari' :
                        ($event_time1->hour >= 13 && $event_time1->hour < 18.59 ? 'petang' : 'malam'))}}.</b></u>
                pada <u><b>{{ $event_start->isoFormat('dddd, D MMMM YYYY') }}.</b></u>
            </span>
        </p>

        <p>
            <span>4.&emsp;&emsp;Kerjasama YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri./Datuk/Dato'/Dr. dalam perkara ini amatlah dihargai.</span>
        </p>

        <p style="text-align:left">
            Sekian, terima kasih.<br>
            <br>
            <br>
            <b>"MALAYSIA MADANI".</b><br>
        </p>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tr>
                <td style="text-align:left; vertical-align:top;">
                    <b>"BERKHIDMAT UNTUK NEGARA"</b>
                </td>
                <td rowspan="2" style="text-align:center">
                    <div class="visible-print">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('assets/images/jata-negara.png', .3, true)->size(40)->size(90)->generate(route('pengesahanQR',[$notis->ahli_id,$event->id]))) !!}" /><br>
                        <small style="font-size: 7pt;"><br>{{$notis->nama_ahli}}</small>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align:left; vertical-align:top;">
                    <br>Saya yang menjalankan amanah,
                </td>
            </tr>
        </table>

        <p style="text-align:left">
            <b>MUNAWATI BINTI YAACOB </b><br>
            14 Disember 2023
        </p>

        <p style="text-align:left">
            <br>
            s.k.:<br>
            <br>
            YBhg. Datuk Dr. Setiausaha Sulit Kanan kepada Ketua Setiausaha Negara<br>
            <br>
            YBrs. Pengarah Bahagian Pengurusan Maklumat Strategik (PERDANA DIGITAL),<br>
            Pejabat Perdana Menteri<br>
        </p>
        <br clear=all style='mso-special-character:line-break;page-break-after:always'>
    </div>
</body>
@empty
@endforelse

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=m_CetakanNotisMesyuarat_ksukp.doc");
?>
