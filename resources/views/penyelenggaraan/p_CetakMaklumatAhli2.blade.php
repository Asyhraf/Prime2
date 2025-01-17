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
    size:21cm 29.7cm;
    margin: 2cm 2cm 2cm 2cm;
    mso-page-orientation: portrait;
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
MAKLUMAT AHLI MESYUARAT
</div>
<br><br>

div class="row">
                      <div class="col-sm-12 col-xl-6">
                        <div class="row">
                          <div class="col-sm-12">


                            <div class="card">
                              <div class="card-body">

                                <h5>PENGURUSAN AHLI MESYUARAT</h5>
                                <hr class="mt-4 mb-4">

                                <!-- Jenis Mesyuarat  -->
                                <div class="form-group">
                                  <label class="col-form-label">JENIS MESYUARAT</label><br><br>

                                  <tr style= "background-color:#FFFFFF">
                                    <th width="5%" style="text-align: center"><strong>Jenis Mesyuarat</strong></th>
                                    @if ( $ahli_mesyuarat-> mesyuarat_ksukp == '1' && $ahli_mesyuarat-> mesyuarat_jkppn == '1' && $ahli_mesyuarat-> mesyuarat_kjp == '1' && $ahli_mesyuarat-> mesyuarat_kebbp == '1' && $ahli_mesyuarat-> mesyuarat_mbkm == '1' )
                                        <td>KSUKP<br>JKPPN <br>KJP<br>KEBBP<br>MBKM</td> 
                                        @elseif ( $ahli_mesyuarat-> mesyuarat_ksukp == '1' && $ahli_mesyuarat-> mesyuarat_jkppn == '1' && $ahli_mesyuarat-> mesyuarat_kjp == '1' && $ahli_mesyuarat-> mesyuarat_kebbp == '1' )
                                            <td>KSUKP<br>JKPPN <br>KJP<br>KEBBP</td>
                                            @elseif ( $ahli_mesyuarat-> mesyuarat_ksukp == '1' && $ahli_mesyuarat-> mesyuarat_jkppn == '1' && $ahli_mesyuarat-> mesyuarat_kjp == '1' )
                                                <td>KSUKP<br>JKPPN <br>KJP</td>
                                                @elseif ( $ahli_mesyuarat-> mesyuarat_ksukp == '1' && $ahli_mesyuarat-> mesyuarat_jkppn == '1' )
                                                    <td>KSUKP<br>JKPPN</td>
                                                    @elseif ( $ahli_mesyuarat-> mesyuarat_ksukp == '1')
                                                    <td>KSUKP</td>   
                                    @endif

    <br clear=all style='mso-special-character:line-break;page-break-after:always' />
    <div class="MsoFooter" style='mso-element:footer' id="f1">
    <p class=MsoFooter align=right style='margin-bottom:0in;margin-bottom:.0001pt; text-align:right;line-height:normal'> 
    <span style=<span style='mso-field-code:" PAGE "'></span></p> 
    </div>
</div>

</body>
</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_MaklumatAhliMesyuarat.doc");
?>