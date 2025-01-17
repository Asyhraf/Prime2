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
        }

        <style type="text/css">< !-- .style1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18pt;
            font-weight: bold;
        }

        -->@page Section1 {
            size: 595.45pt 841.7pt;
            mso-page-orientation: potrait;
            mso-header=margin: .5in;
            margin: 1.0in 1.0in .5in 1.0in;
            /*top-right-bottom-left*/
            mso-footer-margin: .5in;
            mso-paper-source: 0;
            mso-header;
            h1;
            mso-footer: f1;
        }

        mso-page-break-before:always;

        div.Section1 {
            page: Section1;
        }

        #table1 {
            font-family: Arial;
            font-size: 14pt;
            text-align: left;
        }

        #style1 {
            font-family: Arial;
            font-size: 14pt;
            text-align: left;
        }

        .fullspace {
            text-align: justify;
            font-family: Arial;
            font-size: 14pt;
        }

        body {
            font family: Arial;
            font-size: 11pt;
        }
    </style>
</head>



<body>
    <div class="Section1">

        @forelse($ahli_mesyuarat as $counter => $ahli)
        <table width="650" border=0 cellspacing=2 cellpadding=2 style="border-collapse:collapse; border-color:#00000;">
            <tr>
                <td>
                    <table border=0 cellspacing=0 cellpadding=0 align=center width=100%>
                        <tr>
                            <td width="15%" valign="top"><b>Daripada: </b></td>
                            <td width="50%" valign="top">Bahagian Kabinet, Perlembagaan dan <br>
                                Perhubungan Antara Kerajaan<br>
                                Jabatan Perdana Menteri<br>
                                Aras 4 Timur, Bangunan Perdana Putra<br>
                                Pusat Pentadbiran Kerajaan Persekutuan<br>
                                <b><u>62502 PUTRAJAYA</u></b>
                            </td>

                            <td width="35%" valign="top" align="right"><b>
                                    Mesy. {{ $tajuk_mesyuarat->ringkasan }}/ {{ $counter+1 }}
                                </b>
                            </td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td width="10%" valign="top">Kepada : </b></td>
                            <td valign="top" colspan="2">
                                <b>{{ $ahli->nama_ahli }}</b><br>
                                @if(!empty($ahli->Jawatan->nama_jawatan))
                                <span class="badge badge-warning">{{ $ahli->Jawatan->nama_jawatan }}</span>
                            </td>
                            @else
                            Tiada Maklumat Jawatan
                            @endif
                </td>
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>


            <tr>
                <td colspan="3" valign="top" align="right"><b>Tarikh : (Tarikh Surat) </b></td>
            </tr>

        </table>
        </td>
        </tr>




        <tr>
            <td>
                <table border=1 cellspacing=3 cellpadding=10 align=center width=100% style="border-collapse:collapse; border-color:#00000;">
                    <tr bgcolor="#f1f1f1">
                        <td align="center" width="10%"><b>Bil</b></td>
                        <td align="center" width="25%"><b>Tarikh Surat</b></td>
                        <td align="center" width="65%"><b>Bil. Rujukan</b></td>
                    </tr>

                    <tr>
                        <td align="center"><b>1.</b></td>
                        <td align="center"><b>Tarikh Surat</b></td>
                        <td align="center"><b>Bil Rujukan</b></td>
                    </tr>
                </table>
            </td>
        </tr>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td><br><br><br><br><br><br><br><br></td>
        </tr>

        <tr>
            <td align="center"><b>
                    <font stylr="color:#585858;">POTONG DISINI
                        --------------------------------------------------------------------------------</font>
                    <br>
                    <font style="font-size:8pt">(sila ceraikan bahagian ini dari bahagian di atas dan kembalikan kepada penghantar)
                </b></font>
            </td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td>
                <table border=0 cellspacing=0 cellpadding=0 align=center width=100%>
                    <tr>
                        <td width="15%" valign="top"><b>Daripada : </b></td>
                        <td width="75%" valign="top" colspan="2">
                            <b>{{ $ahli->nama_ahli }}</b><br>
                            @if(!empty($ahli->Jawatan->nama_jawatan))
                            <span class="badge badge-warning">{{ $ahli->Jawatan->nama_jawatan }}</span>
                        </td>
                        @else
                        Tiada Maklumat Jawatan
                        @endif
            </td>
        </tr>

        <tr>
            <td> </td>

            <td colspan="2" align="right"><b>
                    Bil Rujukan<br>
                    <!-- Bil Rujukan -->
                    Tarikh Surat</b>
                <!-- Tarikh Surat -->
            </td>
        </tr>
        </table>
        </td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td>
                <table border=0 cellspacing=0 cellpadding=0 align=center width=100%>
                    <tr>
                        <td>
                            <p align="justify"><b>
                                    Ceraikan daripada bahagian atas dan kembalikan kepada, Bahagian Kabinet, Perlembagaan
                                    dan Perhubungan Antara Kerajaan, Jabatan Perdana Menteru, Putrajaya.<br>
                                    (u.p: Encik Akijan bin Hj. Arip - Tel: 03-8872 4065/03-88883324)
                                </b>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td><br><b>Jadual telah disemak dan didapati betul.<br><br></b></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table border=0 cellspacing=0 cellpadding=0 align=center width=100%>
                    <tr>
                        <td width=70%>
                            <table border=0 cellspacing=5 cellpadding=3 align=center width=100% style="color:#585858;">
                                <tr>
                                    <td width="35%"><b>Tandatangan </td>
                                    <td width="65%"><b>: ...........................................</td>
                                </tr>

                                <tr>
                                    <td><b>Nama Penerima </td>
                                    <td><b>: ...........................................</td>
                                </tr>

                                <tr>
                                    <td><b>Tarikh Terima </td>
                                    <td><b>: ...........................................</td>
                                </tr>

                                <tr>
                                    <td><b>Cop Rasmi Jabatan</td>
                                    <td>

                                        <table border=0 cellspacing=0 cellpadding=0 align=left width=225 style="border:1px dotted black;">

                                            <tr>
                                                <td>&nbsp;<br><br><br><br><br><br><br>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td width="2%">&nbsp;</td>


                        <td width="28%" align="center" valign="top">
                            <table border=0 cellspacing=0 cellpadding=0 align=center width=100%>
                                <tr>
                                    <td valign="top" align="center"><b>Mesy. {{ $tajuk_mesyuarat->ringkasan }}/ {{ $counter+1 }}
                                        </b>
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <table border=3 cellspacing=2 cellpadding=2 align=center width="100%" style="border-color:#585858;">
                                <tr>
                                    <td align="center"><br><b>
                                            <font style="font-size:16pt;">
                                                MUSTAHAK<br>
                                                Sila tuliskan<br>
                                                nama penerima<br>
                                                dengan jelas<br><br>
                                            </font>
                                        </b></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>

        </table>

        <br clear=all style='mso-special-character:line-break;page-break-after:always'>



        @empty
        @endforelse

</body>

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_CetakanKawalanDokumen/$tajuk_mesyuarat->ringkasan.doc");
?>