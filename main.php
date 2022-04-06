<?php include "includes/header.php"?>
<?php include "includes/navigation.php" ?>

<style>

    .align{
        padding-left: 40px;
       
    }
   
</style>

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

let distance;
let calcDistance = (date1, date2) => Math.round((date2 - date1) / (1000));
// timer variable
let startTimer;
let tick;
let year;
let month;
let day;
let hour;
let min;
let sec;  
let timer;

</script>



<div class="modal fade" id="reminderModal" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="reminderModalLabel">Reminder will be sent after:</h5>
                    
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                            <!-- <p id="reminder" style="font-size:30px"></p> -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                      </div>
                    </div>
                  </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete license</h5>
                    
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                            <p id="delete" style="font-size:20px">Do you want to delete the license?</p>
                      </div>
                      <div class="modal-footer">
                     
                        
                        <a type="button" class="btn btn-danger modal_delete_link" href="" >DELETE</a>
                        
                      
                      
                        </div>
                        
                   
                    </div>
                  </div>
</div>

<?php 
if(isset($_SESSION['state'])) {
    if($_SESSION['state']===true){
      ?>
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
                            $teamlist_stmt = mysqli_prepare($connection,  "SELECT team_id, team_name FROM teamlist");
                            mysqli_stmt_execute($teamlist_stmt);
                            mysqli_stmt_bind_result($teamlist_stmt, $id_GET, $name_GET);
                            mysqli_stmt_store_result($teamlist_stmt);

                            while(mysqli_stmt_fetch($teamlist_stmt)){
                                $team_id = $id_GET;
                                $team_name = $name_GET;
                        echo "<li class='nav-item nav-default'><a href='PIC_post.php?PIC_id=$team_id' class='nav-link'>$team_name</a></li>";
                            }

                            mysqli_stmt_close($teamlist_stmt);
                            
                            ?>
                        </ul>
                      </div>
                      <div class="modal-footer">
                        
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>


<div class="row ">

    <!-- Blog Entries Column -->
    <div class="col-lg-8 col-md-6 col-sm-6 align mt-3">
    <h1 class="page-header"><b>License posts pages</b></h1>

    <script>
        let team_name;
        let futureYear;
        let futureMonth;
        let futureDate;
        let futureHour;
        let futureMin;
        let renewalDate;
        var renewalArray = [];
        var renewalObj = {};    

    </script>

         <?php 

        

         if($_SESSION['username']){
            $user_role = $_SESSION['user_role'];
            $username = $_SESSION['username']; 
            $user_team = $_SESSION['team_selected'];
          
          $teamlist2_stmt = mysqli_prepare($connection, "SELECT team_name FROM teamlist WHERE  team_id = ?" );
          mysqli_stmt_bind_param($teamlist2_stmt,'i', $user_team);
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
         
         while(mysqli_stmt_fetch($teamname_stmt)){
        
          $renewalDate = strtotime("-2 months" .$license_renewal);
          $year = date('Y',$renewalDate);
          $month = date('m',  $renewalDate);
          $date = date('d', $renewalDate);
      
          ?>
        <script type="text/javascript">
                    team_name ="<?php echo $team_name ?>"
                    futureID   = "<?php echo $license_id ?>"
                    futureYear = "<?php echo $year; ?>";
                    
                    futureMonth = "<?php echo $month; ?>" ;
                   
                    futureDate = "<?php echo $date; ?>";
                  
                    futureHour = 00;
                    futureMin  = 00;

                 
                  

                    renewalObj.team = team_name;
                    renewalObj.id = futureID;
                    renewalObj.year = futureYear;
                    renewalObj.month = futureMonth;
                    renewalObj.date = futureDate;
                    // console.log(renewalObj);
                    renewalArray.push(renewalObj);
                    renewalObj ={};
                    console.log(renewalArray);

         </script>
          
         
          
         
         
               
        <br>
                <!-- First Blog Post -->
                <h2>
                    <a class = "license-name" href="post.php?post_id=<?php echo $license_id  ?>"><?php echo $license_name  ?></a>
                </h2>
                <!-- <embed src="license_pdf/< ?php echo $license_pdf? $license_pdf:''?>"  type="application/pdf" width ="500" height="500"/> -->
                <?php 
                if($license_pdf){
               echo  "<embed src='license_pdf/$license_pdf'  type='application/pdf' width ='520' height='520'/>";
                }
                ?>
                <div class="row">
                  <div class="col-sm-10">
                <p class="lead">
                   permitted by <?php echo $license_authority  ?>
                </p>
                </div>
                <div class="col-sm-2">
               <button data-id='<?php echo $license_id ?>' data-bs-toggle='modal' data-bs-target='#reminderModal' class='reminderlink btn btn-outline-danger'>Reminder!</button>
              
                <!-- <a class="btn btn-outline-danger reminder_link" rel=< ?php echo $license_id ?> href='javascript:void(0)'>Reminder!</a> -->
                <!-- <a class="btn btn-outline-danger"  href="main.php?license=< ?php echo $license_id ?>"  >Reminder!</a> -->
                </div>
                </div>
               
                <div class="row">
                <!--  -->
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
                <!-- <a class="btn btn-outline-primary" href='post.php?post_id=< ?php echo $license_id ?>'>View more</a> -->
               <?php if($user_role === 'clerical' || $user_role === 'PIC'){ ?>
                <a class="btn btn-outline-primary" href='content.php?source=update_content&team_name=<?php echo $team_name ?>&edit=<?php echo $license_id ?>'>Edit</a>
                
               <?php 
               if($user_role === 'PIC'){
                  //  echo "<a class='btn btn-outline-danger' href='main.php?team_name=$team_name &delete= $license_id' >Delete</a>";
                   echo "<a class='btn btn-outline-danger deletelink' delete_team=$team_name delete_number='{$license_number}' delete_id=$license_id  >Delete</a>";
                  } 
               
               ?>
              <?php } ?>

                <!-- <a class="btn btn-outline-info" href='pdfReport.php?report_id=< ?php echo $license_id ?>&team_name=< ?php echo $team_name ?>'>Generate</a> -->
                <a class="btn btn-outline-info" href='pdfReport.php?report_id=<?php echo $license_id ?>&team_name=<?php echo $team_name ?>'>Generate</a>
                <!-- <a class="btn btn-outline-info" href='pdfReport.php?team_name=< ?php echo $team_name ?>'>Generate</a> -->
          

                

                <hr>
             
       <?php
         }
        mysqli_stmt_close($teamname_stmt);
         ?>
          <script>
                  $.ajax({
                      url:"readJson.php",
                      method:"post",
                      data:{renewalArray: JSON.stringify(renewalArray)},
                      success:function(res){
                        console.log(res);
                      }

                    })
                </script>

                 <script type='text/javascript'>
                $(document).ready(function(){
                    $('.reminderlink').click(function(){
                        var reminderid = $(this).data('id');
                        $.ajax({
                            url: 'ajaxfile.php',
                            type: 'post',
                            data: {reminderArray: JSON.stringify(renewalArray), reminderid:reminderid},
                            success: function(response){ 
                                $('.modal-body').html(response); 
                                $('#reminderModal').modal('show'); 
                            }
                        });
                    });
                });
          </script>
          <script type='text/javascript'>
                $(document).ready(function(){
                    $('.deletelink').click(function(){
                      
                      $("#deleteModal").modal('show');
                      var delete_id = $(this).attr("delete_id");
                      var delete_team = $(this).attr("delete_team");
                      var delete_number = $(this).attr("delete_number");
                      var delete_url =   "main.php?delete="+delete_id+"&number="+delete_number+"&team="+delete_team+"";
                      $(".modal_delete_link").attr("href", delete_url);
                   


                    });
                });
          </script>
           

               
             
 </div>
    <?php include "includes/sideBar.php" ?>

    <?php  }?>

</div>

</div>

<?php 
}
else if($_SESSION['state']===false){
  header("Location: index.php");
} 
}
?>
<?php include "includes/footer.php"?>


<?php
        if(isset($_GET['delete'])){
        $delete_id = $_GET['delete']; 
        $delete_number = $_GET['number'];
        // $delete_id = mysqli_real_escape_string($connection,$_GET['delete']);

        // $query = "DELETE FROM {$team_name} WHERE license_id = {$delete_id}";
        // $delete_user_query = mysqli_query($connection, $query);

        $delete_stmt = mysqli_prepare($connection,"DELETE FROM {$team_name} WHERE license_id = ?" );
        mysqli_stmt_bind_param($delete_stmt,"i", $delete_id);
        mysqli_stmt_execute($delete_stmt);
        mysqli_stmt_close($delete_stmt);
      
        
        deleteContentLog($username,$team_name,  $delete_number);

        header("Location: main.php?team_name=$team_name");

        }
        ?>