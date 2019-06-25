<?php
session_start();
	//!!!THIS SERVERPAGE is for the manage instructor page!!!// 

		// initialize variables
		
		$section = "";
		$description = "";
		$id = 0;
		$edit_state = false;


		// connect to database
	$db = mysqli_connect('localhost','root','','info_db');

		// if save button is clicked for adding

	if (isset($_POST['save'])) {

		$section = $_POST['section'];
		$description = $_POST['description'];

// VALIDATION FOR USERNAME //
		$query = "SELECT * from sectiontable where section = '$section'";

		$result = mysqli_query($db, $query);

		if(mysqli_num_rows($result) > 0)
		{
			echo $_SESSION['msgusername'] = '<strong>Section already exist!</strong>';
			header('location: managesection.php');
		}
		else
		{
		
		

		$query = "INSERT INTO sectiontable(section, description) VALUES ('$section', '$description')";

		mysqli_query($db, $query);
		$_SESSION['msg'] = '<span class="glyphicon glyphicon-file"></span><strong> Successfully Added Record!</strong>';
		header('location: managesection.php'); // redirect to manageinstructor page after inserting record
}
	}

		// update records

	if (isset($_POST['update'])) {

		$description = mysqli_real_escape_string($db, $_POST['description']);
		$section = mysqli_real_escape_string($db, $_POST['section']);
		$id = mysqli_real_escape_string($db, $_POST['id']);

		mysqli_query($db, "UPDATE sectiontable SET section='$section', description='$description' WHERE id=$id");

			$_SESSION['msg'] = '<span class="glyphicon glyphicon-check"></span><strong> Successfully Updated Record!</strong>';
			header('location: managesection.php');
}
		


		// delete records

		if(isset($_GET['del'])) {

			$id = $_GET['del'];

			mysqli_query($db, "DELETE FROM sectiontable WHERE id=$id");
			


			$_SESSION['msg11'] = '<span class="glyphicon glyphicon-remove"></span><strong> Deleted Record!</strong>';
			header('location: managesection.php');
		}
	 	
	 	// retrieve all records

	$results = mysqli_query($db, "SELECT * FROM sectiontable ORDER BY id DESC");

	//
	


?>