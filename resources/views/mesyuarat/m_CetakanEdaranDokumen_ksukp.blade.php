<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>

<head>
    <title></title>

    <!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:View>Print</w:View>
  <w:Zoom>90</w:Zoom>
</w:WordDocument>
</xml><![endif]-->

    <style>
        p.MsoHeader {
            font-size: 14.0pt;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 100%;
        }

        p.MsoFooter,
        li.MsoFooter,
        div.MsoFooter {
            margin: 0in;
            margin-bottom: 0in;
            mso-pagination: widow-orphan;
            tab-stops: center 3.0in right 6.0in;
            font-size: 14.0pt;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 100%;
            text-align: right;
        }

        .tab {
            display: inline-block;
            margin-left: 80px;
            align: center;
        }

        /* Style Definitions */

        @page Section1 {
            size: 21cm 29.7cm;
            margin: 3.5cm 2.54cm 2.54cm 2.54cm;
            /*top-right-bottom-left*/
            mso-header-margin: 2.54cm;
            mso-footer-margin: 1.6cm;
            mso-title-page: yes;
            mso-header: h1;
            mso-footer: f1;
            mso-first-header: fh1;
            mso-first-footer: ff1;
            mso-paper-source: 0;
            font-size: 14pt;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 115%;
        }

        div.Section1 {
            page: Section1;
        }

        table#headerfooter {
            margin: 0in 0in 0in 900in;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }

        table.mesyuarat {
            border: none;
            border-collapse: collapse;
            font-family: Arial;
            font-size: 14pt;
            padding-left: 15px;
        }

        table.urussetia {
            border: none;
            border-collapse: collapse;
            font-family: Arial;
            font-size: 14pt;
            padding-left: 5px;
        }

        ol li {
            padding-left: 55px;
            margin-left: 25px;
            text-align: justify;
        }
    </style>
</head>

<body style='tab-interval:.5in'>

    <div class="Section1">
        <p style="text-align: right">BKPP.R.600-13/2/1 Jld. 25(xx)</p>

        <p style="text-align: right">
            <span class="block">{{ $event_start->isoFormat('D MMMM YYYY') }}</span>
        </p>

        <br />
        <p>
            <span>Semua Ahli Mesyuarat Ketua Setiausaha Kementerian</span><br />
            <span>dan Ketua Perkhidmatan</span>
        </p>

        <p>
            <span>YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Dr.,</span>
        </p>

        <p>
            <span style="text-align: justify"><b>Mesyuarat Ketua Setiausaha Kementerian Dan Ketua Perkhidmatan</b></span><br />
            <b>Bilangan&nbsp;{{ $event->meeting_numbers }}&nbsp;Tahun&nbsp;{{ $event->year }}&nbsp;Secara Sidang Video</b><br />
            <b>------------------------------------------------------------------------------------------------</b>
        </p>

        <p>
            <span>Dengan hormatnya perkara di atas adalah dirujuk.</span>
        </p>

        <p style="text-align: justify">
            <span>2.&emsp;&emsp;Seperti YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Dr. sedia maklum, Mesyuarat Ketua Setiausaha Kementerian dan Ketua Perkhidmatan Bilangan xx Tahun 2023 secara sidang video telah diadakan seperti berikut:</span>
        </p>

        <table class='mesyuarat' border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td width="25%"><b>&emsp;&emsp;Tarikh</b></td>
                    <td width="5%"><b>:</b></td>
                    <td width="70%"><b>{{ $event_start->isoFormat('dddd, D MMMM YYYY') }}</b></td>
                </tr>
                <tr>
                    <td width="25%"><b>&emsp;&emsp;Masa</b></td>
                    <td width="5%"><b>:</b></td>
                    <td width="70%"><b>{{$event_time1->format('h.i')}}
                            {{
                            $event_time1->hour < 11.59 ? 'pagi' : 
                            ($event_time1->hour == 12.00 ? 'tengah hari' : 
                            ($event_time1->hour >= 13.00 && $event_time1->hour < 18.59 ? 'petang' : 'malam'))}} hingga
                            {{$event_time2->format('h.i')}}
                            {{
                                $event_time2->hour < 11.59 ? 'pagi' : 
                            ($event_time2->hour == 12.00 ? 'tengah hari' : 
                            ($event_time2->hour >= 13.00 && $event_time2->hour < 18.59 ? 'petang' : 'malam'))}}</b><br /></td>
                </tr>
                <tr>
                    <td width="25%"><b>&emsp;&emsp;Tempat</b></td>
                    <td width="5%"><b>:</b></td>
                    <td width="70%"><b>{{ $event->location }}</b></td>
                </tr>
            </tbody>
        </table>

        <p style="text-align: justify">
            <span>3.&emsp;&emsp;Sukacita bersama-sama ini dikemukakan dokumen-dokumen mesyuarat untuk perhatian dan rujukan iaitu:</span>
        </p>

        <table class='mesyuarat' border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 40px; vertical-align: top;">
                    <td width="15%"><b>&emsp;&emsp;(i)</b></td>
                    <td width="85%"><b>Agenda Mesyuarat;</b></td>
                </tr>
                <tr style="height: 60px; vertical-align: top;">
                    <td width="15%"><b>&emsp;&emsp;(ii)</b></td>
                    <td width="85%"><b>Slaid Taklimat daripada (Kementerian/Agensi) bertajuk "XXXX"; dan</b></td>
                </tr>
                <tr style="height: 60px; vertical-align: top;">
                    <td width="15%"><b>&emsp;&emsp;(iii)</b></td>
                    <td width="85%"><b>Slaid Taklimat daripada (Kementerian/Agensi) bertajuk "XXXX"</b></td>
                </tr>
            </tbody>
        </table>

        <p style="text-align: justify">
            <span>4.&emsp;&emsp;Sekiranya terdapat sebarang pertanyaan bagi dokumen-dokumen mesyuarat, pihak YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Dr. dimohon untuk menghubungi pihak urus setia seperti berikut:</span>
        </p>

        <table class='urussetia' border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 50px; vertical-align: top;">
                    <td width="15%"><b>&emsp;&emsp;(i)</b></td>
                    <td width="40%"><b>Encik Ahmad Khairul bin Mohd Ariffin</b></td>
                    <td width="45%"><b>:&emsp;03-8872 4061/013-388 4185</b></td>
                </tr>
                <tr style="height: 50px; vertical-align: top;">
                    <td width="15%"><b>&emsp;&emsp;(ii)</b></td>
                    <td width="40%"><b>Puan Nurulhazreen binti Shahidun Jamil</b></td>
                    <td width="45%"><b>:&emsp;03-8872 4037/016-385 0057</b></td>
                </tr>
                <tr style="height: 50px; vertical-align: top;">
                    <td width="15%"><b>&emsp;&emsp;(iii)</b></td>
                    <td width="40%"><b>Encik Ahmad Farouq bin Ahmad Fuad</b></td>
                    <td width="45%"><b>:&emsp;03-8872 4063/017-497 9770</b><br /></td>
                </tr>
            </tbody>
        </table>

        <p>Sekian, terima kasih.</p>

        <p><b>"MALAYSIA MADANI"</b></p>

        <p><b>"BERKHIDMAT UNTUK NEGARA"</b></p>

        <p>Saya yang menjalankan amanah,</p>

        <br />
        <p><b>MUNAWATI BINTI YAACOB</b><br />
            Bahagian Kabinet, Perlembagaan<br />
            dan Perhubungan Antara Kerajaan,<br />
            Jabatan Perdana Menteri.<br />
            b.p. Ketua Setiausaha Negara
        </p>

        <p><u>s.k.:</u></p>

        <p>YBhg. Datuk Dr. Timbalan Ketua Setiausaha (Kabinet)<br />
            YBhg. Datuk Dr. Setiausaha Sulit Kanan kepada Ketua Setiausaha Negara
        </p>

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

            <div style='mso-element:header' id=fh1>
                <br />
                <br />
                <br />
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
header("Content-Disposition: attachment;Filename=m_CetakanEdaranDokumen_ksukp.doc");
?>