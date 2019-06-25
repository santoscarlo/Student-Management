<?php
session_start();
	//!!!THIS SERVERPAGE is for the manage instructor page!!!// 

		// initialize variables
		
		$school_year = "";
		$id = 0;
		$edit_state = false;


		// connect to database
	$db = mysqli_connect('localhost','root','','info_db');

		// if save button is clicked for adding

	if (isset($_POST['save'])) {

		$school_year = $_POST['school_year'];
		$description = $_POST['description'];

// VALIDATION FOR YEAR //
		$query = "SELECT * from schoolyeartable where school_year = '$school_year'";

		$result = mysqli_query($db, $query);

		if(mysqli_num_rows($result) > 0)
		{
			echo $_SESSION['msgusername'] = '<strong>Section already exist!</strong>';
			header('location: manageschoolyear.php');
		}
		else
		{
		
		

		$query = "INSERT INTO schoolyeartable(school_year) VALUES ('$school_year')";

		mysqli_query($db, $query);
		$_SESSION['msg'] = '<span class="glyphicon glyphicon-file"></span><strong> Successfully Added Record!</strong>';
		header('location: manageschoolyear.php'); // redirect to manageinstructor page after inserting record
}
	}

		// update records

	if (isset($_POST['update'])) {

		$school_year = mysqli_real_escape_string($db, $_POST['school_year']);
		$id = mysqli_real_escape_string($db, $_POST['id']);

		mysqli_query($db, "UPDATE schoolyeartable SET school_year='$school_year' WHERE id=$id");

			$_SESSION['msg'] = '<span class="glyphicon glyphicon-check"></span><strong> Successfully Updated Record!</strong>';
			header('location: manageschoolyear.php');
}
		


		// delete records

		if(isset($_GET['del'])) {

			$id = $_GET['del'];

			mysqli_query($db, "DELETE FROM schoolyeartable WHERE id=$id");
			


			$_SESSION['msg11'] = '<span class="glyphicon glyphicon-remove"></span><strong> Deleted Record!</strong>';
			header('location: managecourse.php');
		}
	 	
	 	// retrieve all records

	$results = mysqli_query($db, "SELECT * FROM yearleveltable ORDER BY yearlevel_id DESC");

	//
	


?>