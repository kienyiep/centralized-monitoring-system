<style>

    .align{
        padding-left: 40px;
       
    }
   
</style>
<div class="container-fluid">


<div class="row ">

    <!-- Blog Entries Column -->
    <div class="col-lg-8 col-md-6 col-sm-6 align mt-3">
    <h1 class="page-header"><b>License posts page</b></h1>

         <?php 
        if(isset($_POST['submit'])){
           if(isset($_GET['team_name'])){
         $license_split_result = $_POST['search'];
         $teamname_convert =  $_GET['team_name'];
         $team_name = str_replace(" ","_",$teamname_convert);
       
                
         $query = "SELECT * FROM {$team_name} WHERE split_license_name LIKE '%$license_split_result%' OR  license_name = '{$license_split_result}' OR 
         license_number LIKE '%$license_split_result%' OR license_number = '{$license_split_result}'";
        
         $select_all_content_query = mysqli_query($connection, $query);
         check_query($select_all_content_query);
        //  $count = mysqli_num_rows($select_all_content_query);
         while($row = mysqli_fetch_assoc($select_all_content_query)){
         $license_id = $row['license_id'];
         $license_number = $row['license_number'];
         $license_name = $row['license_name'];
         $license_pdf = $row['license_pdf'];
         $license_company = $row['license_company'];
         $license_address = $row['license_address'];
         $license_type = $row['license_type'];
         $license_authority = $row['license_authority'];
         $license_expiry = $row['license_expiry'];
         $license_renewal = $row['license_renewal'];
        
         $license_company = $row['license_company'];
         $license_status = $row['license_status'];
         $license_details = $row['license_details'];
         $license_activity = $row['license_activity'];
         $license_cost = $row['license_cost'];
         $parties_involved = $row['parties_involved'];
         $person_in_charge = $row['person_in_charge'];
         $department_in_charge = $row['department_in_charge'];
         $company_region = $row['company_region'];
         $special_action = $row['special_action'];
         
       
         

         
        

         ?>
               
        <br>
                <!-- First Blog Post -->
                <h2>
                    <a class = "license-name" href="post.php?p_id=<?php  ?>"><?php echo $license_name  ?></a>
                </h2>
                <?php 
                if($license_pdf){
               echo  "<embed src='../license_pdf/$license_pdf'  type='application/pdf' width ='520' height='520'/>";
                }
                ?>
                <p class="lead">
                   permitted by <?php echo $license_authority  ?>
                </p>
                <div class="row">
                <div class="col-sm-6">
                <p><b>Expiry date:</b> <?php echo $license_expiry  ?></p>
                <p><b>Renewal date:</b> <?php echo $license_renewal  ?></p>
               
                <p><b>License ID:</b> <?php echo $license_number?></p>
                <p><b>License type:</b> <?php echo $license_type?></p>
                <p><b>Company name:</b> <?php echo $license_company?></p>
                <p><b>Compant address:</b> <?php echo $license_address?></p>
                <p><b>Other company involved:</b> <?php echo $license_company?></p>
                <p><b>Status:</b> <?php echo $license_status?></p>
                <p><b>Additonal mandatory condition:</b> <?php echo $license_details?></p>
                </div>
                <div class="col-sm-6">
                <p><b>License activity:</b> <?php verifyField($license_activity)  ?></p>
                <p><b>License cost:</b> <?php verifyField($license_cost) ?> 
                <p><b>Person in charge:</b> <?php verifyField($person_in_charge)?></p>
                <p><b>Department in charge:</b> <?php verifyField($department_in_charge)?></p>
                <p><b>Other company region :</b> <?php verifyField($company_region)?></p>
                <p><b>Parties Involved:</b> <?php verifyField($parties_involved)?></p>
                <p><b>Special action required:</b> <?php verifyField($special_action)?></p>
                       
                </div>
                </div>
                <!-- <a class="btn btn-outline-primary" href='post.php?post_id=< ?php echo $license_id ?>'>View more</a> -->
                <a class="btn btn-outline-primary" href='content.php?source=update_content&team_name=<?php echo $team_name ?>&edit=<?php echo $license_id ?>'>Edit</a>

                <a class="btn btn-outline-danger" href='searchPage.php?team_name=<?php echo $team_name ?>&delete=<?php echo $license_id ?>'>Delete</a>

                <a class="btn btn-outline-info" href='pdfReport.php?report_id=<?php echo $license_id ?>&team_name=<?php echo $team_name ?>'>Generate</a>

                

                <hr>
       <?php
          }
         }
        }   
         ?>

       <?php
       if(isset($_GET['team_name'])){
        if(isset($_GET['delete'])){
        $team_name = $_GET['team_name'];    
        $delete_id = $_GET['delete']; 
        $query = "DELETE FROM {$team_name} WHERE license_id = {$delete_id}";
        $delete_query = mysqli_query($connection, $query);
        check_query($delete_query);
        header("Location: searchPage.php?team_name=$team_name");

        }
    }
        ?>
    
    
    </div>
</div>
</div>
