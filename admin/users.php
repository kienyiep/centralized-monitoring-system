<?php include "includes/admin_header.php" ?>
<?php include "includes/admin_navigation.php" ?>


            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
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

                            case 'add_users':
                                include "includes/add_users.php";
                            break;
                            case 'edit_users':
                                include "includes/edit_users.php";
                            break;
                            case 'delete_users':
                                include "includes/delete_users.php";
                            break;
                            
                            default: 
                            include "includes/view_all_users.php";

                            break;
                            



                        }
                        
                        
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

      
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>
 