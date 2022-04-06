<?php 

if(isset($_GET['team_name'])){
$team_name = $_GET['team_name'];
if(isset($_GET['edit'])){
$edit_id = $_GET['edit'];
$query  = "SELECT * FROM $team_name WHERE license_id = {$edit_id}";
$select_all_content_query = mysqli_query($connection,$query);

  while($row = mysqli_fetch_assoc($select_all_content_query)){
    $license_id = $row['license_id'];
    $license_number = $row['license_number'];
    $license_name = $row['license_name'];
    $license_pdf = $row['license_pdf'];
    $license_type = $row['license_type'];
    $authority = $row['license_authority'];
    $expiry = $row['license_expiry'];
    $renewal = $row['license_renewal'];
   
    $license_company = $row['license_company'];
    $license_address = $row['license_address'];
    $license_other_company = $row['license_other_company'];
    $status = $row['license_status'];
    $additional_details = $row['license_details'];
    
    $license_activity = $row['license_activity'];
    $license_cost = $row['license_cost'];
    $parties_involved = $row['parties_involved'];
    $person_in_charge= $row['person_in_charge'];
    $department_in_charge = $row['department_in_charge'];
    $company_region = $row['company_region'];
    $special_action = $row['special_action'];
    $renew_status = $row['renewal_status'];
   

}

  if(isset($_POST['update'])){
    $license_number = $_POST['license_number'];
    $license_name = $_POST['license_name'];
    $license_pdf = $_FILES['pdf']['name'];
    $pdf_type = $_FILES['pdf']['type'];
    $pdf_size = $_FILES['pdf']['size'];
    $pdf_tem_loc = $_FILES['pdf']['tmp_name'];
    $pdf_store = 'license_pdf/'.$license_pdf;
    $license_type = $_POST['license_type'];
    $license_authority = $_POST['authority'];
    $license_expiry = $_POST['expiry_date'];
    $license_renewal = $_POST['renewal_date'];
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $last_modification = date("Y-m-d");
    $modified_by = $_SESSION['username']; 
 
    $license_company = $_POST['company_name'];
    $license_address = $_POST['company_address'];
    $license_other_company = $_POST['company_involved'];
    $license_status = $_POST['status'];
    $additional_details = $_POST['add_details'];

    $license_activity = $_POST['license_activity'];
    $license_cost = $_POST['license_cost'];
    $parties_involved = $_POST['parties_involved'];
    $person_in_charge = $_POST['person_in_charge'];
    $department_in_charge = $_POST['department_in_charge'];
    $company_region = $_POST['company_region'];
    $special_action = $_POST['action_required'];
    
    $license_split_name = explode(' ', $license_name);
    $license_join_name = implode(',' , $license_split_name);
    $license_split_company = explode(' ', $license_company);
    $license_join_company = implode(',' , $license_split_company); 

    $license_split_expiry = explode('-', $expiry);
    $license_join_expiry = implode(',' , $license_split_expiry);  
    $license_split_renewal = explode('-', $renewal);
    $license_join_renewal = implode(',' , $license_split_renewal); 
  


    // if($renewal !== $license_renewal){
    //     $renewal_status = 'true';
    //   }
   

    if(!empty($license_renewal)){


      $team_stmt = mysqli_prepare($connection,"SELECT license_renewal FROM $team_name WHERE license_id = ?" );
      mysqli_stmt_bind_param($team_stmt,'i',$license_id);
      mysqli_stmt_execute($team_stmt);
      mysqli_stmt_bind_result($team_stmt,$renewal_GET); 
     

      while(mysqli_stmt_fetch($team_stmt)){
          $previous_renewal = $renewal_GET;
          $renewal_status= 'true';
          
        }
        mysqli_stmt_close($team_stmt);

        if($license_renewal !== $previous_renewal){
          
      $renew_stmt = mysqli_prepare($connection,"UPDATE $team_name SET renewal_status = ? WHERE license_id = ?" );    
      mysqli_stmt_bind_param($renew_stmt,'si', $renewal_status, $license_id );
      mysqli_stmt_execute($renew_stmt);
      mysqli_stmt_close($renew_stmt);
      
        }
     
    }



    move_uploaded_file($pdf_tem_loc,$pdf_store);

    if(empty($license_pdf)){
        $pdf_stmt= mysqli_prepare($connection, "SELECT license_pdf FROM $team_name WHERE license_id=?");
        mysqli_stmt_bind_param($pdf_stmt,"i",$edit_id);
        mysqli_stmt_execute($pdf_stmt);
        mysqli_stmt_bind_result($pdf_stmt, $pdf_GET);

        while(mysqli_stmt_fetch($pdf_stmt)){
            $license_pdf =  $pdf_GET;
        }
        
    
  }
    $update_stmt = mysqli_prepare($connection,"UPDATE $team_name SET license_number=?, license_name=?, license_pdf=?, license_type=?, license_authority=?, license_expiry=?, license_renewal=?, license_company=?, license_address=?, license_other_company=?, license_status=?, license_details=?, license_activity=?, license_cost=?, parties_involved=?,person_in_charge=?, department_in_charge=?, company_region=?, special_action=?, last_modification=?, modified_by=?, split_license_name=?, split_license_company=? WHERE license_id=?" );

    mysqli_stmt_bind_param($update_stmt, "sssssssssssssssssssssssi",$license_number, $license_name, $license_pdf, $license_type, $license_authority, $license_expiry, $license_renewal, $license_company, $license_address, $license_other_company, $license_status, $additional_details, $license_activity, $license_cost, $parties_involved,$person_in_charge, $department_in_charge, $company_region,$special_action, $last_modification, $modified_by,$license_join_name,$license_join_company,$license_id);

    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
   
  
    $username = $_SESSION['username'];
    updateContentLog($username,$team_name ,$license_number);
    header("Location: main.php?team_name=$team_name");
    // header("Location: post.php?post_id={$license_id}");

  }  
} 
}
?>



<br>
<div class="container">
<!-- Page Heading -->
<div class="row">
    <div class="col-sm-12">

<form action="content.php?source=update_content&team_name=<?php echo $team_name?>&edit=<?php echo $license_id ?>" method="post" enctype= "multipart/form-data">
<div class="row ">
<div class= col-sm-6>
<h2>Mandatory</h2> 

<div class="form-group">
<label for = "license_number">license ID</label>
<input type="text" name="license_number" class="form-control" value = "<?php echo $license_number; ?>">
</div>
<div class="form-group">
<label for = "license_name">license Name</label>
<input type="text" name="license_name" class="form-control" value = "<?php echo $license_name; ?>">
</div>
<div class="form-group">
<label for = "license_type">license Type</label>
<input type="text" name="license_type" class="form-control" value = "<?php echo $license_type; ?>">
</div>
<div class="form-group">
<label for = "authority">authority</label>
<input type="text" name="authority" class="form-control" value= "<?php echo $authority; ?>">
</div>
<div class="form-group">
<label for = "expiry_date">expiry</label>
<input type="date" name="expiry_date" class="form-control" value= "<?php echo $expiry; ?>" >
</div>
<div class="form-group">
<label for = "renewal_date">renewal</label>
<input type="date" name="renewal_date" class="form-control" value= "<?php echo $renewal; ?>" >
</div>




<div class="form-group">
<label for = "company_name">Company name</label>
<input type="text" name="company_name" class="form-control" value= "<?php echo $license_company; ?>" >
</div>

<div class="form-group">
<label for = "license_pdf">Choose license PDF File</label>
<input  id="pdf" type="file" name="pdf" value="<?php echo $license_pdf; ?>" class="form-control" >
</div>

<div class="form-group">
<label for = "company_address">Company address</label>
<input type="text" name="company_address" class="form-control" value= "<?php echo $license_address; ?>" >
</div>
<div class="form-group">
<label for = "company_involved">Other company Invoved</label>
<input type="text" name="company_involved" class="form-control" value= "<?php echo $license_other_company; ?>" >

</div>

<div class="form-group">
<label for = "status">status</label>
<input type="text" name="status" class="form-control" value= "<?php echo $status; ?>" >
</div>
<div class="form-group">
<label for = "add_details">additional_details</label>
<input  class = "form-control" name= "add_details"  value= "<?php echo $additional_details; ?>"> 
</div>
</div>

<div class="col-sm-6">
<h2>Not mandatory</h2>  

<div class="form-group">
<label for = "license_activity" >License activity</label>
<input type="text" name="license_activity" class="form-control" value= <?php echo $license_activity?>>
</div>


<div class="form-group">
<label for = "license_cost">Cost of the license</label>
<input type="text" name="license_cost" class="form-control" value =<?php echo $license_cost?> >
</div>

<div class="form-group">
<label for = "parties_involved">Parties Invoved</label>
<input type="text" name="parties_involved" class="form-control" value= <?php echo $parties_involved?> >

</div>

<div class="form-group">
<label for = "person_in_charge">Person in charge</label>
<input type="text" name="person_in_charge" class="form-control" value= <?php echo $person_in_charge?> >
</div>

<div class="form-group">
<label for = "department_incharged">Department incharged</label>
<input type="text" name="department_in_charge" class="form-control" value= <?php echo $department_in_charge?>>

</div>
<div class="form-group">
<label for = "company_region">Other company's country &#38 region</label>
<input type="text" name="company_region" class="form-control" value= <?php echo $company_region?>>
</div>

<div class="form-group">
<label for = "action_required">Special action required</label>
<input type="text" name="action_required" class="form-control" value= <?php echo $special_action?>>
</div>


</div>


</div>
<br>
<div class="form-group">
<input  class = "btn btn-outline-primary" type = "submit" name = "update" value = "update"> 
</div>
</form>
</div>
</div>
</div>
