<div class="col-md-10" style="margin-left:20%;  border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:90%;">
              <h1>Referral List</h1><br><br>

                  <div class="form-group has-feedback">
                     <input type="text" class="form-control" id="searchstud" onkeyup="search()" placeholder="Search Referral">
                     <span class=" form-control-feedback glyphicon glyphicon-search" aria-hidden="true"></span>
                     <table class="table">
                      <thead>
                        <tr>
                          <th>Legend:</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="success"><td> Finished and evaluated</td></tr>
                        <tr class="warning"><td> Finished but no evaluation</td></tr>
                        <tr class="danger"><td> Unfinished and no evaluation</td></tr>
                      </tbody>
                     </table>
                 </div>
 
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>Referral ID</th>
        <th>ID number</th>
        <th>Client Name</th>
        <th>Exam Name</th>
        <th>Referral Date</th>
      </tr>
    </thead>
    <?php
   $i=0;
   foreach($array as $data_item){
    ?>
    <tbody>
      <tr class="<?php
            if($data_item['status'] == 'unfinish'){
              echo "danger";
            }elseif($data_item['status'] == 'finish'){
              if(empty($data_item['checkeval'])){
              echo "warning";
              }else{
              echo "success";
              }
            }
          ?>
          ">
        <td>
        <?php echo $data_item['ref_num'];  ?>
        </td>
        <td>
        <?php echo $data_item['idnum'];  ?>
        </td>
        <td>
        <?php echo $data_item['fname'];echo " "; echo $data_item['mname'];echo " "; echo $data_item['lname']; ?> 
        </td>
        <td>
        <?php echo $data_item['exam_name'];  ?>
        </td>
        <td>
        <?php echo $data_item['date'];  ?>
        </td>
      </tr>
      <?php $i++;  } ?>
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
    if (td1 || td2 || td3 || td4) {
      if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>