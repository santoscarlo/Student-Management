<?php
session_start();
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 // "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>"; //
} 
	require_once('dbconnect.php');
	include ('nav.php');
	$upload_image = 'uploads/';
	
// DELETE RECORD //
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];

		//select old photo name from database
		$sql = "select studimg from studenttable where id = ".$id;
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$studimg = $row['studimg'];
			unlink($upload_image.$studimg);
			//delete record from database
			$sql = "delete from studenttable where id=".$id;
			if(mysqli_query($conn, $sql)){
				header('location:view_students.php');
			}
		}
	}
?>


<div class="container">
  <div class="jumbotron"> 

<form>

<a href="manage_student.php" class="btn btn-info pull-right">Register Student</a> 

<br />
<br />

  	<legend align="center">Student Information Record</legend>

	<table class="table table-condensed">
			<thead>
				<tr>
					<!-- <th>Student Image</th> -->
					<th>StudID</th>
					<th>Student Name</th>
					<th>Status</th>
					<th>Section</th>
					<th>Course</th>
					<th>Year level</th>
					<th>Actions</th>
				</tr>

			</thead>
			<tbody>
			<?php
				$sql = "select * from studenttable";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result)){
					while($row = mysqli_fetch_assoc($result)){
			?>
				<tr>


		<!-- OLD  NOT LOADING SA BABA -->		<!-- 	<td><img src="<?php// echo $upload_image.$row['studimg'] ?>" height ="100" width="100" width></td> -->

 
<!-- 
			 <td><?php //echo '<img height ="100" width="100" src="data:image/jpeg;base64,'.base64_encode($row['studimg'] ).'"/>' ?> </td>

 -->
					<td><?php echo $row['StudID'] ?></td>
                 	<td><?php echo $row['lastname']. ' '. $row['firstname'] . ', '.  $row['middlename'] ?></td>
                 	<td><?php echo $row['statusofstud'] ?></td>
                 	<td><?php echo $row['section'] ?></td>
                  	<td><?php  echo $row['course'] ?></td>
                  	<td><?php echo $row['yearlevel'] ?></td>
                  	

					<td>
						<a class="btn btn-info" href="edit_students.php?id=<?php echo $row['id'] ?>">
							<span class="glyphicon glyphicon-edit"></span></a>
						
						<a class="btn btn-danger" href="view_students.php?delete=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure to delete this record?')">
							<span class="glyphicon glyphicon-remove-sign"></span></a>
					</td>
				</tr>
			<?php
					}
				}
			?>
			</tbody>
	</table>
</form>
</div>
</div>

<script>

$("table").DataTable();

$('.dataTables_filter').addClass('pull-right');

// WIDER SEARCH BUTTON
 $('.dataTables_filter input[type="search"]').
  css({'width':'200px','display':'inline-block'});

</script>