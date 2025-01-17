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
            mso-page-orientation: portrait;
            margin: 2.54cm 2.54cm 2.54cm 2.54cm;
            /*top-right-bottom-left*/
            mso-paper-source: 0;
            mso-header: h1;
            mso-footer: f1;
        }

        div.Section1 {
            page: Section1;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14pt;
        }

        table {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14pt;
            border-collapse: collapse;
        }
    </style>

</head>

<body>

    <div class="Section1">
        <?php
        $i          = 1;
        foreach ($ahli_mesyuarat as $key => $ahli) {
            if ($key % 4 == 0) {
                // Start a new table for every fourth row
                if ($key != 0) {
                    echo '</table>';
                    echo '<br clear="all" style="mso-special-character:line-break;page-break-after:always">';
                }
                echo '<table border="1" cellspacing="0" cellpadding="0" style="width:100%; border-collapse:collapse; mso-padding-top-alt:0in; mso-padding-bottom-alt:0in;">';
            }
        ?>
            <tr>
                <td style='padding:0in .75pt 0in 0.2cm; height:52pt'>
                    <p class=MsoNormal style='margin-top:0in;margin-right:17.95pt;margin-bottom: 0in;margin: left 0in;;margin-bottom:.0001pt'>
                        <o:p>
                            <font size="14pt" face="Arial, Helvetica, sans-serif" style="text-transform: uppercase;">
                                <b> {{ $ahli->nama_ahli }}</b>
                            </font>
                    </p>
                    <p class=MsoNormal style='margin-top:0in;margin-right:17.95pt;margin-bottom: 0in;margin-left:0in;margin-bottom:.0001pt'>
                        <o:p>
                            <font size="14pt" face="Arial, Helvetica, sans-serif">
                                <!-- {!! nl2br(e($ahli->alamat)) !!} -->
                                <?php
                                $alamat_lines = explode("\n", $ahli->alamat); // Split the address into lines
                                $num_lines = count($alamat_lines); // Count the number of lines

                                foreach ($alamat_lines as $line_key => $line) {
                                    if ($line_key == $num_lines - 1) { // Check if it's the last line
                                        echo "<b>" . nl2br(e($line)) . "</b>"; // If yes, make it bold
                                    } else {
                                        echo nl2br(e($line));
                                    }
                                }
                                ?>
                            </font>
                        </o:p>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="height:50pt; border:none">
                </td>
            </tr>
        <?php
            $i++;
        }
        // Close the last table
        echo '</table>';
        ?>
    </div>

</body>

</html>

<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=p_CetakanStickerAlamat.doc");
?>