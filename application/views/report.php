<div class="col-md-10" style="margin-left:20%;  border-radius:2pt; padding:3pt; position:absolute; overflow:auto; max-width: 75%; max-height:100%;">

<div id="rprt">
<div>
<center><img src="<?php echo base_url(); ?>assets/images/print.png" style="height: 100px; width: 100px;"></center>
<center><h3>University of San Carlos </h3></center>
<center><p>Guidance and Testing Center Referral System Report</p></center>
</div>
<br><br>
<?php
    foreach($rep as $report){
?>
Total Number of Takers: <?php echo $report['numoftakers']; ?><br>

<br><br>

<em>By Gender:</em><br>
<div>
 <table class="table" id="myTable">
    <thead>
      <tr>
        <th>Gender</th>
        <th>Number of Takers</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><a href="#male" data-toggle="modal">Male</a></td>
        <td><?php echo $report['male']; ?></td>
      </tr><tr>
        <td><a href="#female" data-toggle="modal">Female</a></td>
        <td><?php echo $report['female']; ?></td>
      </tr>
    </tbody>
  </table>
</div>

<em>By Year Level:</em><br>
<div>
 <table class="table" id="myTable">
    <thead>
      <tr>
        <th>Year Level</th>
        <th>Number of Takers</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><a href="#firstyr" data-toggle="modal">First Year</a></td>
        <td><?php echo $report['first']; ?></td>
      </tr><tr>
        <td><a href="#secondyr" data-toggle="modal">Second Year</a></td>
        <td><?php echo $report['second']; ?></td>
      </tr><tr>
        <td><a href="#thirdyr" data-toggle="modal">Third Year</a></td>
        <td><?php echo $report['third']; ?></td>
      </tr><tr>
        <td><a href="#fourthyr" data-toggle="modal">Fourth Year</a></td>
        <td><?php echo $report['fourth']; ?></td>
      </tr><tr>
        <td><a href="#fifthyr" data-toggle="modal">Fifth Year</a></td>
        <td><?php echo $report['fifth']; ?></td>
      </tr>
    </tbody>
  </table>
</div>

<em>By School:</em><br>
<div>
 <table class="table" id="myTable">
    <thead>
      <tr>
        <th>School</th>
        <th>Number of Takers</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><a href="#safad" data-toggle="modal">School of Architecture Fine Arts and Design</a></td>
        <td><?php echo $report['safad']; ?></td>
      </tr><tr>
        <td><a href="#sas" data-toggle="modal">School of Arts and Sciences</a></td>
        <td><?php echo $report['sas']; ?></td>
      </tr><tr>
        <td><a href="#shcp" data-toggle="modal">School of Health Care Profession</a></td>
        <td><?php echo $report['shcp']; ?></td>
      </tr><tr>
        <td><a href="#slg" data-toggle="modal">School of Law and Governance</a></td>
        <td><?php echo $report['slg']; ?></td>
      </tr><tr>
        <td><a href="#sbe" data-toggle="modal">School of Business and Economics</a></td>
        <td><?php echo $report['sbe']; ?></td>
      </tr><tr>
        <td><a href="#soed" data-toggle="modal">School of Education</a></td>
        <td><?php echo $report['soed']; ?></td>
      </tr><tr>
        <td><a href="#soe" data-toggle="modal">School of Engineering</a></td>
        <td><?php echo $report['soe']; ?></td>
      </tr>
    </tbody>
  </table>
</div>
<?php   } 
?>

<em>By Exam:</em><br>
<div>
 <table class="table" id="myTable">
    <thead>
      <tr>
        <th>Exam</th>
        <th>Number of Takers</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($exams as $data_item){ 
      ?>
      <tr>
        <td><a href=""><?php echo $data_item->exam_name;?></a></td>
        <td><?php echo $data_item->total; ?></td>
      </tr>
    </tbody>
    <?php } ?>
  </table>
</div>
 
</div>
    <button class="btn btn-info" onclick="printReport('rprt')">Print Report</button>  
     <button class="btn btn-info" onclick="exportWord('rprt')">Export to .doc </button> 
 <br><br><br>
    <a href="<?php echo site_url('Db_process/reset') ?>"><button type="submit" onclick="return confirm_update('Are you sure?')" class="btn btn-danger"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update  </button></a><br><br>

</div>       
</div>

</div>

  <div class="modal fade" id="male" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of Male students</h1>
        </div>
        <div class="modal-body">
           <div id="malerep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                <?php
              if(isset($male)){
              foreach($male as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                  <td><?php echo $data_item->course; ?></td>
                </tr>
                <?php  } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" onclick="printMaleReport('malerep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="female" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of Female students</h1>
        </div>
        <div class="modal-body">
          <div id="femrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(isset($female)){
              foreach($female as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                  <td><?php echo $data_item->course; ?></td>
                </tr>
                <?php  } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printFemaleReport('femrep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="firstyr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of First Year students</h1>
        </div>
        <div class="modal-body">
          <div id="firstyrrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(isset($firstyr)){
              foreach($firstyr as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                  <td><?php echo $data_item->course; ?></td>
                </tr>
                <?php }  } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printFirstyrReport('firstyrrep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="secondyr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of Second Year students</h1>
        </div>
        <div class="modal-body">
          <div id="secondyrrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(isset($secondyr)){
              foreach($secondyr as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                  <td><?php echo $data_item->course; ?></td>
                </tr>
                <?php }  } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printSecondyrReport('secondyrrep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="thirdyr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of Third Year students</h1>
        </div>
        <div class="modal-body">
          <div id="thirdyrrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                <?php
              if(isset($thirdyr)){
              foreach($thirdyr as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                  <td><?php echo $data_item->course; ?></td>
                </tr>
                <?php }  } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printThirdyrReport('thirdyrrep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="fourthyr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of Fourth Year students</h1>
        </div>
        <div class="modal-body">
          <div id="fourthyrrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(isset($fourthyr)){
              foreach($fourthyr as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                  <td><?php echo $data_item->course; ?></td>
                </tr>
                <?php  } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printFourthyrReport('fourthyrrep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="fifthyr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of Fifth Year students</h1>
        </div>
        <div class="modal-body">
          <div id="fifthyrrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(isset($fifthyr)){
              foreach($fifthyr as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                  <td><?php echo $data_item->course; ?></td>
                </tr>
                <?php  } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printFifthyrReport('fifthyrrep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade" id="safad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of School of Architecture Fine Arts and Design   students</h1>
        </div>
        <div class="modal-body">
          <div id="safadrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                </tr>
              </thead>
              <tbody>
                <?php
              if(isset($safad)){
              foreach($safad as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printsafadReport('safadrep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

   <div class="modal fade" id="sas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of School of Arts and Sciences students</h1>
        </div>
        <div class="modal-body">
          <div id="sasrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                </tr>
              </thead>
              <tbody>
                <?php
              if(isset($sas)){
              foreach($sas as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printsasReport('sasrep')"  class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="shcp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of School of Health Care Profession students</h1>
        </div>
        <div class="modal-body">
          <div id="shcprep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                </tr>
              </thead>
              <tbody>
                <?php
              if(isset($shcp)){
              foreach($shcp as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printshcpReport('shcprep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="slg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of School of Law and Governance students</h1>
        </div>
        <div class="modal-body">
          <div id="slgrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                </tr>
              </thead>
              <tbody>
                <?php
              if(isset($slg)){
              foreach($slg as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printslgReport('slgrep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="sbe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of School of Business and Economics students</h1>
        </div>
        <div class="modal-body">
          <div id="sberep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                </tr>
              </thead>
              <tbody>
                <?php
              if(isset($sbe)){
              foreach($sbe as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printsbeReport('sberep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="soed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of School of Education students</h1>
        </div>
        <div class="modal-body">
          <div id="soedrep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                </tr>
              </thead>
              <tbody>
                <?php
              if(isset($soed)){
              foreach($soed as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printsoedReport('soedrep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="soe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">List of School of Engineering students</h1>
        </div>
        <div class="modal-body">
          <div id="soerep">
            <table class="table">
              <thead>
                <tr>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>ID number</th>
                </tr>
              </thead>
              <tbody>
                <?php
              if(isset($soe)){
              foreach($soe as $data_item){
                ?>
                <tr>
                  <td><?php echo $data_item->lname; ?></td>
                  <td><?php echo $data_item->fname; ?></td>
                  <td><?php echo $data_item->id_num; ?></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submitExam" onclick="printsoeReport('soerep')" class="btn btn-info">Print</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
function confirm_update(question) {

  if(confirm(question)){

     alert("Sucessful Reset!");

  }else{
    return false;  
  }

}
</script>