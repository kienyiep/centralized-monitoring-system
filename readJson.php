<?php
include "includes/db.php";
include "includes/function.php";
$renewalArray = json_decode($_POST['renewalArray'],true);
// print_r($_POST['renewalArray']);

$team_name= $renewalArray[0]['team'];

$renewal_fetch=[];


$team_stmt = mysqli_prepare($connection,"SELECT license_id FROM $team_name" );
mysqli_stmt_execute($team_stmt);
mysqli_stmt_bind_result($team_stmt,$license_GET);

while(mysqli_stmt_fetch($team_stmt)){
    $renewal_id = $license_GET;
    array_push($renewal_fetch,$renewal_id);
}


print_r($renewal_fetch);


foreach($renewalArray as $renew_array){
    $renew_id = $renew_array['id'];
    $renew_year = $renew_array['year'];
    $renew_month = $renew_array['month'];
    $renew_day = $renew_array['date'];

  
    if (in_array($renew_id, $renewal_fetch))
    {
      $update_stmt = mysqli_prepare($connection,"UPDATE $team_name SET renewal_year=?, renewal_month=?, renewal_day=? WHERE license_id=?" );
      mysqli_stmt_bind_param($update_stmt,"iiii",$renew_year, $renew_month, $renew_day, $renew_id);
      mysqli_stmt_execute($update_stmt);
      mysqli_stmt_close($update_stmt);
    }
    else
    {
      $insert_stmt = mysqli_prepare($connection,"INSERT INTO $team_name(renewal_year,renewal_month,renewal_day) VALUES(?,?,?)" );
      mysqli_stmt_bind_param($insert_stmt,"iii", $renew_year, $renew_month, $renew_day);
      mysqli_stmt_execute($insert_stmt);
      mysqli_stmt_close($insert_stmt);

    }


}



?>