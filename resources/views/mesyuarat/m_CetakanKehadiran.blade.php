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
    size: 29.7cm 21cm;
    margin: 2cm 2cm 2cm 2cm;
    mso-page-orientation: landscape;
    mso-footer:f1;
    }
    div.Section1 { page:Section1;}

    .pstyle1{
        font-family: 'Arial';
        font-size: 16pt;
        font-weight: bold;
        text-align: right;
        color: grey;
    }

    .pstyle2{
        font-family: 'Arial';
        font-size: 16pt;
        font-weight: bold;
        text-align: center;
    }

    .pstyle3{
        font-family: 'Arial';
        font-size: 14pt;
        font-weight: bold;
    }

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        font-family: 'Arial';
        font-size: 14pt;
        margin: 4px;
        padding: 4px;
    }
</style>

</head>
<body>

<div class="Section1">
<body>
<div class="pstyle2">
    Senarai Kehadiran Ahli (Hadir)
    <br>{{ $event->TajukMesyuarat->nama_tajuk }} ({{ $event->title }})
    <br>Bilangan {{ $event->meeting_numbers }} Tahun {{ $event->year }}
</div>
<br><br>
<table width="950">
    <thead>
        <tr height="50" bgcolor="#f1f1f1">
            <th width="50">BIL.</th>
            <th width="700">NAMA</th>
            <th width="300">NAMA MESYUARAT</th>
        </tr>
    </thead>

<br>
    <tbody>
        @forelse($kehadiran_ahli as $counter => $hadir)
        <tr>
            <td valign="top">
                {{ $counter+1 }}.
            </td>

            <td valign="top" >
                {{ $hadir->NamaID->nama_ahli }}<br>
            </td>

            <td valign="top">
                {{ $hadir->EventID->TajukMesyuarat->nama_tajuk }}
                <br><font color="blue"><i>{{ $hadir->EventID->TajukMesyuarat->ringkasan }} </i>
                </font><br>
            </td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>


    <br clear=all style='mso-special-character:line-break;page-break-after:always' />
    <div class="MsoFooter" style='mso-element:footer' id="f1">
    <p class=MsoFooter align=right style='margin-bottom:0in;margin-bottom:.0001pt; text-align:right;line-height:normal'>
    <span style=<span style='mso-field-code:" PAGE "'></span></p>
    </div>
    </body>
</div>
</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=m_cetakanKehadiran ($event->title Bil $event->meeting_numbers/ $event->year).doc");
?>
