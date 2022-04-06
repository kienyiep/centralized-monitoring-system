<?php 
if($_SERVER['REQUEST_METHOD']=="POST"){
if(isset($_POST['create_user'])){
    // use the trim function to take the white space out.
    $user_firstname = trim($_POST['user_firstname']);
    $user_lastname = trim($_POST['user_lastname']);
    $team_selected= trim($_POST['team_selected']);
    $user_role = trim($_POST['user_role']);
    $username = trim($_POST['username']);
    $user_email = trim($_POST['user_email']);
    $user_password = trim($_POST['user_password']);
  

    $error=['username'=>'','team_selected'=>'','user_role'=>'','password'=>''];

    if(strlen($username)<4){
        $error['username'] = 'Username needs to longer';
    }
    if($username==''){
        $error['username'] = 'Username cannot be empty';
    }
    if(username_exists($username)){
        $error['username'] = 'Username already exist';
    }
 
    if($user_password==''){
        $error['password'] = 'Password cannot be empty';
    }
    if($team_selected==''){
        $error['team_selected'] = 'Team need to be selected';
    }
    if($user_role==''){
        $error['user_role'] = 'User role need to be selected';
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
        register_user($user_firstname,$user_lastname,$team_selected,$user_role,$username,$user_email, $user_password); 
      // login_user($username, $password);
    }
      // register_user($username, $email, $password);
}}

?>



<form action =" " method = "post" enctype="multipart/form-data"> 

<div class ="form-group">
<label for = "author">Firstname</label>
<input type = "text" class = "form-control" name= "user_firstname"> 
</div>

<div class ="form-group">
<label for = "post_status">Lastname</label>
<input type = "text" class = "form-control" name= "user_lastname"> 
</div>
<br>
<div class ="form-group">

<select name="team_selected" id="post_category">

<?php
$query ="SELECT * FROM teamlist";
$showAllTeams = mysqli_query($connection,$query);
echo '<option value="">Select Teams</option>';
while($row = mysqli_fetch_array($showAllTeams)){
$team_id = $row['team_id'];
$team_name = $row['team_name'];
echo "<option value='{$team_id}'>$team_name</option>";
}
?>
</select>
<p class="edit_user"><?php echo isset($error['team_selected'])?$error['team_selected']:''?></p>

</div>


<div class ="form-group">
<select name="user_role" >

<option value="">Select Options</option>
<option value="clerical">clerical</option>
<option value="PIC">PIC</option>
<option value="management">management team</option>


</select>
<p class="edit_user"><?php echo isset($error['user_role'])?$error['user_role']:''?></p>

</div>



<div class ="form-group">
<label for = "post_tags">Username</label>
<input type = "text" class = "form-control" name= "username"> 
<p class="edit_user"><?php echo isset($error['username'])?$error['username']:''?></p>
</div>


<div class ="form-group">
<label for = "post_content">Email</label>
<input type="email" class = "form-control" name= "user_email"> 
</div>

<div class ="form-group">
<label for = "post_content">Password</label>
<input type="password" class = "form-control" name= "user_password"> 
<p class="edit_user"><?php echo isset($error['password'])?$error['password']:''?></p>
</div>
<br>

<div class="form-group">
<input class="btn btn-primary" type="submit" name ="create_user" value="Add User">


</div>

</form>