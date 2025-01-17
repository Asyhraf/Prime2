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
        p.MsoFooter,
        li.MsoFooter,
        div.MsoFooter {
            margin: 0cm;
            margin-bottom: 0001pt;
            mso-pagination: widow-orphan;
            font-size: 12pt;
            text-align: right;
            font-family: 'Arial';
        }

        @page Section1 {
            font-family: 'Arial';
            size: 29.7cm 21cm;
            margin: 2cm 2cm 2cm 2cm;
            mso-page-orientation: landscape;
            mso-footer: f1;
        }

        div.Section1 {
            page: Section1;
        }

        .pstyle1 {
            font-family: 'Arial';
            font-size: 12pt;
            font-weight: bold;
            text-align: right;
            color: grey;
        }

        .pstyle2 {
            font-family: 'Arial';
            font-size: 12pt;
            font-weight: bold;
            text-align: center;
        }

        .pstyle3 {
            font-family: 'Arial';
            font-size: 12pt;
            font-weight: bold;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            font-family: 'Arial';
            font-size: 10pt;
            margin: 4px;
            padding: 4px;

        }
    </style>

</head>

<body>

    <div class="Section1">

        <body>
            <div class="pstyle2">{{ $tajuk_dokumen }}</div>
            <br><br>
            <table width="950">
                <thead>
                    <tr height="50" bgcolor="#f1f1f1">
                        <th width="5%">BIL</th>
                        <th width="25%">NAMA</th>
                        @if($opt_alamat==1) <th>ALAMAT</th>@endif
                        @if($opt_noTel_emel==1) <th>NO TELEFON & E-MAIL</th>@endif
                        @if($opt_pegKhas==1) <th>PEGAWAI KHAS </th>@endif
                        @if($opt_suPej==1) <th>SETIAUSAHA PEJABAT</th>@endif
                        @if($opt_pemandu_noPlat==1) <th>PEMANDU</th>@endif
                        @if($opt_gred_lantikan_bersara==1) <th>GRED, TARIKH LANTIKAN & TARIKH BERSARA WAJIB</th>@endif
                    </tr>
                </thead>


                <tbody>
                    @forelse($ahli_mesyuaratHardCode as $counter => $ahliHC)
                    <?php $bilangan = $counter + 1; ?>
                    <tr>
                        <td valign="top">{{ $bilangan }}.</td>
                        <td valign="top">
                            <b>{{ $ahliHC->nama_ahli }}<b>
                        </td>

                        @if($opt_alamat==1)
                        <td valign="top">
                            {{ $ahliHC->alamat }}
                        </td>
                        @endif

                        @if($opt_noTel_emel==1)
                        <td valign="top">
                            {{ $ahliHC->no_hp_peribadi }} <br> [{{ $ahliHC->emel }}]
                        </td>
                        @endif

                        @if($opt_pegKhas==1)
                        <td valign="top">
                            {{ $ahliHC->pegkhas_nama }}
                        </td>
                        @endif

                        @if($opt_suPej==1)
                        <td valign="top">
                            {{ $ahliHC->supej_nama }}
                        </td>
                        @endif

                        @if($opt_pemandu_noPlat==1)
                        <td valign="top">
                            {{ $ahliHC->pemandu_nama }} <br> [{{ $ahliHC->no_plat }}]
                        </td>
                        @endif

                        @if($opt_gred_lantikan_bersara==1)
                        <td valign="top">
                            {{$ahliHC->Gred->nama_gred}}<br><br>Tarikh Lantikan: {{ date('d/m/Y', strtotime($ahliHC->tarikh_lantikan)) }}<br><br>Tarikh Bersara: {{ date('d/m/Y', strtotime($ahliHC->tarikh_bersara)) }}
                        </td>
                        @endif

                    </tr>
                    @empty
                    @endforelse

                    @forelse($ahli_mesyuarat as $counter => $ahli)
                    <?php $bilangan = $counter + 1; ?>
                    <tr>
                        <td valign="top">{{ $bilangan }}.</td>
                        <td valign="top">
                            <b>{{ $ahli->nama_ahli }}<b>
                        </td>

                        @if($opt_alamat==1)
                        <td valign="top">
                            {{ $ahli->alamat }}
                        </td>
                        @endif

                        @if($opt_noTel_emel==1)
                        <td valign="top">
                            {{ $ahli->no_hp_peribadi }} <br> [{{ $ahli->emel }}]
                        </td>
                        @endif

                        @if($opt_pegKhas==1)
                        <td valign="top">
                            {{ $ahli->pegkhas_nama }}
                        </td>
                        @endif

                        @if($opt_suPej==1)
                        <td valign="top">
                            {{ $ahli->supej_nama }}
                        </td>
                        @endif

                        @if($opt_pemandu_noPlat==1)
                        <td valign="top">
                            {{ $ahli->pemandu_nama }} <br> [{{ $ahli->no_plat }}]
                        </td>
                        @endif

                        @if($opt_gred_lantikan_bersara==1)
                        <td valign="top">
                            {{$ahli->Gred->nama_gred}}<br><br>Tarikh Lantikan: {{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }}<br><br>Tarikh Bersara: {{ date('d/m/Y', strtotime($ahli->tarikh_bersara)) }}
                        </td>
                        @endif

                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>


            <br clear=all style='mso-special-character:line-break;page-break-after:always' />
            <div class="MsoFooter" style='mso-element:footer' id="f1">
                <p class=MsoFooter align=right style='margin-bottom:0in;margin-bottom:.0001pt; text-align:right;line-height:normal'>
                    <span style=<span style='mso-field-code:" PAGE "'></span>
                </p>
            </div>

    </div>

</body>

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_LaporanKeahlian.doc");
?>