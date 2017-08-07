<div class="col-md-10" style="margin-left:20%;  border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:100%;">
    <?php

          foreach($exams as $data_item){
              $examname = $data_item->exam_name;
          }

          foreach($subexams as $data_item){
              $examno = $data_item->exam_num;
              $subexamnum = $data_item->subexam_num;
              $subexamname = $data_item->subexam_name;
          }
          foreach($item as $data_item){
              $item_id = $data_item->item_id;
          }
    ?>

  <h1><?php echo $examname; ?> >> <?php echo  $subexamname; ?></h1>
  <br>
  <div>
  <a href="#editSubExamName" class="btn btn-info" data-toggle="modal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Edit Sub Exam name</a>
  </div>


 <div style="background-color: #e6e6e6; padding: 10px; border-radius: 10px;">
    <br>
    <div>
    <h3>Sub Norms</h3>
    <a href="#addSubNorm" class="btn btn-primary" data-toggle="modal">Add Sub Norm >></a>
    </div>
    <br>
    <?php 
            if( isset($_SESSION['normsub_error'])){
              echo '<br><div class="alert alert-danger" role="alert">'.$_SESSION['normsub_error'].'</div><br>';
            }
            ?>
    <table class="table table-inverse">
      <thead>
         <tr>
          <th>Sub Norm Name</th>
          <th>Minimum Value</th>
          <th>Maximum Value</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($normsub as $data_item){
        ?>
        <tr>
          <td><?php echo $data_item->name; ?></td>
          <td><?php echo $data_item->min; ?></td>
          <td><?php echo $data_item->max; ?></td>
          <td>
            <a href="<?php echo site_url('exam/editnormsubpage/'.$data_item->norm_id) ?>" class="modifybutton"><button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit </button></a>
            <a href="<?php echo site_url('exam/deletenormsub/'.$data_item->norm_id) ?>" class="modifybutton"><button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete </button></a>
          </td>
        </tr>
        <?php   } ?>
      </tbody>
    </table>

  </div>
  <br>

 <div style="background-color: #e6e6e6; padding: 10px; border-radius: 10px;">
    <br>
    <div>
    <h3>Items</h3>
    <a href="#addItem" class="btn btn-primary" data-toggle="modal">Add Item >></a>
    </div>
    <br>
    <?php 
            if( isset($_SESSION['item_error'])){
              echo '<br><div class="alert alert-danger" role="alert">'.$_SESSION['item_error'].'</div><br>';
            }
            ?>
    <table class="table table-inverse">
      <thead>
         <tr>
          <th>Item Number</th>
          <th>Items</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      	<?php
          foreach($item as $data_item){
         ?>
        <tr>
          <td><?php echo $data_item->item_no ?></td>
          <td><?php echo $data_item->question ?></td>
          <td>
            <a href="<?php echo site_url('exam/edititempage/'.$data_item->item_id); ?>" class="modifybutton"><button class="btn btn-primary">Edit Item</button></a>
            <a href="<?php echo site_url('exam/deleteitem/'.$data_item->item_id) ?>" class="modifybutton"><button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete Item </button></a>
          </td>
        </tr>
        <?php  } ?>
      </tbody>
    </table>

  </div>
  <br>

 
 


  <div>
  <a href="<?php echo site_url('exam/returnsubexamspage/'.$examno); ?>"><button class="btn btn-primary modifybutton"><< Return to Sub Exam Selection</button></a>
  </div>

</div>
  
</div>
	<div class="modal fade" id="addSubNorm" tabindex="-1" role="dialog" aria-labelledby="addsubexammodal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title" id="exampleModalLabel">Add Sub Norm for <?php echo $subexamname; ?></h1>
	      </div>
	      <div class="modal-body">
	        <?php
	              foreach($subexams as $data_item){
	                   $exmnum = $data_item->exam_num;
	                   $subexmnum = $data_item->subexam_num;
	                   $subexamname = $data_item->subexam_name; }
	          ?>
	          
	            <?php 
	              $attrib = array('class' => 'form-signin');
	              echo form_open('exam/addnormsub', $attrib); 
	            ?>

	            <div class="form-group">
	            <input type="hidden" class="form-control"  name="exam_num" id="exam_num" value="<?php echo set_value('exam_num', $exmnum); ?>">
	            </div>

	            <div class="form-group">
	            <input type="hidden" class="form-control"  name="subexam_num" id="subexam_num" value="<?php echo set_value('subexam_num', $subexmnum); ?>">
	            </div>

	            <div class="form-group" id="examname">
	            <label>Sub Norm Name</label>
	            <input type="text" class="form-control"  name="name" id="name" placeholder="Name" required>
	            </div>

	            <div class="form-group" id="examname">
	            <label>Sub Norm Min</label>
	            <input type="number" class="form-control"  name="min" id="min" placeholder="Min" required>
	            </div>

	            <div class="form-group" id="examname">
	            <label>Sub Norm Max</label>
	            <input type="number" class="form-control"  name="max" id="max" placeholder="Max" required>
	            </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-info">Submit</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addsubexammodal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title" id="exampleModalLabel">Add Item</h1>
	      </div>
	      <div class="modal-body">
	        <?php 
	              $attrib = array('class' => 'form-signin');
	              echo form_open('exam/additem', $attrib); 
	              foreach($subexams as $data_item){
	                   $subexmnum = $data_item->subexam_num; }
	            ?>

	            <div class="form-group">
	            <input type="hidden" class="form-control"  name="subexam_num" id="subexam_num" value="<?php echo set_value('subexam_num', $subexmnum); ?>">
	            </div>

	            <div class="form-group" id="examname">
	            <label>Question</label>
	            <input type="text" class="form-control"  name="question" id="question" placeholder="Question" required>
	            </div>

	            <div class="form-group" id="examname">
	            <label>Item Number</label>
	            <input type="number" class="form-control"  name="item_no" id="item_no" placeholder="Number" required>
	            </div>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-info">Submit</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>


  <div class="modal fade" id="editSubExamName" tabindex="-1" role="dialog" aria-labelledby="addsubexammodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Edit Sub Exam Name</h1>
        </div>
        <div class="modal-body">
          <?php 
                $attrib = array('class' => 'form-signin');
                echo form_open('exam/editsubexamname/'.$subexamnum, $attrib); 
              ?>

              <div class="form-group">
              <label>Sub Exam Name</label>
              <input type="text" class="form-control"  name="subexam_name" id="subexam_name" placeholder="Name" value="<?php echo $subexamname ?>" value="<?php echo set_value('subexam_name'); ?>" required>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

</div>

</div>
</div>
</div>