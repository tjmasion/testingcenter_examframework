<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">

    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('exam/editnormgen', $attrib);
      foreach($normgen as $data_item){ 
        $norm_id = $data_item->norm_id;
        $exam_num = $data_item->exam_num;
    ?>
    
    <div>
    <a href="<?php echo site_url('exam/modifyexam/'.$exam_num); ?>" class="modifybutton"><button class="btn btn-primary"><< Back</button></a>
    </div>

  <h1>Edit General Norm</h1><br>

    <?php 
            if( isset($_SESSION['normgen_edit_error'])){
              echo '<br><div class="alert alert-danger" role="alert">'.$_SESSION['normgen_edit_error'].'</div><br>';
            }
    ?>

    

    <div class="form-group">
    <input type="hidden" class="form-control"  name="norm_id" id="norm_id" value="<?php echo set_value('norm_id', $norm_id); ?>">
    </div>
    
    <div class="form-group">
    <input type="hidden" class="form-control"  name="exam_num" id="exam_num" value="<?php echo set_value('exam_num', $exam_num); ?>">
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>General Norm Name</label>
    <input type="text" class="form-control"  name="name" id="name" placeholder="Name" value="<?php echo $data_item->name; ?>" value="<?php echo set_value('name'); ?>" required>
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>General Norm Min</label>
    <input type="number" class="form-control"  name="min" id="min" placeholder="Min" value="<?php echo $data_item->min; ?>" value="<?php echo set_value('min'); ?>" required>
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>General Norm Max</label>
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