<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">
  <h1>Add Choice</h1><br>
  
    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('exam/addchoice', $attrib); 
      foreach($choice as $data_item){
           $choice_id = $data_item->choices_id;
           $choice = $data_item->choice; 
           $point_equivalent = $data_item->point_equivalent;
         }
    ?>

    <h2>"<?php echo $ques; ?>"</h2>

    <div class="form-group col-sm-10">
    <input type="hidden" class="form-control"  name="choices_id" id="choices_id" value="<?php echo set_value('choices_id', $choices_id); ?>">
    </div>

    <div class="form-group col-sm-12" id="examname">
    <label>Choice</label>
    <input type="text" class="form-control"  name="choice" id="choice" placeholder="Choice" value="<?php echo set_value('choice'); ?>" required>
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>Point Equivalent</label>
    <input type="number" class="form-control"  name="point_equivalent" id="point_equivalent" placeholder="Number" value="<?php echo set_value('point_equivalent'); ?>" required>
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