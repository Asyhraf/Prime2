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
MAKLUMAT PENGGUNA SISTEM
</div>
<br><br>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">

            <div class="card mb-4">
            <div class="card-header">
                <i class="fa fa-table"></i>
                Maklumat Pengguna Sistem - {{ $user->name }}
            </div>

                <body>
                    {{csrf_field()}}

                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                
                    
                                <!----------------------------------------------------------- Pengurusan Pengguna Sistem ----------------------------------------------------------->
                                <tr style= "background-color:#212F3D">
                                    <th style="text-align: center"><strong><font color="#FFFFFF">PERKARA</font></strong></th>
                                    <th style="text-align: center"><b><strong><font color="#FFFFFF">BUTIRAN</font></strong></b></th>
                                </tr>

                                <tr style= "background-color:#FFFFFF">
                                        <th style="text-align: center"><strong>NAMA</strong></th>
                                        <td>{{ $user->name }}</td>
                                </tr>

                                <tr style= "background-color:#FFFFFF">
                                        <th style="text-align: center"><strong>UNIT</strong></th>
                                        <td>{{ $user->Unit->nama_unit }}</td>
                                </tr>

                                <tr style= "background-color:#FFFFFF">
                                        <th style="text-align: center"><strong>PERANAN</strong></th>
                                        <td>{{ $user->Peranan->nama_peranan }}</td>
                                </tr>

                               
                    </table><br>
                </body>
            </div>
            </div>
        </div>
    </div>
</div>

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
header("Content-Disposition: attachment;Filename=p_MaklumatPenggunaSistem.doc");
?>