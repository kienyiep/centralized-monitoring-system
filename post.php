<?php include "includes/header.php" ?>

<?php include  "includes/navigation.php" ?>
<div class="custom-zcontainer">

<div >

    <!-- Blog Entries Column -->
    <div class="col-md-8">
    <h1 class="page-header"><b>License details</b></h1>
         <?php 
         if(isset($_GET['post_id'])){
         $get_license_id = $_GET['post_id'];  
         if(isset($_SESSION['team_selected'])){
             $team_id = $_SESSION['team_selected'];
         $query= "SELECT * FROM teamlist WHERE team_id = {$team_id}";
         $select_team = mysqli_query($connection, $query);
         while($row = mysqli_fetch_array($select_team)){
             $team_name = $row['team_name'];
         }     
         $query = "SELECT * FROM $team_name  WHERE license_id = {$get_license_id}";
         $select_all_content_query = mysqli_query($connection, $query);
         check_query($select_all_content_query);
         while($row = mysqli_fetch_assoc($select_all_content_query)){
         $license_id = $row['license_id'];
         $license_number = $row['license_number'];
         $license_name = $row['license_name'];
         $license_type = $row['license_type'];
         $license_authority = $row['license_authority'];
         $license_expiry = $row['license_expiry'];
         $license_renewal = $row['license_renewal'];
        
         $license_company = $row['license_company'];
         $license_status = $row['license_status'];
         $license_details = $row['license_details'];
         }
         ?>
               
        <br>
                <!-- First Blog Post -->
                
                <h3>        
                    <?php echo $license_name  ?>
                </h3>
                <p class="lead">
                   permitted by <?php echo $license_authority  ?>
                </p>
                <div class="row">
                <div class="col-sm-6">
                <p><b>Expiry date:</b> <?php echo $license_expiry  ?></p>
                <p><b>Renewal date:</b> <?php echo $license_renewal  ?></p>
               
                <p><b>License ID:</b> <?php echo $license_number?></p>
                <p><b>License type:</b> <?php echo $license_type?></p>
                <p><b>Other company involved:</b> <?php echo $license_company?></p>
                <p><b>Status:</b> <?php echo $license_status?></p>
                <p><b>Additonal mandatory condition:</b> <?php echo $license_details?></p>
                </div>
                <div class="col-sm-6">
                <p><b>Expiry date:</b> <?php echo $license_expiry  ?></p>
                <p><b>Renewal date:</b> <?php echo $license_renewal  ?></p>
               
                <p><b>License ID:</b> <?php echo $license_number?></p>
                <p><b>License type:</b> <?php echo $license_type?></p>
                <p><b>Other company involved:</b> <?php echo $license_company?></p>
                <p><b>Status:</b> <?php echo $license_status?></p>
                <p><b>Additonal mandatory condition:</b> <?php echo $license_details?></p>
                       
                </div>
                </div>
             
             
               
              
                
         

       <?php
         }
        }
         ?>

     
    
    
    </div>
</div>
</div>
