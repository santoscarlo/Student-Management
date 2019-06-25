<?php
session_start();
if(!$_SESSION["submit"]){
  header("location: loginpage.php");
}
include ('nav.php');
include ('dbconnect.php');
?>





<div class="container">
  <div class="jumbotron">

                <?php  $results = mysqli_query($conn, "SELECT * FROM subjecttable where id= '".$_GET['id']."'");

                  while ($row = mysqli_fetch_assoc($results)):
    ?>


<div class="container">
 <a href="index.php" class="btn btn-primary">Back</a>
        <div class="row">

            <div class="col-md-12 col-md-offset-13">

                    <legend class="text-center">Subject Details</legend>

                    <fieldset>
   <div class="form-group col-md-6">
  <label>Subject ID</label>
  <input type="form-control" name="id" value="<?php echo $row['id']; ?>" class="form-control" readonly>
  </div>


    <div class="form-group col-md-6">
  <label>Subject Name</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['subjname']; ?>" readonly>
  </div><br />

    <div class="form-group col-md-6">
  <label>Subject Code</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['subjcode']; ?>" readonly>
  </div><br />

   <div class="form-group col-md-6">
  <label>Subject Description</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['subjdesc']; ?>"  readonly>
  </div><br />


<div class="form-group col-md-6">
  <label>Subject Time</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo  $row['subjtimestart'].' - '.$row['subjtimeend']; ?>" placeholder="studentnumber" readonly>
  </div><br />


 <div class="form-group col-md-6">
  <label>Subject Day</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['subjday']; ?>" readonly>
  </div><br />


 <div class="form-group col-md-6">
  <label>Subject Course</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['course']; ?>" readonly>
  </div><br />


<div class="form-group col-md-6">
  <label>Section</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['section']; ?>"  readonly>
  </div><br />



<div class="form-group col-md-6">
  <label>Subject Term</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['term']; ?>" readonly>
  </div><br />



<div class="form-group col-md-6">
  <label>Student Number</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['school_year']; ?>" placeholder="studentnumber" readonly>
  </div><br />



<div class="form-group col-md-6">
  <label>Instructor Name</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['instructorname']; ?>" readonly>
  </div><br />

<div class="form-group col-md-6">
  <label>Year Level</label>
  <input class="form-control" type="text" name="studentnumber" value="<?php echo $row['yearlevel']; ?>"  readonly>
  </div><br />



<?php endwhile; ?>
