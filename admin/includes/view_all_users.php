<table class = "table table-bordered table-hower">
<style>

.team_status{
    color: red;
}

</style>

            <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Team name</th>
                 
                    </tr>

            </thead>
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Type admin password to delete user</h5>
                    
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                    <form action='users.php?source=delete_users' method="post">
                      <div class="modal-body">
                      <div class="row">
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

            <tbody>

            <?php
            
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
        
                while($row = mysqli_fetch_assoc($select_users)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_role = $row['user_role'];
                $user_email = $row['user_email'];
                $team_id = $row['team_selected'];
                $team_status = false;
                $query2 = "SELECT * FROM teamlist WHERE team_id = $team_id";
                $select_team_name = mysqli_query($connection, $query2);
                $team_count = mysqli_num_rows($select_team_name);
                if($team_count>0) {
                while($rows = mysqli_fetch_array($select_team_name)){
                $team_name_converted = $rows['team_name'];
               
  
                $team_name = str_replace("_"," ",$team_name_converted);
                }
                }else{
                    $update_user_query = "UPDATE users SET team_selected = -1 WHERE user_id = {$user_id}";
                    $update_user = mysqli_query($connection, $update_user_query);

                    $team_name = 'No team ';
                    $team_status= true;
                }
                ?>
                <tr>
                <td><?php echo $user_id?></td> 
                <td><?php echo $username ?></td>
                <td><?php echo $user_firstname ?></td>
                <td><?php echo $user_lastname ?></td>
                <td><?php echo $user_email ?></td>
                <td><?php echo $user_role ?></td>
                <td class='<?php echo $team_status?"team_status":" "?>'><?php echo $team_name?></td>
                <td><a class="btn btn-primary" href='users.php?source=edit_users&edit_users=<?php echo $user_id?>'>Edit</a></td>
                <td><a class="btn btn-danger delete_link" delete_id =<?php echo $user_id ?> delete_name=<?php echo $username?> >Delete</a></td>
                <!-- href='users.php?delete=< ?php echo $user_id?>' -->
                </tr>
                <?php 
                }
            ?>
            
            </tbody>
</table>

<script>

$(document).ready(function(){
  
    $(".delete_link").on('click',function(){
        $("#deleteModal").modal('show');
        var delete_id = $(this).attr("delete_id");
        var delete_name = $(this).attr("delete_name");
        $('#delete_id').val(delete_id);
        $('#delete_name').val(delete_name);
    });




});

</script>
<?php 


if(isset($_GET['delete'])){
$the_user_id =  $_GET['delete'];

$query = "DELETE FROM users WHERE user_id = {$the_user_id}";

$delete_user_query = mysqli_query($connection, $query);
header("Location: users.php");
}


?>
