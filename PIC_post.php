<?php include "includes/header.php"?>
<?php include "includes/PIC_navigation.php" ?>

<style>

    .align{
        padding-left: 40px;
       
    }
   
</style>
<div class="container-fluid">

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Teams</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <ul>
                            <?php 
                            $query = "SELECT * FROM teamlist";
                            $show_all_team = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_array($show_all_team)){
                                $team_id = $row['team_id'];
                                $team_name = $row['team_name'];
                        echo  "<li class='nav-item nav-default'><a href='PIC_post.php?PIC_id=$team_id' class='nav-link'>$team_name</a></li>";
                            }
                            
                            ?>

                        </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-primary" href="main.php">Return to own team</a>
                      </div>
                    </div>
                  </div>
                </div>

<div class="row ">

    <!-- Blog Entries Column -->
    <div class="col-lg-8 col-md-6 col-sm-6 align mt-3">
    <h1 class="page-header"><b>License posts pages</b></h1>

         <?php 

         if(isset($_GET['PIC_id'])){
            $team_id = $_GET['PIC_id'];
         
         $teamlist2_stmt = mysqli_prepare($connection, "SELECT team_name FROM teamlist WHERE  team_id = ?" );
          mysqli_stmt_bind_param($teamlist2_stmt,'i', $team_id);
          mysqli_stmt_execute($teamlist2_stmt);
          mysqli_stmt_bind_result($teamlist2_stmt, $teamname_GET);
          mysqli_stmt_store_result($teamlist2_stmt);
          while(mysqli_stmt_fetch($teamlist2_stmt)){
                 $team_name = $teamname_GET;
          }   
           mysqli_stmt_close($teamlist2_stmt);
        
           $teamname_stmt = mysqli_prepare($connection, "SELECT license_id, license_number, license_name, license_pdf ,license_type, license_authority, license_expiry, license_renewal, license_company, license_address, license_other_company,license_status,license_details,license_activity,license_cost,parties_involved,person_in_charge,department_in_charge,company_region,special_action  FROM $team_name"); 
          mysqli_stmt_execute($teamname_stmt);
          mysqli_stmt_bind_result($teamname_stmt, $license_id, $license_number, $license_name, $license_pdf, $license_type, $license_authority,$license_expiry,$license_renewal, $license_company,$license_address, $license_other_company, $license_status, $license_details, $license_activity, $license_cost, $parties_involved, $person_in_charge, $department_in_charge, $company_region,$special_action);
          mysqli_stmt_store_result($teamname_stmt);
          
         while(mysqli_stmt_fetch($teamname_stmt)){
         
        

         ?>
               
        <br>
                <!-- First Blog Post -->
                <h2>
                    <a class = "license-name" href="post.php?p_id=<?php  ?>"><?php echo $license_name  ?></a>
                </h2>
                <?php 
                if($license_pdf){
               echo  "<embed src='license_pdf/$license_pdf'  type='application/pdf' width ='520' height='520'/>";
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
                <p><b>Other company involved:</b> <?php echo $license_other_company?></p>
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
            
                <a class="btn btn-outline-info" href='pdfReport.php?report_id=<?php echo $license_id ?>&team_name=<?php echo $team_name ?>'>Generate</a>
               
          

                

                <hr>
       <?php
         }
          mysqli_stmt_close($teamname_stmt);
       
         ?>
 </div>
    <?php include "includes/sideBar.php" ?>

    <?php  }?>

  
</div>

</div>
<?php include "includes/footer.php"?>

