<?php
// SAMPLE SUBJECT // THE ORIGINAL FILE IS MANAGE_SUBJECT LOCATED IN THE MANAGESETTINGS 


include('server2.php');
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

    $rec = mysqli_query($db, "SELECT * FROM subjecttable WHERE id=$id");

    $record = mysqli_fetch_array($rec);
    $subjname = $record['subjname'];
    $subjdesc = $record['subjdesc'];
    $subjtimestart = $record['subjtimestart'];
    $subjtimeend = $record['subjtimeend'];
    $subjday = $record['subjday'];
    $course = $record['course'];
    $section = $record['section'];
    $term = $record['term'];
    $school_year = $record['school_year'];
    $id = $record['id'];
  }



 ?>



<div class="container">
  <div class="jumbotron">



  <!-- FOR DELETE MSG -->  
                  <?php if(isset($_SESSION['msg11'])): ?>

     <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     <?php

                            echo $_SESSION['msg11'];
                            unset($_SESSION['msg11']);

                            ?>
    </div>

                  <?php endif ?>

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

                  <br>



<!--SEARCH START HERE-->
    
<div class="row">
  <div class="col-sm-4 pull-right">
    <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-secondary" type="button">Search</button>
      </span>
     <input type="text" name="search_text" id="search_text" placeholder="Search Information" class="form-control" />
    </div>
  </div>

  

<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"./search_include/searchsubject.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#results').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

<!--ENDS HERE-->
      


<!--FORM STARTS HERE-->

 <form method="POST" action="server2.php">

<div class="container">
 
        <div class="row">

    

            <div class="col-md-12 col-md-offset-13">

                    <legend class="text-center">Manage Subjects</legend>

                    <fieldset>
                        <legend>Subject Details</legend>

                                <div class="form-group">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>"></div>

                        <div class="form-group col-md-6">
                            <input type="input" onkeyup="this.value = this.value.replace(/[^a-z/A-Z]/, '')" name="subjname" class="form-control"  placeholder="Enter Subject Name" value="<?php echo $subjname; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" name="subjdesc" class="form-control"  placeholder="Enter Subject Description" value="<?php echo $subjdesc; ?>" required>
                        </div>


                      <div class="form-group col-md-6">
                        <div class="col-sm-2">
                       <label>Subject Time:</label>
                       </div>
                      <div class="col-sm-5">
                       <input class="form-control" type="time" name="subjtimestart" value1="<?php echo $subjtimestart; ?> ">
                       </div>
                      <div class="col-sm-5">
                        <input class="form-control" type="time" name="subjtimeend" class="form-group"  value1="<?php echo $subjtimeend; ?> " required>
                        </div>
                      </div>


                        <div class="form-group col-md-6">
                       <input type="text" name="subjday" class="form-control"  placeholder="Enter Subject Day"  value="<?php echo $subjday; ?>" required>
                        </div>


                         <div class="form-group col-md-6">
                         <select class="form-control" name="term"  value="<?php echo $term; ?>" required>
                        <option selected hidden>Select Subject Term</option>
                                <option>TERM - 1</option>
                                <option>TERM - 2</option>
                                <option>TERM - 3</option>
                          </select>
                        </div>

                          <div class="form-group col-md-6">
                         <select class="form-control" name="school_year"  value="<?php echo $school_year; ?>" required>
                        <option selected hidden>Select Subject Term</option>
                                <option>School Year 2017 - 2018</option>
                                 <option>School Year 2018 - 2019</option>
                                  <option>School Year 2019 - 2020</option>
                          </select>
                        </div>
                       

                         <div class="form-group col-md-6">
                         <select class="form-control" name="course"  value="<?php echo $course; ?>" required>
                        <option selected hidden>Select Subject Courses</option>
                          <optgroup label="COLLEGE COURSES">
                                <option value="BSIT- REG">BSIT - REG</option>
                                <option value="BSIT - NC">BSIT - NC</option>
                                <option value="BSBA - REG">BSBA - REG</option>
                                <option value="BSBA - NC">BSBA - NC</option>
                          </optgroup>
                           <optgroup label="GRADE 11 AND 12 COURSES">
                                <option value="GRADE 11 - ICT">GRADE 11 - ICT</option>
                                <option value="GRADE 11 - ABM">GRADE 11 - ABM</option>
                                <option value="GRADE 11 - HUMSS">GRADE 11 - HUMSS</option>
                                <option value="GRADE 12 - ICT">GRADE 12 - ICT</option>
                                <option value="GRADE 12 - ABM">GRADE 12 - ABM</option>
                                <option value="GRADE 12 - HUMSS">GRADE 12 - HUMSS</option>
                              </optgroup>
                          </select>
                        </div>

                       
                         <div class="form-group col-md-6">
                         <select class="form-control" name="section"  value="<?php echo $section; ?>" required> 
                         <option selected hidden>Select Subject Section</option> 
                 <optgroup label="GRADE 11 - ICT">
                                <option value="ICT - Unix">ICT - Unix</option>
                                <option value="ICT - Vista">ICT - Vista</option>
                 </optgroup>
                 <optgroup label="GRADE 11 - ABM">
                                 <option value="ABM - Henry Sy">ABM - Henry Sy</option>
                 </optgroup>
                 <optgroup label="GRADE 11 - HUMSS">
                                <option value="HUMSS - Sigmund Freud">HUMSS - Sigmund Freud</option>
                 </optgroup>
                 <optgroup label="GRADE 12 - ICT">
                                <option value="ICT - Mark Zuckerburg">ICT - Mark Zuckerburg</option>
                                <option value="ICT - Bill Gates">ICT - Bill Gates</option>
                </optgroup>
                <optgroup label="GRADE 12 - ABM">
                                 <option value="ABM - Steve Jobs">ABM - Steve Jobs</option>
                 </optgroup>
                 <optgroup label="1ST YEAR REG">
                                <option value="BSIT 1-1">BSIT 1-1</option>
                                <option value="BSIT 1-2">BSIT 1-2</option>
                                <option value="BSBA 1-1">BSBA 1-1</option>
                                <option value="BSBA 1-2">BSBA 1-2</option>

                 </optgroup>
                 <optgroup label="2ND YEAR REG">
                                <option value="BSIT 2-1">BSIT 2-1</option>
                                <option value="BSIT 2-2">BSIT 2-2</option>
                                <option value="BSBA 2-1">BSBA 2-1</option>
                                <option value="BSBA 2-2">BSBA 2-2</option>

                </optgroup>
                <optgroup label="3RD YEAR REG">
                                <option value="BSIT 3-1">BSIT 3-1</option>
                                <option value="BSIT 3-2">BSIT 3-2</option>
                                <option value="BSBA 3-1">BSBA 3-1</option>
                                <option value="BSBA 3-2">BSBA 3-2</option>

                </optgroup>
                <optgroup label="1ST YEAR NC">
                                <option value="BSIT 1-1 NC">BSIT 1-1 NC</option>
                                <option value="BSIT 1-2 NC">BSIT 1-2 NC</option>
                                <option value="BSBA 1-1 NC">BSBA 1-1 NC</option>
                                <option value="BSBA 1-2 NC">BSBA 1-2 NC</option>
                 </optgroup>
                 <optgroup label="2ND YEAR">
                                <option value="BSIT 2-1 NC">BSIT 2-1 NC</option>
                                <option value="BSIT 2-2 N">BSIT 2-2 NC</option>
                                <option value="BSBA 2-1 NC">BSBA 2-1 NC</option>
                                <option value="BSBA 2-2 NC">BSBA 2-2 NC</option>
                                
                </optgroup>
                <optgroup label="3RD YEAR">
                                <option value="BSIT 3-1 N">BSIT 3-1 NC</option>
                                <option value="BSIT 3-2 NC">BSIT 3-2 NC</option>
                                <option value=">BSBA 3-1 NC">BSBA 3-1 NC</option>
                                <option value="BSBA 3-2 NC">BSBA 3-2 NC</option>
                </optgroup>
                            </select>
                        </div>

                


                   
                    </fieldset>

<br>
<br>
    <div class="form-group pull-right">
              
              <?php if($edit_state == false): ?>
                   <button type="submit" name="save" class="btn btn-primary">Save Information</button>

          <?php else: ?>
                   <button type="submit" name="update" class="btn btn-primary">Update Information</button>
          
          <?php endif ?>  



    </div>



        </form>

    </div>
 <!--FORM ENDS HERE-->

<!-- NOT EDITED -->


<!--ROWS TABLES-->
<table id="results" class="table">
  <thead>
          <tr>
       
        <th>Subject Name</th>
        <th>Subject Time</th>
        <th row>Subject Day</th>
        <th>Subject Course</th>
        <th>Section</th>
        <th>Term</th>
        <th colspan="3">Actions</th>
          </tr>
  </thead>

            <tbody>

                <?php while ($row = mysqli_fetch_array($results)) { ?>

           <tr>
             
                <td><?php echo $row['subjname'] ?></td>
                 <td><?php echo $row['subjtimestart'] ?></td>
                   <td><?php echo $row['subjtimeend'].' - '.$row['subjday']?></td>
                  <td><?php echo $row['course'] ?></td>
                  <td><?php echo $row['section'] ?></td>
                  <td><?php echo $row['term'] ?></td>
                
                  <td>
                     <a class="btn btn-info btn-sm" href="managesubject.php?editpage=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></a> ||
                  
                     <a class="btn btn-danger btn-sm" href="server2.php?del=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-remove-sign"></a>
                  </td>
         </tr>
               <?php } 
               ?>

            </tbody>

 </table>



</div>
</div>
  
