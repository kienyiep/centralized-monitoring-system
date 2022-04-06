<form action="" method='post'>
 <table class = "table table-bordered table-hower">


            <thead>
                    <tr>

                       
                       
                        <th>License number </th>
                        <th>License name </th>
                        <th>License type </th>
                        <th>License authority </th>
                        <th>License expiry </th>
                        <th>License renewal </th>
                        <th>View license </th>
                        <th>Added date </th>
                        <th>Added by </th>
                        <th>Last modification </th>
                        <th>Modified by</th>
                    

                      
                    </tr>

            </thead>
            <tbody>

            <?php
            if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $user_team_id = $_SESSION['team_selected'];
            $query= "SELECT * FROM teamlist WHERE team_id = {$user_team_id}";
            $user_team = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($user_team)){
               $team_name = $row['team_name'];
            }
            $query = "SELECT * FROM $team_name";
            $select_posts = mysqli_query($connection, $query);
         
                while($row = mysqli_fetch_assoc($select_posts)){
                $license_id = $row['license_id'];
                $license_number = $row['license_number'];
                $license_name = $row['license_name'];
                $license_type = $row['license_type'];
                $license_authority = $row['license_authority'];
                $license_expiry = $row['license_expiry'];
                $license_renewal = $row['license_renewal'];
                $added_date = $row['added_date'];
                $added_by = $row['added_by'];
                $last_modification = $row['last_modification'];
                $modified_by = $row['modified_by'];
               

                echo "<tr>";

                ?>
             
                        
                <?php
                echo "<td>$license_number</td>";  // td - table row element
                echo "<td>$license_name</td>";
                echo "<td>$license_type</td>";
                echo "<td>$license_authority</td>";
                echo "<td>$license_expiry</td>";
                echo "<td>$license_renewal </td>";
               
               
                // here we will set multiple parameter by divide the parameters. We need to devide the values by using &.
                echo "<td><a style='text-decoration:none' href='../post.php?post_id={$license_id}'>View License</a></td>";
                echo "<td>$added_date</td>";
                echo "<td>$added_by</td>";
                echo "<td>$last_modification</td>";
                echo "<td>$modified_by</td>";
                
                echo "</tr>";
                }
            }
            ?>
            
            </tbody>
</table>
</form>

