<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">
  <h1>Add Sub Exam</h1><br>
  
    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('container/addexamtype', $attrib); 
      foreach($examnum as $data_item){
           $exmnum = $data_item->exam_num; }
    ?>

    <div class="form-group col-sm-10">
    <input type="hidden" class="form-control"  name="exam_num" id="exam_num" value="<?php echo set_value('exam_num', $exmnum); ?>">
    </div>

    <div class="form-group col-sm-10">
    <label>Sub Exam Name</label>
    <input type="text" class="form-control"  name="subexam_name" id="subexam_name" placeholder="Name" value="<?php echo set_value('subexam_name'); ?>" required>
    </div>

    <div class="form-group col-sm-8">
    <button type="submit" class="btn btn-info">Submit</button>
  </div>
    
</form>
</div>

</div>

</div>

</div>

</div>
</div>
</div>