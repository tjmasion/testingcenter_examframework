<div class="col-md-10" style="margin-left:20%; border-radius:2pt; padding:3pt; position:absolute;  max-width:75%; max-height:75%;">
<?php
    foreach ($exams as $data_item) {
      $exam_num = $data_item->exam_num;
      $description = $data_item->descrip;
    }
?>

  <div class="col-md-12" style="background-color: #e6e6e6; border-radius:5pt; margin-top: 3%;">
      <h1>Instructions</h1>
      <br>
      <h3>
          <?php echo $description; ?>
      </h3>
      <br><br><br><br><br><br>
      <a href="<?php echo site_url('exam/examspage/'.$exam_num) ?>" ><button type="submit" class="btn btn-success btn-lg" style="margin-left: 80%;"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Proceed to Exam >> </button>
      <br><br>
  </div>
</div>

</div>
</div>