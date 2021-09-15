<?php

$pdf->AddPage();
$html = '<h1 style="text-align: center; font-size: 24px;">LEMBAR DISPOSISI</h1><br>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetFont('helvetica', 'B', 11);
$tbl = <<<EOD
<table cellspacing="0" cellpadding="5">
    <tr>
        <td style="border-bottom: 1px solid #000;">TANGGAL PENYELESAIAN</td>
        <td style="border-bottom: 1px solid #000;" width="30" align="center">:</td>
        <td style="border-bottom: 1px solid #000;">$today</td>
    </tr><br>
    <tr>
        <td>DARI</td>
        <td width="30" align="center">:</td>
        <td></td>
    </tr>
    <tr>
        <td>PERIHAL</td>
        <td width="30" align="center">:</td>
        <td></td>
    </tr>
    <tr>
        <td>TANGGAL SURAT</td>
        <td width="30" align="center">:</td>
        <td></td>
    </tr>
    <tr>
        <td>NO. SURAT</td>
        <td width="30" align="center">:</td>
        <td></td>
    </tr><br>
    <tr>
        <td style="border-top: 1px solid #000; border-right: 1px solid #000;" >INSTRUKSI/INFORMASI</td>
        <td style="border-top: 1px solid #000;" colspan="2">DITERUSKAN KEPADA:</td>
    </tr>
    <tr>
        <td style="border-right: 1px solid #000;" ></td>
        <td colspan="2"></td>
    </tr>
        <tr>
        <td style="border-right: 1px solid #000;" ></td>
        <td colspan="2"></td>
    </tr>
        <tr>
        <td style="border-right: 1px solid #000;" ></td>
        <td colspan="2"></td>
    </tr>
        <tr>
        <td style="border-right: 1px solid #000;" ></td>
        <td colspan="2"></td>
    </tr>
        <tr>
        <td style="border-right: 1px solid #000;" ></td>
        <td colspan="2"></td>
    </tr>
        <tr>
        <td style="border-right: 1px solid #000;" ></td>
        <td colspan="2"></td>
    </tr>
        <tr>
        <td style="border-right: 1px solid #000;" ></td>
        <td colspan="2"></td>
    </tr>


</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

