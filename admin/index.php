<?php include "includes/admin_header.php" ?>

<?php include "includes/admin_navigation.php" ?>

<?php if(isset($_SESSION['admin_name'])){
      if(isset($_SESSION['admin_state'])== 'false'){
    ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            
                            <!-- <small style="color:blue">< ?php echo $_SESSION['admin_name'] ?></small> -->
                        </h1>
                       
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                

                <!-- /.row -->
  
            </div>
            <!-- /.container-fluid -->

   
<?php }else if(isset($_SESSION['admin_state'])== 'true'){ 

header("Location: ../login_admin.php");

}}?>
<?php include "includes/admin_footer.php" ?>
 