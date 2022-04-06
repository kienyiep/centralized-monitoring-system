<?php include "includes/admin_header.php" ?>
<?php include "includes/admin_navigation.php" ?>


<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
    <h1 class="page-header">
            Welcome to admin
            <!-- <small>< ?php echo $_SESSION['admin_name'] ?></small> -->
        </h1>
       
        <?php 
        
        if(isset($_GET['source'])){
           $source = $_GET['source'];

        }else{
            $source = ' ';
        }
        switch($source){

            case 'add_teams':
                include "includes/add_teams.php";
            break;
            case 'edit_teams':
                include "includes/edit_teams.php";
            break;
            case 'delete_teams':
                include "includes/delete_teams.php";
            break;
            
            default: 
            include "includes/view_all_teams.php";

            break;
            



        }
        
        
        ?>
  
</div>
</div>
<!-- /.row -->

</div>

<?php include "includes/admin_footer.php" ?>
 