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
            mso-header-margin: 1.25cm;
            margin: 2.54cm 2.54cm 1.00cm 2.54cm;
            /*top-right-bottom-left*/
            mso-footer-margin: 1.3cm;
            mso-title-page: yes;
            mso-header: h1;
            mso-footer: f1;
            mso-first-header: fh1;
            mso-first-footer: ff1;
            mso-paper-source: 0;
            font-size: 14.0pt;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 115%;
            align: justify;
        }

        div.Section1 {
            page: Section1;
        }

        table {
            border: none;
            border-collapse: collapse;
            font-family: Arial;
            font-size: 14pt;
            text-align: justify;
        }

        .style1 {
            font-family: Arial;
            font-size: 14pt;
            text-align: left;
        }

        body {
            vertical-align: top;
            text-align: justify;
            font-family: Arial;
            font-size: 14pt;
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

        table#headerfooter {
            margin: 0in 0in 0in 900in;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }

        td.a {
            text-transform: uppercase;
        }

        ol.a {
            list-style-type: upper-roman;
            line-height: 100%;
        }

        table.a {
            padding-left: 10px;
        }
    </style>
</head>

<body>
    <div class="Section1">
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b>DOKUMEN INI IALAH HAK MILIK KERAJAAN MALAYSIA</b></td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>BKPP.R.600-13/1/1 Jld. XX</b></td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="justify"><u><b>MESYUARAT MENTERI BESAR DAN KETUA MENTERI KE-
                                @if($event->meeting_numbers == '')
                                XXX
                                @else
                                {{ $event->meeting_numbers }}</b></u>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" height="10%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 35px;">
                    <td class="" width="14%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="14%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>Tarikh</b></td>
                    <td class="" width="5%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b>:</td></b>
                    <td class="" width="3%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="64%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>{{ $event_start->isoFormat('dddd, D MMMM YYYY') }}</b></td>
                </tr>
                <tr style="height: 35px;">
                    <td class="" width="14%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="14%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>Masa</b></td>
                    <td class="" width="5%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b>:</td></b>
                    <td class="" width="3%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="64%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b><u>{{$event_time1->format('h.i')}}
                                {{
                            $event_time1->hour < 11.59 ? 'pagi' : 
                        ($event_time1->hour == 12 ? 'tengah hari' : 
                        ($event_time1->hour >= 13 && $event_time1->hour < 18.59 ? 'petang' : 'malam'))}} hingga
                                {{$event_time2->format('h.i')}}
                                {{
                                    $event_time2->hour < 11.59 ? 'pagi' : 
                        ($event_time2->hour == 12 ? 'tengah hari' : 
                        ($event_time2->hour >= 13 && $event_time2->hour < 18.59 ? 'petang' : 'malam'))}}</u></b></td>
                </tr>
                <tr style="height: 45px;">
                    <td class="" width="14%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="14%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>Tempat</b></td>
                    <td class="" width="5%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b>:</td></b>
                    <td class="" width="3%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="40%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>{{ $event->location }} </b></td>
                </tr>
            </tbody>
        </table>
        <br />
        <br />

        <table border="0" width="100%" class="a" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b><u>AGENDA MESYUARAT</u></b></td>
                </tr>
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="a" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 43px;">
                    <td class="" width="10%" colspan="2" valign="top" style="border-top:1px solid #000000;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b><u>BIL.</u></b></td>
                    <td class="" width="90%" colspan="10" valign="top" style="border-top:1px solid #000000;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="center"><b><u>PERKARA</u></b></td>
                </tr>
                <tr style="height: 15px;">
                    <ol class="a">
                        <td class="" width="10%" colspan="2" valign="top" style="border-top:1px solid #000000;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                                <li></li>
                            </b></td>
                    </ol>
                    <td class="" width="90%" colspan="10" valign="top" style="border-top:1px solid #000000;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                            PERUTUSAN KHAS YAB PERDANA MENTERI </b></td>
                </tr>
                <tr style="height: 23px;">
                    <td width="10%" colspan="2" valign="top" style="border-top:1px solid #000000;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b></b></td>
                    <td width="90%" colspan="10" valign="top" style="border-top:1px solid #000000;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b></b></td>
                </tr>
                <tr style="height: 70px;">
                    <ol class="a" start="2">
                        <td class="" width="10%" colspan="2" valign="top" style="border-top:1px solid #000000;border-bottom:none;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                                <li></li>
                            </b></td>
                    </ol>
                    <td class="a" width="90%" colspan="10" valign="top" style="border-top:1px solid #000000;border-bottom:none;border-left:1px solid #000000;border-right:1px solid #000000;" align="justify"><b>
                            PENGESAHAN MINIT MESYUARAT MENTERI BESAR &nbsp;<br />
                            DAN KETUA MENTERI KE-
                            @if($event->meeting_numbers=='')
                            XXX
                            @else
                            {{$event->meeting_numbers}}
                            @endif
                        </b>
                        <b>PADA {{ $event_start->isoFormat('D MMMM') }}&nbsp;&nbsp;</b><br />
                        <b>{{$event_start->isoFormat('YYYY')}}</b><br />
                        <b>&nbsp;</b><br /><br />
                    </td>
                </tr>
                <tr style="height: 50px;">
                    <ol class="a" start="3">
                        <td class="" width="10%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                                <li></li>
                            </b></td>
                    </ol>
                    <td class="" width="90%" colspan="10" valign="top" style="border-top:none;border-bottom:none;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                            PERKARA-PERKARA BERBANGKIT </b><br /><br />
                    </td>
                </tr>
                <tr style="height: 45px;">
                    <ol class="a" start="4">
                        <td class="" width="10%" colspan="2" valign="top" style="border-top:none;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                                <li></li>
                            </b></td>
                    </ol>
                    <td class="" width="90%" colspan="10" valign="top" style="border-top:none;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                            <u>KERTAS PEMBENTANGAN/MAKLUMAN: </b></u><br /><br />
                    </td>
                </tr>
            </tbody>
        </table>
        <br />

        <br clear=all style='mso-special-character:line-break;page-break-after:always'>

        <table border="0" width="100%" class="a" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 45px;">
                    <ol class="a" start="5">
                        <td class="" width="10%" colspan="2" valign="top" style="border-top:1px solid #000000;border-bottom:none;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                                <li></li>
                            </b></td>
                    </ol>
                    <td class="" width="90%" colspan="10" valign="top" style="border-top:1px solid #000000;border-bottom:none;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                            HAL-HAL LAIN </b></td>
                </tr>

                <tr style="height: 70px;">
                    <ol class="a" start="6">
                        <td class="" width="10%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                                <li></li>
                            </b></td>
                    </ol>
                    <td class="a" width="90%" colspan="10" valign="top" style="border-top:none;border-bottom:none;border-left:1px solid #000000;border-right:1px solid #000000;" align="justify"><b>
                            LAPORAN MAKLUM BALAS KE ATAS KEPUTUSAN-&nbsp;<br />
                            KEPUTUSAN MESYUARAT MENTERI BESAR DAN&nbsp;<br />
                            KETUA MENTERI KE-
                            @if($event->meeting_numbers == '')
                            1XX
                            @else
                            {{ $event->meeting_numbers }}
                            @endif
                        </b>
                        <b> PADA {{ $event_start->isoFormat('D MMMM YYYY') }}&nbsp;</b><br />
                        <b> </b><br />
                    </td>
                </tr>
                <tr style="height: 60px;">
                    <ol class="a" start="7">
                        <td class="" width="10%" colspan="2" valign="top" style="border-top:none;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                                <li></li>
                            </b></td>
                    </ol>
                    <td class="" width="90%" colspan="10" valign="top" style="border-top:none;border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" align="left"><b>
                            PENANGGUHAN MESYUARAT</b><br />
                        <b> </b><br />
                        <b> </b><br />
                        <b> </b><br />
                        <b> &nbsp;</b><br />
                    </td>
                </tr>
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="a" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>Bahagian Kabinet, Perlembagaan dan<br />
                            Perhubungan Antara Kerajaan,<br />
                            Jabatan Perdana Menteri,<br />
                            Putrajaya.</b>
                    </td>
                </tr>
                <br />
            </tbody>
        </table>

        <table border="0" width="100%" class="a" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>{{ $event_start->isoFormat('D MMMM YYYY') }}</b></td>
                </tr>
            </tbody>
        </table>

        <table id='headerfooter' border='0' cellspacing='0' cellpadding='0'>

            <div style='mso-element:header' id=h1>
                <p class=MsoHeader><b>RAHSIA</b></p>
            </div>

            <div style='mso-element:footer' id=f1>
                <p class=MsoFooter>
                    <span style='mso-tab-count:2'></span>
                    <span class=MsoFooter><b>(</b><span style='mso-field-code: PAGE '></span><b>)</b></span>
                    <span style='mso-no-proof:yes'></span></span>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    <span class=MsoFooter><b>RAHSIA</b></span>
                </p>
            </div>

            <div style='mso-element:header' align="right" id=fh1>
                <p class=MsoHeader><b>LAMPIRAN</b></p>
            </div>

            <div style='mso-element:footer' id=ff1>
                <p class=MsoFooter><b>RAHSIA</b></p>
            </div>
        </table>

</body>

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=m_CetakanAgendaMesyuarat_mbkm.doc");
?>