<html xmlns:o='urn:schemas-microsoft-com:office:office'
     xmlns:w='urn:schemas-microsoft-com:office:word'
     xmlns='http://www.w3.org/TR/REC-html40'>
<head>
<!--[if gte mso 9]-->
<XML>
<w:WordDocument>
<w:View>Print</w:View>
<w:Zoom>100</w:Zoom>
<w:DoNotOptimizeForBrowser/>
</w:WordDocument>
</xml>
<!-- [endif]-->

<style>
    p.MsoFooter, li.MsoFooter, div.MsoFooter{
    margin: 0cm;
    margin-bottom: 0001pt;
    mso-pagination:widow-orphan;
    font-size: 14pt;
    text-align: right;
    font-family: 'Arial';
    }

    @page Section1{
    font-family: 'Arial';
    size: 21cm 29.7cm;
    margin: 2cm 2cm 2cm 2cm;
    mso-page-orientation: Portrait;
    mso-footer:f1;
    }
    div.Section1 { page:Section1;}

    .pstyle2{
        font-family: 'Arial';
        font-size: 14pt;
        font-weight: bold;
        text-align: center;
    }

    table, th, td {
        border: 1px solid black;
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
    SENARAI AHLI MESYUARAT
    </div>
    <br><br>
    <table>
        <thead>
            <tr height="50" style="background-color:#f1f1f1">
                <th width="5%">Bil.</th>
                <th width="70%">Nama dan Jawatan</th>
                <th width="25%">Gred</th>
            </tr>
        </thead>


        <tbody>
            @foreach($ahliMesyuarat as $ahli)
            <tr>
                <td valign="top" style='text-align:center'>{{ $loop->iteration }}.</td>

                <td valign="top">
                    {{ $ahli->nama_ahli }}<br>
                    <font color="blue"><i>{{ $ahli->nama_jawatan }}<br>
                    @if(!empty($ahli->nama_kementerian))
                    <font color="blue"><i>{{ $ahli->nama_kementerian }}
                    @endif
                </td>

                <td valign="top" style='text-align:center'>
                    @if(!empty($ahli->nama_gred))
                    {{ $ahli->nama_gred }}<br>
                    <font color="blue"><i>({{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }})
                    @else
                    Tiada Maklumat Gred
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="MsoFooter" style='mso-element:footer' id="f1">
    <p class=MsoFooter style='margin-bottom:0in;margin-bottom:.0001pt; text-align:right; line-height:normal'>
    <span style='mso-field-code:" PAGE "'></span></p>
    </div>
</div>

</body>
</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_SenaraiAhliMesyuarat.doc");
?>
