<div class="col-md-10" style=" margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 100%; max-height:75%;">

<h1>Exam List</h1><br><br>

<?php 
                  $i=0;

                  foreach($prmpt as $data_item){
                  if($data_item['status']=='succ'){
                  echo '<div class="alert alert-success" role="alert"> Exam Successfully Added! </div>';
                  }elseif($data_item['status']=='deacsucc'){
                  echo '<div class="alert alert-success" role="alert"> Exam Successfully Deactivated! </div>';
                  }
                  } 
                
                ?>

  <br><br>

<div class="form-group has-feedback">
  <input type="text" class="form-control" id="searchstud" onkeyup="search()" placeholder="Search Exam">
  <span class=" form-control-feedback glyphicon glyphicon-search" aria-hidden="true"></span>
</div>
    
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>Exam name</th>
        <th>Date created</th>
        <th>Current # of Takers</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
    foreach($exams as $data_item){
      ?>
      <tr>
        <td><?php echo $data_item->exam_name; ?></td>
        <td><?php echo $data_item->date_create; ?></td>
        <td><?php echo $data_item->no_of_takers; ?></td>
        <td><a href="<?php echo site_url('exam/view_exam/'.$data_item->exam_num) ?>"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>View Exam</button></td>
        <td><a href="<?php echo site_url('exam/editexam/'.$data_item->exam_num) ?>"><button type="submit"  <?php if ($data_item->no_of_takers != 0){ ?> disabled <?php }?> class="btn btn-default"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Edit Exam</button></td>
        <td><a href="<?php echo site_url('Db_process/deactivatesexam/'.$data_item->exam_num) ?>"><button type="submit" <?php if ($data_item->no_of_takers != 0){ ?> disabled <?php }?> class="btn btn-danger"><span class="glyphicon glyphicon-pencil"  aria-hidden="true"></span> Deactivate Exam </button></a></td>
      </tr>
      <?php   } ?>
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