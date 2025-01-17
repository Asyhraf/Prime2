@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">

        <div class="col-12 text-right">
            <a href="javascript:history.back()" title="Kembali" class="btn btn-primary btn-sm float-right rounded">
                <i class="fa fa-backward"></i> Kembali
            </a>
        </div>

        <div class="card-header">
            <h3 class="text-center text-uppercase"><b>Susun Atur Kedudukan {{ $event->TajukMesyuarat->nama_tajuk }}</b></h3>
            <h3 class="text-center text-uppercase"><b>Bil. {{ $event->meeting_numbers }} Tahun {{ $event->year }} Pada {{ date('d/m/Y', strtotime($event->start)) }}</b></h3>
        </div>

        <div class="card-body">

            <table border="0" align="center" cellpadding="5" cellspacing="0" style="border-left: 1px solid #3315ab; border-right: 1px solid #3315ab; border-top: 1px solid #3315ab; border-bottom: 1px solid #3315ab">
                <tr>
                    <td>
                        <div style="overflow-x:auto;">
                            <table border=0 cellspacing=0 cellpadding=0 align=center style="text-align:center;">

                                <tr>
                                    <td width="100">&nbsp;</td>
                                    <td width="25">&nbsp;</td>
                                    <td width="250">&nbsp;</td>
                                    <td width="50">
                                        <font size="3px"><b>MBKM<b></font>
                                    </td>
                                    <td width="250">&nbsp;</td>
                                    <td width="25">&nbsp;</td>
                                    <td width="250">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td bgcolor="#8A87D1">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>

                                <tr>
                                    <td valign="top">
                                        <!-- WING PALING KIRI -->
                                        <table border=1 cellspacing=0 cellpadding=0 align=left width=80 style="border-collapse:collapse;border-color:#3315ab;">
                                            <tr>
                                                <td>
                                                    <table border=0 cellspacing=2 cellpadding=2 align=left width=80>
                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">TKSU(K)</td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">SUB(B)</td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">SUB(C)</td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">SUB(P)</td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">KPSU(H)</td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">PEG. KHAS KSN</td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">SUSK KSN</td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">PEG. KSN 1</td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">PEG. KSN 2</td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" align="left" style="font-size:9px; font-family:'Arial';">PEG. KSN 3</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- END PALING KIRI -->
                                    </td>

                                    <td>&nbsp;</td>

                                    <td valign="top">
                                        <!-- WING KIRI -->
                                        <table border=0 cellspacing=0 cellpadding=0 align=center width=100%>
                                            @forelse($ahli_mesyuaratGenap as $counter => $ahli)
                                            <tr>
                                                <td valign="top" align="right" style="font-size:10px; font-family:'Arial';">
                                                    {{ $ahli->nama_jawatan }}
                                                    @if( $ahli->nama_kementerian =="")
                                                    @else
                                                    {{ $ahli->nama_kementerian }} ({{ $ahli->singkatan_kementerian }})
                                                    @endif
                                                    <br><strong>({{ $ahli->nama_ahli }})</strong>
                                                    <br>{{ $ahli->nama_gred }} ({{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }})
                                                </td>

                                                <td>&nbsp;&nbsp;</td>

                                                <td width=20 bgcolor="#8A87D1" valign="top" align="center" style="font-size:10px; font-family:'Arial';">
                                                    &nbsp;&nbsp; {{ $ahli->kekananan_mesy_manual }} &nbsp;&nbsp;<br><br><br><br><br></td>
                                                <td>&nbsp;&nbsp;</td>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td bgcolor="#8A87D1">&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="3">Tiada Rekod Kehadiran Dicatatkan</td>
                                </tr>
                                @endforelse
                            </table>
                            <!-- END WING KIRI -->
                    </td>
                    <td>&nbsp;</td>

                    <td valign="top">
                        <!-- WING KANAN -->

                        <table border=0 cellspacing=0 cellpadding=0 align=center width=100%>
                            @forelse($ahli_mesyuaratGanjil as $counter => $ahli)
                            <tr>
                                <td width=20 bgcolor="#8A87D1" valign="top" align="center" style="font-size:10px; font-family:'Arial';">
                                    &nbsp;&nbsp; {{ $ahli->kekananan_mesy_manual }} &nbsp;&nbsp;<br><br><br><br><br></td>

                                <td valign="top" align="right" style="font-size:10px; font-family:'Arial';">
                                    {{ $ahli->nama_jawatan }}
                                    @if( $ahli->nama_kementerian =="")
                                    @else
                                    {{ $ahli->nama_kementerian }} ({{ $ahli->singkatan_kementerian }})
                                    @endif
                                    <br><strong>({{ $ahli->nama_ahli }})</strong>
                                    <br>{{ $ahli->nama_gred }} ({{ date('d/m/Y', strtotime($ahli->tarikh_lantikan)) }})
                                </td>
                                <td>&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td>
                            </tr>

                            <tr>
                                <td bgcolor="#8A87D1"></td>
                                <td>&nbsp;</td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="3">Tiada Rekod Kehadiran Dicatatkan</td>
                            </tr>
                            @endforelse
                        </table>
                        <!-- END WING KANAN -->
                    </td>

                    <td>&nbsp;</td>

                    <td valign="top">
                        <!-- WING PALING KANAN -->

                        <table border=0 cellspacing=0 cellpadding=0 align=center width=100%>
                            <tr>
                                <td valign="top" align="right" style="font-size:10px; font-family:'Arial';">
                                <td>&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td>
                            </tr>

                            <tr>
                                <td bgcolor="#8A87D1"></td>
                                <td>&nbsp;</td>
                            </tr>

                            <tr>
                                <td colspan=5>
                                    <?php for ($nbr = 0; $nbr < 160; $nbr++) { ?>
                                        <br>
                                    <?php } ?>

                                    <table valign="bottom" border=0 cellspacing=0 cellpadding=2 width=200 align="right">
                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;"><b><u>NOTA:</u></b></td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;"><b><u>Urus setia Bhg. Kabinet & Pej. KSN:</u></b></td>
                                        </tr>


                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">1.&nbsp;&nbsp;- TKSU(K)</td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">2.&nbsp;&nbsp;- SUB(B)</td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">3.&nbsp;&nbsp;- SUB(C)</td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">4.&nbsp;&nbsp;- SUB(P)</td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">5.&nbsp;&nbsp;- KPSU(H)</td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">6.&nbsp;&nbsp;- PEG. KHAS KSN</td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">7.&nbsp;&nbsp;- SUSK KSN</td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">8.&nbsp;&nbsp;- PEG. KSN 1</td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">9.&nbsp;&nbsp;- PEG. KSN 2</td>
                                        </tr>

                                        <tr>
                                            <td valign="bottom" align="left" style="font-size:xx-small;">10.&nbsp;- PEG. KSN 3</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!-- END  WING PALING KANAN -->
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align=center><b>SKRIN</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

            </table>
        </div>
        </td>
        </tr>
        </table>
    </div>
</div>
</div>
@endsection