<?php
  $is_error = $this->session->userdata('is_error'); 
?>

<script>
  $(document).ready(function() {
    var error = '<?php echo $is_error; ?>'
    if(error == '1'){
      $('#createExam').modal();
    }
    
  });
</script>
<body>
<nav class="navbar navbar-default" style="background-color:#2eb82e;">
  <div class="container-fluid">
    <div class="navbar-header">
        <img src="<?php echo base_url(); ?>assets/images/usclogo.png" width="100pt" height="100pt" style="padding: 5pt" />
        <img src="<?php echo base_url(); ?>assets/images/usctext.png" width="400pt" height="100pt" style="transform: translateY(5%);" />
    </div>
  </div>
</nav>
  
<div class="row">
	<div class="col-md-2">
		<ul class="nav nav-pills nav-stacked"  style="background-color: #e6e6e6; margin-top: -15pt;">
       <li role="presentation" style="font-size: 15pt; word-spacing: 0px; "><br><img src="<?php echo base_url(); ?>assets/images/bg.jpg" class="img-circle" alt="user" width="40" height="40"> Testing Center</li><hr>
       <li role="presentation" class="gold"><a href="<?php echo site_url('Page/testinghome') ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"> Home </span></a></li>
       <li role="presentation" class="gold"><a href="#createExam" data-toggle="modal"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Create Exam</span></a></li>
      <li role="presentation"><a href="<?php echo site_url('Page/testingexam') ?>"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"> Available Exams</span></a></li>
      <li role="presentation"><a href="<?php echo site_url('Page/deactestingexam') ?>"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"> Deactivated Exams</span></a></li>
      <li role="presentation"><a href="<?php echo site_url('Page/report') ?>"><span class="glyphicon glyphicon-stats" aria-hidden="true"> Reports</span></a></li>

  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><hr>

  <li role="presentation"><a href="<?php echo site_url('Page/logout') ?>"><span class="glyphicon glyphicon-off" aria-hidden="true"> Logout</span></a></li>

  			<br />

		</ul>
	</div>
    <div class="modal fade" id="createExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Create Exam</h1>
        </div>
        <div class="modal-body">
          <?php 
            if( isset($_SESSION['exam_error'])){
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['exam_error'].'</div>';
            }
            ?>
          <?php 
               $attrib = array('class' => 'form-signin', 'name' => 'examForm');
               echo form_open('exam/addexam', $attrib); 
          ?>
            <div class="form-group">
            <label>Exam Name</label>
            <input type="text" class="form-control"  name="exam_name" id="exam_name" placeholder="Name" required>
            </div>

            <div class="form-group">
            <label>Instructions</label>
            <textarea class="form-control"  name="descrip" id="descrip" placeholder="Exam Instructions" rows="5" required></textarea> 
            </div>

            <div class="form-group">
            <label>Time Limit (Minutes)</label>
            <input type="number"class="form-control"  name="timelimit" id="timelimit" placeholder="Exam Time Limit (Minutes)" required>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" class="btn btn-info">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
    