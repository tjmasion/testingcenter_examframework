   <div class="col-md-10" style=" margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:auto ; max-width:75%; max-height:100%;">



<h1>Student Information</h1><br><br>
<?php
              foreach($prmpt as $data_item){
              if($data_item['status']=='warn'){
              echo '<div class="alert alert-danger" role="alert"> Exam Limit Reached! </div>';
              }elseif($data_item['status']=='successexam'){
              echo '<div class="alert alert-success" role="alert"> Exam Successfully Added! </div>';
              }elseif($data_item['status']=='success'){
              echo '<div class="alert alert-success" role="alert"> Client Successfully Edited! </div>';
              }elseif($data_item['status']=='successexamremove'){
              echo '<div class="alert alert-success" role="alert"> Exam Successfully Removed! </div>';
              }elseif($data_item['status']=='cant'){
              echo '<div class="alert alert-danger" role="alert"> Cannot Add Exam! </div>';
              }         
              } 
                ?>
<div class="container">
 <?php
                  $i=0; $y=0;
                  foreach($ctr as $error){
                    $i = $error->frequency;

                    if($i>=3){
                      $y=1;
                    }
                    }
                  
    foreach($clients as $data_item){
      ?>
Name: <?php echo $data_item->fname; ?> <?php echo $data_item->mname; ?> <?php echo $data_item->lname; ?> <br><br>
ID number: <?php echo $data_item->id_num; ?> <br><br>
Course: <?php echo $data_item->course; ?> <br><br>
Year level: <?php echo $data_item->yrlvl; ?> <br><br>
Sex: <?php echo $data_item->sex; ?> <br><br>
Email: <?php echo $data_item->email; ?><br>
<br>
</div>
<a href="<?php echo site_url('Page/edit_info/'.$data_item->client_num) ?>"><button type="submit" <?php if ($data_item->status == 'inactive'){ ?> disabled <?php   } ?> class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Information </button></a><br><br>

<div>
<?php if ($data_item->status == 'active'){ ?> <a href="<?php echo site_url('Db_process/deactivatestud/'.$data_item->client_num) ?>"><button type="submit"  class="btn btn-danger" onclick="return confirm_deac('Deactivate Student?')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Set Student to Inactive </button></a></div>
<?php }else{ ?> <a href="<?php echo site_url('Db_process/activatestud/'.$data_item->client_num) ?>"><button type="submit" onclick="return confirm_activ('Reactivate Student?')" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Set Student to Active </button></a></div>
<?php }?>


<br><br><br>
<h2>Added Exam</h2>
<br>
<a href="<?php echo site_url('Page/add_exam/'.$data_item->client_num) ?>"><button type="submit" <?php if ($data_item->status == 'inactive' || $y == 1){ ?> disabled <?php   } ?> class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Exam </button></a>


<?php
$this->load->library('session');
$this->session->set_userdata(array(
                            'clnt' => $data_item->client_num
                          ));   
                          } ?>
<br><br>

  <table class="table">
    <thead>
      <tr>
        <th>Exam Name</th>
        <th>Referral Date</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach($array as $data_item1){ 
    ?>
      <tr>
        <td><?php echo $data_item1['exam_name'];  ?></td>
        <td><?php echo $data_item1['date'];  ?></td>
        <td><a href="<?php echo site_url('Db_process/removeexam/'. $data_item1['examid']) ?>"><button type="submit" onclick="return confirm_delete('Are you sure?')" class="btn btn-danger"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remove Exam </button></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  
  <br>
  <h2>Taken Exam</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Referral Number</th>
        <th>Exam Name</th>
        <th>Referral Date</th>
        <th>Date Taken</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach($array2 as $data_item1){ 
    ?>
      <tr>
        <td><?php echo $data_item1['ref_num'];  ?></td>
        <td><?php echo $data_item1['exam_name'];  ?></td>
        <td><?php echo $data_item1['date'];  ?></td>
        <td><?php echo $data_item1['res_date'];  ?></td>
        <td><a href="<?php echo site_url('Page/guidanceexamresults/'.$data_item1['ref_num']) ?>"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> View Results</button></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</div>
</div>
</div>
</div>

<script>
function confirm_deac(question) {

  if(confirm(question)==0){

    return false;  
  }

}

function confirm_activ(question) {

  if(confirm(question)==0){

    return false;  
  }

}

function confirm_delete(question) {

  if(confirm(question)==0){

    return false;  
  }

}


</script>