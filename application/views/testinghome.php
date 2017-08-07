<div class="col-md-10" style=" margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:75%;">

<h1>Student List</h1><br><br>

<div class="form-group has-feedback">
  <input type="text" class="form-control" id="searchstud" onkeyup="search()" placeholder="Search Student">
  <span class=" form-control-feedback glyphicon glyphicon-search" aria-hidden="true"></span>
</div>
     
  <table class="table tablesorter" id="myTable">
    <thead>
      <tr>
        <th>Lastname</th>
        <th>Firstname</th>
        <th>ID number</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
    foreach($clients as $data_item){
      ?>
      <tr>
        <td><?php echo $data_item->lname; ?></td>
        <td><?php echo $data_item->fname; ?></td>
        <td><?php echo $data_item->id_num; ?></td>
        <td><a href="<?php echo site_url('Page/testingrecord/'.$data_item->client_num) ?>"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> View Records</button></a></td>
      </tr>
      <?php   } ?>
    </tbody>
  </table>
  </div>
</div>
</div>
<script>
function search() {
  // Declare variables 
  var input, filter, table, tr, td1, td2, td3, i;
  input = document.getElementById("searchstud");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[0];
    td2 = tr[i].getElementsByTagName("td")[1];
    td3 = tr[i].getElementsByTagName("td")[2];
    if (td1 || td2 || td3) {
      if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>
