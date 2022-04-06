<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">

        <div class="container-fluid">
        <?php  $username = $_SESSION['username'];?>
       
         <a
          class="nav-user dropdown-toggle "
          data-bs-toggle="dropdown" href="#userDropdown" type="button" aria-expanded="false" id="userDropdown"
          ><span class="dropdown-text"> Welcome</span> <span class='username'> <?php echo $username?></a>
          
          <ul class="dropdown-menu" aria-labelledby="userDropdown">
            <li>
              <a href="users.php?source=add_users" class="dropdown-item text-dark pl-4 p-2"
                >Profiles</a
              >
            </li>
            <li>
              <a href="includes/logout.php" class="dropdown-item text-dark pl-4 p-2"
                >log out</a>
            </li>
            
          </ul>

        <div class="collapse navbar-collapse navbar-style" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <?php 
              if(isset($_SESSION['team_selected'])){
                 $user_team = $_SESSION['team_selected'];
                 $user_role = $_SESSION['user_role'];
                 // $username = $_SESSION['username'];
               $query = "SELECT * FROM teamlist WHERE  team_id = $user_team";
               $select_team = mysqli_query($connection,$query);
               while($row = mysqli_fetch_assoc($select_team)){
                   $team_name = $row['team_name'];
               }   
           
               echo "<li class='nav-item'><a class='nav-link' href='main.php?team_name=$team_name'>License</a></li>";
               if($user_role === 'clerical' || $user_role === 'PIC'){
               echo "<li class='nav-item'><a class='nav-link' href='content.php?source=add_content&team_name=$team_name'>Add content</a>   </li>";
               }
            
               if($user_role === 'management' ){
              echo "<li class='nav-item'><a class='nav-link' href='database?user_team= $user_team '>Database</a></li>";
              echo "<li class='nav-item'><a href='access_logging' class='nav-link'>Access Logging</a></li>";

               } 
               if($user_role === 'management' || $user_role === 'PIC' ){
              
              echo "<li class='nav-item' data-bs-toggle='modal' data-bs-target='#exampleModal'><a class='nav-link'>Teams</a></li>";

               } 
              
               if($user_role === 'PIC' ){
               
                echo "<li class='nav-item'><a href='access_logging/$team_name' class='nav-link'>Access Logging</a></li>";
  
                 } 
              
              }
              ?>
            </ul>

            
           
            <form class="d-flex" action="searchPage.php?team_name=<?php echo $team_name ?>" method="post" >
              <input class="form-control me-2" type="text" name="search" placeholder="License name" >
              <input class="btn btn-outline-success" name="submit" type="submit" >Search</input>
            </form> 
        </div>
        </div>
        <!-- /.container -->
</nav> 
  