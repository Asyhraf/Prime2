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

        /* Style Definitions */

        @page Section1 {
            size: 21cm 29.7cm;
            margin: 4.25cm 2.54cm 2.54cm 2.54cm;
            /*top-right-bottom-left*/
            mso-header-margin: 3.54cm;
            mso-footer-margin: 1.6cm;
            mso-title-page: yes;
            mso-first-header: fh1;
            mso-first-footer: ff1;
            mso-header: h1;
            mso-footer: f1;
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
    </style>
</head>

<body style='tab-interval:.5in'>

    <div class="Section1">
        <p style="text-align: right">BKPP.R.600-13/1/1 Jld.XX (XX)</p>

        <p style="text-align: right">
            <span class="block">{{ date('F Y') }}</span>
        </p>
        <br />
        <p>
            Yang Amat Berhormat/Yang Berhormat,<br>
            <span>YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Tuan,</span>
        </p>

        <p>
            <span><b>Minit Mesyuarat Menteri Besar Dan Ketua Menteri Ke-{{ $event->meeting_numbers }}</b></span><br />
            <span><b>---------------------------------------------------------------------------------</b></span>
        </p>

        <p style="text-align: justify">
            <span>Saya dengan hormatnya bersama-sama ini mengemukakan Minit Mesyuarat Menteri Besar dan Ketua Menteri Ke-{{ $event->meeting_numbers }} yang telah diadakan pada
                <b>{{ date('l, d F Y', strtotime($event->start)) }}</b> untuk tindakan dan makluman Yang Amat Berhormat/Yang Berhormat/YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Tuan
                yang mana berkenaan. Sekiranya terdapat sebarang <b>pindaan</b>, mohon kemukakan pindaan tersebut kepada Bahagian Kabinet, Perlembagaan dan Perhubungan Antara Kerajaan,
                Jabatan Perdana Menteri selewat-lewatnya pada <b><u>{{ date('d F Y') }}</u></b>.
            </span>
        </p>

        <p style="text-align: justify">
            <span>2.&emsp;&emsp;Kerjasama pihak Yang Amat Berhormat/Yang Berhormat/YBhg. Tan Sri/Datuk Seri/Dato' Seri/Dato' Sri/Datuk/Dato'/Tuan juga dimohon agar dapat
                mengemukakan <b><u>maklum balas</u></b> kepada Bahagian ini bagi perkara-perkara berkaitan selewat-lewatnya pada <b><u>{{ date('d F Y') }}</u></b> untuk dibentangkan dalam Mesyuarat Menteri Besar dan Ketua Menteri
                Ke-{{ $event->meeting_numbers }}.
            </span>
        </p>

        <p>Sekian, terima kasih.</p>

        <p><b>"MALAYSIA MADANI"</b></p>

        <p><b>"BERKHIDMAT UNTUK NEGARA"</b></p>

        <p>Saya yang menjalankan amanah,</p>

        <p><b>DATUK DR. FARIZAH BINTI AHMAD</b></p>

        <br clear=all style='mso-special-character:line-break;page-break-after:always' />

        <p><b><u>Salinan Kepada:</u></b></p>

        <p>YBhg. Ketua Setiausaha Sulit kepada YAB Perdana Menteri</p>

        <p>YBhg. Setiausaha Sulit Kanan kepada Ketua Setiausaha Negara</p>

        <p><b>Kepada:</b></p>
        @forelse($edaran_minit as $em)
        <p>
            {{ $em->gelaran }}&nbsp;{{ $em->nama_jawatan }}
            @if(!empty($em->nama_kementerian))
            <br>{{ $em->nama_kementerian }}
            @endif
        </p>
        @empty
        <p>tiada data</p>
        @endforelse

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
header("Content-Disposition: attachment;Filename=m_CetakanEdaranMinit_mbkm.doc");
?>
