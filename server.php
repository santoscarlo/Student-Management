<?php
session_start();
	//!!!THIS SERVERPAGE is for the manage instructor page!!!// 

		// initialize variables
		$username = "";
		$password = "";
		$fullname = "";
		$usertype = "";
		$UserID = 0;
		$edit_state = false;


		// connect to database
	$db = mysqli_connect('localhost','root','','info_db');

		// if save button is clicked for adding

	if (isset($_POST['save'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		$usertype = $_POST['usertype'];



// VALIDATION FOR USERNAME //
		$query = "SELECT * from usertable where username = '$username'";

		$result = mysqli_query($db, $query);

		if(mysqli_num_rows($result) > 0)
		{
			echo $_SESSION['msgusername'] = '<strong>Username already exist!</strong>';
			header('location: manageinstructor.php');
		}
		else
		{
		
		

		$query = "INSERT INTO usertable(username, password, fullname, usertype) VALUES ('$username','$password','$fullname','$usertype')";

		mysqli_query($db, $query);
		$_SESSION['msg'] = '<span class="glyphicon glyphicon-file"></span><strong> Successfully Added Record!</strong>';
		header('location: manageinstructor.php'); // redirect to manageinstructor page after inserting record
}
	}

		// update records

	if (isset($_POST['update'])) {

		$username = mysqli_real_escape_string($db, $_POST["username"]);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$fullname = mysqli_real_escape_string($db, $_POST['fullname']);
		$usertype = mysqli_real_escape_string($db, $_POST['usertype']);
		$UserID = mysqli_real_escape_string($db, $_POST['UserID']);

		mysqli_query($db, "UPDATE usertable SET username='$username', password='$password', fullname='$fullname', usertype='$usertype' WHERE UserID=$UserID");

			$_SESSION['msg'] = '<span class="glyphicon glyphicon-check"></span><strong> Successfully Updated Record!</strong>';
			header('location: manageinstructor.php');
}
		


		// delete records

		if(isset($_GET['del'])) {

			$UserID = $_GET['del'];

			mysqli_query($db, "DELETE FROM usertable WHERE UserID=$UserID");
			


			$_SESSION['msg11'] = '<span class="glyphicon glyphicon-remove"></span><strong> Deleted Record!</strong>';
			header('location: manageinstructor.php');
		}
	 	
	 	// retrieve all records

	$results = mysqli_query($db, "SELECT * FROM usertable ORDER BY UserID DESC");

	//
	


?>