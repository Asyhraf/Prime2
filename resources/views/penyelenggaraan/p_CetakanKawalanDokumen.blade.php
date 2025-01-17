<html xmlns:o='urn:schemas-microsoft-com:office:office'
     xmlns:w='urn:schemas-microsoft-com:office:word'
     xmlns='http://www.w3.org/TR/REC-html40'>
<head>
<!--[if gte mso 9]-->
<!-- <XML>
<w:WordDocument>
<w:View>Print</w:View>
<w:Zoom>100</w:Zoom>
<w:DoNotOptimizeForBrowser/>
</w:WordDocument>
</xml> -->
<!-- [endif]-->

<style>

@page Section1
{
    size:21cm 29.7cm;    
    margin: 2cm 2cm 2cm 2cm;
    /*top-right-bottom-left*/
    font-size:12.0pt; 
    font-family: Arial, Helvetica, sans-serif;
}

div.Section1
{
    page:Section1;
}

table
{        
    border-collapse: collapse;
    border-color:#00000;
    font-family: Arial; 
    font-size: 12pt;   
}
</style>
</head>   

<body>
<div class="Section1">

@foreach($ahli_mesyuarat as $ahli)                     
<table border=1 width="100%">
    <tr>
        <td colspan="4">            
            <p style="text-align: right;">        
                <font style="font-size:16pt;">No. Siri : <b>{{ $jenis_mesyuarat }} {{ $bil }}/{{ $loop->iteration }}</b></font>&nbsp;&nbsp;
            </p>

            <p style="text-align: center">
                <font style="font-size:16pt;"><b>BORANG JADUAL</b></font>
            </p>
                    
            <table border=0 width="100%">
                <tr style="height: 1.8cm;" valign="top">
                    <td width="25%" style="font-size:13pt; text-align: center">Daripada:</td>
                    <td width="75%" style="text-align: left"><b>BAHAGIAN KABINET, PERLEMBAGAAN<br>
                    DAN PERHUBUNGAN ANTARA KERAJAAN<br>
                    JABATAN PERDANA MENTERI</b>
                    </td>
                    <p></p>
                <tr>
            </table>

            <table border=0 width="100%">
                <tr style="height: 2.7cm;" valign="top">
                    <td width="15%" style="font-size:13pt; text-align: left">
                        &nbsp;Kepada :
                    </td>
                    <td width="50%" style="text-align: left">
                        <font style="text-transform: uppercase;"><b>{{ $ahli->nama_ahli }}</b></font><br>
                        {{ $ahli->nama_jawatan }}<br>                       
                        @if(!empty($ahli->nama_kementerian))
                        {!! nl2br(e($ahli->nama_kementerian)) !!}
                        @else                        
                        @endif
                    </td>
                    <td width="35%" style="text-align: left">
                        Tarikh : {{ date('d.m.Y', strtotime($date)) }}
                    </td>                    
                </tr>
            </table>            
        </td>   
        <p></p>
    </tr>

    <tr style="border:1;" align=center valign="top">
        <td style="font-size:11pt;" align="center" width="8%"><b>BIL.</b></td>
        <td style="font-size:11pt;" align="center" width="17%"><b>TARIKH SURAT</b></td>
        <td style="font-size:11pt;" align="center" width="40%"><b>BIL. RUJUKAN</b></td>
        <td style="font-size:11pt;" align="center" width="35%"><b>PERKARA</b></td>
    </tr>

    <tr border=1 align=center valign="top">
        <td align="center"><b>1.</b></td>
        <td align="center"><b>{{ date('d.m.Y', strtotime($tarikhSurat)) }}</p></td>
        <td align="left">&nbsp;<b>{{ $bilRujukan }}</b></td>
        <td style="height: 2cm;" align="center"><b>{{ $perkara }}<br>{{ $jenis_mesyuarat }} Ke-{{ $bil }}</td>
        <p></br></br></p></b>
    </tr>

    <tr border=1 align=center valign="top">
        <td align="center"></td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="left" style="font-size:8pt;">&nbsp;<b>No.Tel: 03-88724067 (HAFIZ)<br><br>&nbsp;No. Faks: 03-88883324</b><br><br></td>
    </tr>   

    <tr> 
        <td colspan="4">     
            <p>
                <br><br><br>
            <p>

            <p class="row" align="center">
                <b>--------------------------------------CARIK DAN DIKEMBALIKAN---------------------------------------</b>
            <p>
            
            <p style="text-align: right;">        
                <font style="font-size:16pt;">No. Siri : <b>{{ $jenis_mesyuarat }} {{ $bil }}/{{ $loop->iteration }}</b></font>&nbsp;&nbsp;
            </p>          
            
            <table border=0 width="100%">
                <tr style="height: 3.3cm;" valign="top">
                    <td width="15%" style="font-size:13pt; text-align: left">
                        &nbsp;Kepada :
                    </td>
                    <td width="50%" style="text-align: left">
                        <font style="text-transform: uppercase;"><b>{{ $ahli->nama_ahli }}</b></font><br>
                        {{ $ahli->nama_jawatan }}<br>                       
                        @if(!empty($ahli->nama_kementerian))    
                        {!! nl2br(e($ahli->nama_kementerian)) !!}                   
                        @else                        
                        @endif
                    </td>
                    <td width="35%">
                        <p style="text-align: left">Tarikh : {{ date('d.m.Y', strtotime($date)) }}</p>
                        <p style="text-align: center"><b>{{ $perkara }}<br>{{ $jenis_mesyuarat }} Ke-{{ $bil }}</p>
                    </td>                    
                </tr>
            </table>
            
            <p>        
                <font style="font-size:10pt;">&nbsp;<b>Jadual telah disemak dan didapati betul.<br>
                &nbsp;Sila kembalikan semula kepada (MUHAMMAD HAFIZ BIN MD NASIR - Faks: 03-8888 3324)</b></font><br>
            </p> 

            <table border=0 width=100%>

                <tr style="font-size:5pt; height: 0.3cm;">
                    <td width="25%"></td>
                    <td width="40%"></td>
                    <td width="35%"></td>
                </tr>

                <tr style="font-size:13pt; height: 1cm;" valign="top">
                    <td width="25%">&nbsp;Tandatangan</td>
                    <td width="40%">: ..........................................</td>
                    <td width="35%" rowspan="5">&nbsp;&nbsp;Cop Rasmi Jabatan</td>
                </tr>

                <tr style="font-size:13pt; height: 1cm;" valign="top">
                    <td width="25%">&nbsp;Tarikh</td>
                    <td width="40%">: ..........................................</td>
                </tr>

                <tr style="font-size:13pt; height: 1cm;" valign="top">
                    <td width="25%">&nbsp;Nama</td>
                    <td width="40%">: ..........................................</td>
                </tr>

                <tr style="font-size:13pt; height: 1cm;" valign="top">
                    <td width="25%">&nbsp;Jawatan </td>
                    <td width="40%">: ..........................................</td>
                </tr>

                <tr style="font-size:10pt; height: 0.3cm;">
                    <td width="25%"></td>
                    <td width="40%"></td>
                </tr>
            </table>
        </td>   
    </tr>
</table>    

<br clear=all style='mso-special-character:line-break;page-break-after:always'>
@endforeach 
</body>
</html>    

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_CetakanBorangJadual.doc");
?>