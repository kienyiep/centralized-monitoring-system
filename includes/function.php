<?php
function verifyField($fieldName){
echo $fieldName ? $fieldName : '&#45;';
  }


  function insertContentLog($userLog,$team_name,$contentID){
    $addContentLog = 'access_logging/'.$team_name.'/'.$team_name.'_addLog.txt';
    if(!file_exists($addContentLog)){
      mkdir('access_logging/'.$team_name.'/', 0755, true);
      file_put_contents($addContentLog,'');
    }
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $time = date('m/d/y h:i A',time());

    $content = file_get_contents($addContentLog);
    $content .= "Insert time: $time,\tTeam Name: $team_name,\tUsername: $userLog,\tLicense No: $contentID\r";

    file_put_contents($addContentLog,$content);
  }

  function updateContentLog($userLog,$team_name,$contentID){
    $update_content_log ='access_logging/'.$team_name.'/'.$team_name.'_updateLog.txt';

    if(!file_exists($update_content_log)){
      if(!is_dir('access_logging/'.$team_name.'/')){
      mkdir('access_logging/'.$team_name.'/', 0755, true);
      }
      file_put_contents($update_content_log,'');
    }
    date_default_timezone_set('Asia/Kuala_Lumpur');
    
    $time = date('m/d/y h:i A',time());
    $content = file_get_contents($update_content_log);
    $content .= "Update time: $time,\tTeam Name: $team_name,\tUsername: $userLog,\tLicense No: $contentID\r";
    file_put_contents($update_content_log,$content);

  }

  function deleteContentLog($userLog,$team_name,$contentID){
    $delete_content_log ='access_logging/'.$team_name.'/'.$team_name.'_deleteLog.txt';
   
    if(!file_exists($delete_content_log)){
      if(!is_dir('access_logging/'.$team_name.'/')){
      mkdir('access_logging/'.$team_name.'/', 0755, true);
      }
      file_put_contents($delete_content_log,'');
    }
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $time = date('m/d/y h:i A',time());

    $content = file_get_contents($delete_content_log);
    $content .= "Delete time: $time,\tTeam Name: $team_name,\tUsername: $userLog,\tLicense No: $contentID\r";
    file_put_contents($delete_content_log,$content);

  }

  function check_query($query){
    global $connection;
     if(!$query){
         die("QUERY FAILED". mysqli_error($connection));
     }
    }

  function username_exists($username){
    global $connection;
    $query="SELECT username FROM users WHERE username='$username'";
    $result=mysqli_query($connection,$query);
    check_query($result);
    
    if(mysqli_num_rows($result)>0){
        return true;
    } else{
        return false;
    }
    }
    
    function email_exists($email){
    global $connection;
    $query="SELECT user_email FROM users WHERE user_email='$email'";
    $result=mysqli_query($connection,$query);
    check_query($result);
    
    if(mysqli_num_rows($result)>0){
        return true;
    } else{
        return false;
    }
    }

function login_user($username , $password){
 global $connection;
 $username =trim($username);
 $password = trim($password);

 $username = mysqli_real_escape_string($connection, $username);// clean the username
 $password = mysqli_real_escape_string($connection, $password);//clean the password

 $query= "SELECT * FROM users WHERE username = '{$username}'";
 $select_user_query = mysqli_query($connection, $query);
 if(!$select_user_query){

    die("QUERY FAILED". mysqli_error($connection));
 }

 while($row = mysqli_fetch_array($select_user_query)){

    $db_user_id =$row['user_id'];
    $db_username =$row['username']; 
    $db_user_password =$row['user_password'];
    $db_user_firstname =$row['user_firstname'];
    $db_user_lastname =$row['user_lastname'];
    $db_user_team =$row['team_selected'];
    $db_user_role =$row['user_role'];
  
 }



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
    header("Location: ../index.php?invalid=''");
   //  header("Location: ../index.php");

 }
    }


?>