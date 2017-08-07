<div class="col-md-10" style=" margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:initial ; max-width:75%; max-height:75%;">
<?php $account_id = $this->session->userdata('account_id'); ?>
<h1>Edit Information</h1><br><br>
<div class="container">
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


     foreach($clients as $data_item){ ?>
    <?php
      $attrib = array('class' => 'form-signin');
      echo form_open('Db_process/update/'.$data_item->client_num, $attrib); 
    ?>
    <div class="form-group col-sm-8">
      <label for="idnum">ID Number:</label>
      <input type="number" class="form-control" name="id_num" id="id_num" max="17000000" placeholder=""  value="<?php echo $data_item->id_num; ?>" value="<?php echo set_value('id_num'); ?>" required> 
   </div>
    <br>
    <div class="form-group col-sm-8">
      <label for="lname">Last Name:</label>
      <input type="text" class="form-control" name="lname" id="lname" maxlength="30" placeholder="" value="<?php echo $data_item->lname; ?>" value="<?php echo set_value('lname'); ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8">
      <label for="fname">First Name:</label>
      <input type="text" class="form-control" name="fname" id="fname" maxlength="30" placeholder="" value="<?php echo $data_item->fname; ?>"  value="<?php echo set_value('fname'); ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8">
      <label for="mname">Middle Name:</label>
      <input type="text" class="form-control" name="mname" id="mname" maxlength="30" placeholder="" value="<?php echo $data_item->mname; ?>" value="<?php echo set_value('mname'); ?>" required> 
    </div>
    <br>
    
    <div class="form-group col-sm-8">

    <label for="course">Select Course:</label>
    <select class="form-control" name="course" id="course" value="<?php echo $data_item->course; ?>" value="<?php echo set_value('course'); ?>">
    <?php foreach($courses as $data_item1){  ?>
    <option value="<?php echo $data_item1->coursecode; ?>"><?php echo $data_item1->cdescrip; ?></option>
    <?php } ?>
    </select>
    </div>
    <br>
    
    <br>
    <div class="form-group col-sm-8" >
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="" value="<?php echo $data_item->email; ?>" value="<?php echo set_value('email'); ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8">
    <label><input type="radio" id="sex" name="sex" checked value="<?php echo $data_item->sex; ?>">No Changes</label><br>
    <label><input type="radio" id="sex" name="sex" value="Male">Male</label><br>
    <label><input type="radio" id="sex" name="sex" value="Female">Female</label>
    </div>
    <input type="hidden" id="user" name="user" value="<?php echo set_value('account_id', $account_id) ?>">
    <br>
    <?php   } ?>
    <div class="form-group col-sm-8">
    <button type="submit" onsubmit="return confirm_delete('Alter Information?')" class="btn btn-default">Submit</button>
    </div>
  </form>
</div>
 

</div>
</div>
</div>
</div>

<script>
function confirm_delete(question) {

  if(confirm(question)==0){

    return false;  
  }

}
</script>