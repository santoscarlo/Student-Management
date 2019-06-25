<?php
session_start();
	//!!!THIS SERVERPAGE is for the manage dependent dropdown page!!!// 

		// initialize variables
		
		$course = "";
		$yearlevel = "";
		$section = "";
		$id = 0;
		$edit_state = false;


		// connect to database
	$db = mysqli_connect('localhost','root','','info_db');

		// if save button is clicked for adding

	if (isset($_POST['save'])) {

		$course  = $_POST['course'];
		$yearlevel = $_POST['yearlevel'];
		$section = $_POST['section'];


// VALIDATION FOR YEAR //
		$query = "SELECT * from course_yearlevel_section where course = '$course' AND section = '$section' and yearlevel = '$yearlevel'";

		$result = mysqli_query($db, $query);

		if(mysqli_num_rows($result) > 0)
		{
			echo $_SESSION['msgusername'] = '<strong>Data already exist!</strong>';
			header('location: managedropdown.php');
		}
		else
		{
		
		

		$query = "INSERT INTO course_yearlevel_section(course, yearlevel, section) VALUES ('$course', '$yearlevel', '$section')";

		mysqli_query($db, $query);
		$_SESSION['msg'] = '<span class="glyphicon glyphicon-file"></span><strong> Successfully Added Record!</strong>';
		header('location: managedropdown.php'); // redirect to manageinstructor page after inserting record
}
	}

		// update records

	if (isset($_POST['update'])) {

		$course = mysqli_real_escape_string($db, $_POST['course']);
		$yearlevel = mysqli_real_escape_string($db, $_POST['yearlevel']);
		$section = mysqli_real_escape_string($db, $_POST['section']);
		$id = mysqli_real_escape_string($db, $_POST['id']);

		mysqli_query($db, "UPDATE course_yearlevel_section SET course='$course', yearlevel='$yearlevel', section = '$section' WHERE id=$id");

			$_SESSION['msg'] = '<span class="glyphicon glyphicon-check"></span><strong> Successfully Updated Record!</strong>';
			header('location: managedropdown.php');
}
		


		// delete records

		if(isset($_GET['del'])) {

			$id = $_GET['del'];

			mysqli_query($db, "DELETE FROM course_yearlevel_section WHERE id=$id");
			


			$_SESSION['msg11'] = '<span class="glyphicon glyphicon-remove"></span><strong> Deleted Record!</strong>';
			header('location: managedropdown	.php');
		}
	 	
	 	// retrieve all records

	$results = mysqli_query($db, "SELECT * FROM course_yearlevel_section ORDER BY id DESC");

	//
	


?>