<?php include 'db.php'; ?>
<?php include 'function.php'; ?>
<?php session_start(); ?>
<!-- each time somebody come in this page, we will cancel the session. -->
<?php

$_SESSION['admin_id'] = null;
$_SESSION['admin_name'] = null;
$_SESSION['admin_email'] = null;
$_SESSION['admin_password'] = null;
$_SESSION['admin_state'] = false;
// $query = "UPDATE adminstate SET ";
// $query .= "state_bool = 'false' ";

// $update_state = mysqli_query($connection, $query);

// check_query($update_state);


header("Location: ../login_admin.php");
?>
