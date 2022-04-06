<form action="" method='post'>
 <table class = "table table-bordered table-hower">


            <thead>
                    <tr>

                       
                       
                        <th>Firstname </th>
                        <th>Lastname</th>
                        <th>username </th>
                        <th>user_email</th>
                        <th>user_role</th>
                        <th>team</th>
                     

                      
                    </tr>

            </thead>
            <tbody>

            <?php
            if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $user_team_id = $_SESSION['team_selected'];
            $query= "SELECT * FROM users WHERE team_selected = {$user_team_id}";
            $select_users = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($select_users)){
               $user_firstname = $row['user_firstname'];
               $user_lastname = $row['user_lastname'];
               $username = $row['username'];
               $user_email= $row['user_email'];
               $user_role = $row['user_role'];
               $team= $row['team_selected'];

               $select_team_query = "SELECT team_name FROM teamlist WHERE team_id={$team}"; 
               $select_team = mysqli_query($connection, $select_team_query);
               while($row = mysqli_fetch_array($select_team)){
                   $team_name = $row['team_name'];
               }
               echo "<tr>";
               echo "<td>$user_firstname</td>";  // td - table row element
               echo "<td>$user_lastname</td>";
               echo "<td>$username</td>";
               echo "<td>$user_email</td>";
               echo "<td>$user_role</td>";
               
               echo "<td>$team_name</td>";
               
               echo "</tr>";
            }
            
            }
            ?>
            
            </tbody>
</table>
</form>

