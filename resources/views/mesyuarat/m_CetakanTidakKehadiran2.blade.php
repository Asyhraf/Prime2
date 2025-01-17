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

	<title>Maklumat Peribadi</title>
	<style>
		p.MsoHeader {
			font-size: 12.0pt;
			font-family: Arial, Helvetica, sans-serif;
			line-height: 100%;
		}

		p.MsoFooter,
		li.MsoFooter,
		div.MsoFooter {
			margin: 0in;
			margin-bottom: 0in;
			mso-pagination: widow-orphan;
			tab-stops: center 3.0in right 6.0in;
			font-size: 12.0pt;
			font-family: Arial, Helvetica, sans-serif;
			line-height: 100%;
			text-align: right;
		}

		/* Style Definitions */

		@page Section1 {
			size: 29.7cm 21cm;
			margin: 2cm 2cm 2cm 2cm;
			/*top-right-bottom-left*/
			mso-header-margin: 1.6cm;
			mso-footer-margin: 1.6cm;
			mso-title-page: yes;
			mso-header: h1;
			mso-footer: f1;
			mso-first-header: fh1;
			mso-first-footer: ff1;
			mso-paper-source: 0;
			font-size: 14pt;
			font-family: Arial, Helvetica, sans-serif;
			line-height: 115%;
		}

		div.Section1 {
			page: Section1;
		}

		#table1 {
			border: none;
			border-collapse: collapse;
			font-family: Arial;
			font-size: 12pt;
			text-align: left;
		}

		table#headerfooter {
			margin: 0in 0in 0in 900in;
			width: 1px;
			height: 1px;
			overflow: hidden;
		}
	</style>
</head>

<body style='tab-interval:.5in'>
	<div class="Section1">
		<p style="text-align: center">
            <b>SENARAI KEHADIRAN AHLI MESYUARAT (TIDAK HADIR)<br>
            {{ Str::upper(Str::limit($event->TajukMesyuarat->nama_tajuk,110)) }} ({{ $event->title }})<br>
            BILANGAN {{ $event->meeting_numbers }} TAHUN {{ $event->year }}<br>
            -------------------------------------------------------------------------------------------</b>
		</p>

		<table width="100%" cellspacing="0" cellpadding="0" id="table1">
			<thead>
				<tr>
					<th width="8%" valign="top" style="text-align: center"><b><u>BIL</u></b></th>
					<th width="42%" valign="top" style="text-align: center"><b><u>NAMA DAN JAWATAN</u></b></th>
					<th width="15%" valign="top" style="text-align: center"><b><u>GRED</u></b><br><br></th>
					<th width="15%" valign="top" style="text-align: center"><b><u>CATATAN</u></b><br><br></th>
					<th width="20%" valign="top" style="text-align: center"><b><u>DIWAKILI</u></b><br><br></th>
				</tr>
			</thead>

			@forelse($tidakkehadiran as $counter => $hadir)
			<tbody>
				<tr>
					<td valign="top" style="text-align: center">
						{{ $counter+1 }}.
					</td>

					<td valign="top">
						<b>{{ $hadir->nama_ahli }}</b><br>
						<span style="color: blue;">{{ $hadir->nama_jawatan }}</span>
						@if(!empty($hadir->nama_kementerian))
						<br><span style="color: blue;">{{ $hadir->nama_kementerian }}</span>
						@endif
					</td>

					<td valign="top" style="text-align: center">
						@if(!empty($hadir->nama_gred))
						{{ $hadir->nama_gred }}
						<br>{{ date('d/m/Y', strtotime($hadir->tarikh_lantikan)) }}
						@else
						Tiada Maklumat<br>Gred / Tarikh Lantikan
						@endif
					</td>

					<td valign="top" style="text-align: center">
						@if(!empty($hadir->catatan))
						{{ $hadir->catatan }}<br>
						@else
						Tiada Catatan<br>
						@endif
					</td>

					<td valign="top" style="text-align: center">
						@if(!empty($hadir->wakil_oleh))
						{{ $hadir->wakil_oleh }}
						@else
						Tiada Wakil
						@endif
					</td>
				</tr>

                <tr>
                    <td colspan="3" style="height: 10px;"></td>
                </tr>
			</tbody>
			@empty
			<tr>
				<br><br><br><br>
				<td colspan="3" style="text-align: center"><b>Tiada Rekod Kehadiran </b></td>
			</tr>
			</tbody>
			@endforelse
		</table>

		<br><br><br><br>
		<p style="text-align: left">
			Bahagian Kabinet, Perlembagaan dan<br />
			Perhubungan Antara Kerajaan,<br />
			Jabatan Perdana Menteri,<br />
			PUTRAJAYA
		</p>

		<p style="text-align: left"><b>{{ date('d/m/Y', strtotime($date)) }}</b></p>

		<table id='headerfooter' border='0' cellspacing='0' cellpadding='0'>

			<div style='mso-element:header' id=h1>
				<p class=MsoHeader><b>RAHSIA</b></p>
			</div>

			<div style="mso-element:footer" id=f1>
				<div style="display: flex; justify-content: center; align-items: center; width: 100%; font-family: Arial, sans-serif; font-size: 12pt;">
					<div style="flex: 1; text-align: center;">
						<b>(</b><span style="display: inline-block;"><span style='mso-field-code:" PAGE "'></span></span><b>)</b>
					</div>
					<div style="flex: 1; text-align: right;">
						<span style="margin-left: auto;"><b>RAHSIA</b></span>
					</div>
				</div>
			</div>

			<div style='mso-element:header' id=fh1>
				<p class=MsoHeader><b>RAHSIA</b></p>
			</div>

			<div style='mso-element:footer' id=ff1>
				<p class=MsoFooter><b>RAHSIA</b></p>
			</div>

		</table>
	</div>
</body>

</html>
<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=SENARAI_KETIDAKHADIRAN ($event->title Bil $event->meeting_numbers- $event->year).doc");
?>
