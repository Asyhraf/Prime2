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
    vertical-align: center;
}
    
</style>
</head>

<body>
<div class="Section1">
    <div class="pstyle2">
    Senarai Jawatan
    </div>
    <br><br>
    <table>
        <thead>
            <tr height="50%" style="background-color:#f1f1f1">
                <th width="10%">BIL.</th>
                <th width="90%">NAMA JAWATAN</th>                             
            </tr>
        </thead>

        <tbody> 
        @forelse($ref_jawatan as $counter => $jawatan)                          
            <tr>
                <td style="text-align: center">
                {{ $counter+1 }}.
                </td> 
                
                <td> 
                {{ $jawatan->nama_jawatan }}        
                </td>       
            </tr>  
        @empty
        @endforelse        
        </tbody>
    </table>
    
    <div class="MsoFooter" style='mso-element:footer' id="f1">
    <p class=MsoFooter style='margin-bottom:0in; margin-bottom:.0001pt; text-align:right; line-height:normal'> 
    <span style=<span style='mso-field-code:" PAGE "'></span></p> 
    </div>
</div>

</body>
</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_CetakanJawatan.doc");
?>