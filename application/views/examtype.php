<div class="col-md-10" style="margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:75%;">

<div class="page-header">
	<h1>Add Exam Type</h1>
</div>
<form>
  <div class="col-md-3">
  	<?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('container/examcontainer', $attrib); 
    ?>

    <div class="form-group col-sm-8">
  	<label>Exam Type Number</label>
    <input type="number" class="form-control" name="exam_num" id="exam_num" placeholder="Number" value="<?php echo set_value('exam_num'); ?>">
    </div>

    <div class="form-group col-sm-8">
    <label>Exam Type Name</label>
    <input type="text" class="form-control"  name="exam_name" id="exam_name" placeholder="Name" value="<?php echo set_value('exam_name'); ?>">
    </div>

    <div class="form-group col-sm-8">
    <button type="submit" class="btn btn-info">Next >></button>
    </div>

  </form>
  </div>
  <div class="col-md-3">

  </div>
</div>
</form>


</div>

</div>
</div>
</div>
</div>
