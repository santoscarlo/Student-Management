<?php
	//!!!THIS SERVERPAGE is for the manage student page!!!// 
	session_start();


		// initialize variables
		$StudID = "";
		$RFIDStudNo = "";
		$firstname = "";
		$middlename = "";
		$lastname = "";
		$gender = "";
		
		
		$contactnum = "";
		$section = "";
		$statusofstud = "";
		$yearlevel = "";
		$course = "";
		$parentcontactnum = "";
		$id = 0;
		$edit_state = false;


		// connect to database
	$db = mysqli_connect('localhost','root','','info_db');

		// if save button is clicked for adding

	if (isset($_POST['save'])) {

		//$id = $_POST['id'];
		$StudID = $_POST['StudID'];
		$RFIDStudNo = $_POST['RFIDStudNo'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$gender = $_POST['gender'];

		$file = addslashes(file_get_contents($_FILES['studimg']['tmp_name']));
		
		$contactnum  = $_POST['contactnum'];
		$section = $_POST['section'];
		$statusofstud = $_POST['statusofstud'];
		
		$yearlevel = $_POST['yearlevel'];
		$course = $_POST['course'];
		$parentcontactnum = $_POST['parentcontactnum'];



// FOR VALIDATION OF STUDID //
		$query = "SELECT * from studenttable where StudID = '$StudID'";

		$result = mysqli_query($db, $query);

		if(mysqli_num_rows($result) > 0)
		{
			echo $_SESSION['msgstud'] = '<strong>Student ID already exist!</strong>';
			header('location: managestudent.php');
		}
		else
		{

		
 		$query = "INSERT INTO studenttable(StudID, RFIDStudNo, firstname, middlename, lastname, gender, studimg, contactnum, statusofstud, section, yearlevel, course, parentcontactnum) VALUES ('$StudID','$RFIDStudNo','$firstname','$middlename','$lastname','$gender', '$file','$contactnum','$statusofstud', '$section', '$yearlevel','$course','$parentcontactnum')";
	
		mysqli_query($db, $query);

		$_SESSION['msg2'] ='<span class="glyphicon glyphicon-file"></span><strong> Successfully Added Record!</strong>';
		header('location: managestudent.php'); // redirect to managa student page after inserting record
}
	 }



		// update records

	if (isset($_POST['update'])) {

		$StudID = mysqli_real_escape_string($db, $_POST["StudID"]);
		$RFIDStudNo  = mysqli_real_escape_string($db, $_POST["RFIDStudNo"]);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$middlename = mysqli_real_escape_string($db, $_POST['middlename']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);

		

		$contactnum  = mysqli_real_escape_string($db, $_POST['contactnum']);
		$statusofstud = mysqli_real_escape_string($db, $_POST['statusofstud']);
		$section = mysqli_real_escape_string($db, $_POST['section']);
		$yearlevel = mysqli_real_escape_string($db, $_POST['yearlevel']);
		$course = mysqli_real_escape_string($db, $_POST['course']);
		$parentcontactnum  = mysqli_real_escape_string($db, $_POST['parentcontactnum']);
		$id = mysqli_real_escape_string($db, $_POST['id']);


		mysqli_query($db, "UPDATE studenttable SET StudID='$StudID', RFIDStudNo='$RFIDStudNo', firstname='$firstname', middlename='$middlename', lastname='$lastname', gender='$gender',contactnum='$contactnum', statusofstud='$statusofstud', section='$section', yearlevel='$yearlevel' ,course='$course', parentcontactnum='$parentcontactnum' WHERE id=$id");

			$_SESSION['msg2'] = '<span class="glyphicon glyphicon-check"></span><strong> Successfully Updated Record!</strong>';
			header('location: managestudent.php');
	}



		// delete records

		if(isset($_GET['del'])) {

			$id = $_GET['del'];

			mysqli_query($db, "DELETE FROM studenttable WHERE id=$id");
			

			$_SESSION['msg11'] = '<span class="glyphicon glyphicon-remove"></span><strong> Deleted Record!</strong>';
			
			header('location: viewstudent.php');
		}
	 	


	 	// retrieve all records



	


?>