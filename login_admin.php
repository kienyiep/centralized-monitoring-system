<?php include "includes/header.php"; 
include "includes/client_navigation.php"
?>


<?php 
// $query ="SELECT * FROM adminstate";
// $admin_state = mysqli_query($connection,$query);
// while($row = mysqli_fetch_array($admin_state)){
//   $_SESSION['admin_state'] = $row['state_bool'];
// }

if(isset($_SESSION['admin_state'])){

if($_SESSION['admin_state']){
 $adminState = true;
}else{
  $adminState = false;

}
}else{
  $adminState=false;
}



  if($adminState===false){ ?>
<div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-4 mt-3 ">
          <!-- mt-3 margin-top -->
          <div class="border border-white shadow-sm mt-3 rounded my_form">
            <h3 class="heading3">Login to admin site</h3>
            <p class="text-muted">Login as admin</p>
            <?php
            if(isset($_GET['invalid'])){
                echo "<p class='invalid_paragraph'> <span class='invalid_span'>&#33;</span> Invalid login, please try again</p>";
            }
            
            ?>
            <form action="includes/login.php" method="post">
              <!-- bm-3 margin-bottom -->
              <div class="mb-3">
                <!-- <label class="form-label">Username</label> -->
                <input
                  type="text"
                  name="admin_username"
                  class="form-control"
                  placeholder="admin username"
                />
              </div>
              <div class="mb-3">
                <!-- <label class="form-label">Password</label> -->
                <input
                  type="password"
                  name="admin_password"
                  class="form-control"
                  placeholder="admin password"
                />
              </div>
              <div class="mb-3">
                <input
                  type="submit"
                  value="login"
                  name="submit_admin"
                  class="btn btn-primary"
                />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php } else if($adminState === true){ 
      header("Location: admin");
    } ?>
    
<?php include "includes/footer.php" ?>