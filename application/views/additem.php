<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">
  <h1>Add Item</h1><br>
  
    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('exam/additem', $attrib); 
      foreach($subexams as $data_item){
           $subexmnum = $data_item->subexam_num; }
    ?>

    <div class="form-group col-sm-10">
    <input type="hidden" class="form-control"  name="subexam_num" id="subexam_num" value="<?php echo set_value('subexam_num', $subexmnum); ?>">
    </div>

    <div class="form-group col-sm-12" id="examname">
    <label>Question</label>
    <input type="text" class="form-control"  name="question" id="question" placeholder="Question" value="<?php echo set_value('question'); ?>" required>
    </div>

    <div class="form-group col-sm-5" id="examname">
    <label>Item Number</label>
    <input type="number" class="form-control"  name="item_no" id="item_no" placeholder="Number" value="<?php echo set_value('item_no'); ?>" required>
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