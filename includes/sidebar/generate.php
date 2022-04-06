<?php
$data = array("");

if(isset($_POST['save-multicheckbox'])){
  if(isset($_POST['checklist']) && isset($_POST['checklicense'])){
    
  $checklist = $_POST['checklist'];
  $array_checklist= array();
  foreach($checklist as $checkitems){
     array_push($array_checklist, $checkitems);
  }
  $join_array_checklist = implode(',' , $array_checklist);

  $checklicense = $_POST['checklicense'];
  $array_checklicense = array();
 

    foreach($checklicense as $check){
    array_push($array_checklicense, $check);
  }
  $join_array_checklicense = implode(',' , $array_checklicense);
   // echo $join_array_checklicense;
    header("Location: fullpdfReport.php?team_name=$team_name&selected_license=$join_array_checklist&check_license=$join_array_checklicense");
  
  
 }else  if(isset($_POST['checklist'])){
  $checklist = $_POST['checklist'];
  $array_checklist= array();
  foreach($checklist as $checkitems){
     array_push($array_checklist, $checkitems);
  }
  $join_array_checklist = implode(',' , $array_checklist);
  header("Location: fullpdfReport.php?team_name=$team_name&selected_license=$join_array_checklist");
   //   header("Location: main.php?team_name=$team_name&source=$source");
 }
}
?>