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
            mso-header-margin: 1.2cm;
            margin: 1.18cm 2.54cm 1.27cm 2.54cm;
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
            line-height: 100%;
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
    </style>
</head>

<body>
    <div class="Section1">
        <br />
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="right">BKPP.R.600-13/1/1 Jld.xx (xx) </td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="right">{{ $event_start->isoFormat('MMMM YYYY') }} </td>
                </tr><br />
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">Yang Amat Berhormat/Yang Berhormat, </td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="justify"><b>Mesyuarat Menteri Besar Dan Ketua Menteri Ke-{{$event->meeting_numbers}} - Pindaan Masa <br />
                            Mesyuarat </b>
                        @if($event->meeting_numbers=='')
                        xx
                        @endif
                    </td>
                    <span><b>------------------------------------------------------------------------------------------------</b></span>
                </tr><br /><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td>
                        <p style="text-align: justify">
                            <span>Dengan hormatnya dimaklumkan bahawa Mesyuarat Menteri Besar dan <br />
                                Ketua Menteri (MBKM) Ke-{{$event->meeting_numbers}} dipinda seperti berikut:
                                @if($event->meeting_numbers=='')
                                XX
                                @endif
                            </span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table><br />

        <table border="0" width="100%" height="10%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 35px;">
                    <td class="" width="14%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="14%" colspan="2" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>Tarikh</b></td>
                    <td class="" width="5%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="center"><b>:</td></b>
                    <td class="" width="3%" colspan="1" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b></b></td>
                    <td class="" width="64%" colspan="3" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>{{ $event_start->isoFormat('D MMMM YYYY') }} ( {{ $event_start->isoFormat('dddd')}} )</b></td>
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

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td>
                        <p style="text-align: justify">
                            <span>2.&emsp;&emsp;Butiran-butiran lain tidak berubah. Mesyuarat akan dipengerusikan </span><br />
                            oleh YAB Perdana Menteri. Sehubungan ini, Yang Amat <br />
                            Berhormat/Yang Berhormat dengan segala hormatnya dijemput hadir. <br />
                        </p>
                    </td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">Sekian, terima kasih.</td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 60px;">
                    <td class="" width="50%" colspan="5" valign="top" style="border-top:none;border-bottom:none;border-left:none;border-right:none;">
                        <p style="text-align: left">
                            <b>"BERKHIDMAT UNTUK NEGARA" </b>
                        </p>
                    </td>
                </tr><br />
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><b>(NAMA TKSU KABINET JPM)</b></td><br />
                </tr>
            </tbody>
        </table>

    </div>

    <br clear=all style='mso-special-character:line-break;page-break-after:always'>
    <br />

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><u><b>Salinan Kepada:</b></u></td>
            </tr><br />
        </tbody>
    </table>

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YBhg. Ketua Setiausaha Sulit kepada <br />
                    YAB Perdana Menteri</td>
            </tr><br />
        </tbody>
    </table>

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YBhg. Setiausaha Sulit Kanan kepada <br />
                    Ketua Setiausaha Negara</td>
            </tr><br />
        </tbody>
    </table>

    <br clear=all style='mso-special-character:line-break;page-break-after:always'>
    <br />

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left"><u><b>Kepada:</b></u></td>
            </tr><br />
        </tbody>
    </table>

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YAB Timbalan Perdana Menteri<br />
                    dan Menteri Kemajuan Desa dan Wilayah</td>
            </tr><br />
        </tbody>
    </table>

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YAB Timbalan Perdana Menteri<br />
                    dan Menteri Perladangan dan Komoditi</td>
            </tr><br />
        </tbody>
    </table>

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YB Menteri Pengangkutan<br /><br />
                    YB Menteri Pertanian dan Keterjaminan Makanan<br /><br />
                    YB Menteri Ekonomi<br /><br />
                    YB Menteri Pembangunan Kerajaan Tempatan<br /><br />
                    YB Menteri Pertahanan<br /><br />
                    YB Menteri Kerja Raya<br /><br />
                    YB Menteri Dalam Negeri<br /><br />
                    YB Menteri Perdagangan Antarabangsa dan Industri<br /><br />
                    YB Menteri Pembangunan Wanita, Keluarga dan Masyarakat<br /><br />
                    YB Menteri Perdagangan Dalam Negeri dan Kos Sara Hidup <br /><br />
                </td>
            </tr>
        </tbody>
    </table>

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YB Menteri di Jabatan Perdana Menteri (Undang-Undang dan<br />
                    Reformasi Institusi)</td>
            </tr><br />
        </tbody>
    </table>

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YB Menteri Sumber Asli, Alam Sekitar dan Perubahan Iklim<br /><br />
                    YB Menteri Pelancongan, Seni dan Budaya<br /><br />
                    YB Menteri Komunikasi dan Digital<br /><br />
                    YB Menteri Pembangunan Kerajaan Tempatan<br /><br />
                    YB Menteri Pendidikan<br /><br />
                </td>
            </tr><br />
        </tbody>
    </table>

    <br clear=all style='mso-special-character:line-break;page-break-after:always'>
    <br />

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YB Menteri di Jabatan Perdana Menteri (Hal Ehwal Agama)<br /><br />
                    YB Menteri Kesihatan<br /><br />
                </td>
            </tr>
        </tbody>
    </table>

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YB Menteri di Jabatan Perdana Menteri<br />
                    (Hal Ehwal Sabah, Sarawak dan Tugas-Tugas Khas)</td>
            </tr><br />
        </tbody>
    </table>

    <br clear=all style='mso-special-character:line-break;page-break-after:always'>
    <br />

    <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
        <tbody>
            <tr>
                <td class="" width="100%" colspan="0" style="border-top:none;border-bottom:none;border-left:none;border-right:none;" align="left">YAB Premier Sarawak<br /><br />
                    YAB Ketua Menteri Sabah<br /><br />
                    YAB Menteri Besar Kelantan<br /><br />
                    YAB Menteri Besar Terengganu<br /><br />
                    YAB Menteri Besar Negeri Sembilan<br /><br />
                    YAB Ketua Menteri Pulau Pinang<br /><br />
                    YAB Menteri Besar Pahang<br /><br />
                    YAB Menteri Besar Selangor<br /><br />
                    YAB Ketua Menteri Melaka<br /><br />
                    YAB Menteri Besar Kedah<br /><br />
                    YAB Menteri Besar Perak<br /><br />
                    YAB Menteri Besar Johor<br /><br />
                    YAB Menteri Besar Perlis<br /><br />
                </td>
            </tr><br />
        </tbody>
    </table>

    <table id='headerfooter' border='0' cellspacing='0' cellpadding='0'>
        <br />

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

        <div style='mso-element:header' id=fh1>
            <br /><br /><br /><br /><br /><br />
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
header("Content-Disposition: attachment;Filename=m_CetakanPindaanTarikhMesyuarat_mbkm.doc");
?>