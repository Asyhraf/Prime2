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


<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18pt;
	font-weight: bold;
}
-->
@page 
{
	size:A4;	
}
@page Section1
{
	size:210mm 297mm; mso-page-orientation:potrait;
	mso-header-margin:.0in;
	margin: 0.0in 0.0in 0.0in 0.0in;
	/* top-right-buttom-left*/
	mso-footer-margin:.0in; mso-paper-source:0;mso-header:h1;mso-footer:f1;
	
}

mso-page-break-before:always; 
div.Section1{
	page:Section1;
}

#table1{
font-family:Arial;
font-size: 14pt;
text-align: left;
}

#style1{
font-family:Arial;
font-size: 14pt;
text-align: left;
}

.fullspace {
	text-align: justify;
	font-family: Arial;
	font-size: 14pt;

}

body{
 font-family:Arial Narrow;
 font-size: 10pt;
}

</style>
</head>
<body>

<div class="Section1">

<!-- <table  width="700" border=0 cellspacing=0 cellpadding=0 style="border-collapse:collapse; border-color:#00000;">
@for ($i = 0; $i < $ahliCount; $i++)
    <tr>
        @forelse($ahli_mesyuarat as $counter => $ahli)                          
            
                <td width="2cm" valign="top" height="3.71cm">

                ({{ $counter+1 }})
                </td>
                <td width="12.5cm" valign="top" colspan="2" height="3.71cm">
                <b>{{ $ahli->nama_ahli }}</b>
                @if($ahli->alamat== "") 
                {
                    <br>
                }
                @else
                    <br>{{ $ahli->alamat }}
                @endif
                </td>  
    </tr>
    @empty  
    @endforelse
@endfor -->


<table  width="700" border=0 cellspacing=0 cellpadding=0 style="border-collapse:collapse; border-color:#00000;">
@forelse($ahli_mesyuarat as $counter => $ahli)
    
    <tr>
        @for($r = 0; $r < 2; $r++)       
            <td width="2cm" valign="top" height="3.71cm">

            ({{ $counter+1 }})
            </td>
            <td width="12.5cm" valign="top" colspan="2" height="3.71cm">
            <b>{{ $ahli->nama_ahli }}</b>
            @if($ahli->alamat== ""){ }
            @else
                <br>{{ $ahli->alamat }}
            @endif
            </td>
        @endfor
    </tr>
@empty  
@endforelse

   
	
</table>
</div>
</body>
</html>    

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_CetakanStickerAlamat/$tajuk_mesyuarat->ringkasan.doc");
?>