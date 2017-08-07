       <div class="col-md-10" style="margin-left:20%;  border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:75%;">
              <h1>Activity Log</h1><br><br>
     
  <table class="table">
    <thead>
      <tr>
        <th>Account ID</th>
        <th>Username</th>
        <th>User Type</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date and Time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach($array as $data_item){
      ?>
      <tr>
        <td><?php echo $data_item['account_id']; ?></td>
        <td><?php echo $data_item['username']; ?></td>
        <td><?php echo $data_item['usertype']; ?></td>
        <td><?php echo $data_item['fname']; ?></td>
        <td><?php echo $data_item['lname']; ?></td>
        <td><?php echo $data_item['date']; ?></td>
        <td><?php echo $data_item['action']; ?></td>
      </tr>
    <?php   } ?>
    </tbody>
  </table>
</div>
</div>
