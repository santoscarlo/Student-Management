<?php 
session_start();
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 // "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>"; //
} 

include ('header.php');
?>

<div class="container">

<div class="panel panel-default">

<div class="panel panel-heading">
<h2 align="center"> List of Reports </h2>
</div></div>


<div class="jumbotron">

	<table  class="table">

		<tr>
			
			<th>List</th>
			<th>Buttons</th>

		</tr>



 <tr>
    <td>SF2 Basis Report  List</td>
    <td><a href="sf2basisreport.php" class="btn btn-info">VIEW/SEARCH</a></td>
  </tr>

 <tr>
    <td>Search Visitor Monitoring Logs  List</td>
    <td><a href="visitormonitoringlist.php" class="btn btn-info">VIEW/SEARCH</a></td>
  </tr>

 <tr>
    <td>Search InterBranch Visitor Monitoring Logs  List</td>
    <td><a href="interbranchvisitormonitoringlist.php" class="btn btn-info">VIEW/SEARCH</a></td>
  </tr>

 <tr>
    <td>Search College Monitoring Logs  List</td>
    <td><a href="collegemonitoringlist.php" class="btn btn-info">VIEW/SEARCH</a></td>
  </tr>


 <tr>
    <td>Search SHS Student Monitoring Logs  List</td>
    <td><a href="shsmonitoringlist.php" class="btn btn-info">VIEW/SEARCH</a></td>
  </tr>

  <tr>
    <td>Search Attendance  List</td>
    <td><a href="searchattendancereport.php" class="btn btn-info">VIEW/SEARCH</a></td>
  </tr>

  <tr>
  	<td>Subject List</td>
  	<td><a href="subjectlist.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>

  <tr>
  	<td>Subject loaded to instructor list</td>
  	<td><a href="subjectloadedinstructorlist.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>

  <tr>
    <td>Enrolled H.E Student List</td>
    <td><a href="enrolledHEstudentlist.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>

 <tr>
    <td>Enrolled SHS Student List</td>
    <td><a href="enrolledSHSstudentlist.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>

  <tr>
    <td>Suspended Student List</td>
    <td><a href="suspendedstudentlist.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>


  <tr>
    <td>Not Enrolled Student List</td>
    <td><a href="notenrolledstudentlist.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>

 <tr>
    <td>Kickout Student List</td>
    <td><a href="kickoutstudentlist.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>

  <tr>
    <td>Alumni Student List</td>
    <td><a href="alumnistudentlist.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>


  <tr>
  	<td>BSIT Student List</td>
  	<td><a href="bsitstudents.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>

  <tr>
  	<td>BSBA Student List</td>
  	<td><a href="bsbastudents.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>
 

 <tr>
    <td>Grade 11 Student List</td>
    <td><a href="grade11students.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>

  <tr>
    <td>Grade 12 Student List</td>
    <td><a href="grade12students.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>


  <tr>
    <td>SHS Parent Contact Number Details List</td>
    <td><a href="SHSparentscontactnumber.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>


  <tr>
    <td>H.E Contact Number Details List</td>
    <td><a href="hecontactlist.php" class="btn btn-info">VIEW PRINT</a></td>
  </tr>

</table>
</div>
</div>
