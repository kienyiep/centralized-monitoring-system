

<?php
include "includes/db.php";
if(isset($_POST['reminderid'])){
  $reminder_id = $_POST['reminderid'];
  
$reminderArray = json_decode($_POST['reminderArray'],true);
// print_r($_POST['renewalArray']);
$team_name= $reminderArray[0]['team'];

  $query = "SELECT * FROM $team_name";
  $select_renewal = mysqli_query($connection, $query);
  while($row = mysqli_fetch_array($select_renewal)){
    $renewal_id = $row['license_id'];
    $license_renewal = $row['license_renewal'];
    $renewal_year = $row['renewal_year'];
    $renewal_month = $row['renewal_month'];
    $renewal_day = $row['renewal_day'];
    if($reminder_id === $renewal_id){
     
      ?>
        <script>
          license_renewal =  "<?php echo $license_renewal ?>";
          validation = new Date(license_renewal);
          renewal_year = "<?php echo $renewal_year ?>";
          renewal_month = "<?php echo $renewal_month ?>";
          renewal_day = "<?php echo $renewal_day ?>";
          renewal_hour = 00;
          renewal_min = 00;


          current = new Date();
          curYear = current.getFullYear();
          curMonth = current.getMonth()+1; // this is 0 based, hence need to add 1 to start at Jan

          curDate = current.getDate();
          curHour = current.getHours();
          curMin = current.getMinutes();

            present = new Date(curYear,curMonth, curDate, curHour, curMin);
            console.log("present",present);
            future = new Date(renewal_year,renewal_month,renewal_day,renewal_hour,renewal_min);

            distance = calcDistance(present, future);
            console.log(distance);
        
                      year = String(Math.trunc(distance / (60*60*24*31*12))).padStart(2, 0);
                      month = String(Math.trunc(distance / (60*60*24*31)%12)).padStart(2, 0);
                      day = String(Math.trunc(distance / (60*60*24)%31)).padStart(2, 0);
                      hour = String(Math.trunc((distance / (60*60))%24)).padStart(2, 0);
                      min = String(Math.trunc((distance / 60) %60 )).padStart(2, 0);
                      sec = String(distance % 60).padStart(2, 0);
                      // console.log(year);
                     if(isNaN(validation)){
                        document.getElementById("reminder").innerHTML = "No renewal date set";
                    }else{
                      if(distance>0){
                  document.getElementById("reminder").innerHTML = year +"years " +month +"months " +day +"day " +hour +"hours " ;
                      }else{
                  document.getElementById("reminder").innerHTML = "The notification will be sent through email at 12 am";
                      }

                      }
                      // console.log(distance);
                // Decrease 1s
                 
      
            
        </script>

        <p id="reminder" style="font-size:20px"></p>

         

      <?php
    }
  }

}



?>