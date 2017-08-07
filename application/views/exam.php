<div class="col-md-10" style="margin-left:20%; border-radius:2pt; padding:3pt; position:absolute;  max-width:75%; max-height:75%;">
<?php
    $clientnum = $this->session->userdata('account_id');

  foreach ($exams as $data_item) {
    $exam_num = $data_item->exam_num;
    $examname = $data_item->exam_name;
    $instructions = $data_item->descrip;
    $timelimit = $data_item->timelimit;
  }
  foreach ($subexam as $data_item) {
    $subexam_num = $data_item->subexam_num;
  }
?>
<center><h1><?php echo $examname; ?></h1></center>

  <div class="col-md-12" style="background-color: #f2f2f2; border-radius:5pt; margin-top: 3%; position:absolute;">
  <div>
    <h3>Instructions</h3>
    <p>
      <?php echo $instructions;  ?>
    </p>
  </div>

  <br><br>
  <h3>Time remaining: <span id="timer"></span></h3>
    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('exam/scoring', $attrib); 
    ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th><center>Questions</center></th>
            <th colspan="4"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          shuffle($item);
          foreach($item as $data_item){
            ?>
          <tr>
            <?php 
              $i++;
              $itemid = $data_item->item_id;  
              ?>
            <th scope="row"><?php echo $i;  ?></th>
            <td><?php echo $data_item->question;  ?></td>
            <div class="form-group col-sm-10">
            <input type="hidden" class="form-control"  name="item_id" id="item_id" value="<?php echo set_value('item_id', $itemid); ?>">
            </div>
            <?php
            foreach($choice as $data_item){
              ?>
            <td>
              <center><input type="radio" name="<?php echo $itemid; ?>" value="<?php echo $data_item->choices_id;?>" required></center>
              <center><?php echo $data_item->choice; } ?></center>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

        <div class="form-group col-sm-10">
        <input type="hidden" class="form-control"  name="exam_num" id="exam_num" value="<?php echo set_value('exam_num', $exam_num); ?>">
        </div>
        
        <div class="form-group col-sm-10">
        <input type="hidden" class="form-control"  name="client_num" id="client_num" value="<?php echo set_value('client_num', $clientnum); ?>">
        </div>
      <br><br>
      <button type="submit" class="btn btn-success" onclick="return confirm('Submit exam?')" id="clickButton" style="margin-left: 90%;"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Submit >></button>
      <br><br>
      <?php form_close(); ?>
  </div>
</div>

</div>
</div>
<script>
        var min = <?php echo $timelimit; ?>;
        var count = min * 60;
        var counter = setInterval(timer, 1000); //1000 will  run it every 1 second

        function timer() {
            count = count - 1;
            if (count == -1) {
                clearInterval(counter);
                return;
            }

            var seconds = count % 60;
            var minutes = Math.floor(count / 60);
            var hours = Math.floor(minutes / 60);
            minutes %= 60;
            hours %= 60; 

            if(hours === 0 && minutes === 0 && seconds === 0){
              var button = document.getElementById('clickButton');
                                button.form.submit();
            }

            document.getElementById("timer").innerHTML = hours + ":"+ minutes + ":" + seconds; 
        }
      </script>