<!-- < ?php

function check_query($query){
global $connection;
 if(!$query){
     die("QUERY FAILED". mysqli_error($connection));
 }
}
?> -->