<?php
 $query = "SELECT * FROM {$team_name} ";
 $select_all_license_query = mysqli_query($connection, $query);
 check_query($select_all_license_query);

 
?>

<!-- 
            < ?php if(isset($_POST['search'])) {  
              echo "<ul class='list-group list-group-flush'>";
                       echo "<li class='list-group-item active'></li>";
                       echo "<li class='list-group-item list-group-item-secondary'></li>";
                       echo "<li class='list-group-item list-group-item-danger'></li>";
                       echo "</ul>";

             } ?>     -->

