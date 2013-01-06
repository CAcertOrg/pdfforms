<?php

// Optionally define the filesystem path to your system fonts
// otherwise tFPDF will use [path to tFPDF]/font/unifont/ directory
// define("_SYSTEM_TTFONTS", "C:/Windows/Fonts/");

require_once('lib/tfpdf.php');

$pdf = new tFPDF();
$pdf->AddPage();

// Add a Unicode font (uses UTF-8)
 $pdf->AddFont('FreeSans','I','FreeSansOblique.ttf',true);
 $pdf->AddFont('FreeSans','','FreeSans.ttf',true);
 $pdf->AddFont('FreeSans','B','FreeSansBold.ttf',true);
 $pdf->AddFont('FreeSans','BI','FreeSansBoldOblique.ttf',true);
 $pdf->AddFont('FreeSans','I','FreeSansOblique.ttf',true);
 $pdf->AddFont('PierreDingbats','','PierreDingbats.ttf',true);
 $pdf->SetFont('FreeSans','B',14);

$pdf->Ln(10);
$pdf->Write(5,'The file size of this PDF is only 12 KB.');

$pdf->Output("test.pdf","D");
?>
