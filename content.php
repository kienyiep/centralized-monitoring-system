<?php include "includes/header.php";
      include "includes/navigation.php";
?>

    
    <?php 
    if(isset($_GET['source'])){
        $source =  $_GET['source'];
      }else{
         $source = ' ';
      }
      switch($source){
          case 'add_content':
            include "insert_content.php";
          break;
          case 'update_content':
            include "update_content.php";
          break;
          case 'delete_content';
           include "delete_content.php";
          break;
          case 'view_content';
           include "view_content_details.php";
          break;
        

      }
    ?>
   
        
    
    
<?php include "includes/footer.php"?>