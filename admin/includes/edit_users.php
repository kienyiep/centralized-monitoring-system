<?php 

if(isset($_GET['edit_users'])){
$the_user_id =$_GET['edit_users'];

$query = "SELECT * FROM users WHERE user_id = $the_user_id";
$select_users_query = mysqli_query($connection,$query);
while($row = mysqli_fetch_array($select_users_query)){
  $user_id = $row['user_id'];
  $user_firstname = $row['user_firstname'];
  $user_lastname =$row['user_lastname'];
  $user_team_id =$row['team_selected'];
  $user_role =$row['user_role'];
  $username = $row['username'];  
  $user_email = $row['user_email'];
  $user_password = $row['user_password'];

}




if(isset($_POST['update_user'])){
   
   $user_firstname = $_POST['user_firstname'];
   $user_lastname = $_POST['user_lastname'];
   $team_selected = $_POST['team_selected'];
   $user_role = $_POST['user_role'];
   $update_username = $_POST['username'];
   $user_email = $_POST['user_email']; 
   $user_password = $_POST['user_password'];

   $error=['username'=>'', 'password'=>''];

   if(strlen($username)<4){
       $error['username'] = 'Username needs to longer';
   }
   if($username==''){
       $error['username'] = 'Username cannot be empty';
   }
   if(username_exists($update_username) && $username !== $update_username){
       $error['username'] = 'Username already exist';
   }

   if($user_password==''){
       $error['password'] = 'Password cannot be empty';
   }
 
  
   foreach($error as $key => $value){
       if(empty($value)){
           // if the array is empty, then we will unset that key, 
           // here we will clean up our empty field.
           unset($error[$key]);
           // register_user($username,$email,$password);
           // login_user($username,    $password);
       }

   }

   if(empty($error)){
       
        if($user_role==='PIC'){
         $selectlist_stmt = mysqli_prepare($connection, "SELECT alert_name FROM teamlist WHERE team_id=?");
         mysqli_stmt_bind_param($selectlist_stmt,'i', $team_selected);
         mysqli_stmt_execute($selectlist_stmt);
         mysqli_stmt_bind_result($selectlist_stmt, $alertname_GET);
         mysqli_stmt_store_result($selectlist_stmt);
         
         while(mysqli_stmt_fetch($selectlist_stmt)){
             if(empty($alertname_GET)){
                 $teamlist_stmt = mysqli_prepare($connection, "UPDATE teamlist SET alert_firstname=?, alert_lastname=?, alert_name=?, alert_email=?,alert_role=? WHERE team_id=?");
                 mysqli_stmt_bind_param($teamlist_stmt,'sssssi',$user_firstname,$user_lastname,$update_username,$user_email,$user_role,$team_selected);
                 mysqli_stmt_execute($teamlist_stmt);
                 mysqli_stmt_close($teamlist_stmt);
   
             }
   
         
         }
         mysqli_stmt_close($selectlist_stmt);
      }

   if(!empty($user_password)){
      $query_password ="SELECT user_password FROM users WHERE user_id = {$the_user_id}";
      $get_user_query = mysqli_query($connection, $query_password);
      check_Query($get_user_query);

      $row = mysqli_fetch_array($get_user_query);
      $db_user_password =  $row['user_password'];


      if($db_user_password != $user_password){

         $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>12));
      }
   }
      $query ="UPDATE users SET ";
      $query .= "user_firstname = '{$user_firstname}', ";
      $query .= "user_lastname = '{$user_lastname}', ";
      $query .= "team_selected = {$team_selected}, "; // this will give us the date for today.
      $query .= "user_role = '{$user_role}', "; // this will give us the date for today.
      $query .= "username = '{$update_username}', ";
      $query .= "user_email = '{$user_email}', ";
      $query .= "user_password = '{$user_password}' ";
      $query .= "WHERE user_id = {$the_user_id} ";   
   
      $edit_user_query = mysqli_query($connection, $query);
      check_Query($edit_user_query);
      header("Location:users.php?source=edit_users&edit_users={$the_user_id}");
   }


}
  
}else{
   header("Location: index.php");
}
?>



<form action =" " method = "post" enctype="multipart/form-data">
<div class ="form-group">
<label for = "author">Firstname</label>
<input type = "text" value="<?php echo $user_firstname; ?>" class = "form-control" name= "user_firstname"> 
</div>

<div class ="form-group">
<label for = "post_status">Lastname</label>
<input type = "text" value="<?php echo $user_lastname; ?>" class = "form-control" name= "user_lastname"> 
</div>
<br>
<div class ="form-group">
<select name="team_selected" id="post_category">

<option value= "<?php echo $user_team_id ?>" >
<?php 
$query = "SELECT * FROM teamlist WHERE team_id = $user_team_id";
$show_team = mysqli_query($connection,$query);
while($row = mysqli_fetch_array($show_team)){
$team_name = $row['team_name'];
echo $team_name;
}
?>

</option>
<?php

$query ="SELECT * FROM teamlist";
$showAllTeams = mysqli_query($connection,$query);
while($row = mysqli_fetch_array($showAllTeams)){
 $team_id = $row['team_id'];
$team_name = $row['team_name'];
if($team_id !== $user_team_id){
echo "<option value='{$team_id}'>$team_name</option>";
   }
}


?>


</select>
</div>
   <br>
<div class ="form-group">
<select name="user_role" id="post_category">

<option value= "<?php echo $user_role; ?>" ><?php echo $user_role; ?></option>
<?php
if($user_role == 'clerical'){
echo "<option value='PIC'>PIC</option>";
echo "<option value='management'>management team</option>";
}else if($user_role == 'PIC'){
echo "<option value='clerical'>clerical</option>";
echo "<option value='management'>management team</option>";
}else if($user_role == 'management'){
   echo "<option value='clerical'>clerical</option>";
echo "<option value='PIC'>PIC</option>";
}
?>
<!-- <option value="admin">Admin</option>
<option value="subscriber">Subscriber</option> -->

</select >
</div>
<br>






<div class ="form-group">
<label for = "post_tags">Username</label>
<input type = "text" value="<?php echo $username; ?>" class = "form-control" name= "username"> 
<p class="edit_user"><?php echo isset($error['username'])?$error['username']:''?></p>
</div>

<div class ="form-group">
<label for = "post_content">Email</label>
<input type="email" value="<?php echo $user_email; ?>" class = "form-control" name= "user_email"> 
</div>

<div class ="form-group">
<label for = "post_content">Password</label>
<input  type="password" value="<?php echo $user_password; ?>" class = "form-control" name= "user_password">
<p class="edit_user"><?php echo isset($error['password'])?$error['password']:''?></p> 
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name ="update_user" value="Update User">


</div>

</form>