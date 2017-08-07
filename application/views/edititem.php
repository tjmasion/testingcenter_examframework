<div class="row" style="margin-left:20%;  position:absolute; overflow:auto;max-width: 80%; max-height:100%;">
  <h1>Edit Item</h1><br>

    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('exam/edititem', $attrib);
      $i=0;
      foreach($item as $data_item){ 
        $item_id = $data_item->item_id;
        $ques = $data_item->question;
        $item_no = $data_item->item_no;
    ?>

    <div class="form-group">
    <input type="hidden" class="form-control"  name="item_id" id="item_id" value="<?php echo set_value('item_id', $item_id); ?>">
    </div>

    <div class="form-group col-sm-12">
    <label>Question</label>
    <input type="text" class="form-control" name="question" id="question" placeholder="Question" value="<?php echo $ques; ?>" value="<?php echo set_value('question'); ?>" required>
    </div>

    <div class="form-group col-sm-5">
    <label>Item Number</label>
    <input type="number" class="form-control"  name="item_no" id="item_no" placeholder="Item Number" value="<?php echo $item_no; ?>" value="<?php echo set_value('item_no'); ?>" required>
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