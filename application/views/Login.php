  <!DOCTYPE html>
<head><title>USC Guidance Center</title>
	  <meta charset="utf-8">
  	  <meta name="viewport" content="width=device-width, initial-scale=1">
  	  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  	  <script src="<?php echo base_url(); ?>assets/jquery/3.1.1/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assests/js/bootstrap.min.js"></script>
      <style>
      html,
      body {
        height: 100%;
      }
      body{
         background-image: url("<?php echo base_url(); ?>assets/images/bgabstract.jpg");
         background-size: 100% 150%;
         padding-top: 40px;
         padding-bottom: 40px;
      }
      h2{
        font-family: "Times New Roman", Georgia, Serif;
        color: #0d0d0d;
        font-size: 300%;
        transform: translateX(9%) translateY(-250%);
      }
      h3{
        font-family: "Times New Roman", Georgia, Serif;
        color: #0d0d0d;
        font-size: 200%;
        transform: translateX(9%) translateY(-450%);
      }
      footer{
        margin-top: 14%;
        color:black;
      }
      </style>
</head>

<body>
<div id="wrap">
<div class="container-fluid" style="background-color: #e6ffe6; padding:10pt; margin:50pt 0pt 50pt 0pt; opacity:0.9; width: 100%; height: 380pt;">
<center>
<div class="inner_container" style="width: 1000pt; height: 380pt; transform: translateY(-3%); text-align: left; padding: 10pt;">
<img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-rounded" alt="usc logo" width="100" height="100">
<h2>University of San Carlos</h2>
<h3>Guidance Center Online Exam</h3>
<div class="container" style="margin: 0pt 0pt 0pt 0pt; padding:0pt; transform: translateX(10%) translateY(-30%); "><img src="<?php echo base_url(); ?>assets/images/process.png" alt="process" width="700" height="275"></div>
<div class="container-fluid" style=" background-color: #cccccc; opacity:0.9; width: 300pt; border: 1px solid #8c8c8c; padding: 10pt 20pt 30pt 20pt; margin: 0pt 10pt 10pt 10pt; border-radius: 20px; transform: translateX(225%) translateY(-106.5%);">
  <br><h1 style="color: #8c8c8c; font-size: 20pt; font-family: "Times New Roman", Times, serif; position:absolute;"><span class="glyphicon glyphicon-edit"></span> Login to your account</h1><br>
   <?php 
      $attrib = array('class' => 'form-signin');
      echo form_open('Db_process/userlogin', $attrib); 
    ?>
     <div class="alert alert-danger" role="alert">test</div>
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
    <div class="checkbox">
    <label><input type="checkbox"><strong>Remember me</strong></label>
  </div>
  <br>

    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Login</button>
 <?php echo form_close(); ?>
  <a href="<?php echo site_url('Page/guidancehome') ?>"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Guidance</button></a>
  <a href="<?php echo site_url('Page/testinghome') ?>"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Testing Center</button></a>
  <a href="<?php echo site_url('Page/studenthome') ?>"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Student</button></a>
</div>
</div>
</div>
</center>
</div>
<footer>
  <p><strong><center>Copyright &copy;2017. All Rights Reserved<br>University of San Carlos<br>P. del Rosario St., Cebu City, Philippines 6000<br>
    Phone: +63 (32) 253 1000 | Fax: +63 (32) 255 4341 | E-mail: ismis@usc.edu.ph</center></strong>
  </p>
  </footer>
</div>
</body>
</html>