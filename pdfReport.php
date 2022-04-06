<?php
require('fpdf/fpdf.php');
include "includes/db.php";
if(isset($_GET['team_name'])){
if(isset($_GET['report_id'])){
    $team_name =$_GET['team_name'];
    $report_id = $_GET['report_id'];
    $query = "SELECT * FROM $team_name  WHERE license_id = {$report_id}";
    $get_report_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($get_report_query)){
        $license_number = $row['license_number'];
        $license_name = $row['license_name'];
        $license_type = $row['license_type'];
        $license_authority = $row['license_authority'];
        $license_expiry = $row['license_expiry'];
        $license_renewal = $row['license_renewal'];
        $license_company = $row['license_company'];
        $license_details=$row['license_details'];
      }
    
$pdf = new FPDF('p', 'mm', 'A4', true, 'UTF-8', false);
// to display the content
$pdf->AddPage();
// setFont（fontfamily, B/I/U, Font Size)
$pdf->SetFont('Arial','B',16);
/* cell(cell width ,cell height, actual text,border (1- if we want a border for the cell 0- if we dont want a border on a cell.), the next position of the cell after this cell(0-the next cell will be the same line, 1- the next cell will be the next line), allignment(c-center, l-left, r-right)) */
// $pdf->Cell(40,10,'Hello World!', 0, );

$pdf->Cell(0,10,$license_name, 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(43,10,'License Info', 1, 0, 'L');
$pdf->Cell(0,10,' Licnese Content', 1, 1, 'L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(43,10,'Number', 1, 0, 'L');
$pdf->Cell(0,10,' '.$license_number, 1, 1, 'L');

$pdf->Cell(43,10,'type', 1, 0, 'L');
$pdf->Cell(0,10,' '.$license_type, 1, 1, 'L');
$pdf->Cell(43,10,'Authorizer', 1, 0, 'L');
$pdf->Cell(0,10,' '.$license_authority, 1, 1, 'L');
$pdf->Cell(43,10,'Company involved', 1, 0, 'L');
$pdf->Cell(0,10,' '.$license_company, 1, 1, 'L');
$pdf->Cell(43,10,'Due date', 1, 0, 'L');
$pdf->Cell(0,10,' '.$license_expiry, 1, 1, 'L');
$pdf->Cell(43,10,'Renewal date', 1, 0, 'L');
$pdf->Cell(0,10,' '.$license_renewal, 1, 1, 'L');


// $pdf->SetY(-32);
// $pdf->Cell(38,10,"License due date: ", 0, 0, 'L');
// $pdf->Cell(80,10,$license_expiry, 0, 0, 'L');
// $pdf->Cell(45,10,"License renewal date: ", 0, 0, 'L');
// $pdf->Cell(0,10,$license_renewal, 0, 0, 'L');



}
}
// will generate the pdf
$pdf->Output();
?>