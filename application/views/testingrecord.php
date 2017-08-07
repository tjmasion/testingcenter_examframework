<div class="col-md-10" style="margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:75%;">

<h1>Student Information</h1><br><br>
      
<div class="container">
  <?php
              
              foreach($prmpt as $data_item){
              if($data_item['status']=='warn'){
              echo '<div class="alert alert-danger" role="alert"> Exam Limit Reached! </div>';
              }elseif($data_item['status']=='successexam'){
              echo '<div class="alert alert-success" role="alert"> Exam Successfully Added! </div>';
              }elseif($data_item['status']=='successexamremove'){
              echo '<div class="alert alert-success" role="alert"> Exam Successfully Removed! </div>';
              }elseif($data_item['status']=='cant'){
              echo '<div class="alert alert-danger" role="alert"> Cannot Add Exam! </div>';
              }         
              } 
              

                  $i=0; $y=0;
                  foreach($ctr as $error){
                    $i = $error->frequency;

                    if($i>=3){
                      $y=1;
                    }
                    }
    foreach($clients as $data_item){
      ?>
        Name: <?php echo $data_item->fname; ?><?php echo " ";?><?php echo $data_item->mname; ?><?php echo " ";?><?php echo $data_item->lname; ?> <br><br>
        ID number: <?php echo $data_item->id_num; ?> <br><br>
        Course: <?php echo $data_item->course; ?> <br><br>
        Year level: <?php echo $data_item->yrlvl; ?> <br><br>
        Sex: <?php echo $data_item->sex; ?> <br><br>
        Email: <?php echo $data_item->email; ?> <br><br>
  
</div>
<h2>Added Exams</h2><br> 
<a href="<?php echo site_url('Page/testingaddexam/'.$data_item->client_num) ?>"><button type="submit" <?php if ($data_item->status == 'inactive' || $y == 1){ ?> disabled <?php   } ?> class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Exam </button></a>  
<?php 
  $this->load->library('session');
  $this->session->set_userdata(array(
  'clnt' => $data_item->client_num
                          )); 
}?>
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
    <tbody>
     <?php
      foreach($array as $data_item1){ 
    ?>
      <tr>
        <td><?php echo $data_item1['exam_name'];  ?></td>
        <td><?php echo $data_item1['date'];  ?></td>
        <td><a href="<?php echo site_url('Db_process/removeexamtesting/'. $data_item1['examid']) ?>"><button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remove Exam </button></a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</div>
</div>
</div>