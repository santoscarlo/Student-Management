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

    $rec = mysqli_query($db, "SELECT id, StudID, RFIDStudNo, firstname, middlename, lastname, contactnum, statusofstud, section, yearlevel, course, parentcontactnum FROM studenttable WHERE id=$id");

    $record = mysqli_fetch_array($rec);
    $RFIDStudNo = $record['RFIDStudNo'];
    $firstname = $record['firstname'];
    $middlename = $record['middlename'];
    $lastname = $record['lastname'];

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

    <div class="form-inline pull-right">
        <form class="form-group">
  <a href="viewstudent.php" class="btn btn-info" role="button">View All Students</a>
    <a href="managestudent.php" class="btn btn-info" role="button">Register Student</a>

</div>
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


                        <div class="form-group col-md-6">
                           <input type="input" onkeyup="this.value = this.value.replace(/[^0-9,+]/, '')" min="0" maxlength="13" name="contactnum" class="form-control"  placeholder="Enter Student Cellphone Number" value="<?php echo $contactnum; ?>">
                        </div>

                         <div class="form-group col-md-6">
                          <input type="input" onkeyup="this.value = this.value.replace(/[^0-9,+]/, '')" min="0" maxlength="13" name="parentcontactnum" class="form-control"  placeholder="Enter Guardian Cellphone Number" value="<?php echo $parentcontactnum; ?>">
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
<!-- 
<script type="text/javascript">
function course_onchange(){
    var course = document.getElementById("course").value;
    var yearlevel = document.getElementById("yearlevel");

    if(course=="ICT"){
        var html = '<option value="GRADE 11 SHS">GRADE 11 SHS</option>';
            html += '<option value="GRADE 12 SHS">GRADE 12 SHS</option>';
            yearlevel.innerHTML = html;
    }
    else if(course=="ABM"){
           var html = '<option value="GRADE 11 SHS">GRADE 11 SHS</option>';
            html += '<option value="GRADE 12 SHS">GRADE 12 SHS</option>';
            yearlevel.innerHTML = html;
    }
    else if(course=="HUMSS"){
         var html = '<option value="GRADE 11 SHS">GRADE 11 SHS</option>';
            html += '<option value="GRADE 12 SHS">GRADE 12 SHS</option>';
            yearlevel.innerHTML = html;
    }
     else if(course=="BSIT"){
        var html = '<option value="1ST YEAR COLLEGE - REG">1ST YEAR COLLEGE - REG</option>';
            html += '<option value="2ND YEAR COLLEGE - REG">2ND YEAR COLLEGE - REG</option>';
            html += '<option value="3RD YEAR COLLEGE - REG">3RD YEAR COLLEGE - REG</option>';
            html += '<option value="1ST YEAR COLLEGE - NC">1ST YEAR COLLEGE - NC</option>';
            html += '<option value="2ND YEAR COLLEGE - NC">2ND YEAR COLLEGE - NC</option>';
            html += '<option value="3RD YEAR COLLEGE - NC">3RD YEAR COLLEGE - NC</option>';
            yearlevel.innerHTML = html;
    }
     else if(course=="BSBA"){
        var html = '<option value="1ST YEAR COLLEGE - REG">1ST YEAR COLLEGE - REG</option>';
            html += '<option value="2ND YEAR COLLEGE - REG">2ND YEAR COLLEGE - REG</option>';
              html += '<option value="3RD YEAR COLLEGE - REG">3RD YEAR COLLEGE - REG</option>';
                html += '<option value="1ST YEAR COLLEGE - NC">1ST YEAR COLLEGE - NC</option>';
                  html += '<option value="2ND YEAR COLLEGE - NC">2ND YEAR COLLEGE - NC</option>';
                    html += '<option value="3RD YEAR COLLEGE - NC">3RD YEAR COLLEGE - NC</option>';
            yearlevel.innerHTML = html;

        }
         else if(course=="Alumni"){
        var html = '<option>-Choose-</option>';
         html += '<option value="Alumni">Alumni</option>';
            yearlevel.innerHTML = html;
    }            
}


function yearlevel_onchange(){
    var course = document.getElementById("course").value;
    var yearlevel = document.getElementById("yearlevel").value;
    var section = document.getElementById("section");

    if(course=="ICT" && yearlevel=="GRADE 11 SHS"){
        var html = '<option value="ICT - UNIX">ICT - UNIX</option>';
            html += '<option value="ICT - VISTA">ICT - VISTA</option>';
            section.innerHTML = html;
    }
    else if(course=="ICT" && yearlevel=="GRADE 12 SHS"){
        var html = '<option value="ICT - Mark Zuckerburg">ICT - Mark Zuckerburg</option>';
            html += '<option value="ICT - Bill Gates">ICT - Bill Gates</option>';
            section.innerHTML = html;
    }
     else if(course=="ABM" && yearlevel=="GRADE 11 SHS"){
        var html = '<option value="ABM - Henry Sy">ABM - Henry Sy</option>';
            section.innerHTML = html;
    }
    else if(course=="ABM" && yearlevel=="GRADE 12 SHS"){
        var html = '<option value="ABM - Steve Jobs">ABM - Steve Jobs</option>';
            section.innerHTML = html;
    }
    else if(course=="HUMSS" && yearlevel=="GRADE 11 SHS"){
        var html = '<option value="HUMSS - Sigmund Freud">HUMSS - Sigmund Freud</option>';
            section.innerHTML = html;
    }
    else if(course=="HUMSS" && yearlevel=="GRADE 12 SHS"){
        var html = '<option value="HUMSS - GRADE 12">HUMSS - GRADE 12</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="1ST YEAR COLLEGE - REG"){
        var html = '<option value="BSIT 1 - 1 REG">BSIT 1 - 1 REG</option>';
             html += '<option value="BSIT 1 - 2 REG">BSIT 1 - 2 REG</option>';
            section.innerHTML = html;
    }
     else if(course=="BSIT" && yearlevel=="2ND YEAR COLLEGE - REG"){
        var html = '<option value="BSIT 2 - 1 REG">BSIT 2 - 1 REG</option>';
             html += '<option value="BSIT 2 - 2 REG">BSIT 2 - 2 REG</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="3RD YEAR COLLEGE - REG"){
        var html = '<option value="BSIT 3 - 1 REG">BSIT 3 - 1 REG</option>';
             html += '<option value="BSIT 3 - 2 REG">BSIT 3 - 2 REG</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="1ST YEAR COLLEGE - NC"){
        var html = '<option value="BSIT 1 - 1 NC">BSIT 1 - 1 NC</option>';
             html += '<option value="BSIT 1 - 2 NC">BSIT 1 - 2 NC</option>';
            section.innerHTML = html;
    }
     else if(course=="BSIT" && yearlevel=="2ND YEAR COLLEGE - NC"){
        var html = '<option value="BSIT 2 - 1 NC">BSIT 2 - 1 NC</option>';
             html += '<option value="BSIT 2 - 2 NC">BSIT 2 - 2 NC</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="3RD YEAR COLLEGE - NC"){
        var html = '<option value="BSIT 3 - 1 NC">BSIT 3 - 1 NC</option>';
             html += '<option value="BSIT 3 - 2 NC">BSIT 3 - 2 NC</option>';
            section.innerHTML = html;  
    }  
                 // BSBA

     else if(course=="BSBA" && yearlevel=="1ST YEAR COLLEGE - REG"){
        var html = '<option value="BSBA 1 - 1 REG">BSBA 1 - 1 REG</option>';
             html += '<option value="BSBA 1 - 2 REG">BSBA 1 - 2 REG</option>';
            section.innerHTML = html;
    }
     else if(course=="BSBA" && yearlevel=="2ND YEAR COLLEGE - REG"){
        var html = '<option value="BSBA 2 - 1 REG">BSBA 2 - 1 REG</option>';
             html += '<option value="BSBA 2 - 2 REG">BSBA 2 - 2 REG</option>';
            section.innerHTML = html;
    }
    else if(course=="BSBA" && yearlevel=="3RD YEAR COLLEGE - REG"){
        var html = '<option value="BSBA 3 - 1 REG">BSBA 3 - 1 REG</option>';
             html += '<option value="BSBA 3 - 2 REG">BSBA 3 - 2 REG</option>';
            section.innerHTML = html;  
    } 
     else if(course=="BSBA" && yearlevel=="1ST YEAR COLLEGE - NC"){
        var html = '<option value="BSBA 1 - 1 NC">BSBA 1 - 1 NC</option>';
             html += '<option value="BSBA 1 - 2 NC">BSBA 1 - 2 NC</option>';
             section.innerHTML = html;
    }
     else if(course=="BSBA" && yearlevel=="2ND YEAR COLLEGE - NC"){
        var html = '<option value="BSBA 2 - 1 NC">BSBA 2 - 1 NC</option>';
             html += '<option value="BSBA 2 - 2 NC">BSBA 2 - 2 NC</option>'; 
             section.innerHTML = html;
    }
    else if(course=="BSBA" && yearlevel=="3RD YEAR COLLEGE - NC"){
        var html = '<option value="BSBA 3 - 1 NC">BSBA 3 - 1 NC</option>';
             html += '<option value="BSBA 3 - 2 NC">BSBA 3 - 2 NC</option>';
             section.innerHTML = html; 
    }
     else if(course=="Alumni" && yearlevel=="Alumni"){
        var html = '<option value="Alumni">Alumni</option>';
             section.innerHTML = html; 
    }
    
}

</script>
 -->
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
                          <label>Select Year Level</label>
                            <select id= "yearlevel" class="form-control" name="yearlevel" value="<?php echo $yearlevel; ?>" required>
        
                          <option value="" selected="selected">-Choose Year Level-</option>
                            <optgroup label="SHS Level">
                           <option value="GRADE 11 SHS">GRADE 11 SHS</option>
                              <option value="GRADE 12 SHS">GRADE 12 SHS</option>
                            </optgroup>
                              <optgroup label="College Level Regular Class">
                               <option value="1ST YEAR COLLEGE - REG">1ST YEAR COLLEGE - REG</option>
                             <option value="2ND YEAR COLLEGE - REG">2ND YEAR COLLEGE - REG</option>
                             <option value="3RD YEAR COLLEGE - REG">3RD YEAR COLLEGE - REG</option>
                           </optgroup>
                           <optgroup label="College Level Night Class">
                             <option value="1ST YEAR COLLEGE - REG">1ST YEAR COLLEGE - NC</option>
                               <option value="1ST YEAR COLLEGE - REG">1ST YEAR COLLEGE - NC</option>
                             <option value="2ND YEAR COLLEGE - REG">2ND YEAR COLLEGE - NC</option>
                             <option value="3RD YEAR COLLEGE - REG">3RD YEAR COLLEGE - NC</option>
                               </optgroup>
                                <optgroup label="Alumni">
                             <option value="Alumni">Alumni</option>

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
