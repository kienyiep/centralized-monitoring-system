<?php include "includes/admin_header.php" ?>
<?php include "includes/admin_navigation.php" ?>


<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
   


<?php
if(isset($_GET['team_id'])){
    $team_id = $_GET['team_id'];
  
    ?>
    <h3>Select user to receive the email notification</h3>
 <form action ="alert_teams.php?team_id=<?php echo $team_id ?>" method = "post" enctype="multipart/form-data">
 <div class="form-group">
 <label for = "reminder_role"><b>Users</b></label> 
 <br>
            <select name="reminder_role" id="post_category">
             <?php 
             $select_stmt = mysqli_prepare($connection,"SELECT alert_name FROM teamlist WHERE team_id=?");
             mysqli_stmt_bind_param($select_stmt, 'i',$team_id);
             mysqli_stmt_execute($select_stmt);
             mysqli_stmt_bind_result($select_stmt, $alert_name);
             mysqli_stmt_store_result($select_stmt);
             while(mysqli_stmt_fetch($select_stmt)){
             ?>
            <option value="<?php echo $alert_name ?>" ><?php echo $alert_name ?></option>
            <?php
             }
            mysqli_stmt_close($select_stmt);

            $user_stmt = mysqli_prepare($connection, "SELECT username FROM users WHERE team_selected=?");
            mysqli_stmt_bind_param($user_stmt,'i',$team_id);
            mysqli_stmt_execute($user_stmt);

            mysqli_stmt_bind_result($user_stmt, $username);
            mysqli_stmt_store_result($user_stmt);
            while(mysqli_stmt_fetch($user_stmt)){

            echo  "<option value=$username >$username</option>";
            
            }
            mysqli_stmt_close($user_stmt);
            ?>
                 
    </select >
    </div>
    <br>
   
    <div class="form-group">
            <label for=""><b>User first name</b></label>
            <?php $firstname_stmt = mysqli_prepare($connection,"SELECT alert_firstname FROM teamlist WHERE team_id=?");
                  mysqli_stmt_bind_param($firstname_stmt, 'i',$team_id);
                  mysqli_stmt_execute($firstname_stmt);
                  mysqli_stmt_bind_result($firstname_stmt, $firstname_GET);
                  mysqli_stmt_store_result($firstname_stmt);
                  while(mysqli_stmt_fetch($firstname_stmt)){
             ?>
             <div class="col-lg-3 col-md-3 col-sm-3" >
            <input class="form-control" readonly='readonly' type="text"  value="<?php echo $firstname_GET ?>">
            </div>
            <?php }
              mysqli_stmt_close($firstname_stmt);
            ?>
          
   </div>
   <br>
    <div class="form-group">
            <label for=""><b>User last name</b></label>
            <?php $lastname_stmt = mysqli_prepare($connection,"SELECT alert_lastname FROM teamlist WHERE team_id=?");
                  mysqli_stmt_bind_param($lastname_stmt, 'i',$team_id);
                  mysqli_stmt_execute($lastname_stmt);
                  mysqli_stmt_bind_result($lastname_stmt, $lastname_GET);
                  mysqli_stmt_store_result($lastname_stmt);
                  while(mysqli_stmt_fetch($lastname_stmt)){
             ?>
             <div class="col-lg-3 col-md-3 col-sm-3" >
            <input class="form-control" readonly='readonly' type="text"  value="<?php echo $lastname_GET ?>">
            </div>
            <?php }
              mysqli_stmt_close($lastname_stmt);
            ?>
          
   </div>
   <br>
    <div class="form-group">
            <label for=""><b>Team name</b></label>
            <?php $selectteam_stmt = mysqli_prepare($connection,"SELECT team_name FROM teamlist WHERE team_id=?");
                  mysqli_stmt_bind_param($selectteam_stmt, 'i',$team_id);
                  mysqli_stmt_execute($selectteam_stmt);
                  mysqli_stmt_bind_result($selectteam_stmt, $team_name);
                  mysqli_stmt_store_result($selectteam_stmt);
                  while(mysqli_stmt_fetch($selectteam_stmt)){
             ?>
             <div class="col-lg-3 col-md-3 col-sm-3" >
            <input class="form-control" readonly='readonly' type="text"  value="<?php echo $team_name ?>">
            </div>
            <?php }
              mysqli_stmt_close($selectteam_stmt);
            ?>
          
   </div>
   <br>
    <div class="form-group">
            <label for=""><b>User role</b></label>
            <?php $selectuser_stmt = mysqli_prepare($connection,"SELECT alert_role FROM teamlist WHERE team_id=?");
                  mysqli_stmt_bind_param($selectuser_stmt, 'i',$team_id);
                  mysqli_stmt_execute($selectuser_stmt);
                  mysqli_stmt_bind_result($selectuser_stmt, $alert_role);
                  mysqli_stmt_store_result($selectuser_stmt);
                  while(mysqli_stmt_fetch($selectuser_stmt)){
             ?>
             <div class="col-lg-3 col-md-3 col-sm-3" >
            <input class="form-control" readonly='readonly' type="text"  value="<?php echo $alert_role ?>">
            </div>
            <?php }
             mysqli_stmt_close($selectuser_stmt);?>
   </div>
   <br>
    <div class="form-group">
            <label for=""><b>User email</b></label>
            <?php $email_stmt = mysqli_prepare($connection,"SELECT alert_email FROM teamlist WHERE team_id=?");
                  mysqli_stmt_bind_param($email_stmt, 'i',$team_id);
                  mysqli_stmt_execute($email_stmt);
                  mysqli_stmt_bind_result($email_stmt, $alert_email);
                  mysqli_stmt_store_result($email_stmt);
                  while(mysqli_stmt_fetch($email_stmt)){
             ?>
             <div class="col-lg-3 col-md-3 col-sm-3" >
            <input class="form-control" readonly='readonly' type="text"  value="<?php echo $alert_email ?>">
            </div>
            <?php }
             mysqli_stmt_close($email_stmt);?>
   </div>
   <br>
    <div class="form-group">
            <input class="btn btn-outline-primary" type="submit" name="alert_submit" value="SET">
   </div>
                         
</form>

<?php
  if(isset($_POST['alert_submit'])){
    $alert_user = $_POST['reminder_role'];
   

    $selectall_stmt = mysqli_prepare($connection, "SELECT user_firstname, user_lastname, user_role,user_email FROM users WHERE username=?");
    mysqli_stmt_bind_param($selectall_stmt,'s', $alert_user);
    mysqli_stmt_execute($selectall_stmt);
    mysqli_stmt_bind_result($selectall_stmt, $firstname_GET, $lastname_GET ,$role_GET, $email_GET);
    mysqli_stmt_store_result($selectall_stmt);
    while(mysqli_stmt_fetch($selectall_stmt)){

    $update_stmt = mysqli_prepare($connection,"UPDATE teamlist SET alert_firstname=?, alert_lastname=? ,alert_name=?, alert_email=?, alert_role=? WHERE team_id=? ");
    mysqli_stmt_bind_param($update_stmt,'sssssi',$firstname_GET,$lastname_GET,$alert_user,$email_GET, $role_GET,$team_id);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
    header('Location: alert_teams.php?team_id='.$team_id);


}
mysqli_stmt_close($selectall_stmt);

  }
}
?>

</div>
</div>
<!-- /.row -->

</div>

<?php include "includes/admin_footer.php" ?>
 