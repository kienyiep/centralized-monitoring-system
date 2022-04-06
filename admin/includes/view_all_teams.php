 <table class = "table table-bordered table-hower">
                            <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Team name</th>
                                
                                    </tr>

                            </thead>
                        <tbody>
     
                            <?php
                            
                    if(isset($_GET['team_id'])){
                        $team_id = $_GET['team_id'];
                        
                        // $query = "SELECT * FROM users WHERE team_selected = {$team_id}";
                        // $select_all_users = mysqli_query($connection, $query);

                        $stmt = mysqli_prepare($connection, "SELECT user_id, username, user_password, user_firstname, user_lastname, user_email, team_selected FROM users WHERE team_selected = ? ");

                        if(isset($stmt)){
                            mysqli_stmt_bind_param($stmt,"i", $team_id);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt,$user_id, $username, $user_password, $user_firstname, $user_lastname, $user_email, $team_selected);
                            
                        }

                        while(mysqli_stmt_fetch($stmt)){
                            
                            
                                // $user_id = $row['user_id'];
                                // $username = $row['username'];
                                // $user_password = $row['user_password'];
                                // $user_firstname = $row['user_firstname'];
                                // $user_lastname = $row['user_lastname'];
                                // $user_email = $row['user_email'];
                                // $team_selected = $row['team_selected'];
                                

                                echo "<tr>";
                                echo "<td>$user_id</td>";  
                                echo "<td>$username</td>";
                                echo "<td>$user_firstname</td>";
                                echo "<td>$user_lastname</td>";
                                echo "<td>$user_email</td>";
                                echo "<td>$team_selected</td>";
                                // echo "<td><a class='btn btn-primary' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                                // echo "<td><a class='btn btn-danger'  href='users.php?delete={$user_id}'>Delete</a></td>";
                                echo "</tr>";
                                }
                                mysqli_stmt_close($stmt);
                            ?>
                            
                            </tbody>
                    </table>

                    <?php
                

            }


            
            
            ?>

            
            

        

 