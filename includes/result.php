<?php
if(isset($_POST['save-multicheckbox'])){
  $brandlist = $_POST['brandlist'];
  foreach($brandlist as $branditems)
  {
    echo $branditems . "<br>";
  }
}


?>