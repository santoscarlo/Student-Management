<?php
include('server3.php');
include('nav.php');

//for restriction
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 //echo "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>";
} // until here



  // fetch the record to be updated

  if(isset($_GET['editpage'])) {

    $id = $_GET['editpage'];

    $edit_state = true;

    $rec = mysqli_query($db, "SELECT * FROM studenttable WHERE id=$id");

    $record = mysqli_fetch_array($rec);
    $RFIDStudNo = $record['RFIDStudNo'];
    $firstname = $record['firstname'];
    $middlename = $record['middlename'];
    $lastname = $record['lastname'];

    $file = $record['studimg'];

    $contactnum = $record['contactnum'];
    $statusofstud = $record['statusofstud'];
    $section = $record['section'];
    $yearlevel= $record['yearlevel'];
    $course = $record['course'];
    $parentcontactnum = $record['parentcontactnum'];
    $StudID = $record['StudID'];
    $id = $record['id'];
  }



 ?>

 <?php

 //for dependent dropdown
$connect = mysqli_connect("localhost", "root", "", "info_db");
$course = '';
$query = "SELECT course FROM course_yearlevel_section GROUP BY course";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result))
{
 $course .= '<option value="'.$row["course"].'">'.$row["course"].'</option>';
}
?>
<div class="container">
  <div class="jumbotron">

    
                  
<!-- FOR UPDATE, RECORD, GET MSG -->

                  <?php if(isset($_SESSION['msg2'])): ?>
                      
    <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     <?php

                            echo $_SESSION['msg2'];
                            unset($_SESSION['msg2']);

                            ?>
    </div>

                  <?php endif ?>

                  <!-- FOR STUDID -->

                  <?php if(isset($_SESSION['msgstud'])): ?>
                      
    <div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     <?php

                            echo $_SESSION['msgstud'];
                            unset($_SESSION['msgstud']);

                            ?>
    </div>

                  <?php endif ?>



<!--FORM STARTS HERE-->



 <form method="POST" action="server3.php" enctype="multipart/form-data">

  <a href="viewstudent.php" class="btn btn-info pull-right" role="button">View All Students</a>

<div class="container">
  
        <div class="row">

          <div class="col-md-12 col-md-offset-13">

                    <legend class="text-center">Manage Student</legend>

                    <fieldset>
                        <legend>Student Information</legend>
                          <div><input type="hidden" name="id" value="<?php echo $id; ?>"></div>
                          
                        <div class="form-group col-md-6">
                               <input type="input" onkeyup="this.value = this.value.replace(/[^0-9]/, '')" min="0" maxlength="12"  name="StudID" class="form-control"  placeholder="Enter Student ID" value="<?php echo $StudID; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                           <input type="text" name="RFIDStudNo" class="form-control pull-right"  placeholder="Scan RFID" value="<?php echo $RFIDStudNo; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                         <input type="input" onkeyup="this.value = this.value.replace(/[^a-z\s,A-Z\s]/, '')" name="firstname" class="form-control"  placeholder="Enter First Name" value="<?php echo $firstname; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                         <input type="input" onkeyup="this.value = this.value.replace(/[^a-z/\s,A-Z/\s]/, '')"  name="middlename" class="form-control pull-right"  placeholder="Enter Middle Name" value="<?php echo $middlename; ?>" required>   
                        </div>

                        <div class="form-group col-md-6">
                          <input type="input" onkeyup="this.value = this.value.replace(/[^a-z\s,A-Z\s]/, '')" name="lastname" class="form-control"  placeholder="Enter lastname" value="<?php echo $lastname; ?>" required>
                        </div>

                         <div class="form-group col-md-6">
                         <select name="gender" class="form-control" value="<?php  echo $gender; ?>">
                         <option value="Male">Male</option>
                         <option value="Female">Female</option>
                         </select>
                        </div>

                        <div  style="margin-top: -6px;" class="form-group col-md-6">
                          <input type="file"  accept="image/png, image/jpeg, image/gif" name="studimg" class="form-control"  placeholder="Select Image" required><label style="font-size: 10px;">**Please provide below 5MB photo.**</label> 
                        </div>

                   

                        <div class="form-group col-md-6">
                           <input type="input" onkeyup="this.value = this.value.replace(/[^0-9,+]/, '')" min="0" maxlength="13" name="contactnum" value="<?php echo $contactnum; ?>"class="form-control"  placeholder="Enter Student Cellphone Number"><label style=" font-size: 10px; margin-bottom: 100px; margin-top: -10px;">**Please input cellphone number here if College student.**</label>
                        </div>

                         <div style="margin-top: -120px;" class="form-group col-md-6">
                          <input type="input" onkeyup="this.value = this.value.replace(/[^0-9,+]/, '')" min="0" maxlength="13" name="parentcontactnum" value="<?php echo $parentcontactnum; ?>" class="form-control"  placeholder="Enter Guardian Cellphone Number"><label style="font-size: 10px;">**Please input cellphone number here if SHS student.**</label>
                        </div>
                    </fieldset>



                        <legend>Select option:</legend>
            
                        <div class="form-group col-md-6">
                             <label>Select Status of Student</label>
                            <select class="form-control" name="statusofstud" value="<?php echo $statusofstud; ?>" required>
                               
                                <option>Enrolled</option>
                                <option>Not Enrolled</option>
                                <option>Suspended</option>
                                <option>Alumni</option>
                                <option>Kickout</option>
                            </select>
                        </div>


                         <div class="form-group col-md-6">
                             <label>Select Course</label>
                     <select name="course" id="course" class="form-control action">
    <option value="">Select Course</option>
    <?php echo $course; ?>
   </select>
                        </div>

                        <div class="form-group col-md-6"> 
                           <label>Select Year Level</label>
                            <select name="yearlevel" id="yearlevel" class="form-control action" required>
                                <option value="">Select YearLevel</option>
                               </select>
                        </div>

                         <div class="form-group col-md-6">
                             
                         <label>Select Section</label>
                         <select id= "section"  class="form-control" name="section" required>
                         </select>
                          </div>
                       <br /> 


                

                 <div class="form-group pull-right">
              
              <br><br><?php if($edit_state == false): ?>
                   <button type="submit" name="save" class="btn btn-primary">Register Information</button>

          <?php else: ?>
                
                  <button type="submit" name="update" class="btn btn-primary">Update Information</button>
            
                  
          <?php endif ?>  



    </div>

                </form>
            </div>

        </div>
    </div>
  <script>
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "course")
   {
    result = 'yearlevel';
   }
   else
   {
    result = 'section';
   }
   $.ajax({
    url:"fetch_course_yearlevel_section.php",
    method:"POST",
    data:{action:action, query:query},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});
</script>



</div>
</div>
