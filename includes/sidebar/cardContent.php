<div class="card-body bg-light ">
      <div class="row">
      <div class="col-8">
      <h4 class="card-title">Generate report</h4>

      <div class="dropdown">
            <button
              class="btn btn-light dropdown-toggle"
              type="button"
              id="my_dropdown"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
          Select option to filter
          </button>
            <ul class="dropdown-menu" aria-labelledby="my_dropdown">
              <?php if(isset($_GET['PIC_id'])) {

                $team_id = $_GET['PIC_id'];
                  echo " <li><a class='dropdown-item' href='PIC_Post.php?PIC_id=$team_id&source=license'>License</a></li>";
                  echo  "<li><a class='dropdown-item' href='PIC_post.php?PIC_id=$team_id&source=date'>Date</a></li>";
              }else{
                echo " <li><a class='dropdown-item' href='main.php?team_name=$team_name&source=license'>License</a></li>";
                echo  "<li><a class='dropdown-item' href='main.php?team_name=$team_name&source=date'>Date</a></li>";
              }
              
              ?>


             
             
              
            </ul>
          </div>
      </div>
      <div class="col-4 mt-2">
        <input name="save-multicheckbox" type="submit" class="btn btn-outline-info btn-bs-block" name="submit" value="Generate" />
      </div>
</div>

    </div>