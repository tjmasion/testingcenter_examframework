<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">
  <h1>Create Exam</h1><br>
  
    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('exam/addexam', $attrib); 
    ?>

    <div class="form-group col-sm-12">
    <label>Exam Name</label>
    <input type="text" class="form-control"  name="exam_name" id="exam_name" placeholder="Name" value="<?php echo set_value('exam_name'); ?>" required>
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