<nav >
<div class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a  class="navbar-brand" href="#">CMS Admin</a>

       <div class="collapse navbar-collapse " >
      <ul class="navbar-nav ms-auto admin-navbar">
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

        </div>

<div class="navbar2 bg-dark">
     
      <ul class="navbar-nav2 mt-5  w-100">
      <li class="nav-item2  w-100"> <a href="teams.php?source=add_teams" class="nav-link2 text-light "
      >Teams</a>
      </li>
        <li class="nav-item2 dropdown w-100">
         
          <a
          class="nav-link2 dropdown-toggle text-light pl-4"
          data-bs-toggle="collapse" href="#userDropdown" role="button" aria-expanded="false" aria-controls="navbarDropdown"
          >Users</a>
       
          <ul class="collapse multi-collapse" id="userDropdown">
            <li>
              <a href="users.php?source=add_users" class="dropdown-item text-light pl-4 p-2"
                >Add users</a
              >
            </li>
            <li>
              <a href="users.php?" class="dropdown-item text-light pl-4 p-2"
                >View all users</a
              >
            </li>
            
          </ul>
        </li>
    
     
      </ul>
</div>
</nav> 
  