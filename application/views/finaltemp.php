<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">
  <h1>What do you want to do next?</h1><br>
  <?php 
    foreach($item as $data_item){
           $itemid = $data_item->item_id;
           $ques = $data_item->question;
           }
    foreach($subexam as $data_item){
           $subexamnum = $data_item->subexam_num;
           $subexamname = $data_item->subexam_name;
           }
    foreach($normsub as $data_item){
           $normsubid = $data_item->norm_id;
           $normsubname = $data_item->name;
           }
    foreach($exam as $data_item){
           $examnum = $data_item->exam_num;
           $examname = $data_item->exam_name;
           }

  ?>

  <div>
  <a href="<?php echo site_url('container/choicespage/'.$itemid); ?>"><button class="btn btn-info">Add Another Choice</button></a>
  <em>Add another choice for question: "<?php echo $ques; ?>" </em>
  </div>
  
  <br>

  <div>
  <a href="<?php echo site_url('container/itemspage/'.$subexamnum); ?>"><button class="btn btn-info">Add Another Item</button></a>
  <em>Add another item for sub exam: "<?php echo $subexamname; ?>" </em>
  </div>

  <br>

  <div>
  <a href="<?php echo site_url('container/subnormpage/'.$subexamnum); ?>"><button class="btn btn-info">Add Another Sub Norm</button></a>
  <em>Add another sub norm for sub exam: "<?php echo $subexamname; ?>"</em>
  </div>

  <br>

  <div>
  <a href="<?php echo site_url('container/subexamspage/'.$examnum); ?>"><button class="btn btn-info">Add Another Sub Exam</button></a>
  <em>Add another sub exam for exam: "<?php echo $examname; ?>" </em>
  </div>


  <br><br><br>


  <div>
  <a href="<?php echo site_url('container/normgenpage/'.$data_item->exam_num); ?>"><button class="btn btn-primary">Proceed to General Norm >></button></a>
  </div>

</div>

</div>

</div>

</div>

</div>
</div>
</div>