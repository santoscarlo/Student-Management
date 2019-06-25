<?php

session_start();
if(!$_SESSION["loginuser"]){
  header("location: loginadmin.php");
} else {
 // "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>"; //
} 

include ('user_nav.php');
include ('dbcon.php');

    //for foreign subject_id key ////
  if(isset($_GET['id']))
  {
    $_SESSION['id']=$_GET['id'];

  } 
    // 'till here ///
  $date = "";
  $flag=0;
if(isset($_POST['submit'])) 
  {

    $date =$_POST['date'];
    
          foreach ($_POST['attendance_status'] as $key=>$attendance_status)  
          {

            $lastname = $_POST['lastname'] [$key];
            $firstname = $_POST['firstname'] [$key];
            $middlename = $_POST['middlename'] [$key];
            $StudID = $_POST['StudID'] [$key];
            $SubjID = $_GET['id'];
                  
    $query = "SELECT * from attendance_records where lastname = '$lastname' AND firstname = '$firstname' AND firstname = '$firstname' AND date = '$date' AND $SubjID = '$SubjID'";
       
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
      $message = '<div class="alert alert-danger alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Record Already Exists!</strong>
                        </div>'; // VALIDATION NA AYAW NAMAN MAGSHOW YUN MSG, PERO OK NA LOL
      
    }
    else
    {

            $result = mysqli_query($conn, "INSERT into attendance_records(SubjID, lastname, firstname, middlename, studentnumber, attendance_status, date)values('$SubjID', '$lastname','$firstname', '$middlename', '$StudID', '$attendance_status','$date')");

          
            if($result)
            {
            }
    }         $flag=1;
          }
  }

?>

<div class="container">

<div class="panel panel-default">

<div class="panel panel-heading">
<h2 align="center"> 






<div class=""><img src="img/logo1.png" align="left" width="199px" height="100"/></div>


       <?php echo '<h3 align="center" class="text">Subject Name: '.$_GET['subjname']
       .'<br><br>Section: '.$_GET['section']
      .'<br></h3>

         <span style="font-size: 15px;"><div align="right"><br>Instructor Name: '.$_SESSION['loginuser'].'<br>
             </div></span>';
       ?>




 </h2>
</div></div>


<div class="panel panel-default">

<div class="panel panel-heading">
<h2>
<a class="btn btn-info" href="homepage.php" id="back">Back</a>
<button class="btn btn-info pull-right" id="printpagebutton" onclick="printpage()">Print this page</button></div>



<script> // Print
function printpage() {

    //Get the print button and put it into a variable
    var printButton = document.getElementById("printpagebutton");
    var backButton = document.getElementById("back");
      var recordadd = document.getElementById("recordadd");

    //Set the button visibility to 'hidden' 
    printButton.style.visibility = 'hidden';
     backButton.style.visibility = 'hidden';
    recordadd.style.visibility = 'hidden';
    //Print the page content
    window.print()

    //Restore button visibility
    printButton.style.visibility = 'visible';
    backButton.style.visibility = 'visible';
        recordadd.style.visibility = 'visible';
}
 </script>



<div class="panel panel-default">



    
<!--MSG-->
<?php if($flag) { ?>
<div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong><span class="glyphicon glyphicon-ok"></span></strong> Attendance By Date Successfully Recorded!
  </div><?php } ?>
<!--END-->




<div class="panel panel-body">

<strong><legend align="center">Attendance By Date</legend></strong>

<table class="table table-responsive">


    
  <thead>
          <tr>
            <th> No.</th>
              <th> Student ID</th>
              <th> Last Name</th>
              <th> First Name</th>
               <th> Middle Name</th>
              <th> Attendance Status</th>
          </tr>

  </thead>

<tbody>

<?php
 $sql = "SELECT * FROM studenttable WHERE statusofstud IN ('Enrolled', 'Suspended') and section = '".$_GET['section']."' ORDER BY lastname ASC";
$run_query = mysqli_query($conn,$sql);
$counter = 0;
if ($run_query)
{
  $id = 0;
  while ($row = mysqli_fetch_array($run_query)){
    $id++;
?>

<tbody>

<form method="POST">
  <tr>
    <td><?php echo $id;?></td>
    <td><?php echo $row['StudID']?></td>
    <input type="hidden" value="<?php echo $row['StudID']; ?>" name="StudID[]">
    <td><?php echo $row['lastname']?></td>
    <input type="hidden" value="<?php echo $row['lastname']; ?>" name="lastname[]">
    <td><?php echo $row['firstname']?></td>
    <input type="hidden" value="<?php echo $row['firstname']; ?>" name="firstname[]">
    <td><?php echo $row['middlename']?></td>
    <input type="hidden" value="<?php echo $row['middlename']; ?>" name="middlename[]">
    <td>
      <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Present"
      <?php if(isset($_POST['attendance_status'][$counter]) && $_POST['attendance_status'] [$counter]=="Present") {
        echo "checked=checked";
      }
      ?>
      required>Present
      <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Absent" 
  
      <?php if(isset($_POST['attendance_status'][$counter]) && $_POST['attendance_status'][$counter]=="Absent") {
        echo "checked=checked";
      }
      ?>
        required>Absent
      <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Late"

      <?php if(isset($_POST['attendance_status'][$counter]) && $_POST['attendance_status'][$counter]=="Late") {
        echo "checked=checked";
      }
      ?> required>Late
      <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Excuse"

      <?php if(isset($_POST['attendance_status'][$counter]) && $_POST['attendance_status'][$counter]=="Excuse") {
        echo "checked=checked";
      }
      ?> required>Excuse
    </td>


  </tr>




<?php



$counter++;


}
}
?>
                   
</table> 
<br />
<div class="form-group col-md-3 pull-right">
  <label>Select Date:</label>
<input type="date" name="date" class="form-control" value="<?php echo $date; ?>" placeholder="Date" required>
<br />

      <input type="submit" name="submit" id="recordadd" value="Record Attendance" class="btn btn-primary pull-right">

</div>

</form>


</div>
</div>    
</div>

