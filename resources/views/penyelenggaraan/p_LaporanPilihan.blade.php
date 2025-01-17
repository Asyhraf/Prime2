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
            margin: 2cm 1cm 2cm 1cm;
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

        <div class="pstyle2">{{ $tajuk_dokumen }}</div>
        <br><br>
        <table>
            <thead>
                <tr height="50" bgcolor="#f1f1f1">
                    <th width="5%" style="text-align: center;">BIL</th>
                    <th>NAMA</th>
                    @if($opt_alamat==1) <th>ALAMAT</th>@endif
                    @if($opt_noTel_emel==1) <th>NO TELEFON & E-MAIL</th>@endif
                    @if($opt_pegkhas==1) <th>PEGAWAI KHAS</th>@endif
                    @if($opt_suPejnoTel_emel==1) <th>SETIAUSAHA PEJABAT, NO TELEFON & E-MAIL</th>@endif
                    @if($opt_pemandu_noPlat==1) <th>PEMANDU</th>@endif
                    @if($opt_gred_lantikan_bersara==1) <th>GRED, TARIKH LANTIKAN & TARIKH BERSARA WAJIB</th>@endif
                </tr>
            </thead>

            <tbody>
                @forelse($ahli_mesyuarat as $ahli)                    
                <tr>
                    <td valign="top">{{ $loop->iteration }}.</td>
                    <td valign="top">
                        <b>{{ $ahli->nama_ahli }}</b>
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

                    @if($opt_pegkhas==1)
                    <td valign="top">
                        @if(!empty($ahli->pegkhas_nama))                              
                            {{ $ahli->pegkhas_nama }}                              
                        @else
                            Tiada Maklumat Pegawai Khas
                        @endif
                    </td>
                    @endif

                    @if($opt_suPejnoTel_emel==1)
                    <td valign="top">
                        @if(!empty($ahli->supej_nama))                                                      
                            {{ $ahli->supej_nama }} <br> {{ $ahli->supej_hp }} <br> [{{ $ahli->supej_emel }}]
                        @else
                            Tiada Maklumat Setiausaha
                        @endif
                    </td>
                    @endif

                    @if($opt_pemandu_noPlat==1)
                    <td valign="top">
                        {{ $ahli->pemandu_nama }} <br> [{{ $ahli->no_plat }}]
                    </td>
                    @endif

                    @if($opt_gred_lantikan_bersara==1)
                    <td valign="top">
                        @if(!empty($ahli->nama_gred))
                        {{ $ahli->nama_gred }}<br><br>Tarikh Lantikan: {{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }}<br><br>Tarikh Bersara: {{ date('d/m/Y', strtotime($ahli->tarikh_bersara)) }}
                        @else
                        Tiada Maklumat Gred
                        @endif
                    </td>
                    @endif

                </tr>
                @empty
                <tr>
                    <td colspan="7">Tiada Maklumat Ahli</td>
                </tr>
                @endforelse
            </tbody>
        </table>

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
header("Content-Disposition: attachment;Filename=p_LaporanPilihan.doc");
?>