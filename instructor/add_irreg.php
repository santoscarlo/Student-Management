<?php
include('addirreg_server.php');
include('user_nav.php');

//for restriction
if(!$_SESSION["loginuser"]){
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
 
<link rel="stylesheet" href="../css/jquery-ui.css">
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery-ui.js"></script>  

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



 <form method="POST" action="addirreg_server.php">

<!--   <a href="add_attendance_user.php" class="btn btn-info pull-right" role="button">Back</a> -->

<div class="container">
  
        <div class="row">

          <div class="col-md-12 col-md-offset-13">

                    <legend class="text-center">Add Irregular Student</legend>

                    <fieldset>
                        <legend></legend>
                          <div><input type="hidden" name="id" value="<?php echo $id; ?>"></div>
                          
                        <div class="form-group col-md-6">
                               <input id="sample" type="input" onkeyup="this.value = this.value.replace(/[^0-9]/, '')" min="0" maxlength="12"  name="StudID" class="form-control"  placeholder="Enter Student ID" value="<?php echo $StudID; ?>" required>
                        </div>


                        <div class="form-group col-md-6">
                         <input id="firstname" type="input" onkeyup="this.value = this.value.replace(/[^a-z\s,A-Z\s]/, '')" name="firstname" class="form-control"  placeholder="Enter First Name" value="<?php echo $firstname; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                         <input  id="middlename" type="input" onkeyup="this.value = this.value.replace(/[^a-z/\s,A-Z/\s]/, '')"  name="middlename" class="form-control pull-right"  placeholder="Enter Middle Name" value="<?php echo $middlename; ?>" required>   
                        </div>

                        <div class="form-group col-md-6">
                          <input  id="lastname" type="input" onkeyup="this.value = this.value.replace(/[^a-z\s,A-Z\s]/, '')" name="lastname" class="form-control"  placeholder="Enter lastname" value="<?php echo $lastname; ?>" required>
                        </div>

                   

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
                         <select id= "course" class="form-control" name="course" onChange = "change_course()" required>
                          <option value="" selected="selected">-Choose Course-</option>
                            
                            <?php 
                                $connect = mysqli_connect("localhost", "root", "", "info_db");                                
                               $select = mysqli_query($connect, "SELECT courses FROM coursestable");
                               while ($row=mysqli_fetch_array($select))
                               {
                                echo "<option>".$row['courses']."</option>";
                               }
                               ?>
                            </select>
                        </div>



                         <div class="form-group col-md-6">
                             
                         <label>Select Section</label>
                         <select id= "section"  class="form-control" name="section" required>
                          <option value="" selected="selected">-Choose section-</option>
                                                       
                            <?php 

                               $select = mysqli_query($connect, "SELECT section FROM sectiontable");
                               while ($row=mysqli_fetch_array($select))
                               {
                                echo "<option>".$row['section']."</option>";
                               }
                               ?>
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
  



</div>
</div>


 <script>
  $(function() {
    $( "#sample" ).autocomplete({
      source: 'search1.php'
    });
  });

$(function() {
    $( "#firstname" ).autocomplete({
      source: 'search2.php'
    });
  });



$(function() {
    $( "#middlename" ).autocomplete({
      source: 'search3.php'
    });
  });



$(function() {
    $( "#lastname" ).autocomplete({
      source: 'search4.php'
    });
  });


  </script>






