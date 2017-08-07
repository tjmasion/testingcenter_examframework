	<div class="col-md-10" style="margin-left:20%;  border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:100%;">
              <h1>Account List</h1><br><br>
               
               <?php 
                  $i=0;

                  foreach($prmpt as $data_item){
                  if($data_item['status']=='deac'){
                  echo '<div class="alert alert-warning" role="alert"> Account Successfully Deactivated! </div>';
                  }elseif($data_item['status']=='reac'){
                  echo '<div class="alert alert-success" role="alert"> Successfully Reactivated! </div>';
                  }elseif($data_item['status']=='success'){
                  echo '<div class="alert alert-success" role="alert"> Account Successfully Added! </div>';
                  }elseif($data_item['status']=='cant'){
                  echo '<div class="alert alert-success" role="alert"> Cannot Deactivate Account. Pending Exam! </div>';
                  }elseif($data_item['status']=='addsuc'){
                  echo '<div class="alert alert-success" role="alert"> Successfully Edited Account! </div>';
                  }elseif($data_item['status']=='caddsuc'){
                  echo '<div class="alert alert-success" role="alert"> Successfully Added Course! </div>';
                  }
                  } 
                
                ?>

                  <div class="form-group has-feedback">
                     <input type="text" class="form-control" id="searchstud" onkeyup="search()" placeholder="Search Account">
                     <span class=" form-control-feedback glyphicon glyphicon-search" aria-hidden="true"></span>
                 </div>
     
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>Account ID</th>
        <th>User Type</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach($accounts as $data_item){
      ?>
      <tr>
        <td><?php echo $data_item->account_id; ?></td>
        <td><?php echo $data_item->usertype; ?></td>
        <td><?php echo $data_item->username; ?></td>
        <td><?php echo $data_item->fname; ?></td>
        <td><?php echo $data_item->lname; ?></td>
        <td><a href="<?php echo site_url('Page/editaccount/'.$data_item->account_id) ?>"><button type="submit" <?php if($data_item->account_id == 1){ echo "disabled"; } ?> class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Account </button></a></td>
        <td><a href="<?php echo site_url('Db_process/deactivateaccount/'.$data_item->account_id) ?>"><button type="submit" <?php if($data_item->account_id == 1){ echo "disabled"; } ?> onclick="return confirm_delete('Deactivate Account?')" class="btn btn-danger"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Deactivate Account </button></a></td>
      </tr>
    <?php   } ?>
    </tbody>
  </table>
</div>
</div>
<script>
function search() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("searchstud");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[0];
    td2 = tr[i].getElementsByTagName("td")[1];
    td3 = tr[i].getElementsByTagName("td")[2];
    td4 = tr[i].getElementsByTagName("td")[3];
    td5 = tr[i].getElementsByTagName("td")[4];
    if (td1 || td2 || td3) {
      if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1 || td5.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}


function confirm_delete(question) {

  if(confirm(question)==0){

    return false;  
  }

}

</script>
