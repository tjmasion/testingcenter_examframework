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
      <li role="presentation"><a href="<?php echo site_url('Page/testingexam') ?>"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"> Available Exams</span></a></li>
      <li role="presentation"><a href="<?php echo site_url('Page/deactestingexam') ?>" ><span class="glyphicon glyphicon-duplicate" aria-hidden="true"> Deactivated Exams</span></a></li>

  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><hr>

  <li role="presentation"><a href="<?php echo site_url('Page/logout') ?>"><span class="glyphicon glyphicon-off" aria-hidden="true"> Logout</span></a></li>

  			<br />

		</ul>
	</div>
  <script>
      var inFormOrLink;
      $(document).on("click", ".createexambutton", function(event){
          $(window).off('beforeunload');
      })
      $(document).on("click", ".modifybutton", function(event){
          $(window).off('beforeunload');
      })
      $(document).on("submit", "form", function(event){
          $(window).off('beforeunload');
      })


      $(window).on("beforeunload", function() { 
          return inFormOrLink ? "Do you really want to close?" : null; 

      });
      $(window).on('unload', function(){
        window.location.href = "<?php echo site_url('exam/cancelcreate');?>";
      });
      
  </script>
    