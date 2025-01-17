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
    mso-page-orientation:potrait;
    mso-header-margin:.5in;
    margin:.2in .0in .0in .0in;
    mso-footer-margin:.5in; 
    mso-paper-source:0;
    mso-header:h1;
    mso-footer:f1;

}
div.Section1 { 
    page:Section1; 
}

body {  
    font-family : Arial, Helvetica, sans-serif; 
    font-size : 14pt; 
} 
</style>

</head>
<body>

<div class="Section1">
    <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-padding-top-alt:0in; mso-padding-bottom-alt:0in">
        
    <?php
    $columns    = $column_display;
    $count      = $ahliMesyCount1;
    $i          = 0;
    $bil        = 0;
    foreach($ahli_mesyuarat as $ahli) {
    
        $bil = $bil+1;
        if($i % $columns == 0){
        ?>
            <tr style='height:52pt'>
        <?php
        }
        ?>
            <td width=397 style='width:298.05pt;padding:0in .75pt 0in .75pt;height:52pt'>
                <p class=MsoNormal style='margin-top:0in;margin-right:17.95pt;margin-bottom: 0in;margin-left:17.95pt;margin-bottom:.0001pt'><o:p><font size="2" face="Arial, Helvetica, sans-serif">
                ({{ $bil }})<b> {{ $ahli->nama_ahli }}</b>
                </p>
                <p class=MsoNormal style='margin-top:0in;margin-right:17.95pt;margin-bottom: 0in;margin-left:17.95pt;margin-bottom:.0001pt'><o:p><font size="2" face="Arial, Helvetica, sans-serif">

                {{ $ahli->alamat }}

                </font></o:p>
                </p>
            </td>
        <?php
        if(($i % $columns) == ($columns - 1) || ($i + 1) == $columns){
            ?>
            <tr style="height:40pt">
            <?php
        }
        $i++;
    }

    ?>
    </table>
</div>

</body>
</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_CetakanStickerAlamat.doc");
?>