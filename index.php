<?php include "includes/header.php"; 
include "includes/admin_navigation.php"
?>
<?php 

if(isset($_SESSION['state'])){
// $query ="SELECT * FROM sessionstate";
// $session_state = mysqli_query($connection, $query);

// while($row = mysqli_fetch_array($session_state)){
//   $_SESSION['state']= $  row['state_bool'];
// }
if($_SESSION['state']){
$state = true;

}else{
  $state = false;
}
}else{
  $state=false;
}
?>

<!--< ?php -->

<!--$time = date('m/d/y h:i A',time());-->

<!--$query = "INSERT INTO updateDate(date_time) ";-->
<!--$query .= "VALUES('{$time}')";-->

<!--$insert_date = mysqli_query($connection,$query);-->
<!--?>-->

<script>
let renewal_id;
let renewal_year;
let renewal_month;
let renewal_day;
let renewal_hour;
let renewal_min;
let current;
let curYear;
let curMonth;
let curDate;
let curHour;
let curMin;
let present;
let future;
let dis;
let team_selected;
</script>


<!--< ?php -->

<!--$time = date('m/d/y h:i A',time());-->
<!--$query = "INSERT INTO updateDate(date_time) ";-->
<!--$query .= "VALUES($time)";-->

<!--$insert_date = mysqli_query($connection,$query);-->

<!--?>-->

<?php 

 
if( $state === false){
  ?>
<div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-4 mt-3 ">
          <!-- mt-3 margin-top -->
          <div class="border border-white shadow-sm mt-3 rounded my_form">
            <h3 class="heading3">Login to CMS system</h3>
            <p class="text-muted">Login as client</p>
            <?php
             if(isset($_GET['invalid'])){

              $error = $_GET['invalid'];
              if($error === 'password'){
                echo "<p class='invalid_paragraph'> <span class='invalid_span'>&#33;</span> Invalid login, please try again</p>";
              }else  if($error === 'team'){
                echo "<p class='invalid_paragraph'> <span class='invalid_span'>&#33;</span>  No team is assigned to the user, please assign a team to the user</p>";
                
              }
            }
            
            ?>
            <form action="includes/login.php" method="post" >
              <!-- bm-3 margin-bottom -->
              <div class="mb-3">
                <!-- <label class="form-label">Username</label> -->
                <input
                  type="text"
                  name="username"
                  class="form-control"
                  placeholder="username"
                />
              </div>
              <div class="mb-3">
                <!-- <label class="form-label">Password</label> -->
                <input
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="password"
                />
              </div>
              <div class="mb-3">
                <input
                  type="submit"
                  value="login"
                  name="submit_client"
                  class="btn btn-primary"
                />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php 
    } 
    else if($state === true) { 
      
      header("Location: main.php");
    }

      ?>
      

<?php include "includes/footer.php" ?>