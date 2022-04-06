<?php include 'db.php'; ?>
<?php include 'function.php'; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<?php
if(isset($_POST['submit_client'])){
 $username = $_POST['username'];
 $password = $_POST['password'];

 $username = mysqli_real_escape_string($connection, $username);// clean the username
 $password = mysqli_real_escape_string($connection, $password);//clean the password


 $stmt = mysqli_prepare($connection, "SELECT user_id, username, user_password, user_firstname, user_lastname, team_selected, user_role FROM users WHERE username = ?");
 mysqli_stmt_bind_param($stmt,"s",$username);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_bind_result($stmt,$user_id, $username, $user_password, $user_firstname, $user_lastname, $team_selected, $user_role );

if(!$stmt){
            
   die('QUERY FAILED'. mysqli_error($connection));
}

//  while($row = mysqli_fetch_array($select_user_query)){
   while(mysqli_stmt_fetch($stmt)){
    $db_user_id =$user_id;
    $db_username =$username; 
    $db_user_password =$user_password;
    $db_user_firstname =$user_firstname;
    $db_user_lastname =$user_lastname;
    $db_user_team =$team_selected;
    $db_user_role =$user_role;
  
 }

if($db_user_team < 0){
   header("Location: ../index.php?invalid=team");
}else{

 if(password_verify($password, $db_user_password)){
    
   $_SESSION['username'] = $db_username;
   $_SESSION['firstname'] = $db_user_firstname;
   $_SESSION['lastname'] = $db_user_lastname;
   $_SESSION['team_selected'] = $db_user_team;
   $_SESSION['user_role'] = $db_user_role;
   $_SESSION['state'] = true;

   // $query = "UPDATE sessionstate SET ";
   // $query .= "state_bool = 'true' ";

   // $update_state = mysqli_query($connection, $query);

   // check_query($update_state);
   

   
    header("Location: ../main.php");

 }else {
    header("Location: ../index.php?invalid=password");
   //  header("Location: ../index.php");

 }
}

} else if(isset($_POST['submit_admin'])){
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];
    $admin_username = mysqli_real_escape_string($connection, $admin_username);// clean the username
    $admin_password = mysqli_real_escape_string($connection, $admin_password);//clean the password
    

 $admin_stmt = mysqli_prepare($connection,"SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_name = ?");   
 mysqli_stmt_bind_param( $admin_stmt, "s", $admin_username);
 mysqli_stmt_execute($admin_stmt);
 mysqli_stmt_bind_result($admin_stmt, $admin_id, $admin_name, $admin_email, $password_GET);

 while(mysqli_stmt_fetch($admin_stmt)){
   $db_admin_id =$admin_id;
   $db_admin_name =$admin_name; 
   $db_admin_email = $admin_email;
   $db_admin_password = $password_GET;
}


 if(password_verify($admin_password, $db_admin_password)){
    $_SESSION['admin_id'] = $db_admin_id;
    $_SESSION['admin_name'] = $db_admin_name;
    $_SESSION['admin_email'] = $db_admin_email;
    $_SESSION['admin_password'] = $db_admin_password;
    $_SESSION['admin_state'] = true;
   //  $query = "UPDATE adminstate SET ";
   //  $query .= "state_bool = 'true' ";
 
   //  $update_state = mysqli_query($connection, $query);
 
   //  check_query($update_state);
    
   
    header("Location: ../admin");
      
  }else {
    
     header("Location: ../login_admin.php?invalid=''");
 
  }


}
?>
