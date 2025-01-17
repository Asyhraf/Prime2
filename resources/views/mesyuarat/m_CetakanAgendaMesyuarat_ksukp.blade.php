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

        li.a {
            padding-left: 55px;
            text-align: justify;
            list-style-type: upper-roman;
            line-height: 220%
        }

        dd {
            text-align: justify;
            line-height: 100%
        }

        li.b {
            padding-left: 55px;
            text-align: justify;
            line-height: 100%
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
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>BKPP.R.600-13/2/1 Jld. xx </b></td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:2px solid #000000;border-left:none;border-right:none;" align="center"><b>MESYUARAT KETUA SETIAUSAHA KEMENTERIAN </b><br />
                        <b>DAN KETUA PERKHIDMATAN BILANGAN {{ $event->meeting_numbers }} TAHUN {{ $event->year }}</b>
                    </td>
                </tr>
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" height="10%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 35px;">
                    <td class="" width="14%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="17%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>Tarikh</b></td>
                    <td class="" width="4%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b>:</td></b>
                    <td class="" width="63%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>{{ $event_start->isoFormat('D MMMM YYYY') }} ( {{ $event_start->isoFormat('dddd')}} )</td></b>
                    <td class="" width="2%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td><br />
                </tr>
                <tr style="height: 35px;">
                    <td class="" width="14%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="17%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>Masa</b></td>
                    <td class="" width="4%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b>:</td></b>
                    <td class="" width="63%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>{{$event_time1->format('h.i')}}
                            {{
                            $event_time1->hour < 11.59 ? 'pagi' : 
                        ($event_time1->hour == 12 ? 'tengah hari' : 
                        ($event_time1->hour >= 13 && $event_time1->hour < 18.59 ? 'petang' : 'malam'))}}</td></b>
                    <td class="" width="2%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td><br />
                </tr>
                <tr style="height: 22px;">
                    <td class="" width="14%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="17%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>Tempat</b></td>
                    <td class="" width="4%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b>:</td></b>
                    <td class="" width="63%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>{{ $event->location }} </td></b>
                    <td class="" width="2%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td><br />
                </tr>
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><span>__________________________________________________________</span></td>
                </tr>
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b><u>A G E N D A</u></b></td>
                </tr>
            </tbody>
        </table>
        <br />
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <ol>
                        <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="justify"><b>
                                <li class="a">PERUTUSAN YBHG. PENGERUSI</li>
                                <li class="b">TAKLIMAT</li>
                                <dd>&emsp;&nbsp;Taklimat daripada (Contoh Kementerian/Agensi) bertajuk <br />
                                <dd>&emsp;&nbsp;"XXXXX"</dd>
                                <li class="a">HAL-HAL LAIN</li>
                                <li class="a">PENANGGUHAN MESYUARAT</li>
                            </b></td>
                    </ol>
                </tr>
            </tbody>
        </table>

        <br />
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>Bahagian Kabinet, Perlembagaan dan<br />
                            Perhubungan Antara Kerajaan,<br />
                            Jabatan Perdana Menteri,<br />
                            Putrajaya.<br /></b>
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
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    <span class=MsoFooter><b>RAHSIA</b></span>
                </p>
            </div>

            <div style='mso-element:header' id=fh1>
                <p class=MsoHeader><b>RAHSIA</b></p>
            </div>

            <div style='mso-element:footer' id=ff1>
                <p class=MsoFooter><b>RAHSIA</b></p>
            </div>
        </table>

</body>

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=m_CetakanAgendaMesyuarat_ksukp.doc");
?>