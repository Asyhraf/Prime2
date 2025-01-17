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
            margin: 4.25cm 2.54cm 2.54cm 2.54cm;
            /*top-right-bottom-left*/
            mso-header-margin: 3.54cm;
            mso-footer-margin: 1.6cm;
            mso-title-page: yes;
            mso-header: h1;
            mso-footer: f1;
            mso-first-header: fh1;
            mso-first-footer: ff1;
            mso-paper-source: 0;
            font-size: 13.0pt;
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

        table#urussetia {
            border: none;
            border-collapse: collapse;
            font-family: Arial;
            font-size: 13pt;
            vertical-align: top;
            padding-left: 30px;
        }
    </style>
</head>

<body style='tab-interval:.5in'>

    <div class="Section1">
        <p style="text-align: right">BKPP.R.600-13/2/1 Jld. 25 (XX)</p>

        <p style="text-align: right">
            <span class="block">{{ date('d F Y') }}</span>
        </p>

        <p>
            <span>Semua Ahli Mesyuarat Ketua Setiausaha Kementerian</span><br />
            <span>dan Ketua Perkhidmatan</span>
        </p>

        <p>
            <span>YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Dr.,</span>
        </p>

        <p style="text-align: justify">
            <span><b>Minit Mesyuarat Ketua Setiausaha Kementerian Dan Ketua Perkhidmatan</b></span>
            <b>Bilangan&nbsp;{{ $event->meeting_numbers }}&nbsp;Tahun&nbsp;{{ $event->year }}</b><br />
            <span><b>--------------------------------------------------------------------------------------------------------</b></span>
        </p>

        <p>
            <span>Saya dengan hormatnya merujuk kepada perkara di atas.</span>
        </p>

        <p style="text-align: justify">
            <span>2.&emsp;&emsp;Bersama-sama ini dikemukakan Minit Mesyuarat Ketua Setiausaha Kementerian dan Ketua Perkhidmatan Bilangan XX Tahun 2023 yang diadakan pada HARI XX, XX Disember 2023 secara sidang video untuk tindakan dan perhatian YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Dr.</span>
        </p>

        <p style="text-align: justify">
            <span>3.&emsp;&emsp;Kerjasama YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Dr. juga dimohon untuk mengemukakan cadangan pindaan minit (sekiranya ada) dan status tindakan ke atas keputusan-keputusan mesyuarat kepada pihak urus setia selewat-lewatnya pada {{ date('l d F Y') }}.</span>
        </p>

        <p>Sekian, terima kasih.</p>

        <p><b>"MALAYSIA MADANI"</b></p>

        <p><b>"BERKHIDMAT UNTUK NEGARA"</b></p>

        <p>Saya yang menjalankan amanah,</p>

        <p><b>MUNAWATI BINTI YAACOB</b></p>

        <br clear=all style='mso-special-character:line-break;page-break-after:always' />
        <p><u>s.k.:</u></p>

        <p>YBhg. Timbalan Ketua Setiausaha (Kabinet)</p>

        <p>YBhg. Setiausaha Sulit Kanan kepada Ketua Setiausaha Negara</p>

        <p><b>Senarai Edaran:</b></p>
        @forelse($edaran_minit as $em)
        <p>
            {{ $em->gelaran }}&nbsp;{{ $em->nama_jawatan }}<br>
            @if(!empty($em->nama_kementerian))
            {{ $em->nama_kementerian }}
            @else
            Tiada Maklumat Kementerian
            @endif
        </p>
        @empty
        <p>tiada data</p>
        @endforelse

        <br clear=all style='mso-special-character:line-break;page-break-after:always' />
        <p style="text-align: center"><b>URUS SETIA</b></p>

        <p style="text-align: justify">Sekiranya terdapat sebarang pertanyaan, pihak YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Dr. boleh menghubungi pihak urus setia seperti yang berikut:</p>

        <table id='urussetia' border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr style="height: 50px;">
                    <td width="45%"><b>Encik Ahmad Khairul bin Mohd Ariffin</b></td>
                    <td width="10%"><b>:</b></td>
                    <td width="45%"><b>03-8872 4061/013-388 4185</b></td>
                </tr>
                <tr style="height: 50px;">
                    <td width="45%"><b>Puan Nurulhazreen binti Shahidun Jamil</b></td>
                    <td width="10%"><b>:</b></td>
                    <td width="45%"><b>03-8872 4037/016-385 0057</b><br /></td>
                </tr>
                <tr style="height: 50px;">
                    <td width="45%"><b>Encik Ahmad Farouq bin Ahmad Fuad</b></td>
                    <td width="10%"><b>:</b></td>
                    <td width="45%"><b>03-8872 4063/017-497 9770</b></td>
                </tr>
            </tbody>
        </table>

        <br />
        <table id='headerfooter' border='0' cellspacing='0' cellpadding='0'>

            <div style='mso-element:header' id=h1>
                <p class=MsoHeader><b>RAHSIA</b></p>
            </div>

            <div style='mso-element:footer' id=f1>
                <p class=MsoFooter>
                    <span style='mso-tab-count:2'></span>
                    <span style='mso-field-code: PAGE '><span style='mso-no-proof:yes'></span></span>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
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
header("Content-Disposition: attachment;Filename=m_CetakanEdaranMinit_ksukp.doc");
?>
