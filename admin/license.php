<?php include "includes/admin_header.php" ?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">

        <div class="container-fluid">
        <a  class="navbar-brand" href="teams.php?source=add_teams">CMS Admin</a>
        
     
       <div class="collapse navbar-collapse " >
      <ul class="navbar-nav ms-auto admin-navbar">
          <?php if(isset($_GET['team_name'])){
              $team_name= $_GET['team_name'];
              ?>
            
      <form class="d-flex" action="license.php?source=search_license&team_name=<?php echo $team_name?>" method="post" >
              <input class="form-control me-2" type="text" name="search" placeholder="License name" >
              <input class="btn btn-outline-success" name="submit" type="submit" >Search</input>
            </form> 

         <?php }?>   
        <li class="nav-item"><a href="../access_logging" class = "nav-link">Access Logging</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class='username'> 
            <?php if(isset($_SESSION['admin_name'])){
            echo $_SESSION['admin_name'];
            }
            ?>
            </span>
          </a>
          <ul class="dropdown-menu admin-navstyle" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="admin_profile.php">Profiles</a></li>
            <li><a class="dropdown-item" href="../includes/logout_admin.php">Log out</a></li>
           
          </ul>
          
        </li>
      </ul>
  
    </div>
        </div>
        <!-- /.container -->

        
</nav>        


<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
    <h1 class="page-header">
            <!-- Welcome to admin -->
            <!-- <small>< ?php echo $_SESSION['admin_name'] ?></small> -->
        </h1>
       
        <?php 
        
        if(isset($_GET['source'])){
           $source = $_GET['source'];

        }else{
            $source = ' ';
        }
        switch($source){

            
            case 'team_license':
                include "includes/team_license.php";
            break;
            case 'search_license':
                include "includes/search_license.php";
            break;
            
            default: 
            include "includes/view_all_license.php";

            break;
            



        }
        
        
        ?>
  
</div>
</div>
<!-- /.row -->

</div>

<?php include "includes/admin_footer.php" ?>
 