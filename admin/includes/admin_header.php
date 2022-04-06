<?php 
include "../includes/db.php";
include "functions.php";

session_start();
ob_start()
?>

<?php 
//  if not set, then we will direct the user to index.php.
if(!isset($_SESSION['admin_name'])){
// if($_SESSION['user_role'] !== 'admin'){

   header("Location: ../index.php");
// }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
      
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <link href="css/sb-admin.css" rel="stylesheet" type="text/css">
      <link
      rel="stylesheet"
      href=" https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
    />

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

      <!-- <link href="includes/style.css" rel="stylesheet" type="text/css"> -->
    

    <title>Document</title>


</head>
<body>
