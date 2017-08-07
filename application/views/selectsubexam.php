<div class="col-md-10" style="margin-left:20%;  border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:100%;">

    <?php

          foreach($exams as $data_item){
              $exam_num = $data_item->exam_num;
              $examname = $data_item->exam_name;
          }
    ?>
    <?php 
            if( isset($_SESSION['finishcreate_error'])){
              echo '<br><div class="alert alert-danger" role="alert">'.$_SESSION['finishcreate_error'].'</div><br>';
            }
            ?>
  <h1><?php echo $examname; ?></h1>
  <br>

  <div>
  <a href="#editExamName" class="btn btn-info" data-toggle="modal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Edit exam name</a>
  </div>

  <br>

  <div style="background-color: #e6e6e6; padding: 10px; border-radius: 10px;">
    <h3>Sub Exams</h3>
    <br>
    <div>
    <a href="#addSubExam" class="btn btn-primary" data-toggle="modal">Add Sub Exam >></a>
    </div>
    <br>
    <?php 
            if( isset($_SESSION['subexam_error'])){
              echo '<br><div class="alert alert-danger" role="alert">'.$_SESSION['subexam_error'].'</div><br>';
            }
            ?>
    <table class="table table-inverse">
      <thead>
        <tr>
          <th>Sub Exam Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach($subexams as $data_item){
      ?>
        <tr>
          <td><?php echo $data_item->subexam_name; ?></td>
          <td>
            <a href="<?php echo site_url('exam/modifysubexam/'.$data_item->subexam_num) ?>" class="modifybutton"><button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modify </button></a>
            <a href="<?php echo site_url('exam/deletesubexam/'.$data_item->subexam_num) ?>" class="modifybutton"><button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete </button></a>
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
    <h3>Choices</h3>
    <a href="#addChoice" class="btn btn-primary" data-toggle="modal">Add Choice >></a>
    </div>
    <br>
    <?php 
            if( isset($_SESSION['choices_error'])){
              echo '<br><div class="alert alert-danger" role="alert">'.$_SESSION['choices_error'].'</div><br>';
            }
            ?>
    <table class="table table-inverse">
      <thead>
         <tr>
          <th>Choices</th>
          <th>Point Equivalent</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($choice as $data_item){
         ?>
        <tr>
          <td><?php echo $data_item->choice;  ?></td>
          <td><?php echo $data_item->point_equivalent; ?></td>
          <td>
            <a href="<?php echo site_url('exam/editchoicepage/'.$data_item->choices_id); ?>" class="modifybutton"><button class="btn btn-primary">Edit Choice</button></a>
            <a href="<?php echo site_url('exam/deletechoice/'.$data_item->choices_id) ?>" class="modifybutton"><button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete Choice </button></a>
          </td>
        </tr>
        <?php  } ?>
      </tbody>
    </table>

  </div>

  <br>
  <div style="background-color: #e6e6e6; padding: 10px; border-radius: 10px;">
    <h3>General Norms</h3>
    <div>
    <a href="#addGenNorm" class="btn btn-primary" data-toggle="modal">Add General Norm >></a>
    <br>
    </div>
    <?php 
            if( isset($_SESSION['normgen_error'])){
              echo '<br><div class="alert alert-danger" role="alert">'.$_SESSION['normgen_error'].'</div><br>';
            }
            ?>
    <table class="table table-inverse">
      <thead>
         <tr>
          <th>General Norm Name</th>
          <th>Minimum Value</th>
          <th>Maximum Value</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($normgen as $data_item){
        ?>
        <tr>
          <td><?php echo $data_item->name; ?></td>
          <td><?php echo $data_item->min; ?></td>
          <td><?php echo $data_item->max; ?></td>
          <td>
            <a href="<?php echo site_url('exam/editnormgenpage/'.$data_item->norm_id) ?>" class="modifybutton"><button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit </button></a>
            <a href="<?php echo site_url('exam/deletenormgen/'.$data_item->norm_id) ?>" class="modifybutton"><button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete </button></a>
          </td>
        </tr>
        <?php   } ?>
      </tbody>
    </table>
  </div>
  <br>

  <br>

  <br><br>

  <br>

  <br><br>




  <br><br>
  <div>
  <a href="<?php echo site_url('exam/finishcreate/'.$exam_num); ?>" class="modifybutton"><button class="btn btn-primary">Finish >></button></a>
  </div>

  <div class="modal fade" id="addSubExam" tabindex="-1" role="dialog" aria-labelledby="addsubexammodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Add Sub Exam</h1>
        </div>
        <div class="modal-body">
          <?php 
                $attrib = array('class' => 'form-signin');
                echo form_open('exam/addsubexam', $attrib); 
                foreach($exams as $data_item){
                     $exmnum = $data_item->exam_num; }
              ?>

              <div class="form-group">
              <input type="hidden" class="form-control"  name="exam_num" id="exam_num" value="<?php echo set_value('exam_num', $exam_num); ?>">
              </div>

              <div class="form-group">
              <label>Sub Exam Name</label>
              <input type="text" class="form-control"  name="subexam_name" id="subexam_name" placeholder="Name" required>
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

  <div class="modal fade" id="addGenNorm" tabindex="-1" role="dialog" aria-labelledby="addgennormmodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Add General Norm</h1>
        </div>
        <div class="modal-body">
          <?php 
                $attrib = array('class' => 'form-signin');
                echo form_open('exam/addnormgen', $attrib); 
                foreach($exams as $data_item){
                     $exam_num = $data_item->exam_num; }
              ?>

              <div class="form-group">
              <input type="hidden" class="form-control"  name="exam_num" id="exam_num" value="<?php echo set_value('exam_num', $exam_num); ?>">
              </div>

              <div class="form-group" id="examname">
              <label>General Norm Name</label>
              <input type="text" class="form-control"  name="name" id="name" placeholder="Name" required>
              </div>

              <div class="form-group" id="examname">
              <label>General Norm Min</label>
              <input type="number" class="form-control"  name="min" id="min" placeholder="Min" required>
              </div>

              <div class="form-group" id="examname">
              <label>General Norm Max</label>
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

  <div class="modal fade" id="editExamName" tabindex="-1" role="dialog" aria-labelledby="addsubexammodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Edit Exam Name</h1>
        </div>
        <div class="modal-body">
          <?php 
                $attrib = array('class' => 'form-signin');
                echo form_open('exam/editexamname/'.$exam_num, $attrib); 
              ?>

              <div class="form-group">
              <label>Exam Name</label>
              <input type="text" class="form-control"  name="exam_name" id="exam_name" placeholder="Name" value="<?php echo $examname ?>" value="<?php echo set_value('exam_name'); ?>" required>
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

  <div class="modal fade" id="addChoice" tabindex="-1" role="dialog" aria-labelledby="addchoicemodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Add Choice</h1>
        </div>
        <div class="modal-body">
          
          <?php
            $attrib = array('class' => 'form-signin');
            echo form_open('exam/addchoice', $attrib);
          ?>

          <div class="form-group">
          <input type="hidden" class="form-control"  name="exam_num" id="exam_num" value="<?php echo set_value('exam_num', $exam_num); ?>">
          </div>

          <div class="form-group" id="examname">
          <label>Choice</label>
          <input type="text" class="form-control"  name="choice" id="choice" placeholder="Choice" required>
          </div>

          <div class="form-group" id="examname">
          <label>Point Equivalent</label>
          <input type="number" class="form-control"  name="point_equivalent" id="point_equivalent" placeholder="Number" required>
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

</div>
</div>
</div>

