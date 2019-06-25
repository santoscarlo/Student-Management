<?php
	//!!!THIS SERVERPAGE is for the manage subject page!!!// 
	session_start();

		// initialize variables
		$subjname = "";
		$subjcode = "";
		$subjtimestart = "";
		$subjtimeend = "";
		$subjday = "";
		$course = "";
		$id = 0;
		$edit_state = false;
		$section = "";
		$subjdesc = "";
		$section = "";
		$term = "";


		// connect to database
	$db = mysqli_connect('localhost','root','','info_db');

		// if save button is clicked for adding

	if (isset($_POST['save'])) {

		$subjname = $_POST['subjname'];
		$subjcode = $_POST['subjcode'];
		$subjdesc = $_POST['subjdesc'];
		$subjtimestart = $_POST['subjtimestart'];
		$subjtimeend = $_POST['subjtimeend'];
		$subjday = $_POST['subjday'];
		$course = $_POST['course'];
		$section = $_POST['section'];
		$term = $_POST['term'];
		$school_year = $_POST['school_year'];
		

		$query = "INSERT INTO subjecttable(subjname, subjcode, subjdesc, subjtimestart, subjtimeend, subjday, course, section, term, school_year) VALUES ('$subjname', '$subjcode', '$subjdesc', '$subjtimestart', '$subjtimeend', '$subjday','$course','$section','$term','$school_year')";
		mysqli_query($db, $query);
		$_SESSION['msg2'] = '<span class="glyphicon glyphicon-file"></span><strong> Successfully Added Record!</strong>';
		header('location: managesubject.php'); // redirect to manageinstructor page after inserting record

	}

		// update records

	if (isset($_POST['update'])) {
		
		$subjname  = mysqli_real_escape_string($db, $_POST["subjname"]);
		$subjcode  = mysqli_real_escape_string($db, $_POST["subjcode"]);
		$subjdesc = mysqli_real_escape_string($db,$_POST["subjdesc"]);
		$subjtimestart = mysqli_real_escape_string($db,$_POST["subjtimestart"]);
		$subjtimeend = mysqli_real_escape_string($db,$_POST["subjtimeend"]);
		$subjday = mysqli_real_escape_string($db,$_POST["subjday"]);
		$course  = mysqli_real_escape_string($db,$_POST["course"]);
		$id = mysqli_real_escape_string($db,$_POST["id"]);
		$section = mysqli_real_escape_string($db,$_POST["section"]);
		$term = mysqli_real_escape_string($db,$_POST["term"]);
		$school_year = mysqli_real_escape_string($db,$_POST["school_year"]);

		mysqli_query($db, "UPDATE subjecttable SET subjname='$subjname', subjcode='$subjcode', subjdesc='$subjdesc', subjtimestart='$subjtimestart', subjtimeend='$subjtimeend', subjday='$subjday', course='$course', section='$section', term='$term', school_year='$school_year' WHERE id=$id");

			$_SESSION['msg2'] = '<span class="glyphicon glyphicon-check"></span><strong> Successfully Updated Record!</strong>';
			header('location: managesubject.php');
	}



		// delete records

		if(isset($_GET['del'])) {

			$id = $_GET['del'];

			mysqli_query($db, "DELETE FROM subjecttable WHERE id=$id");
			
			$_SESSION['msg11'] = '<span class="glyphicon glyphicon-remove"></span><strong> Deleted Record!</strong>';
			
			header('location: managesubject.php');
		}
	 	


	 	// retrieve all records

	$results = mysqli_query($db,"SELECT * FROM `subjecttable` ORDER BY id DESC");

	


?>