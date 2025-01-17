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
            size: 21cm 29.7cm;
            margin: 2cm 2cm 2cm 2cm;
            mso-page-orientation: portrait;
            mso-footer: f1;
        }

        div.Section1 {
            page: Section1;
        }

        .pstyle1 {
            font-family: 'Arial';
            font-size: 14pt;
            font-weight: bold;
            text-align: right;
            color: grey;
        }

        .pstyle2 {
            font-family: 'Arial';
            font-size: 14pt;
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
            background-color:#FFFFFF;
            border-collapse: collapse;
            font-family: 'Arial';
            font-size: 12pt;
            margin: 4px;
            padding: 4px;
        }
    </style>

</head>

<body>

    <div class="Section1">

        <div class="pstyle2">
            MAKLUMAT AHLI MESYUARAT
        </div>
        <br>

        <table width="100%" class="table table-bordered">
            <!----------------------------------------------------------- BUTIRAN AHLI ----------------------------------------------------------->
            <tr>
                <td colspan="2" style="text-align: center; background-color:#212F3D">
                    <strong><span color="#FFFFFF">BUTIRAN AHLI</span></strong>
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Jenis Mesyuarat</strong></td>
                <td width="60%">
                    @if ( $butiran-> mesyuarat_ksukp == '1')
                    KSUKP<br>
                    @endif
                    @if ( $butiran-> mesyuarat_mbkm == '1')
                    MBKM<br>
                    @endif
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Nama</strong></td>
                <td width="60%"> {{ $ahli_mesyuarat->nama_ahli }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No. Kad Pengenalan</strong></td>
                <td width="60%"> {{ $butiran->no_ic }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Jawatan</strong></td>
                <td width="60%"> {{ $jawatan->nama_jawatan }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Kementerian</strong></td>
                <td width="60%">
                    @if(!empty($kementerian))
                    {{ $kementerian->nama_kementerian }} ({{ $kementerian->singkatan_kementerian }})
                    @else
                    @endif
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Alamat</strong></td>
                <td width="60%">
                    <?php
                    $alamat_lines = explode("\n", $butiran->alamat); // Split the address into lines
                    $num_lines = count($alamat_lines); // Count the number of lines

                    foreach ($alamat_lines as $line_key => $line) {
                        if ($line_key == $num_lines - 1) { // Check if it's the last line
                            echo "" . nl2br(e($line)) . ""; // If yes, make it bold
                        } else {
                            echo nl2br(e($line));
                        }
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Telefon Bimbit (Peribadi)</strong></td>
                <td width="60%"> {{ $butiran->no_hp_peribadi }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Emel</strong></td>
                <td width="60%"> {{ $butiran->emel }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Nama Isteri/Suami</strong></td>
                <td width="60%"> {{ $butiran->isteri_suami }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Status Ahli</strong></td>
                <td width="60%"> {{ $status_ahli->nama_status_ahli }} </td>
            </tr>
        </table>
        <br>
            <!----------------------------------------------------------- LANTIKAN & PERSARAAN ----------------------------------------------------------->
        <table width="100%" class="table table-bordered">
            <tr>
                <td colspan="2" style="text-align: center; background-color:#212F3D">
                    <strong><span color="#FFFFFF">LANTIKAN SEMASA</span></strong>
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Gred</strong></td>
                <td width="60%">
                    @if(!empty($gred->nama_gred))
                    {{ $gred->nama_gred }}
                    @endif
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Susunan Kekananan</strong></td>
                <td width="60%"> {{ $lantikan->kekananan_mesy_manual }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Tarikh Gred</strong></td>
                <td width="60%"> {{ $lantikan->tarikh_lantikan ? date('d/m/Y', strtotime($lantikan->tarikh_lantikan)) : '' }} </td>
            </tr>
        </table>
        <br>
        <table width="100%" class="table table-bordered">
            <tr>
                <td colspan="2" style="text-align: center; background-color:#212F3D">
                    <strong><span color="#FFFFFF">LANTIKAN KONTRAK</span></strong>
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Tarikh Mula Kontrak</strong></td>
                <td width="60%"> {{ $lantikan->tarikh_mula_kontrak1 ? date('d/m/Y', strtotime($lantikan->tarikh_mula_kontrak1)) : '' }} </td>
            </tr>
        </table>
        <br>
        <table width="100%" class="table table-bordered">
            <tr>
                <td colspan="2" style="text-align: center; background-color:#212F3D">
                    <strong><span color="#FFFFFF">PERSARAAN WAJIB</span></strong>
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Tarikh Bersara Wajib</strong></td>
                <td width="60%"> {{ $lantikan->tarikh_bersara ? date('d/m/Y', strtotime($lantikan->tarikh_bersara)) : '' }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Gred Jawatan Semasa Bersara</strong></td>
                <td width="60%">
                    @if(!empty($GredBersara->nama_gred))
                    {{ $GredBersara->nama_gred }}
                    @endif
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Tarikh Lantikan Gred Jawatan Semasa Bersara</strong></td>
                <td width="60%"> {{ $lantikan->tarikh_lantikan_semasa_bersara ? date('d/m/Y', strtotime($lantikan->tarikh_lantikan_semasa_bersara)) : '' }} </td>
            </tr>
        </table>

        <br clear=all style='mso-special-character:line-break;page-break-after:always' />
        @forelse($peg_khas as $pkhas)
        <table width="100%" class="table table-bordered">
            <!----------------------------------------------------------- Pegawai Khas ----------------------------------------------------------->
            <tr>
                <td colspan="2" style="text-align: center; background-color:#212F3D">
                    <strong><span color="#FFFFFF">PEGAWAI KHAS {{ $loop->iteration }}</span></strong>
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Nama</strong></td>
                <td width="40%"> {{ $pkhas->pegkhas_nama }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Emel</strong></td>
                <td width="60%"> {{ $pkhas->pegkhas_emel }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Tel (Bimbit)</strong></td>
                <td width="60%"> {{ $pkhas->pegkhas_hp }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Tel (Pejabat)</strong></td>
                <td width="60%"> {{ $pkhas->pegkhas_telpej }} </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Faks</strong></td>
                <td width="60%"> {{ $pkhas->pegkhas_faks }} </td>
            </tr>
        </table>
        <br>
        @empty
        <table width="100%" class="table table-bordered">
            <tr>
                <td colspan="2">Tiada Rekod</td>
            </tr>
        </table>
        <br>
        @endforelse

        @forelse($supej as $setiausaha)
        <table width="100%" class="table table-bordered">
            <!----------------------------------------------------------- Setiausaha Pejabat ----------------------------------------------------------->
            <tr>
                <td colspan="2" style="text-align: center; background-color:#212F3D">
                    <strong><span color="#FFFFFF">SETIAUSAHA PEJABAT {{ $loop->iteration }}</span></strong>
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Nama</strong></td>
                <td width="60%">{{ $setiausaha->supej_nama }}</td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Emel</strong></td>
                <td width="60%">{{ $setiausaha->supej_emel }}</td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Tel (Bimbit)</strong></td>
                <td width="60%">{{ $setiausaha->supej_hp }}</td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Tel (Pejabat)</strong></td>
                <td width="60%">{{ $setiausaha->supej_telpej }}</td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Faks</strong></td>
                <td width="60%">{{ $setiausaha->supej_faks }}</td>
            </tr>
        </table>
        <br>
        @empty
        <table width="100%" class="table table-bordered">
            <tr>
                <td colspan="2">Tiada Rekod </td>
            </tr>
        </table>
        <br>
        @endforelse

        <table width="100%" class="table table-bordered">
            <!----------------------------------------------------------- Pemandu/ BG / Kenderaan ----------------------------------------------------------->
            <tr>
                <td colspan="2" style="text-align: center; background-color:#212F3D">
                    <strong><span color="#FFFFFF">PEMANDU</span></strong>
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Nama</strong></td>
                <td width="60%">{{ $pemandu_bguard->pemandu_nama }}</td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Tel (Bimbit)</strong></td>
                <td width="60%">{{ $pemandu_bguard->pemandu_hp }}</td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Tel (Pejabat)</strong></td>
                <td>{{ $pemandu_bguard->pemandu_telpej }}</td>
            </tr>
        </table>
        <br>
        <table width="100%" class="table table-bordered">
            <tr>
                <td colspan="2" style="text-align: center; background-color:#212F3D">
                    <strong><span color="#FFFFFF">BODYGUARD</span></strong>
                </td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>Nama</strong></td>
                <td width="60%">{{ $pemandu_bguard->bguard_nama }}</td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Tel (Bimbit)</strong></td>
                <td width="60%">{{ $pemandu_bguard->bguard_hp }}</td>
            </tr>

            <tr>
                <td width="40%" style="text-align: center"><strong>No Tel (Pejabat)</strong></td>
                <td width="60%">{{ $pemandu_bguard->bguard_telpej }}</td>
            </tr>
        </table>
            <br>
        <table width="100%" class="table table-bordered">
            <tr>
                <td colspan="2" style="text-align: center; background-color:#212F3D">
                    <strong><span color="#FFFFFF">KENDERAAN</span></strong>
                </td>
            </tr>
            <tr>
                <td width="40%" style="text-align: center"><strong>No Plat Kenderaan</strong></td>
                <td width="60%">{{ $pemandu_bguard->no_plat }}</td>
            </tr>
        </table>

        <div class="MsoFooter" style='mso-element:footer' id="f1">
            <p class=MsoFooter style='margin-bottom:0in; margin-bottom:.0001pt; text-align:right; line-height:normal;'>
                <span style=<span style='mso-field-code:" PAGE "'></span>
            </p>
        </div>
    </div>

</body>

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_MaklumatAhliMesyuarat.doc");
?>
