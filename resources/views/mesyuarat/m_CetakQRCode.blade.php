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
            font-size: 14pt;
            text-align: right;
            font-family: 'Arial';
        }

        @page Section1 {
            font-family: 'Arial';
            size: 21cm 29.7cm;
            margin: 2cm 2cm 2cm 2cm;
            mso-page-orientation: Portrait;
            mso-footer: f1;
        }

        div.Section1 {
            page: Section1;
        }

        body {
            font-family: Arial;
            font-size: 11pt;
        }

        table {
            border: none;
            border-collapse: collapse;
            font-family: 'Arial';
            font-size: 9pt;
            margin: 4px;
            padding: 4px;
        }

        .style1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18pt;
            font-weight: bold;
        }

        .pstyle2 {
            font-family: 'Arial';
            font-size: 18pt;
            font-weight: bold;
            text-align: center;
        }

        .title {
            font-family: 'Times New Roman';
            font-size: 20pt;
            font-weight: bold;
            text-align: center;
        }

        .img-logo {
            size: 300px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .sub-title {
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

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
</head>


@forelse($butiranAhliMesyuarat as $counter => $butiran)

<body>
    <div class="Section1">
        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;">
            <tbody>
                <tr>
                    <td class="text-center">
                        <p class="title">
                            <img width="150" height="125" src="{{asset('assets/images/jata-negara.png')}}" alt="">
                            <br>
                            Aplikasi Pengurusan Pra - Mesyuarat (PRIME) 2.0
                            <br>
                            <br>
                            <u>
                                Pengesahan Kehadiran Mesyuarat {{$events->title}}
                                <br>Bil. {{$events->meeting_numbers}} / {{$events->year}}
                                Pada {{ date('d/m/Y', strtotime($events->start)) }}
                            </u>
                            <br>
                            <br>
                            {{$butiran->nama_ahli}}

                            <br>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <?php $eventID = $events->id ?>

        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000000;" align="center">
            <tbody>
                <tr align="center">
                    <td width="25%"></td>
                    <td width="50%">
                        <div class="visible-print" align="center">
                            <img align="center" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('assets/images/jata-negara.png', .3, true)->size(200)->size(250)->generate(route('pengesahanQR',[$butiran->id_ahli,$events->id]))) !!}" />
                        </div>
                    </td>
                    <td width="25%"></td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <table border="0" width="100%" class="" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="text-center">
                        <p class="sub-title">
                            Hanya untuk kegunaan urusan <br>
                            Aplikasi Pengurusan Pra - Mesyuarat (PRIME) 2.0 sahaja
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br clear=all style='mso-special-character:line-break;page-break-after:always'>

    @empty
    @endforelse

</body>

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=QR Pengesahan Kehadiran $events->title- Bil $events->meeting_numbers- $events->year.doc");
?>
