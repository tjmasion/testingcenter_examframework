<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">

    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('exam/editnormsub', $attrib);
      foreach($normsub as $data_item){ 
        $norm_id = $data_item->norm_id;
        $exam_num = $data_item->exam_num;
        $subexam_num = $data_item->subexam_num;
    ?>
    <div>
    <a href="<?php echo site_url('exam/modifysubexam/'.$subexam_num); ?>" class="modifybutton"><button class="btn btn-primary"><< Back</button></a>
    </div>

  <h1>Edit Sub Norm</h1><br>


    <div class="form-group">
    <input type="hidden" class="form-control"  name="norm_id" id="norm_id" value="<?php echo set_value('norm_id', $norm_id); ?>">
    </div>
    
    <div class="form-group">
    <input type="hidden" class="form-control"  name="exam_num" id="exam_num" value="<?php echo set_value('exam_num', $exam_num); ?>">
    </div>

    <div class="form-group">
    <input type="hidden" class="form-control"  name="subexam_num" id="subexam_num" value="<?php echo set_value('subexam_num', $subexam_num); ?>">
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>Sub Norm Name</label>
    <input type="text" class="form-control"  name="name" id="name" placeholder="Name" value="<?php echo $data_item->name; ?>" value="<?php echo set_value('name'); ?>" required>
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>Sub Norm Min</label>
    <input type="number" class="form-control"  name="min" id="min" placeholder="Min" value="<?php echo $data_item->min; ?>" value="<?php echo set_value('min'); ?>" required>
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>Sub Norm Max</label>
    <input type="number" class="form-control"  name="max" id="max" placeholder="Max" value="<?php echo $data_item->max; ?>" value="<?php echo set_value('max'); ?>" required>
    </div>

    <div class="form-group col-sm-8">
    <button type="submit" class="btn btn-info">Submit</button>
    </div>
    
     <?php   } ?>

</form>
</div>

</div>

</div>

</div>

</div>
</div>
</div>