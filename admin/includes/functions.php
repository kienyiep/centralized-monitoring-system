<?php 

function verifyField($fieldName){
    echo $fieldName ? $fieldName : '&#45;';
      }
      
function addTeams(){
    global $connection;
    if(isset($_POST['submit'])){
        $team_name = $_POST['team_name'];
      
        $query = "CREATE TABLE IF NOT EXISTS {$team_name}(license_id INT(10) NOT NULL AUTO_INCREMENT,
        license_number VARCHAR(255),
        license_name VARCHAR(255),
        license_type VARCHAR(255),
        license_authority VARCHAR(255),
        license_expiry date,
        license_renewal date,
        license_image text,
        license_company VARCHAR(255),
        license_address VARCHAR(255),
        license_other_company VARCHAR(255),
        license_status VARCHAR(255),
        license_details VARCHAR(255),
        license_activity VARCHAR(255),
        license_cost VARCHAR(255),
        parties_involved VARCHAR(255),
        person_in_charge VARCHAR(255),
        department_in_charge VARCHAR(255),
        company_region VARCHAR(255),
        special_action VARCHAR(255),
        split_license_name VARCHAR(255),
        split_license_company VARCHAR(255),
        PRIMARY KEY(license_ID)
        )";
        $create_table = mysqli_query($connection,$query);
        
        check_query($create_table);
        
        $query ="SELECT * FROM teamlist WHERE team_name = '{$team_name}'";
        $check_team = mysqli_query($connection, $query);
        $count= mysqli_num_rows($check_team);
        if($count == NULL){
            $query = "INSERT INTO teamlist(team_name) ";
            $query .= "VALUES('$team_name')";   
        
            $insert_query = mysqli_query($connection, $query);
            check_query($insert_query);
}
        header("Location: teams.php");
       
       
}
}


function findAllTeams(){
    global $connection;
    $query ="SELECT * FROM teamlist";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_array($result)){
   
     $team_name =$row['team_name'];
    echo "<tr>";
    echo "<td>{$team_name}</td>";
    echo "<td><a href='includes/view_all_teams.php?team_name={$team_name}'>View details</a></td>"; 
    echo "<td><a href='categories.php?delete={$team_name}'>Delete</a></td>"; 
    echo "<td><a href='categories.php?edit={$team_name}'>Rename</a></td>"; 
    echo "</tr>";
    }

}

function username_exists($username){
    global $connection;

    // $query="SELECT username FROM users WHERE username='$username'";
    // $result=mysqli_query($connection,$query);
    // check_query($result);
    $stmt=mysqli_prepare($connection,"SELECT username FROM users WHERE username= ?");
    mysqli_stmt_bind_param($stmt,"s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt)>0){
        return true;
    } else{
        return false;
    }
    mysqli_stmt_close($stmt);
    }

    function check_query($query){
        global $connection;
         if(!$query){
             die("QUERY FAILED". mysqli_error($connection));
         }
    }

    function register_user($user_firstname , $user_lastname, $team_selected, $user_role,$username, $user_email,$user_password ){
        global $connection;

        $firstname = mysqli_real_escape_string($connection, $user_firstname);
        $lastname = mysqli_real_escape_string($connection, $user_lastname);
        $team = mysqli_real_escape_string($connection, $team_selected);
        $role = mysqli_real_escape_string($connection, $user_role);
        $name = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $user_email);
        $password = mysqli_real_escape_string($connection, $user_password);
        $hash_password = password_hash($password, PASSWORD_BCRYPT, array('cost'=> 10) );
     
        // $query = "INSERT INTO users(user_firstname,user_lastname,team_selected,user_role,username,user_email,user_password) ";
        $stmt = mysqli_prepare($connection,"INSERT INTO users(user_firstname,user_lastname,team_selected,user_role,username,user_email,user_password) VALUES(?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt,'ssissss',$firstname, $lastname, $team, $role, $name, $email, $hash_password );
        mysqli_stmt_execute($stmt);
        if(!$stmt){
            
             die('QUERY FAILED'. mysqli_error($connection));
         }
         mysqli_stmt_close($stmt);

        
         if($role==='PIC'){
            $selectlist_stmt = mysqli_prepare($connection, "SELECT alert_name FROM teamlist WHERE team_id=?");
            mysqli_stmt_bind_param($selectlist_stmt,'i', $team);
            mysqli_stmt_execute($selectlist_stmt);
            mysqli_stmt_bind_result($selectlist_stmt, $alertname_GET);
            mysqli_stmt_store_result($selectlist_stmt);
            
            while(mysqli_stmt_fetch($selectlist_stmt)){
                if(empty($alertname_GET)){
                    $teamlist_stmt = mysqli_prepare($connection, "UPDATE teamlist SET alert_firstname=?, alert_lastname=?, alert_name=?, alert_email=?,alert_role=? WHERE team_id=?");
                    mysqli_stmt_bind_param($teamlist_stmt,'sssssi',$firstname,$lastname,$name,$email,$role,$team);
                    mysqli_stmt_execute($teamlist_stmt);
                    mysqli_stmt_close($teamlist_stmt);

                }

            
            }
            mysqli_stmt_close($selectlist_stmt);
         }
         
        echo "User created: " ." " ."<a href='users.php'>View Users </a> "; 
          
        }



?>