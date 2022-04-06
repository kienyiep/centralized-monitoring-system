
<?php 

if(isset($_POST['create_license'])){
    $license_number = $_POST['license_num'];
    $license_name = $_POST['license_name'];
    $license_pdf = $_FILES['pdf']['name'];
    $pdf_type = $_FILES['pdf']['type'];
    $pdf_size = $_FILES['pdf']['size'];
    $pdf_tem_loc = $_FILES['pdf']['tmp_name'];
    $pdf_store = 'license_pdf/'.$license_pdf;
    $license_type = $_POST['license_type'];
    $authority = $_POST['authority'];
    $expiry = $_POST['expiry_date'];
    $renewal = $_POST['renewal_date'];
    // $renewal_hour = $_POST['renewal_hour'];
    // $renewal_min = $_POST['renewal_min'];

    // $license_image = $_FILES['image']['name'];
    // $license_image_temp = $_FILES['image']['tmp_name'];

    $license_company = $_POST['company_name'];
    $license_address = $_POST['company_address'];
    $license_other_company = $_POST['company_involved'];
    $status = $_POST['status'];
    $additional_details = $_POST['add_mandatory'];

    $license_activity = $_POST['license_activity'];
    $license_cost = $_POST['license_cost'];
    $parties_involved = $_POST['parties_involved'];
    $person_in_charge = $_POST['person_in_charge'];
    $department_in_charge = $_POST['department_in_charge'];
    $company_region = $_POST['company_region'];
    $action_required = $_POST['action_required'];
    
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $added_date = date('y-m-d',time());
    $added_by = $_SESSION['username'];
    
    $license_split_name = explode(' ', $license_name);
    $license_join_name = implode(',' , $license_split_name);  

    $license_split_company = explode(' ', $license_company);
    $license_join_company = implode(',' , $license_split_company);  
    
   if(empty($renewal)){
    $renewal_status='false';
   }else{
    $renewal_status='true';
   
   }

    // $license_split_expiry = explode('-', $expiry);
    // $license_join_expiry = implode(',' , $license_split_expiry);  
    // $license_split_renewal = explode('-', $renewal);
    // $license_join_renewal = implode(',' , $license_split_renewal);  
     
    move_uploaded_file($pdf_tem_loc,$pdf_store);

    if(isset($_POST['renewal_date'])){

        $renewal = $_POST['renewal_date'];
        $renewalDate = strtotime($renewal);
        $year = date('y',$renewalDate);
        $month = date('m', $renewalDate);
        $date = date('d', $renewalDate);

        }
    ?>
    <?php
    if(isset($_GET['team_name'])){
    $team_name = $_GET['team_name'];
    $stmt = mysqli_prepare($connection,"INSERT INTO $team_name(license_number,license_name,license_pdf,license_type,license_authority,license_expiry,license_renewal,license_company,license_address,license_other_company,license_status,license_details,license_activity,license_cost,parties_involved,person_in_charge,department_in_charge,company_region,special_action, added_date, added_by, split_license_name, split_license_company,renewal_status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


    mysqli_stmt_bind_param($stmt,'ssssssssssssssssssssssss',$license_number, $license_name, $license_pdf, $license_type, $authority, $expiry,$renewal, $license_company, $license_address,$license_other_company, $status, $additional_details, $license_activity, $license_cost, $parties_involved, $person_in_charge, $department_in_charge, $company_region, $action_required,$added_date,$added_by, $license_join_name,$license_join_company,$renewal_status );

    mysqli_stmt_execute($stmt);
    if(!$stmt){        
         die('QUERY FAILED'. mysqli_error($connection));
     }
     mysqli_stmt_close($stmt);


    $username = $_SESSION['username'];
    insertContentLog($username,$team_name,$license_number);
    header("Location: main.php?team_name=$team_name");
    }

    ?>

     

        


    <?php
}

?>


<div class="container mt-5 ">
<!-- Page Heading -->
<div class="row justify-content-center ">
    <div class="col-sm-12">

<form action="" method="post" enctype= "multipart/form-data">
<div class="row ">
<div class= col-sm-6>
<h2>Mandatory</h2>    

<div class="form-group">
<label for = "license_number">License ID</label>
<input type="text" name="license_num" class="form-control" >
</div>

<div class="form-group">
<label for = "license_name">License Name</label>
<input type="text" name="license_name" class="form-control" >
</div>

<div class="form-group">
<label for = "license_type">License Type</label>
<input type="text" name="license_type" class="form-control" >
</div>

<div class="form-group">
<label for = "authority">Authority</label>
<input type="text" name="authority" class="form-control" >

</div>

<div class="form-group">
<label for = "expiry_date">Expiry Date</label>
<input type="date" name="expiry_date" class="form-control" >

</div>

<div class="form-group">
<label for = "renewal_date">Renewal Date</label>
<input type="date" name="renewal_date" class="form-control" >

</div>

<div class="form-group">
<label for = "company_name">Company name</label>
<input type="text" name="company_name" class="form-control" >
</div>
<div class="form-group">
<label for = "license_pdf">Choose license PDF File</label>
<input  id="pdf" type="file" name="pdf" value="" class="form-control" >
</div>
<div class="form-group">
<label for = "company_address">Company address</label>
<input type="text" name="company_address" class="form-control" >
</div>
<div class="form-group">
<label for = "company_involved">Other company Invoved</label>
<input type="text" name="company_involved" class="form-control" >

</div>

<div class="form-group">
<label for = "status">Status</label>
<input type="text" name="status" class="form-control" >

</div>

<div class="form-group">
<label for = "add_mandatory">Addtional mandatory condition</label>
<input  class = "form-control" name= "add_mandatory" id="" cols="30" row="30"> 
</div>
</div>

<div class="col-sm-6">
<h2>Not mandatory</h2>  

<div class="form-group">
<label for = "license_activity" >License activity</label>
<input type="text" name="license_activity" class="form-control" >
</div>


<div class="form-group">
<label for = "license_cost">Cost of the license</label>
<input type="text" name="license_cost" class="form-control" >
</div>

<div class="form-group">
<label for = "parties_involved">Parties Invoved</label>
<input type="text" name="parties_involved" class="form-control" >

</div>

<div class="form-group">
<label for = "person_in_charge">Person in charge</label>
<input type="text" name="person_in_charge" class="form-control" >
</div>

<div class="form-group">
<label for = "department_incharged">Department in charge</label>
<input type="text" name="department_in_charge" class="form-control" >

</div>

<div class="form-group">
<label for = "company_region">Other company's country &#38 region</label>
<input type="text" name="company_region" class="form-control" >
</div>



<div class="form-group">
<label for = "action-required">Special action required</label>
<input type="text" name="action_required" class="form-control" >
</div>


</div>
</div>

<div class="form-group">
    <br>
<input  class = "btn btn-outline-primary" type = "submit" name = "create_license" value = "submit"> 
</div>
</form>
</div>
</div>
</div>
