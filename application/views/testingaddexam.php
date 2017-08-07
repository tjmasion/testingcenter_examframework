<div class="col-md-10" style=" margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:75%;">
<h1>Exam List</h1><br><br>
<?php $account_id = $this->session->userdata('account_id'); ?>
<div class="form-group has-feedback">
  <input type="text" class="form-control" id="searchstud" onkeyup="search()" placeholder="Search Exam">
  <span class=" form-control-feedback glyphicon glyphicon-search" aria-hidden="true"></span>
</div>
 
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>Exam name</th>
        <th>Date created</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
    $clientnum;
    $examnum;
    foreach($clients as $data_item){
      $clientnum = $data_item->client_num;
    }  
        $this->load->library('session');
        $this->session->set_userdata(array(
                            'clienttest' => $clientnum
                          ));
    ?>
    
    <?php
    foreach($exams as $data_item1){
      $examnum = $data_item1 ->exam_num;
    ?>
      <tr>
        <td><?php echo $data_item1->exam_name; ?></td>
        <td><?php echo $data_item1->date_create; ?></td> 
       <td><a href="<?php echo site_url('Db_process/addstud_examtest/'.$data_item1->exam_num); ?>"><button type="submit" onclick="return confirm_add('Add Exam?')" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Exam </button></a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</div>
</div>
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
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>