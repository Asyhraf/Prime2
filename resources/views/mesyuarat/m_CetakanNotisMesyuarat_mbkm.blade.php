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
            font-size: 13.0pt;
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
            font-size: 13.0pt;
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
            mso-header-margin: 1.18cm;
            margin: 1.18cm 2.54cm 1.27cm 2.54cm;
            /*top-right-bottom-left*/
            mso-footer-margin: 1.3cm;
            mso-title-page: yes;
            mso-header: h1;
            mso-footer: f1;
            mso-first-header: fh1;
            mso-first-footer: ff1;
            mso-paper-source: 0;
            font-size: 13.0pt;
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
            font-size: 13pt;
            text-align: justify;
        }

        .style1 {
            font-family: Arial;
            font-size: 13pt;
            text-align: left;
        }

        body {
            vertical-align: top;
            text-align: justify;
            font-family: Arial;
            font-size: 13pt;
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

@forelse($notis_mesyuarat as $counter => $notis)

<body>
    <div class="Section1">
        <br />
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="right">BKPP.R.600-13/1/1 Jld.17 (XXX)</td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="right">{{ $event_start->isoFormat('MMMM YYYY') }} </td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">Yang Amat Berhormat, </td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="justify">
                        <b>
                            Mesyuarat Menteri Besar Dan Ketua Menteri Kali Ke {{ $event->meeting_numbers }}
                        </b>
                    </td>
                    <span><b>--------------------------------------------------------------------------------</b></span>
                </tr><br /><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td>
                        <p style="text-align: justify">
                            <span>
                                Saya dengan hormatnya memaklumkan bahawa Mesyuarat Menteri Besar dan
                                Ketua Menteri (MBKM) Ke-{{ $event->meeting_numbers }}
                                akan diadakan seperti ketetapan yang berikut :
                            </span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table><br />

        <table width="100%" height="10%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color: none;">
            <tbody>
                <tr style="height: 30px;">
                    <td width="8.5%" align="left"><b></b></td>
                    <td width="16%" align="left"><b>Tarikh</b></td>
                    <td width="4%" align="center"><b>:</td></b>
                    <td width="6%" align="center"><b></td></b>
                    <td width="40%" align="left"><b>{{ $event_start->isoFormat('dddd, D MMMM YYYY') }} </td></b>
                    <td width="29.5%" align="left"></td>
                </tr>
                <tr style="height: 30px;">
                    <td width="8.5%" align="left"><b></b></td>
                    <td width="16%" align="left"><b>Masa</b></td>
                    <td width="4%" style='text-align:center'><b>:</td></b>
                    <td width="6%" style='text-align:center'><b></td></b>
                    <td width="40%" align="left"><b>{{$event_time1->format('h.i')}}
                            {{
                            $event_time1->hour < 11.59 ? 'pagi' :
                            ($event_time1->hour == 12 ? 'tengah hari' :
                            ($event_time1->hour >= 13 && $event_time1->hour < 18.59 ? 'petang' : 'malam'))}}</td></b>
                    <td class="" width="29.5%" align="left"></td>
                </tr>
                <tr style="height: 45px;">
                    <td width="8.5%" align="left"><b></b></td>
                    <td width="16%" valign="top" align="left"><b>Tempat</b></td>
                    <td width="4%" valign="top" style='text-align:center'><b>:</b></td>
                    <td width="6%" style='text-align:center'></td>
                    <td width="40%" valign="top" align="left"><b>{{ $event->location }}</b></td>
                    <td width="29.5%" align="left"></td>
                </tr>
                <tr style="height: 30px;">
                    <td width="8.5%" align="left"><b></b></td>
                    <td width="16%" align="left"><b>Pengerusi</b></td>
                    <td width="4%" style='text-align:center'><b>:</td></b>
                    <td width="6%" style='text-align:center'><b></td></b>
                    <td width="40%" align="left"><b>YAB Perdana Menteri</b></td>
                    <td width="29.5%" align="left"></td>
                </tr>
            </tbody>
        </table>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td>
                        <p style="text-align: justify">
                            <span>2.&emsp;&emsp;Yang Amat Berhormat dengan segala hormatnya dijemput hadir </span><br />
                            bersama-sama Yang Berhormat Setiausaha Kerajaan Negeri.
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;"> -->

        <p style="text-align: justify">
            <span>3.&emsp;&emsp;Bagi maksud perancangan dan penyelarasan, kerjasama Yang Amat <br />
                Berhormat dimohon untuk mengesahkan kehadiran melalui pautan
                <u><b>URL: http://broga.kabinet.gov.my/prime2.0/public/m_QRCode/{{ $notis->ahli_id }}/{{ $event->id }}</u></b> atau mengimbas kod QR di bawah sebelum atau pada
                <u><b>{{ $event_start->isoFormat('dddd, D MMMM YYYY') }}.</b></u>
            </span><br />
        </p>

        <p style="text-align:left">
            Sekian, terima kasih.<br>
            <br>
            <br>
            <b>"MALAYSIA MADANI".</b><br>
        </p>
        <!-- </table> -->

        <table width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color: none;">
            <tr>
                <td style="text-align:left; vertical-align:top;">
                    <b>"BERKHIDMAT UNTUK NEGARA"</b>
                </td>
                <td rowspan="2" style="text-align:center">
                    <div class="visible-print">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('assets/images/jata-negara.png', .3, true)->size(40)->size(90)->generate(route('pengesahanQR',[$notis->ahli_id, $event->id]))) !!}" /><br>
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
            <b>(NAMA TKSU KABINET)</b><br>
        </p>

        <br clear=all style='mso-special-character:line-break;page-break-after:always'>
        <br />
        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left"><u><b>Salinan Kepada:</b></u></td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">YBhg. Ketua Setiausaha Sulit kepada <br />
                        YAB Perdana Menteri</td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">YBhg. Setiausaha Sulit Kanan kepada <br />
                        Ketua Setiausaha Negara</td>
                </tr><br />
            </tbody>
        </table>

        <br clear=all style='mso-special-character:line-break;page-break-after:always'>
        <br />
        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left"><u><b>Kepada:</b></u></td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">YAB Timbalan Perdana Menteri<br />
                        dan Menteri Kemajuan Desa dan Wilayah</td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">YAB Timbalan Perdana Menteri<br />
                        dan Menteri Perladangan dan Komoditi</td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">YB Menteri di Jabatan Perdana Menteri<br />
                        (Undang-Undang dan Reformasi Institusi)</td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">YB Menteri di Jabatan Perdana Menteri<br />
                        (Hal Ehwal Sabah, Sarawak dan Tugas-Tugas Khas)</td>
                </tr><br />
            </tbody>
        </table>

        <br clear=all style='mso-special-character:line-break;page-break-after:always'>
        <br />

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">YAB Premier Sarawak<br /><br />
                        YAB Ketua Menteri Sabah<br /><br />
                        YAB Menteri Besar Terengganu<br /><br />
                        YAB Menteri Besar Negeri Sembilan<br /><br />
                        YAB Ketua Menteri Pulau Pinang<br /><br />
                        YAB Menteri Besar Pahang<br /><br />
                        YAB Menteri Besar Selangor<br /><br />
                        YAB Menteri Besar Kedah<br /><br />
                        YAB Menteri Besar Perak<br /><br />
                        YAB Menteri Besar Johor<br /><br />
                        YAB Menteri Besar Perlis<br /><br />
                        YAB Ketua Menteri Melaka<br /><br />
                        YAB Menteri Besar Kelantan<br /><br /></td>
                </tr><br />
            </tbody>
        </table>

        <br clear=all style='mso-special-character:line-break;page-break-after:always'>
        <br />
        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left"><u><b>Hadir Bersama:</b></u></td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">YB Setiausaha Kerajaan Negeri Sabah<br /><br />
                        YB Setiausaha Kerajaan Negeri Sarawak<br /><br />
                        YB Setiausaha Kerajaan Johor<br /><br />
                        YB Setiausaha Kerajaan Kelantan<br /><br />
                        YB Setiausaha Kerajaan Terengganu<br /><br />
                        YB Setiausaha Kerajaan Perlis<br /><br />
                        YB Setiausaha Kerajaan Selangor<br /><br />
                        YB Setiausaha Kerajaan Pulau Pinang<br /><br />
                        YB Setiausaha Kerajaan Melaka<br /><br />
                        YB Setiausaha Kerajaan Perak<br /><br />
                        YB Setiausaha Kerajaan Pahang<br /><br />
                        YB Setiausaha Kerajaan Negeri Sembilan<br /><br />
                        YB Setiausaha Kerajaan Kedah<br /><br />
                        YBhg. Setiausaha Persekutuan Sarawak<br /><br />
                        YBhg. Setiausaha Persekutuan Sabah<br /><br />
                    </td>
                </tr><br />
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left"><u><b>Turut Hadir:</b></u></td>
                </tr>
            </tbody>
        </table>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="" width="100%" colspan="0" align="left">YBhg. Peguam Negara<br /><br />
                        YBhg. Ketua Pengarah Perkhidmatan Awam<br /><br />
                        YBhg. Ketua Setiausaha Perbendaharaan<br /><br />
                    </td>
                </tr>
            </tbody>
        </table>

        <br clear=all style='mso-special-character:line-break;page-break-after:always'>
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
                <br /><br /><br />
                <p class=MsoHeader><b>RAHSIA</b></p>
            </div>

            <div style='mso-element:footer' id=ff1>
                <p class=MsoFooter><b>RAHSIA</b></p>
            </div>
        </table>
    </div>
</body>
@empty
@endforelse

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=m_CetakanNotisMesyuarat_mbkm.doc");
?>
