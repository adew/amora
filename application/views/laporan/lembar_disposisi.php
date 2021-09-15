<?php 

    ob_start();
    require_once APPPATH . 'third_party/tcpdf/config/tcpdf_config.php';
    
    $pdf = new PDF_1();
    
    
    $pdf->SetTitle('Laporan');
    
    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->AddPage();
    $pdf->SetFont('dejavusans', 'B', 12);
    $pdf->Write(0, 'LEMBAR DISPOSISI', '', 0, 'C', true, 0, false, false, 0);

    $pdf->Ln();
    $pdf->SetFont('dejavusans', '', 12);

    $pdf->Ln();


    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);

    $pdf->MultiCell(60, 10, 'TANGGAL PENYELESAIAN', 'B', 'L', 1, 0);
    $pdf->MultiCell(60, 10, ':', 'B', 'C', 1, 0);
    $pdf->MultiCell(60, 10, $today, 'B', 'L', 1, 1);

    $pdf->Ln(5);

    $pdf->MultiCell(60, 4, 'DARI', 0, 'L', 1, 0);
    $pdf->MultiCell(60, 4, ':', 0, 'C', 1, 0);
    $pdf->MultiCell(60, 4, $disposisi_surat_masuk->dari, 0, 'L', 1, 1);

    $pdf->Ln();

    $pdf->MultiCell(60, 4, 'PERIHAL', 0, 'L', 1, 0);
    $pdf->MultiCell(60, 4, ':', 0, 'C', 1, 0);
    $pdf->MultiCell(60, 4, $disposisi_surat_masuk->perihal, 0, 'L', 1, 1);

    $pdf->Ln();

    $pdf->MultiCell(60, 4, 'TANGGAL SURAT', 0, 'L', 1, 0);
    $pdf->MultiCell(60, 4, ':', 0, 'C', 1, 0);
    $pdf->MultiCell(60, 4, $disposisi_surat_masuk->tgl_surat, 0, 'L', 1, 1);

    $pdf->Ln();

    $pdf->MultiCell(60, 4, 'NO. SURAT', 0, 'L', 1, 0);
    $pdf->MultiCell(60, 4, ':', 0, 'C', 1, 0);
    $pdf->MultiCell(60, 4, $disposisi_surat_masuk->no_surat, 0, 'L', 1, 1);

    $pdf->Ln();

    $html = '<p>INSTRUKSI/INFORMASI *)</p>';
    $pdf->MultiCell(90, 50, $html . $disposisi_surat_masuk->keterangan, 'TR', 'L', 1, 0, '', '', true, 0, true);

    $html = '<p>DITERUSKAN KEPADA:</p>';
    $pdf->MultiCell(90, 50, $html . $disposisi_surat_masuk->kepada, 'T', 'L', 1, 0, '', '', true, 0, true);
    
    ob_clean();
    $pdf->Output('laporan-surat-masuk.pdf', 'I');
?>



