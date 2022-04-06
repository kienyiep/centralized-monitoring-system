<?php

// if(isset($_GET['team_name'])){
//     $team_name = $_GET['team_name'];

if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
// $admin_id = $_POST['admin_id'];
$admin_password = $_POST['admin_password'];

// $password_query = "SELECT admin_password FROM admins";
// $admin_password_query = mysqli_query($connection, $password_query);

// while($row = mysqli_fetch_array($admin_password_query)){
//     $password_obtained = $row['admin_password'];
// }

$password_stmt = mysqli_prepare($connection,"SELECT admin_password FROM admins" );
// mysqli_stmt_bind_param($password_stmt,"i",$admin_id);
mysqli_stmt_execute($password_stmt);
mysqli_stmt_bind_result($password_stmt, $password_GET);

while(mysqli_stmt_fetch($password_stmt)){
$password_obtained = $password_GET;
}
mysqli_stmt_close($password_stmt);
if(password_verify($admin_password,$password_obtained)){

// $select_table_query = "SELECT team_name FROM teamlist WHERE team_id = $delete_id";
// $select_table = mysqli_query($connection, $select_table_query);
// while($row= mysqli_fetch_array($select_table)){
//     $team_name = $row['team_name'];
// }

$teamname_stmt = mysqli_prepare($connection, "SELECT team_name FROM teamlist WHERE team_id = ?");
mysqli_stmt_bind_param($teamname_stmt,"i", $delete_id);
mysqli_stmt_execute($teamname_stmt);
mysqli_stmt_bind_result($teamname_stmt, $teamname_GET);
// mysqli_stmt_close($stmt);
while(mysqli_stmt_fetch($teamname_stmt)){
$team_name = $teamname_GET;
}
mysqli_stmt_close($teamname_stmt);
$drop_table_stmt = mysqli_prepare($connection, "DROP TABLE $team_name");
mysqli_stmt_execute($drop_table_stmt);
mysqli_stmt_close($drop_table_stmt);

$drop_team_stmt = mysqli_prepare($connection,"DELETE FROM teamlist WHERE team_id = ?");
mysqli_stmt_bind_param($drop_team_stmt, "i", $delete_id );
mysqli_stmt_execute($drop_team_stmt);
mysqli_stmt_close($drop_team_stmt);
// $drop_table_query = "DROP TABLE $team_name";
// $drop_table = mysqli_query($connection, $drop_table_query);
// check_query($drop_table);


// $drop_team_query = "DELETE FROM teamlist WHERE team_id = $delete_id";
// $delete_team = mysqli_query($connection, $drop_team_query);
// check_query($delete_team);

header('Location: teams.php?source=add_teams');
}else{
    header('Location: teams.php?source=add_teams&delete_error=""');
}

}
// }
?>