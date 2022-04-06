
<?php

if(isset($_POST['rename'])){
  // echo "success";
    $team_id = $_POST['team_id'];
    
    $team_name = $_POST['team_name'];
  
    $update_name_convert = $_POST['update_name'];
  
    $update_name = str_replace(" ","_",$update_name_convert);
  
    $query = "SELECT team_name FROM teamlist WHERE team_id = {$team_id}";
    $select_table = mysqli_query($connection,$query );
    while($row = mysqli_fetch_array($select_table)){
        $table_name = $row['team_name'];
    }
    
    $select_teamlist_query ="SELECT * FROM teamlist WHERE team_name = '{$update_name}'";
    $select_teamlist = mysqli_query($connection, $select_teamlist_query);
    check_query($select_teamlist);

    $count_team = mysqli_num_rows($select_teamlist);


if($count_team === 0){
    $rename_team_query = "UPDATE teamlist SET team_name='{$update_name}' WHERE team_id= {$team_id}";
    $update_team = mysqli_query($connection, $rename_team_query);
    check_query($update_team);

    $rename_table_query ="ALTER TABLE $table_name RENAME TO $update_name";
    $update_table = mysqli_query($connection,$rename_table_query);
    check_query($update_table);

   
    header("Location:teams.php?source=add_teams");
}else{
  header("Location:teams.php?source=add_teams");
}
}

?>

<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">$update_name</h5>
                    
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                       
                      <div class="modal-body">
                     
                        <div class="mb-3">
                           <p>Team already exists </p>
                           <p>Insert another team name</p>
                        </div>
                       
                      </div>
                      <div class="modal-footer">
                        <a class="btn btn-primary" href="teams.php?source=add_teams" >Close</a>
                      </div>
                    
                    </div>
            </div>
</div>