<?php include "db.php" ?>
<?php include "sidebar/checkBoxScript.php" ?>
<?php include "sidebar/generate.php" ?>

<div class="col-lg-4 col-md-4 col-sm-6 ">
    <div class="container">

      <form action="" method="POST" id="form1">
      <?php include "sidebar/license_modal.php" ?>
      <div class="card mt-3">
        <!-- display the card body -->
          <?php include "sidebar/cardContent.php" ?> 

          <!-- decide to search license or date  -->
          <?php 
              if(isset($_GET['source'])){
                $source =  $_GET['source'];
              }else{
                $source = ' ';
              }
              switch($source){
                case 'license':
                  include "sidebar/searchCompany.php";
                break;
                case 'date':
                  include "sidebar/searchDate.php";
                break;
              }
          ?>


          <?php
              if(isset($_POST['submit'])) { 
              $search_name =$_POST['search_name'];
              $query = "SELECT * FROM {$team_name} WHERE license_company = '{$search_name}' OR  split_license_company LIKE '%$search_name%'";
              $select_all_license_query = mysqli_query($connection, $query);
              check_query($select_all_license_query); 
          ?>

          <!-- the list of the checkbox and content -->
          <?php include "sidebar/viewcontent.php" ?>
              <?php 
              // } 
              }else if(isset($_POST['submit_expiry'])){
                $search_expiry = $_POST['search_expiry'];
                $search_renewal = $_POST['search_renewal'];
                $query = "SELECT * FROM {$team_name} WHERE license_expiry LIKE
                '%$search_expiry%' AND license_renewal LIKE '%$search_renewal%'";

                $select_all_license_query = mysqli_query($connection, $query);
                check_query($select_all_license_query); 
                include "sidebar/viewcontent.php";
              }else{ 
              ?>
              <?php 
              $query = "SELECT * FROM {$team_name} ";
              $select_all_license_query = mysqli_query($connection, $query);
              check_query($select_all_license_query); 
              ?>
            <!-- the list of the checkbox and content -->
              <?php include "sidebar/viewcontent.php" ?>
                        
              <?php } ?>  
            </div>   
            <div class></div>
      </form>

    </div>
</div>