<body>
<?php
  $clientnum = $this->session->userdata('account_id');
?>
<nav class="navbar navbar-default" style="background-color:#2eb82e;">
  <div class="container-fluid">
    <div class="navbar-header">
        <img src="<?php echo base_url(); ?>assets/images/usclogo.png" width="100pt" height="100pt" style="padding: 5pt" />
        <img src="<?php echo base_url(); ?>assets/images/usctext.png" width="400pt" height="100pt" style="transform: translateY(5%);" />
    </div>
  </div>
</nav>
  
<div class="row" >
  <div class="col-md-2">
  <ul class="nav nav-pills nav-stacked"  style="background-color: #e6e6e6; margin-top: -15pt;">
  <li role="presentation" style="font-size: 15pt; word-spacing: 0px; "><br><img src="<?php echo base_url(); ?>assets/images/bglogin.jpg" class="img-circle" alt="user" width="40" height="40"> Student</li><hr>
  <li role="presentation" class="gold"><a href="<?php echo site_url('Page/studenthome/'.$clientnum) ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"> Home </span></a></li>
  <li role="presentation"><a href="<?php echo site_url('exam/availableexams/'.$clientnum) ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Take Exam </span></a></li>
  <li role="presentation"><a href="<?php echo site_url('Page/studentexamhistory/'.$clientnum) ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Exam History </span></a></li>
  <li role="presentation"><a href="<?php echo site_url('Page/aboutus') ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> About Us </span></a></li>

   <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><hr>

  <li role="presentation"><a href="<?php echo site_url('Page/logout') ?>"><span class="glyphicon glyphicon-off" aria-hidden="true"> Logout</span></a></li>

  <br />


		</ul>
	</div>