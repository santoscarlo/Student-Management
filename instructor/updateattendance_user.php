<?php
session_start();
//for restriction
if(!$_SESSION["loginuser"]){
  header("location: loginadmin.php");
} else {
 //echo "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>";
} // until here

include ('user_nav.php');

		$studentnumber = "";
		$lastname = "";
		$middlename = "";
		$firstname = "";
		$attendance_status = "";
		$date = "";
		$id = 0;
		$edit_state = false;
		
	$db = mysqli_connect('localhost','root','','info_db');


  if(isset($_GET['edit'])) {

    $id = $_GET['edit'];
    $edit_state = true;

          $rec = mysqli_query($db, "SELECT * FROM attendance_records WHERE id=$id");
         
          $record = mysqli_fetch_array($rec);
           $studentnumber = $record['studentnumber'];
          $lastname = $record['lastname'];
          $middlename = $record['middlename'];
          $firstname = $record['firstname'];
          $attendance_status = $record['attendance_status'];
           $date = $record['date'];
          $id = $record['id'];
  }
		// update records

	if (isset($_POST['update'])) {

		$studentnumber = mysqli_real_escape_string($db, $_POST["studentnumber"]);
		$lastname  = mysqli_real_escape_string($db, $_POST["lastname"]);
		$middlename = mysqli_real_escape_string($db, $_POST['middlename']);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$attendance_status = mysqli_real_escape_string($db, $_POST['attendance_status']);
		$date = mysqli_real_escape_string($db, $_POST['date']);

		$id = mysqli_real_escape_string($db, $_POST['id']);


		mysqli_query($db, "UPDATE attendance_records SET studentnumber='$studentnumber', lastname='$lastname', middlename='$middlename', firstname='$firstname', attendance_status='$attendance_status', date='$date' WHERE id=$id");

			$_SESSION['updatealert'] = '<span class="glyphicon glyphicon-edit"></span><strong> Successfully Updated Record!</strong>';
			header('refresh:2; updateattendance_user.php');
	}


?>

<div class="container">
	<div class="jumbotron">

       <?php if(isset($_SESSION['updatealert'])): ?>
                      
    <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     <?php

                            echo $_SESSION['updatealert'];
                            unset($_SESSION['updatealert']);

                            ?>
    </div>

                  <?php endif ?>

<form action="updateattendance_user.php" method="POST">

	<div class="container">
	<div class="jumbotron">
        <div class="row">

<a href="subjects.php" class="btn btn-primary">Back to subjects</a>
                    <legend class="text-center">Update Attendance Status</legend>

 	<div class="form-group col-md-6">
	<label>Roll No.</label>
	<input type="number" name="id" value="<?php echo $id; ?>" class="form-control" placeholder="Roll No.">
	</div>

  	<div class="form-group col-md-6">
	<label>Student Number</label>
	<input class="form-control" type="text" name="studentnumber" value="<?php echo $studentnumber; ?>" placeholder="studentnumber" readonly>
	</div><br />

  <div class="form-group col-md-6">
	<label>Lastname</label>
	<input class="form-control" type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Lastname" readonly>
	</div><br />

  <div class="form-group col-md-6">
	<label>Middlename</label>
	<input class="form-control" type="text" name="middlename" value="<?php echo $middlename; ?>" placeholder="middlename" readonly>
	</div><br />

  <div class="form-group col-md-6">
	<label>Firstname</label>
	<input class="form-control" type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="firstname" readonly>
	</div><br />

 <div class="form-group col-md-6">
	<label>Select Attendance Status</label>
	<select name="attendance_status"  value="<?php echo $attendance_status; ?>" class="form-control">
	<option value="Present">Present</option>
	<option value="Absent">Absent</option>
	<option value="Late">Late</option>
	<option value="Excuse">Excuse</option>
</select>
	</div><br />

  <div class="form-group col-md-6">
	<label>Select Date</label>
	<input type="date" name="date" class="form-control" value="<?php echo $date; ?>" placeholder="Date">
	</div><br />

<br />
	 <div class="form-group pull-right">
              
              <?php if($edit_state == false): ?>
              <!--      <button type="submit" name="save" class="btn btn-primary">Save Record</button> -->

          <?php else: ?>
                   <button type="submit" name="update" class="btn btn-primary">Update Record</button>
          
          <?php endif ?>  