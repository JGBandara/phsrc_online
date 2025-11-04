<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/cls_pdf.php';

$pdf = new cls_pdf();
$recRecNumber = "INV20251104";
$row = [
    "receipt_number" => $recRecNumber,

];

$pdfPath = $pdf->generateFromTemplate('receiptTemplate.php', $row, $recRecNumber, 'receipts', 'F');
?>