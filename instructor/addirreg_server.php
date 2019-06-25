<?php
	//!!!THIS SERVERPAGE is for the manage student page!!!// 
	session_start();


		// initialize variables
		$StudID = "";
		$firstname = "";
		$middlename = "";
		$lastname = "";
		
		$statusofstud = "";
		$section = "";
		$course = "";
		$id = 0;
		$edit_state = false;


		// connect to database
	$db = mysqli_connect('localhost','root','','info_db');

		// if save button is clicked for adding

	if (isset($_POST['save'])) {

		//$id = $_POST['id'];
		$StudID = $_POST['StudID'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$section = $_POST['section'];
		$statusofstud = $_POST['statusofstud'];
		$course = $_POST['course'];



// // FOR VALIDATION OF STUDID //
// 		$query = "SELECT * from studenttable where StudID = '$StudID'";

// 		$result = mysqli_query($db, $query);

// 		if(mysqli_num_rows($result) > 0)
// 		{
// 			echo $_SESSION['msgstud'] = '<strong>Student ID already exist!</strong>';
// 			header('location: managestudent.php');
// 		}
// 		else
// 		{

		
 		$query = "INSERT INTO studenttable(StudID, firstname, middlename, lastname, section, course, statusofstud) VALUES ('$StudID', '$firstname','$middlename','$lastname', '$section', '$course', '$statusofstud')";
	
		mysqli_query($db, $query);

		$_SESSION['msg2'] ='<span class="glyphicon glyphicon-file"></span><strong> Successfully Added Record!</strong>';
		header('location: add_irreg.php'); // redirect to managa student page after inserting record
}
	 



		// update records

	if (isset($_POST['update'])) {

		$StudID = mysqli_real_escape_string($db, $_POST["StudID"]);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$middlename = mysqli_real_escape_string($db, $_POST['middlename']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);

		$statusofstud = mysqli_real_escape_string($db, $_POST['statusofstud']);

		$section = mysqli_real_escape_string($db, $_POST['section']);
		$course = mysqli_real_escape_string($db, $_POST['course']);
		$id = mysqli_real_escape_string($db, $_POST['id']);


		mysqli_query($db, "UPDATE studenttable SET StudID='$StudID', firstname='$firstname', middlename='$middlename', lastname='$lastname', section='$section', course='$course', statusofstud='$statusofstud'  WHERE id=$id");

			$_SESSION['msg2'] = '<span class="glyphicon glyphicon-check"></span><strong> Successfully Updated Record!</strong>';
			header('location: add_irreg.php');
	}



		// delete records

		if(isset($_GET['del'])) {

			$id = $_GET['del'];

			mysqli_query($db, "DELETE FROM studenttable WHERE id=$id");
			

			$_SESSION['msg11'] = '<span class="glyphicon glyphicon-remove"></span><strong> Deleted Record!</strong>';
			
			header('location: add_irreg.php');
		}
	 	


	 	// retrieve all records



	


?>