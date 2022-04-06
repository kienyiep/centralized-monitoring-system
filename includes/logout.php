<?php include 'db.php'; ?>
<?php include 'function.php'; ?>
<?php session_start(); ?>
<?php ob_start(); ?>
<!-- each time somebody come in this page, we will cancel the session. -->
<?php

$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['team_selected'] = null;
$_SESSION['user_role'] = null;
$_SESSION['state'] = false;

// $query = "UPDATE sessionState SET ";
// $query .= "state_bool = 'false' ";
// $update_state = mysqli_query($connection, $query);
// check_query($update_state);

header("Location: ../index.php");
?>
