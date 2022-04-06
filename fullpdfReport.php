<?php
require('fpdf/fpdf.php');
include "includes/db.php";
include "includes/function.php";
// include "includes/check_query.php";



if(isset($_GET['team_name'])){

    $team_name =$_GET['team_name'];
    
if(isset($_GET['selected_license'])){
    $getlicenseID = $_GET['selected_license'];
    $pdf = new FPDF('p', 'mm', 'A4', true, 'UTF-8', false);
  
    $pdf->AddPage();
   
    $pdf->SetFont('Arial','B',9);
    $new_license_list=[];
    $split_licenseID = explode(',', $getlicenseID);

    $new_license_list = $split_licenseID;



}

if(isset($_GET['check_license'])){
  $getCheckList = $_GET['check_license'];
  $new_check_list=[];
  $split_CheckList = explode(',', $getCheckList);
  $new_check_list = $split_CheckList;
}

foreach($new_license_list as $licenseID){

$query = "SELECT * FROM $team_name WHERE 
    license_id in ({$licenseID}) ";

$get_report_query = mysqli_query($connection, $query);
// check_query($get_report_query);

foreach($get_report_query as $rows){
 
  if(isset($_GET['check_license'])){

  foreach($new_check_list as $checklist){
 
    switch($checklist){          
      case 'license_number':
          $license_number =  $rows['license_number']; 
          $pdf->Cell(50,10,'Number', 1, 0, 'L');
          $pdf->MultiCell(0,10,' '.$license_number, 1, 'L');
      break;
      case 'license_name':
          $license_name = $rows['license_name']; 
          $pdf->Cell(50,10,'Name', 1, 0, 'L');
          $pdf->MultiCell(0,10,' '.$license_name, 1, 'L');
      break;
      case 'license_type':
         $license_type = $rows['license_type'];
         $pdf->Cell(50,10,'Type', 1, 0, 'L');
         $pdf->MultiCell(0,10,' '.$license_type, 1, 'L');
     break;
     
      case 'license_authority':
        $license_authority = $rows['license_authority'];
        $pdf->Cell(50,10,'Authority', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$license_authority, 1, 'L');
    break;
     
      case 'license_expiry':
        $license_expiry = $rows['license_expiry'];
        $pdf->Cell(50,10,'Expiry', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$license_expiry, 1, 'L');
    break;
      
      
      case 'license_renewal':
         $license_renewal = $rows['license_renewal'];
         $pdf->Cell(50,10,'Renewal', 1, 0, 'L');
         $pdf->MultiCell(0,10,' '.$license_renewal, 1, 'L');
     break;
       
     
      case 'license_company':
        $license_company = $rows['license_company'];
        $pdf->Cell(50,10,'Company', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$license_company, 1, 'L');
    break;
       
     
      case 'license_address':
        $license_address = $rows['license_address'];
        
        $pdf->Cell(50,10,'Address', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$license_address, 1, 'L');
      
    break;
      
      case 'license_other_company':
        $license_other_company = $rows['license_other_company'];
        $pdf->Cell(50,10,'Other company', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$license_other_company, 1, 'L');
    break;
    
      case 'license_status':
        $license_status = $rows['license_status'];
        $pdf->Cell(50,10,'Status', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$license_status, 1, 'L');
    break;
     
      case 'license_details':
          $license_details = $rows['license_details'];
          $pdf->Cell(50,10,'Details', 1, 0, 'L');
          $pdf->MultiCell(0,10,' '.$license_details, 1, 'L');
      break;
     
      case 'license_activity':
        $license_activity = $rows['license_activity'];
        $pdf->Cell(50,10,'Activity', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$license_activity, 1, 'L');
    break;
 
    case 'license_cost':
        $license_cost = $rows['license_cost'];
        $pdf->Cell(50,10,'Cost', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$license_cost, 1, 'L');
    break;
    case 'parties_involved':
        $parties_involved = $rows['parties_involved'];
        $pdf->Cell(50,10,'Parties involved', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$parties_involved, 1, 'L');
    break;
    case 'person_in_charge':
       $person_in_charge = $rows['person_in_charge'];
       $pdf->Cell(50,10,'PIC', 1, 0, 'L');
       $pdf->MultiCell(0,10,' '.$person_in_charge, 1, 'L');
    break;
    case 'department_in_charge':
        $department_in_charge = $rows['department_in_charge'];
        $pdf->Cell(50,10,'Department', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$department_in_charge, 1, 'L');
    break;
    case 'company_region':
        $company_region = $rows['company_region'];
        $pdf->Cell(50,10,'Company region', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$company_region, 1, 'L');
    break;
    case 'special_action':
        $special_action = $rows['special_action'];
        $pdf->Cell(50,10,'Speical Action', 1, 0, 'L');
        $pdf->MultiCell(0,10,' '.$special_action, 1, 'L');
    break;
  }
  
  
 
  
  }
}else{
  $license_company = $rows['license_company'];
  $license_renewal = $rows['license_renewal'];
  $license_expiry = $rows['license_expiry'];

  $pdf->Cell(50,10,'Company', 1, 0, 'L');
  $pdf->MultiCell(0,10,' '.$license_company, 1, 'L');
  $pdf->Cell(50,10,'Expiry', 1, 0, 'L');
  $pdf->MultiCell(0,10,' '.$license_expiry, 1, 'L');
  $pdf->Cell(50,10,'Renewal', 1, 0, 'L');
  $pdf->MultiCell(0,10,' '.$license_renewal, 1, 'L');

}
  
  
  $pdf->Ln(10);
}


    
  }

}
// will generate the pdf
$pdf->Output();
?>