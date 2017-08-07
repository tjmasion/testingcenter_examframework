<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">
  <h1>Edit Item</h1><br>

    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('exam/editchoice', $attrib);
      foreach($choice as $data_item){ 
        $choices_id = $data_item->choices_id;
        $choice = $data_item->choice;
        $point_equivalent = $data_item->point_equivalent;
    ?>

    <div class="form-group">
    <input type="hidden" class="form-control"  name="choices_id" id="choices_id" value="<?php echo set_value('choices_id', $choices_id); ?>">
    </div>

    <div class="form-group col-sm-12">
    <label>Choice</label>
    <input type="text" class="form-control" name="choice" id="Choice" placeholder="Choice" value="<?php echo $choice; ?>" value="<?php echo set_value('choice'); ?>" required>
    </div>

    <div class="form-group col-sm-5">
    <label>Point Equivalent</label>
    <input type="number" class="form-control"  name="point_equivalent" id="point_equivalent" placeholder="Point Equivalent" value="<?php echo $point_equivalent; ?>" value="<?php echo set_value('point_equivalent'); ?>" required>
    </div>

    <br><br>

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