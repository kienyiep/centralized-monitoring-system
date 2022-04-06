<?php
include "includes/db.php";
require 'vendor/autoload.php'; 
?>

<?php
$team_stmt = mysqli_prepare($connection, "SELECT team_id, team_name FROM teamlist" );
mysqli_stmt_execute($team_stmt);
mysqli_stmt_bind_result($team_stmt, $id_GET, $name_GET);
mysqli_stmt_store_result($team_stmt);
while(mysqli_stmt_fetch($team_stmt)){
 
  $team_selected = $id_GET;
  $user_role = "PIC";
  $teamname = $name_GET;
  

$teamname_stmt= mysqli_prepare($connection, "SELECT license_id, license_renewal, renewal_year, renewal_month,renewal_day, renewal_status FROM $teamname");
mysqli_stmt_execute($teamname_stmt);
mysqli_stmt_bind_result($teamname_stmt, $id_GET, $renewal_GET, $year_GET, $month_GET, $day_GET,$status_GET);
mysqli_stmt_store_result($teamname_stmt);

while(mysqli_stmt_fetch($teamname_stmt)){
 
  $renew_license_id = $id_GET;
  $license_renewal = $renewal_GET;
  $renewal_year = $year_GET;
  $renewal_month = $month_GET;
  $renewal_day = $day_GET;
  $renewal_status = $status_GET;
  $renewal_hour = 00;
  $renewal_min = 00;
  $renewal_date = $renewal_year.'-'.$renewal_month.'-'.$renewal_day.' '.$renewal_hour.':'.$renewal_min; 
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $renewalTime = strtotime($renewal_date);
  $currentTime = strtotime('+12 hours now');
  $distance = round(($renewalTime - $currentTime)/(60*60*24));
  echo $distance;
  
  $user_stmt = mysqli_prepare($connection,"SELECT alert_email FROM teamlist WHERE team_id= ?");
  mysqli_stmt_bind_param($user_stmt, "i", $team_selected);
  mysqli_stmt_execute($user_stmt);
  mysqli_stmt_bind_result($user_stmt, $email_GET);
  mysqli_stmt_store_result($user_stmt);

while(mysqli_stmt_fetch($user_stmt)){

$pic_email = $email_GET;

  if($distance < 0 && $renewal_status === 'true'){
$renewal_status = 'false';

      

$sender='sender email';

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom($sender, "Renew license");
$email->setSubject("Notification to renew license");
$email->addTo($pic_email, "Receiver");
$email->addContent("text/plain", "localhost/capstone2/smartglove/renewal_post.php?team_id={$team_selected}&post_id={$renew_license_id}");
$email->addContent(
    "text/html", "localhost/capstone2/smartglove/renewal_post.php?team_id={$team_selected}&post_id={$renew_license_id}"
);
$sendgrid = new \SendGrid('INPUT_SENDGRID_API_KEY');
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
    
       if($response->statusCode() >= 200 && $response->statusCode() < 230){
      $update_stmt = mysqli_prepare($connection, "UPDATE $teamname SET renewal_status=? WHERE license_id=?");
      mysqli_stmt_bind_param($update_stmt, 'si', $renewal_status, $renew_license_id);
      mysqli_stmt_execute($update_stmt);
      mysqli_stmt_close($update_stmt);
      }
    
      
} catch (Exception $e ) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}



      }
   }
    mysqli_stmt_close($user_stmt);
  
  }
  mysqli_stmt_close($teamname_stmt);
  
}
mysqli_stmt_close($team_stmt);




?>


