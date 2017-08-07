<div class="col-md-10" style="margin-left:20%; border-radius:2pt; padding:3pt; position:absolute;  max-width:75%; max-height:75%;">
<?php
    $clientnum = $this->session->userdata('account_id');

  foreach ($exams as $data_item) {
    $exam_num = $data_item->exam_num;
    $examname = $data_item->exam_name;
    $instructions = $data_item->descrip;
  }
  foreach ($subexam as $data_item) {
    $subexam_num = $data_item->subexam_num;
  }
?>
<center><h1><?php echo $examname; ?></h1></center>

  <div class="col-md-12" style="background-color: #f2f2f2; border-radius:5pt; position:absolute;">

  <div>
    <h3>Instructions</h3>
    <p>
      <?php echo $instructions;  ?>
    </p>
  </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th><center>Questions</center></th>
            <th colspan="4"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($item as $data_item){
            ?>
          <tr>
            <?php $itemid = $data_item->item_id;  ?>
            <th scope="row"><?php echo $data_item->item_no;  ?></th>
            <td><?php echo $data_item->question;  ?></td>
            <div class="form-group col-sm-10">
            <input type="hidden" class="form-control"  name="item_id" id="item_id" value="<?php echo set_value('item_id', $itemid); ?>">
            </div>
            <?php
            foreach($choice as $data_item){
              ?>
            <td>
              <center><input type="radio" name="<?php echo $itemid; ?>" value="<?php echo $data_item->choices_id;?>" disabled></center>
              <center><?php echo $data_item->choice; } ?></center>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
  </div>
</div>

</div>
</div>
