<?php
$width = 100;  
$height = 120; 
$pageLayout = array($width, $height); //  or array($height, $width) 
$pdf = new TCPDF("L", "mm", $pageLayout , true, 'UTF-8', false);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetTitle('Barcode');
// $pdf->SetMargins(10, 10, 10, true);
// ---------------------------------------------------------

$style = array(
    'position' => 'C',
    'align' => 'C',
    'stretch' => true,
    'fitwidth' => true,
    'width' =>'150px',
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 0,
    'vpadding' => 0,
    'marginTop' => 10, 
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
// $pdf->Ln();
foreach($code as $value) {
    $pdf->AddPage();
    // $pdf->Ln();
    $pdf->write1DBarcode($value, 'C128', '', '', '', 50, 1, $style, 'N');
    // $pdf->Ln();
    
}

// $pdf->Ln();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('barcode.pdf', 'I');
$pdf->SetTitle('Barcode');
//============================================================+
// END OF FILE
//============================================================+