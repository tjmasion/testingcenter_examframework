<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">
  <h1>Add General Norm</h1><br>
  
    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('exam/addnormgen', $attrib); 
      foreach($exam as $data_item){
           $exmnum = $data_item->exam_num; }
    ?>

    <div class="form-group col-sm-10">
    <input type="hidden" class="form-control"  name="exam_num" id="exam_num" value="<?php echo set_value('exam_num', $exmnum); ?>">
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>General Norm Name</label>
    <input type="text" class="form-control"  name="name" id="name" placeholder="Name" value="<?php echo set_value('name'); ?>" required>
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>General Norm Min</label>
    <input type="number" class="form-control"  name="min" id="min" placeholder="Min" value="<?php echo set_value('min'); ?>" required>
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>General Norm Max</label>
    <input type="number" class="form-control"  name="max" id="max" placeholder="Max" value="<?php echo set_value('max'); ?>" required>
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