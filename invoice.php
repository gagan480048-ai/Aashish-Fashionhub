<?php
require('fpdf/fpdf.php');   // Make sure FPDF folder exists
include("config/db.php");

if(!isset($_GET['order'])){
    die("Invalid Order");
}

$order_number = $_GET['order'];

$result = mysqli_query($conn, 
    "SELECT * FROM orders WHERE order_number='$order_number'");

$order = mysqli_fetch_assoc($result);

if(!$order){
    die("Order Not Found");
}

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->Cell(0,10,'INVOICE',0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','',12);
$pdf->Cell(100,10,'Order Number: '.$order['order_number'],0,1);
$pdf->Cell(100,10,'Customer Name: '.$order['customer_name'],0,1);
$pdf->Cell(100,10,'Payment Method: '.$order['payment_method'],0,1);
$pdf->Cell(100,10,'Total Amount: Rs '.$order['total_amount'],0,1);
$pdf->Cell(100,10,'Order Date: '.$order['created_at'],0,1);

$pdf->Ln(10);
$pdf->Cell(0,10,'Thank you for shopping with us!',0,1,'C');

$pdf->Output();
?>