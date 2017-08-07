  <div class="col-md-10" style="margin-left:20%; border-radius:2pt; padding:0pt; position:absolute; overflow: initial; max-width: 75%; max-height:75%;">
  <?php $account_id = $this->session->userdata('account_id'); ?>
<h1>Add Student</h1><br><br>
    <?php
        

        foreach($err as $data_item){
        if($data_item['status']=='mname'){
            echo '<div class="alert alert-danger" role="alert"> Invalid Input (Middle Name)</div>';
        }elseif($data_item['status']=='lname'){
            echo '<div class="alert alert-danger" role="alert"> Invalid Input (Last Name)</div>';
        }elseif($data_item['status']=='fname'){
            echo '<div class="alert alert-danger" role="alert"> Invalid Input (First Name)</div>';
        }elseif($data_item['status']=='idnum'){
            echo '<div class="alert alert-danger" role="alert"> ID Number already taken</div>';
        }elseif($data_item['status']=='name'){
            echo '<div class="alert alert-danger" role="alert"> Full Name already taken</div>';
        }elseif($data_item['status']=='email'){
            echo '<div class="alert alert-danger" role="alert"> Email Address already taken</div>';
        }elseif($data_item['status']=='name'){
            echo '<div class="alert alert-danger" role="alert"> Full Name already taken</div>';
        }

        } 
    ?>
    
<div class="container">
    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('Db_process/add_client', $attrib ); 
    ?>
    <div class="form-group col-sm-8">
      <label for="idnum">ID Number:</label>
      <input type="number" class="form-control" name="id_num" id="id_num" max="17000000" maxlength="8" placeholder="USC ID number" value="<?php echo set_value('id_num'); ?>" required> 
   </div>
    <br>
    <div class="form-group col-sm-8">
      <label for="lname">Last Name:</label>
      <input type="text" class="form-control" name="lname" id="lname" maxlength="30" placeholder="Last name" value="<?php echo set_value('lname'); ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8">
      <label for="fname">First Name:</label>
      <input type="text" class="form-control" name="fname" id="fname" maxlength="30" placeholder="First name" value="<?php echo set_value('fname'); ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8">
      <label for="mname">Middle Name:</label>
      <input type="text" class="form-control" name="mname" id="mname" maxlength="30" placeholder="Middle name" value="<?php echo set_value('mname'); ?>" required> 
    </div>
    <br>
    

    <div class="form-group col-sm-8">

    <label for="course">Select Course:</label>
    <select class="form-control" name="course" id="course" value="<?php echo set_value('course'); ?>">
    <?php foreach($courses as $data_item){  ?>
    <option value="<?php echo $data_item->coursecode; ?>"><?php echo $data_item->cdescrip; ?></option>
    <?php } ?>
    </select>
    </div>
    <br>
    <div class="form-group col-sm-8" >
      <label for="yr">Year Level:</label>
       <select class="form-control" name="yrlvl" id="yrlvl" value="<?php echo set_value('yrlvl'); ?>">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      </select>
    </div>
    <br>
    <div class="form-group col-sm-8" >
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8">
    <label><input type="radio" id="sex" name="sex" value="Male" required>Male</label><br>
    <label><input type="radio" id="sex" name="sex" value="Female" required>Female</label>
    </div>
    <input type="hidden" id="user" name="user" value="<?php echo set_value('account_id', $account_id) ?>">
    <br>
    <div class="form-group col-sm-8">
    <button type="submit" onsubmit="return confirm_add('Add Client?')" class="btn btn-default">Submit</button>
    </div>
  </form>
</div>
</div>

</div>
</div>
</div>
</div>
<script>
function confirm_add(question) {

  if(confirm(question)==0){

      return false;  
 }

}
</script>
