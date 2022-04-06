<?php
include ob_start();
// if(isset($_GET['team_name'])){
//     $team_name = $_GET['team_name'];

if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];

$admin_password = $_POST['admin_password'];

$password_stmt = mysqli_prepare($connection,"SELECT admin_password FROM admins");
mysqli_stmt_execute($password_stmt);
mysqli_stmt_bind_result($password_stmt,$password_GET);
while(mysqli_stmt_fetch($password_stmt)){
$password_obtained = $password_GET;
}
mysqli_stmt_close($password_stmt);
if(password_verify($admin_password, $password_obtained)){


$delete_stmt  = mysqli_prepare($connection, "DELETE FROM users WHERE user_id = ?" ); 
mysqli_stmt_bind_param($delete_stmt,"i",$delete_id);
mysqli_stmt_execute($delete_stmt);
mysqli_stmt_close($delete_stmt);

header('Location: users.php');
}else{
    header('Location: users.php');
}

}
// }
?>