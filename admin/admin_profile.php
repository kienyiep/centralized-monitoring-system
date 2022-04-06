<?php include "includes/admin_header.php" ?>

<?php include "includes/admin_navigation.php" ?>
<div id="wrapper">


<?php
if(isset($_SESSION['admin_state'])){
   
    $admin_id = $_SESSION['admin_id'];
    $query = "SELECT * FROM admins WHERE admin_id = {$admin_id}";
    $select_user_profile_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_array($select_user_profile_query)){
        $admin_id = $row['admin_id'];
        $admin_firstname = $row['admin_firstname'];
        $admin_lastname = $row['admin_lastname'];
        $admin_name = $row['admin_name'];
        $admin_email = $row['admin_email'];
        $admin_password = $row['admin_password'];
    
    }

}

if(isset($_POST['edit_user'])){

    $admin_firstname = $_POST['user_firstname'];
    $admin_lastname = $_POST['user_lastname'];
    

    $admin_name = $_POST['username'];
    $admin_email = $_POST['user_email'];
    $admin_password = $_POST['user_password'];

    $password = mysqli_real_escape_string($connection, $admin_password);
    $hash_password = password_hash($password, PASSWORD_BCRYPT, array('cost'=> 12) );
  
    $query ="UPDATE admins SET ";
    $query .= "admin_firstname = '{$admin_firstname}', ";
    $query .= "admin_lastname = '{$admin_lastname}', ";
    $query .= "admin_name = '{$admin_name}', ";
    $query .= "admin_email = '{$admin_email}', ";
    $query .= "admin_password = '{$hash_password}' ";
    $query .= "WHERE admin_id = {$admin_id} ";   
 
    $edit_admin_query = mysqli_query($connection, $query);
    check_query($edit_admin_query);
 }


?>
    <!-- Navigation -->




<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        
    <form action =" " method = "post" enctype="multipart/form-data"> 

    <div class ="form-group">
    <label for = "author">Firstname</label>
    <input type = "text" value="<?php echo $admin_firstname; ?>" class = "form-control" name= "user_firstname"> 
    </div>

    <div class ="form-group">
    <label for = "post_status">Lastname</label>
    <input type = "text" value="<?php echo $admin_lastname; ?>" class = "form-control" name= "user_lastname"> 
    </div>
 
    <div class ="form-group">
    <label for = "post_tags">Username</label>
    <input type = "text" value="<?php echo $admin_name; ?>" class = "form-control" name= "username"> 
    </div>

    <div class ="form-group">
    <label for = "post_content">Email</label>
    <input type="email" value="<?php echo $admin_email; ?>" class = "form-control" name= "user_email"> 
    </div>

    <div class ="form-group">
    <label for = "post_content">Password</label>
    <input autocomplete="off" type="password" value="<?php echo $admin_password ?>" class = "form-control" name= "user_password"> 
    </div>

    <div class="form-group">
    <input class="btn btn-primary" type="submit" name ="edit_user" value="Update Profile">


    </div>

    </form>
                    
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php" ?>
 