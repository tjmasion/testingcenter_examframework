<!DOCTYPE html>
<head><title>USC Guidance Center</title>

	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
  	  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  	  <script src="<?php echo base_url(); ?>assets/jquery/1.10.2/jquery-1.10.2.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
      <style>
      body{
      	 width: 100%; 
         background-image: url("<?php echo base_url(); ?>assets/images/bgabstract.jpg");
         padding-top: 40px;
      }
      h2{
        color: #0d0d0d;
        font-size: 300%;
        transform: translateX(9%) translateY(-250%);
      }
      h3{
        color: #0d0d0d;
        font-size: 200%;
        transform: translateX(9%) translateY(-450%);
      }
      footer{
        margin-top: 14%;
        color:#2b2b2b;
      }
      </style>
      <script>
          $(window).load(function(){
                 $('#myModal').modal('show');
             });
      </script>
</head>

<body>
<div class="container-fluid" style="background-color: #e6ffe6; padding-top:20pt;margin-top: 5%; opacity:0.9; height: 450pt;">
<div class="container-fluid" style="height: 380pt; transform: translateY(-3%);   text-align: left; padding: 10pt; margin-top: 20pt;">
<img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-rounded" alt="usc logo" width="100" height="100">
<h2>University of San Carlos</h2>
<h3>Guidance Center Online Exam</h3>
<div class="container" style="margin: 0pt 0pt 0pt 0pt; padding:0pt; transform: translateX(10%) translateY(-30%); "><img src="<?php echo base_url(); ?>assets/images/process.png" alt="process" width="700" height="275"></div>
<div class="container-fluid" style=" background-color: #cccccc; opacity:0.9; width: 300pt; border: 1px solid #8c8c8c; padding: 10pt 20pt 30pt 20pt; margin: 0pt 10pt 10pt 10pt; border-radius: 20px; transform: translateX(225%) translateY(-106.5%);">
  <br><h1 style="color: #8c8c8c; font-size: 20pt; font-family: "Times New Roman", Times, serif; position:absolute;"><span class="glyphicon glyphicon-edit"></span> Login to your account</h1><br>
  <?php 
    if( isset($_SESSION['error_message'])){
      echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error_message'].'</div>';
    }
    ?>
   <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('Db_process/userlogin', $attrib); 
    ?>
    <div class="form-group has-feedback has-feedback-left">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
      <i class="form-control-feedback glyphicon glyphicon-user" aria-hidden="true" style="background-color:#e6e6e6; border:1px solid #d9d9d9; border-radius:1px;"></i>
    </div><br>
    <div class="form-group has-feedback has-feedback-left">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
      <i class="form-control-feedback glyphicon glyphicon-lock" aria-hidden="true" style="background-color:#e6e6e6; border:1px solid #d9d9d9; border-radius:1px;"></i>
    </div><br>
  <br>

    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Login</button>
 <?php echo form_close(); ?>
</div>
</div>
</div>
</div>

	<div id="myModal" class="modal fade in" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <center>
	        	<center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center>
	        	<center><h4>University of San Carlos </h4></center>
	        	<center><p>Guidance and Testing Center Referral System Report</p></center>	
	        </center>
	      </div>
	      <div class="modal-body">
	        <center><p style="text-align: justify;">This system is created for the sole purpose of automating the creation of exams, referrals, generation of reports, and dissemination of exams to students. Creating an automated system saves a lot of time for the exam takers since they would not be shading circles manually and by this way even the university can track the status of the students. The system assists personnel from the guidance center as well as in testing center who serves as the authors of the exams. The system which can refer and supply the students with the appropriate exam can be of great help to the centers.</p></center>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

<footer>
  <p><strong><center>Copyright &copy;2017. All Rights Reserved<br>University of San Carlos<br>P. del Rosario St., Cebu City, Philippines 6000<br>
    Phone: +63 (32) 253 1000 | Fax: +63 (32) 255 4341 | E-mail: ismis@usc.edu.ph</center></strong>
  </p>
  </footer>
</div>
</body>
</html>