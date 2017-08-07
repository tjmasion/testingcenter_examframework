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
  			<li role="presentation" style="font-size: 15pt; word-spacing: 0px; "><br><img src="<?php echo base_url(); ?>assets/images/bglogin.jpg" class="img-circle" alt="user" width="40" height="40">Admin</li><hr>
  			<li role="presentation"><a href="<?php echo site_url('Page/adminhome') ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"> Home </span></a></li>
        <li role="presentation" class="gold"><a href="<?php echo site_url('Page/createaccount'); ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Create Account</span></a></li>
        <li role="presentation" class="gold"><a href="<?php echo site_url('Page/deactivatedaccounts'); ?>"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"> Reactivate Account</span></a></li>
        <li role="presentation"><a href="<?php echo site_url('Page/addcourse') ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Add Program</span></a></li>
        <li role="presentation"><a href="<?php echo site_url('Db_process/activitylog') ?>"><span class="glyphicon glyphicon-flag" aria-hidden="true"> Activity Log</span></a></li>

  			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><hr>

  			<li role="presentation"><a href="<?php echo site_url('Page/logout') ?>"><span class="glyphicon glyphicon-off" aria-hidden="true"> Logout</span></a></li>

  			<br />

		</ul>
	</div>