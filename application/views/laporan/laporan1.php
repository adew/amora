<?php 

    ob_start();
    require_once APPPATH . 'third_party/tcpdf/config/tcpdf_config.php';
    
    $pdf = new PDF();
    
    
    $pdf->SetTitle('Laporan');
    
    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->SetFont('dejavusans', 'B', 26);
    $pdf->AddPage();
    
    $pdf->Write(10, $title, '', false, 'C', true);
    $pdf->Ln(10);
    $pdf->SetFont('dejavusans', '', 10);
    $html = $table;
    $pdf->writeHTML($html);
    ob_clean();
    $pdf->Output('laporan-surat-masuk.pdf', 'I');
?>

