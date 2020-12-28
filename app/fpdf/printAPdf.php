<?php
// Instanciation de la classe dérivée
include 'PDF.class.php';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Impression de la ligne numéro '.$i,0,1);
$pdf->Output();