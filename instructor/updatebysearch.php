<!-- THIS IS FOR ROLL NO. NOT REALLY APPLICABLE IN MY OPINION BECAUSE THE ATTENDANCE HAS ATTENDANCE BY DATE ALREADY -->

<?php

session_start();
//for restriction
if(!$_SESSION["loginuser"]){
  header("location: loginadmin.php");
} else {
 //echo "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>";
} // until here

include ('user_nav.php');
?>
<div class="container">
	<div class="jumbotron">
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "info_db";

$id = "";
$SubjID = "";
$lastname = "";
$middlename = "";
$firstname = "";
$studentnumber = "";
$attendance_status = "";
$date = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


try{
$connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
	echo 'Error';
}

function getPosts() 
{

$posts = array();
$posts[0] = $_POST['id'];
$posts[1] = $_POST['SubjID'];
$posts[2] = $_POST['lastname'];
$posts[3] = $_POST['middlename'];
$posts[4] = $_POST['firstname'];
$posts[5] = $_POST['studentnumber'];
$posts[6] = $_POST['attendance_status'];
$posts[7] = $_POST['date'];
return $posts;

}

if(isset($_POST['search']))
{
	$data = getPosts();

	$search_Query = "SELECT * FROM attendance_records where id = $data[0]";

	$search_Result = mysqli_query($connect, $search_Query);

	if($search_Result) 
	{
		if(mysqli_num_rows($search_Result)) 
		{
			while($row = mysqli_fetch_array($search_Result)) 
			{
				$id = $row['id'];
				$SubjID = $row['SubjID'];
				$lastname = $row['lastname'];
				$middlename = $row['middlename'];
				$firstname = $row['firstname'];
				$studentnumber = $row['studentnumber'];
				$attendance_status = $row['attendance_status'];
				$date = $row['date'];
			}
		}else {
			echo '
				<div class="alert alert-danger">
				  <strong>No data found!
				</strong></div>';
		}

	}else{
		echo 'Result Error';
	}
}


if(isset($_POST['update'])) 
{
	$data = getPosts();
	$update_Query = "UPDATE `attendance_records` SET `SubjID`='$data[1]',`lastname`='$data[2]',`middlename`='$data[3]',`firstname`='$data[4]',`studentnumber`='$data[5]',`attendance_status`='$data[6]',`date`='$data[7]' WHERE `id`='$data[0]'";

	try{
		$update_Query = mysqli_query($connect, $update_Query);

		if($update_Query)
		{
			if(mysqli_affected_rows($connect) > 0)
			{
				echo '                   
			   		<div class="alert alert-success alert-dismissable">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Successfully Updated Record</strong>
		     </div>';

			}else{
				echo '
					<div class="alert alert-danger">
					  <strong> Not Updated.
					</strong></div>';
			}
		}
 } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
	}
}




?>
<div class="container">
	<div class="jumbotron">
 
 <form method="POST" action="updatebysearch.php">

<a href="subjects.php" class="btn btn-primary">Back to subjects</a>
        <div class="row">

            <div class="col-md-12 col-md-offset-13">

                    <legend class="text-center">Update Attendance Status By Roll No.</legend>

 	<div class="form-group col-md-6">
	<label>Search Roll No.</label>
	<input type="number" name="id" value="<?php echo $id; ?>" class="form-control" placeholder="Roll No.">
	</div>

	<div class="form-group col-md-6">
	<label>Subj ID</label>
	<input type="number" name="SubjID" value="<?php echo $SubjID; ?>" class="form-control" placeholder=".">
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
	<label>Enter Attendance Status</label>
	<input type="text" name="attendance_status" value="<?php echo $attendance_status; ?>" class="form-control" placeholder="Attendance Status">
	</div><br />

  <div class="form-group col-md-6">
	<label>Select Date</label>
	<input type="date" name="date" class="form-control" value="<?php echo $date; ?>" placeholder="Date">
	</div><br />

<br />
<div class="form-group pull-right">
<input type="submit" value="Search" class="btn btn-primary" name="search">
<input type="submit" value="Update" class="btn btn-primary" name="update">
</div>
</div>

</form>
</div>
</div>