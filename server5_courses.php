<?php
session_start();
	//!!!THIS SERVERPAGE is for the manage instructor page!!!// 

		// initialize variables
		
		$courses = "";
		$description = "";
		$id = 0;
		$edit_state = false;


		// connect to database
	$db = mysqli_connect('localhost','root','','info_db');

		// if save button is clicked for adding

	if (isset($_POST['save'])) {

		$courses = $_POST['courses'];
		$description = $_POST['description'];

// VALIDATION FOR USERNAME //
		$query = "SELECT * from coursestable where courses = '$courses'";

		$result = mysqli_query($db, $query);

		if(mysqli_num_rows($result) > 0)
		{
			echo $_SESSION['msgusername'] = '<strong>Section already exist!</strong>';
			header('location: managecourse.php');
		}
		else
		{
		
		

		$query = "INSERT INTO coursestable(courses, description) VALUES ('$courses', '$description')";

		mysqli_query($db, $query);
		$_SESSION['msg'] = '<span class="glyphicon glyphicon-file"></span><strong> Successfully Added Record!</strong>';
		header('location: managecourse.php'); // redirect to manageinstructor page after inserting record
}
	}

		// update records

	if (isset($_POST['update'])) {

		$description = mysqli_real_escape_string($db, $_POST['description']);
		$courses = mysqli_real_escape_string($db, $_POST['courses']);
		$id = mysqli_real_escape_string($db, $_POST['id']);

		mysqli_query($db, "UPDATE coursestable SET courses='$courses', description='$description' WHERE id=$id");

			$_SESSION['msg'] = '<span class="glyphicon glyphicon-check"></span><strong> Successfully Updated Record!</strong>';
			header('location: managecourse.php');
}
		


		// delete records

		if(isset($_GET['del'])) {

			$id = $_GET['del'];

			mysqli_query($db, "DELETE FROM coursestable WHERE id=$id");
			


			$_SESSION['msg11'] = '<span class="glyphicon glyphicon-remove"></span><strong> Deleted Record!</strong>';
			header('location: managecourse.php');
		}
	 	
	 	// retrieve all records

	$results = mysqli_query($db, "SELECT * FROM coursestable ORDER BY id DESC");

	//
	


?>