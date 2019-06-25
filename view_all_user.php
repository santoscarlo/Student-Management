<?php

session_start();
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 // "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>"; //
} 

include ('headersubj.php');
include ('dbconnect.php');

?>



<div class="container">

<div class="panel panel-default">

<div class="panel panel-heading">
<h2 align="center"> <?php echo 'Subject Name: '.$_GET['subjname']
			 .'<br><br>Subject ID:'.$_GET['id']
			.'</div>'
			 ?> </h2>
</div></div>


			<?php if(isset($_GET['add_attendance']))
			{
				// DISPLAY SUBJECT NAME IN THE ATTENDANCE FORM
				 $subjname = $_GET['subjname'];
				 $subjID = $_GET['id'];
				 
			

}
			?>


<div class="container">


<div class="panel panel-default">

<div class="panel panel-heading">
<h2>
<a class="btn btn-info" href="index.php">Back</a>
<!-- <a class="btn btn-info pull-right" href="update.php" id="update">Update Attendance Status of Student</a>
 --></h2>

<div class="panel panel-default">





<div class="panel panel-body">


<table class="table">

				<th>No. of Attendance</th>
				<th>Date</th>
				<th>Show Attendance</th>	


		<?php 
		$subjID = $_GET['id'];
		$result= mysqli_query($conn, "SELECT * FROM attendance_records WHERE SubjID = '$subjID' GROUP BY date ORDER BY date DESC");

		$noofattendance=0; //represents number of attendance // 


			while($row=mysqli_fetch_array($result))
			{
				$noofattendance++;

				?>

		<tr>
		<td><?php echo $noofattendance; ?> </td>
		<td><?php echo $row['date']; ?> </td>
		<td>
				<form action="show_attendance_user.php" method="POST">
				<input type="submit" name="show_attendance_user" value="Show Attendance" class="btn btn-primary" >	
				<input type="hidden" value="<?php echo $row['date'] ?>" name="date">
				<input type="hidden" value="<?php echo $row['SubjID'] ?>" name="SubjID">

					
				</form>



		</td>



</tr>

<?php

}

?>


</table>




</div>
</div>
