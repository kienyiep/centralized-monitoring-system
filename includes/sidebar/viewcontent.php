<ul class='list-group list-group-flush'>
    <div class="row">
    <div class="col-md-9">
    <li class='list-group-item '><input type="checkbox" id="select-all" value="Select All"> Select all</input></li>
    </div>
    <div class="col-md-3">
      <a class="btn btn-outline-primary "data-bs-toggle='modal' data-bs-target='#filterModal'>Options</a>
    </div>
    </div>
    <?php 
            foreach($select_all_license_query as $row){
                $license_id = $row['license_id'];
                $license_number = $row['license_number'];
                $license_name = $row['license_name'];
                $license_type = $row['license_type'];
                $license_authority = $row['license_authority'];
                $license_company = $row['license_company'];
                $license_expiry = $row['license_expiry'];
                $license_renewal = $row['license_renewal'];
                $license_address = $row['license_address'];
                $license_other_company = $row['license_other_company'];
                $license_status = $row['license_status'];
                $license_details = $row['license_details'];
                $license_activity = $row['license_activity'];
                $license_cost = $row['license_cost'];
                $parties_involved = $row['parties_involved'];
                $person_in_charge = $row['person_in_charge'];
                $department_in_charge = $row['department_in_charge'];
                $company_region = $row['company_region'];
                $special_action = $row['special_action'];
              ?>
               <li class='list-group-item '> <input type='checkbox' name='checklist[]' value ='<?php echo $license_id ?>'> 
               <?php echo $license_company ?>
               
                
                <div >
                <span><b>Renewal: </b>  <?php echo $license_renewal ?> <b>Expiry: </b> <?php echo $license_expiry?></span>
                </div>
                
               
                
                </input></li>
                <!-- <span  id="license_number" > < ?php echo $license_number ?> <span> -->
                <?php


                     
            }


    ?>
</ul>


                


               


