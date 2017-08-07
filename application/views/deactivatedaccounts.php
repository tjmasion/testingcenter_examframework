	<div class="col-md-10" style="margin-left:20%;  border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:100%;">
              <h1>Account List</h1><br><br>
               <?php
                  foreach($prmpt as $data_item){
                  if($data_item['status']=='reac'){
                  echo '<div class="alert alert-success" role="alert"> Account Successfully Reactivated! </div>';
                  }
                }

               ?>
                  <div class="form-group has-feedback">
                     <input type="text" class="form-control" id="searchacc" onkeyup="search()" placeholder="Search Account">
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
        <td><a href="<?php echo site_url('Db_process/reactivateaccount/'.$data_item->account_id) ?>"><button type="submit" onclick="return confirm_delete('Reactivate Account?')" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Reactivate Account </button></a></td>
      </tr>
    <?php   } ?>
    </tbody>
  </table>
</div>
</div>
<script>
function confirm_delete(question) {

  if(confirm(question)==0){

    return false;  
  }

}


function search() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("searchacc");
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

</script>