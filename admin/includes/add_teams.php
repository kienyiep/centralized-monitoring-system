<?php 

if(isset($_POST['delete_error'])){
echo "<p style='color:red'>'error delete team'</p>";
}
 if(isset($_POST['submit'])){
    $teamname_convert = $_POST['team_name'];
    $team_name = str_replace(" ","_",$teamname_convert);
    $query = "CREATE TABLE IF NOT EXISTS {$team_name}(license_id INT(10) NOT NULL AUTO_INCREMENT,
    license_number VARCHAR(255),
    license_name VARCHAR(255),
    license_pdf VARCHAR(255),
    license_type VARCHAR(255),
    license_authority VARCHAR(255),
    license_expiry date,
    license_renewal date,
    license_company VARCHAR(255),
    license_address VARCHAR(255),
    license_other_company VARCHAR(255),
    license_status VARCHAR(255),
    license_details VARCHAR(255),
    license_activity VARCHAR(255),
    license_cost VARCHAR(255),
    parties_involved VARCHAR(255),
    person_in_charge VARCHAR(255),
    department_in_charge VARCHAR(255),
    company_region VARCHAR(255),
    special_action VARCHAR(255),
    added_date date,
    added_by VARCHAR(255),
    last_modification date,
    modified_by VARCHAR(255),
    split_license_name VARCHAR(255),
    split_license_company VARCHAR(255),
    renewal_year int(30),
    renewal_month int(30),
    renewal_day int(30),
    renewal_hour int(30),
    renewal_min int(30),
    renewal_status VARCHAR(255),
    PRIMARY KEY(license_ID)
    )";
    $create_table = mysqli_query($connection,$query);
    
    check_query($create_table);
    
    $query ="SELECT * FROM teamlist WHERE team_name = '{$team_name}'";
    $check_team = mysqli_query($connection, $query);
    $count= mysqli_num_rows($check_team);
    if($count == NULL){
        $query = "INSERT INTO teamlist(team_name) ";
        $query .= "VALUES('$team_name')";   
    
        $insert_query = mysqli_query($connection, $query);
        check_query($insert_query);
}
    header("Location:teams.php?source=add_teams");
   
   
}

?>
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Rename team</h5>
                    
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                       <form action='teams.php?source=edit_teams' method="post">
                      <div class="modal-body">
                     
                      <div class="row">
                          
                           <div class="col-sm-0">
                            <input type="hidden" class="form-control" placeholder="" name="team_id" id="team_id"  >
                          </div>
                           <div class="col-sm-0">
                            <input type="hidden" class="form-control" placeholder="" name="team_name" id="team_name"  >
                          </div>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" name="update_name" id="update_name">
                            </div>
                        </div>
                       
                      </div>
                      <div class="modal-footer">
                        <input name="rename" type="submit" class="btn btn-secondary"  value="rename" >
                        <!-- <button type="button" name="update_button" id="update_button"class="btn btn-secondary ">rename</button> -->
                      </div>
                    
                      </form>
                    </div>
            </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Type admin password to delete team</h5>
                    
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                    <form action='teams.php?source=delete_teams' method="post">
                      <div class="modal-body">
                      <div class="row">
                     
                           <!-- <div class="col-sm-0">
                            <input type="hidden" class="form-control" placeholder="" name="admin_id" id="admin_id"  >
                          </div> -->
                           <div class="col-sm-0">
                            <input type="hidden" class="form-control" placeholder="" name="delete_id" id="delete_id"  >
                          </div>
                           <div class="col-sm-3">
                            <input readonly="readonly" class="form-control" placeholder="" name="delete_name" id="delete_name">
                          </div>
                          <div class="col-sm-9">
                          <input type="password"  class="form-control" placeholder="Admin password" name="admin_password" id="recipient-name">
                            </div>
                        </div>
                       
                      </div>
                      <div class="modal-footer">
                      <input name="delete" type="submit" class="btn btn-danger"  value="DELETE" >

                      </div>
                      </form>
                    </div>
            </div>
</div>




            <div class="row">
                 <div class="col-lg-5 col-md-5 col-sm-5">
                        <form class="" action="" method="post" >
                           
                        
                                <!-- <div class="row"> -->
                                <div class="input-group">
                                <input  type="text"   name="team_name" value=""placeholder="team name"  class="form-control"/>
                                <button  type="submit" name ="submit" class="btn btn-primary" >
                                    Add teams
                                 </button>
                                </div>
                            </form> 
                        <?php //UPDATE AND INCLUDE QUERY
                        if(isset($_GET['edit'])){

                            $cat_id = $_GET['edit'];
                            include "includes/update_categories.php";

                        }
                        
                         ?>
                      
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-7">

                      
                            <table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                       <th>Team name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $query ="SELECT * FROM teamlist";
                                $result = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_array($result)){
                                $admin_id = $_SESSION['admin_id'];
                                $team_id =$row['team_id'];
                                
                                $teamname_convert =$row['team_name'];
                                $team_name = str_replace("_"," ",$teamname_convert);
                                echo "<tr>";
                                echo "<td>{$team_name}</td>";
                                echo "<td><a class='btn btn-primary' href='teams.php?team_id={$team_id}'>View users</a></td>"; 
                                
                               echo "<td><a  href='license.php?source=team_license&license_id={$team_id}&team_name={$team_name}'  class='btn btn-primary'>View License</a></td>";
                             
                                echo "<td><a delete_name={$team_name} delete_id={$team_id} href='javascript:void(0)' class='btn btn-danger delete_link'>Delete</a></td>";
                                echo "<td><a admin_id={$admin_id} team_name={$team_name} team_id={$team_id} href='javascript:void(0)' class='btn btn-secondary edit_link'>Rename</a></td>";
                                echo "<td><a href='alert_teams.php?team_id={$team_id}' class='btn btn-outline-primary alert_link' '>Alert receiver</a></td>"; 
                                
                                echo "</tr>";

                             
                                ?>
                          
                                <?php
                                }
                                  ?>
                        </tbody>
                    </table>
                </div>


</div>

<script>
$(document).ready(function(){
    $(".edit_link").on('click',function(){
        $("#updateModal").modal('show');
        var team_id = $(this).attr("team_id");
        var team_name = $(this).attr("team_name");
        $('#team_id').val(team_id);
        $('#team_name').val(team_name);
    });

    $(".delete_link").on('click',function(){
        $("#deleteModal").modal('show');
        var delete_id = $(this).attr("delete_id");
        var delete_name = $(this).attr("delete_name");
        var admin_id = $(this).attr("admin_id");
        $('#admin_id').val(admin_id);
        $('#delete_id').val(delete_id);
        $('#delete_name').val(delete_name);
    });




});
/* $(document).ready(function(){
   
});
 */

// $(document).ready(function(){

//     $("#update_button").click(function(){
//         // $("#update_button").modal('show');
//         var team_id = $('#team_id').val();
//         var team_name = $('#team_name').val();
//         var update_name = $('#update_name').val();
       
//         if(update_name !== ''){
//             $.ajax({
//                 url:"teams.php?source=edit_teams",
//                 method:"POST",
//                 data:{team_id:team_id, team_name:team_name, update_name:update_name},
//                 success:function(data){
                    
//                 }
//             })
//         }
//     });


// });





</script>

  
                      
                    
   
