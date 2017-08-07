<div class="col-md-10" style=" margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:initial ; max-width:75%; max-height:75%;">
<?php $account_id = $this->session->userdata('account_id'); ?>
<h1>Edit Account</h1><br><br>
<div class="container">
    <?php

       foreach($err as $data_item){
        if($data_item['status']=='lname'){
            echo '<div class="alert alert-danger" role="alert"> Invalid Input (Last Name)</div>';
        }elseif($data_item['status']=='fname'){
            echo '<div class="alert alert-danger" role="alert"> Invalid Input (First Name)</div>';
        }elseif($data_item['status']=='name'){
            echo '<div class="alert alert-danger" role="alert"> Full Name already taken</div>';
        }elseif($data_item['status']=='uname'){
            echo '<div class="alert alert-danger" role="alert"> Username already taken</div>';
        }elseif($data_item['status']=='cpass'){
            echo '<div class="alert alert-danger" role="alert"> Password dont match</div>';
        }
        } 


        foreach($accounts as $data_item){ 
        ?>

    <div class="container">
    <?php 
    //onclick="return confirm_delete('Are you sure?')"
      $attrib = array('class' => 'form-signin');
      echo form_open('Db_process/editaccount', $attrib ); 
    ?>
   
    <div class="form-group col-sm-8">
      <label for="lname">Last Name:</label>
      <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name" maxlength="30"  value="<?php echo $data_item->lname; ?>" value="<?php echo set_value('lname'); ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8">
      <label for="fname">First Name:</label>
      <input type="text" class="form-control" name="fname" id="fname" placeholder="First name" maxlength="30" value="<?php echo $data_item->fname; ?>" value="<?php echo set_value('fname'); ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8" >
      <label for="idnum">ID Number:</label>
      <input type="number" class="form-control" name="idnum" id="idnum" placeholder="ID Number" maxlength="17000000" value="<?php echo $data_item->idnum; ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8" >
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="username" id="username" placeholder="Username" maxlength="20" value="<?php echo $data_item->username; ?>" value="<?php echo set_value('username'); ?>" required> 
    </div>
    <br>
    <div class="form-group col-sm-8" >
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" maxlength="20" value="<?php echo $data_item->password; ?>" value="<?php echo set_value('password'); ?>" required> 
    </div>
    <div class="form-group col-sm-8" >
      <label for="password">Confirm Password:</label>
      <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Password" maxlength="20" value="<?php echo $data_item->password; ?>" value="<?php echo set_value('cpassword'); ?>" required> 
    </div>
     <div class="form-group col-sm-8">
    <label for="usertype">User Type:</label>
     <select class="form-control" name="usertype" id="usertype" value="<?php echo $data_item->usertype; ?>" value="<?php echo set_value('usertype'); ?>">
    <option>guidance</option>
    <option>testing</option>
    <option>admin</option>
    
    </select>
    </div>
    <input type="hidden" id="aid" name="aid" value="<?php echo $data_item->account_id; ?>">
    <br>
    <div class="form-group col-sm-8">
    <button type="submit" onclick="return confirm_delete('Edit Account?')" class="btn btn-default">Submit</button>
    </div>
  </form>
  <?php } ?>
</div>
</div>
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