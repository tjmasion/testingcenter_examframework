<div class="col-md-10" style="margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width:80%; max-height:100%;">
   <?php
        $i=0;
        foreach($array as $data_item) {
          $clientid = $data_item['c_id'];
          $lname = $data_item['c_lname'];
          $mname = $data_item['c_mname'];
          $fname = $data_item['c_fname'];
          $course = $data_item['c_course'];
          $yrlvl = $data_item['c_yrlvl'];
          $exam_num = $data_item['exam_num'];
          $exam_name = $data_item['exam_name'];
          $exam_date = $data_item['gen_date'];
          $gen_tot = $data_item['gen_tot'];
          $gen_name = $data_item['gen_name'];
          $ref_num = $data_item['ref_num'];
          $num = $data_item['client_num'];

        }
      ?>
  <div class="col-md-12" id='res' style="border-radius:5pt;  margin-top: 3%;">
    <br>
    <div>
    <center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center>
    <center><h3>University of San Carlos </h3></center>
    <center><p>Guidance and Testing Center Referral System</p></center>
    </div>
    <center><h2><?php echo $exam_name; ?> Exam Results</h2></center>

    <div class="row">
     
      <div class="col-md-6" style=" margin-top: 3%;">
      <br>
      <p>ID Number: <?php echo $clientid; ?></p>
      <p>Name:  <?php echo $lname.", ".$fname." ".$mname; ?></p>
      <p>Course and Year Level:  <?php echo $course." - ".$yrlvl; ?></p>
      <br>
      </div>
      <div class="col-md-6" style="margin-top: 3%;">
      <br>
      <p>Exam No.: <?php echo $exam_num; ?></p>
      <p>Exam Name: <?php echo $exam_name; ?></p>

      <br>

      <p>Date taken: <?php echo $exam_date; ?></p>
      </div>
      <div style="background-color: black; height: 1px; width: 100%;">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6" style="margin-top: 3%;">
        <center><h3>Subexam Results</h3></center>
         <center><h3></h3></center>
         <br>
          <table class="table table-striped">
            <tbody>
            <?php 
              $i = 0;
              foreach($res_sub as $data_item) {
            ?>
              <tr>
                <td><?php echo $data_item['subexam_name']; ?></td>
                <td><?php echo $data_item['total']; ?></td>
                <td><?php echo $data_item['result']; ?></td>
              </tr>
              <?php $i++; } ?>
            </tbody>
          </table>
          <br><br><br><br>
      </div>

      <div class="col-md-6" style="margin-top: 3%;">
          <center><h3>Overall Result</h3></center>
          <br><br>
          <table class="table">
            <thead>
              <tr>
                <th>Subexams Raw Score</th>
                <td><?php echo $gen_tot; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Exam Overall Result</th>
                <td><?php echo $gen_name; ?></td>
              </tr>
            </tbody>
          </table>
          <br><br><br><br>
      </div>
      <div style="background-color: black; height: 1px; width: 100%;">
      </div>
      <br><br><br><br>
      <br><br><br><br>
      <br><br><br><br>
      <br><br><br><br>
      <br><br><br><br>
  </div>
  </div>
  <br><br><br>
<?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('Db_process/add_evaluation', $attrib ); 
?>


<br>
<div>
 <button class="btn btn-info" onclick="printResult('res')">Print Result</button>
</div>
</div>


</div>
</div>
