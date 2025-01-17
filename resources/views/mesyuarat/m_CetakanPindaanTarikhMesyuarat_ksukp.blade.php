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
            font-size: 12.0pt;
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
            font-size: 12.0pt;
            line-height: 100%;
            font-family: "Arial";
            mso-fareast-font-family: "Arial, Helvetica, sans-serif";
            mso-page-break-before: always;
            text-align: right;
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
            margin: 1.9cm 1.5cm 0.99cm 2.49cm;
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
            font-size: 12pt;
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

        dd {
            text-align: justify;
            line-height: 100%
        }
    </style>
</head>

<body style='tab-interval:.5in'>
    <div class="Section1">
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">BKPP.R.600-13/2/1 Jld. XX (XX)</td>
                </tr><br />
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri./Datuk/Dato'/Dr., </td>
                </tr><br />
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="justify"><b>PENANGGUHAN MESYUARAT KETUA SETIAUSAHA KEMENTERIAN DAN KETUA <br />
                            PERKHIDMATAN BILANGAN
                            @if($event->meeting_numbers=='')
                            XX
                            @else
                            {{$event->meeting_numbers}}
                            @endif
                            TAHUN
                            @if($event->year=='')
                            20XX
                            @else
                            {{$event->year}}
                            @endif</b>
                    </td>
                </tr><br />
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="justify">Dengan hormatnya dimaklumkan bahawa Mesyuarat Ketua Setiausaha Kementerian dan <br />
                        Ketua Perkhidmatan Bilangan
                        @if($event->meeting_numbers=='')
                        XX
                        @else
                        {{$event->meeting_numbers}}
                        @endif
                        Tahun
                        @if($event->year=='')
                        20XX
                        @else
                        {{$event->year}}
                        @endif
                        yang dijadualkan pada
                        <b><u>{{$event_start->isoFormat('dddd, D MMMM')}}<br />
                                {{$event->year}}
                                @if($event->year=='')
                                20XX
                                @endif
                            </u></b> jam <b><u>{{$event_time1->format('h.i')}}
                                {{
                                $event_time1->hour < 11.59 ? 'pagi' : 
                            ($event_time1->hour == 12 ? 'tengah hari' : 
                            ($event_time1->hour >= 13 && $event_time1->hour < 18.59 ? 'petang' : 'malam'))}}</u></b> bertempat di <b><u>{{ $event->location }}</u></b>
                        adalah <b><u>ditangguhkan.</u></b>
                    </td>
                </tr><br />
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">Sekian, terima kasih.</td>
                </tr><br />
            </tbody>
        </table>
        <br />
        <br />
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>"BERKHIDMAT UNTUK NEGARA"</b></td>
                </tr><br />
            </tbody>
        </table>
        <br />
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">Saya yang menjalankan amanah,</td>
                </tr> <br />
            </tbody>
        </table>
        <br />
        <br />
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>(SUB H-NAMA)</b><br />
                        {{$event_start->isoFormat('D MMMM')}} {{$event->year}}
                        @if($event->year=='')
                        20XX
                        @endif
                    </td>
                </tr><br />
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><u>s.k:</u>
                    </td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YBhg. Datuk Dr. Setiausaha Sulit Kanan kepada Ketua Setiausaha Negara</td>
                </tr>
                <br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="justify">YBrs. Pengarah Bahagian Pengurusan Maklumat Strategik (PERDANA DIGITAL), Pejabat <br />
                        Perdana Menteri</td>
                </tr><br />
            </tbody>
        </table>
</body>

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=m_CetakanPindaanTarikhMesyuarat_ksukp.doc");
?>