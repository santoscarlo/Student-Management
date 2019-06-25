<?php
session_start();

if(!$_SESSION["loginuser"]){
  header("location: loginpage.php");
}

include ('user_nav.php');
include ('dbcon.php');




// $update=0;

// if(isset($_POST['edit'])) 
// 	{


// 		$date = date("Y-m-d");
// 		$records = mysqli_query($conn, "SELECT * FROM attendance_records WHERE SubjID = '$subjID'");;
// 		$num = mysqli_num_rows($records);

// 		if($num) 
// 		{
// 					foreach ($_POST['attendance_status'] as  $id=>$attendance_status)  {

// 						$lastname = $_POST['lastname'] [$id];
// 						$firstname = $_POST['firstname'] [$id];
// 						$middlename = $_POST['middlename'] [$id];
// 						$StudID = $_POST['StudID'] [$id];

// 				//check here,
// 						$result = mysqli_query($conn, "UPDATE attendance_records set lastname='$lastname', firstname='$firstname', 'middlename='$middlename', studentnumber= '$StudID', attendance_status='$attendance_status'
// 							where date='$date';
// 							");

// 						if($result)
// 						 {
// 							$update=1;
// 						}
// 					}

// 		}
	// }



?>
<!-- <?php if($update) { ?>
<div class="alert alert-success"><strong>success!</strong> stud attendance updated </div>
<?php } ?> -->
<!--END-->




<div class="container">

<div class="panel panel-default">

<div class="panel panel-heading">
<h2 align="center"> 


      
<div class=""><img src="img/logo1.png" align="left" width="199px" height="100"/></div>
<div class="text">
Subject ID: <?php echo $_POST['SubjID']?>
<br />
<br />
Date: <?php
echo $_POST['date'];?> </h2>

<?php echo 

 '<div class="text2">Instructor Name: '.$_SESSION['loginuser'].' </div>'; ?>


</div>

<div class="panel panel-default">

<div class="panel panel-heading">
<h2>
<a class="btn btn-info" href="homepage.php" id="back">Back</a>
<a class="btn btn-info pull-right" id="printpagebutton" onclick="printpage()">Print this page</a></div>






<div class="panel panel-body">



		<form action="homepage.php" method="POST">

			<table class="table">
			<tr>
			<th>Roll No.</th>
			<th>No.</th>
			<th>Student Number</th>
			<th>Student Name</th>
			<th>Attendance Status</th>
			<th>Date</th>
			<th id="hide">Edit</th>
			</tr>

<?php

  $conn = mysqli_connect('localhost','root','','info_db');
	$result= mysqli_query($conn, "SELECT * FROM attendance_records WHERE SubjID = '".$_POST['SubjID']."' AND date = '".$_POST['date']."' ORDER BY lastname ASC");

$No=0; //count num // 

$counter = 0;

while($row=mysqli_fetch_array($result))
{
	$No++;

	?>

<tr>
<td><?php echo $row['id']; ?> </td>
<td><?php echo $No; ?> </td>
<td><?php echo $row['studentnumber']; ?> </td>
<td><?php echo $row['lastname'].', '.$row['firstname'].' '.$row['middlename']; ?> </td>


<td><?php echo $row['attendance_status'];?></td>

<td><?php echo $row['date'];?></td>

<td id="updatebutton"><a class="btn btn-info btn-sm" href="updateattendance_user.php?edit=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></a></span></td>
</tr>

<?php
$counter++;
}

?>
</table>
</form>

</div>


</div>


</div>
</div>

<script> // Print
function printpage() {

    //Get the print button and put it into a variable
    var printButton = document.getElementById("printpagebutton");
 	var back = document.getElementById("back");
 	var updatebutton = document.getElementById("updatebutton");
    //Set the button visibility to 'hidden' 
    printButton.style.visibility = 'hidden';
    back.style.visibility = 'hidden';
    updatebutton.style.visibility = 'hidden';
    //Print the page content
    window.print()

    //Restore button visibility
    printButton.style.visibility = 'visible';
    back.style.visibility = 'visible';
    updatebutton.style.visibility = 'visible';
}
 </script>


