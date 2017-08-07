<div class="col-md-10" style="margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width:75%; max-height:75%;">

  <h2>Exams Taken</h2>          
  <table class="table">
    <thead>
      <tr>
        <th>Exam ID</th>
        <th>Exam Name</th>
        <th>Date Taken</th>
        <th>Result</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i=0;
      foreach($array as $data_item){
        ?>
      <tbody>
      <tr>
        <td><?php echo $data_item['exam_num']; ?></td>
        <td><?php echo $data_item['exam_name']; ?></td>
        <td><?php echo $data_item['date']; ?></td>
        <td><?php echo $data_item['result']; ?></td>
        <td><a href="<?php echo site_url('Page/examresultsstud/'.$data_item['refnum']); ?>"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> View Results </button></a></td>
      </tr>
      <?php $i++;  } ?>
    </tbody>
  </table>
</div>

</div>
</div>