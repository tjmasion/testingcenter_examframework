<div class="col-md-10>" style="margin-left:20%; border-radius:2pt; padding:3pt; position:absolute; overflow:hidden; max-width: 75%; max-height: 75%;">


<div class="page-header">
  <h1>Student Information<small></small></h1>
</div>
<?php
foreach ($clients as $data_item) {
?> 	
<p><b>ID Number: <?php echo $data_item->id_num;?></b> </p><br>
<p><b>First Name: <?php echo $data_item->fname?></b> </p><br>
<p><b>Middle Name: <?php echo $data_item->mname?></b> </p><br>
<p><b>Last Name: <?php echo $data_item->lname?></b> </p><br>
<p><b>Course and Year Level: <?php echo $data_item->course;?> <?php echo $data_item->yrlvl;?></b> </p><br>
<p><b>Sex: <?php echo $data_item->sex;?></b> </p><br>
<p><b>Email: <?php echo $data_item->email;?></b> </p><br>
<?php } ?>
</div>

</div>