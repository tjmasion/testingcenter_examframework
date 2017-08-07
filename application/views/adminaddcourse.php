 <div class="col-md-10" style="margin-left:20%; border-radius:2pt; padding:0pt; position:absolute; overflow: initial; max-width: 75%; max-height:75%;">
  <?php $account_id = $this->session->userdata('account_id'); ?>
<h1>Add Program</h1><br><br>
    
    
<div class="container">
    <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('Db_process/add_course', $attrib ); 
    ?>
    <div class="form-group col-sm-8">
      <label for="ccode">Program Code:</label>
      <input type="text" class="form-control" name="ccode" id="ccode" maxlength="10" placeholder="Program Code" value="<?php echo set_value('coursecode'); ?>" required> 
   </div>
    <br>
    <div class="form-group col-sm-8">
      <label for="cname">Program Name:</label>
      <input type="text" class="form-control" name="cname" id="cname" maxlength="150" placeholder="Program name" value="<?php echo set_value('cdescrip'); ?>" required> 
    </div>
    <div class="form-group col-sm-8">

    <label for="course">Select School:</label>
    <select class="form-control" name="school" id="school">
       <option value="safad">School of Architecture and Fine Arts Design</option>
       <option value="sas">School of Arts and Sciences</option>
       <option value="shcp">School of Health Care Profession</option>
       <option value="slg">School of Law and Governance</option>
       <option value="sbe">School of Business and Economics</option>
       <option value="soed">School of Education</option>
       <option value="soe">School of Engineering</option>
   
    </select>
    </div>
    <br>
    <div class="form-group col-sm-8">
    <button type="submit" onsubmit="return confirm_add('Add Course?')" class="btn btn-default">Submit</button>
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