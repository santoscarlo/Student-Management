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

<script> // Print
function printpage() {

    //Get the print button and put it into a variable
    var printButton = document.getElementById("printpagebutton");
  var back = document.getElementById("back");

    //Set the button visibility to 'hidden' 
    printButton.style.visibility = 'hidden';
    back.style.visibility = 'hidden';
    //Print the page content
    window.print()

    //Restore button visibility
    printButton.style.visibility = 'visible';
   back.style.visibility = 'visible';
  
  
}
 </script>


<div class="container">

<div class="panel panel-default">

<div class="panel panel-heading">
<h2 align="center"> 


      
<div class=""><img src="img/logo1.png" align="left" width="199px" height="100"/></div>
<div class="text">
Subject ID: <?php echo $_GET['id']?>
<br />
<br />
Subject Name: <?php
echo $_GET['subjname'];?> </h2>

<?php echo 

 '<div class="text2">Instructor Name: '.$_SESSION['submit'].' </div>'; ?>


</div>

<div class="panel panel-default">

<div class="panel panel-heading">
<h2>
<a class="btn btn-info" href="homepage.php" id="back">Back</a>

<a class="btn btn-info" id="printpagebutton" onclick="printpage()">Print this page</a></div>
<h3 align="center">Students Total No. of Lates</h3>





<div class="panel panel-body">

        
                     <table class="table table-bordered">  
                          <thead>  
                               <tr>  
                                   <td>No.</td>
                                <td>Student Number</td>
                                  <td>Lastname</td>
                                    <td>Firstname</td>
                                    <td>Middlename</td>
                                    <td>Attendance Status</td>
                                    <td>Total No. of Lates</td>
 
                               </tr>  
                          </thead>  
                          <?php  
                          $attendance_status = '';
                          $subjID = $_GET['id'];
                          $query = "SELECT distinct studentnumber, lastname, firstname, middlename, studentnumber, attendance_status, count(attendance_status) as 'Count' FROM attendance_records WHERE attendance_status IN ('Late') AND SubjID = '$subjID' GROUP BY studentnumber ORDER BY lastname";

              $run_query = mysqli_query($conn, $query);
$No=0;
              if(mysqli_num_rows($run_query))
              {
                $i = 1;
              

                          while($row = mysqli_fetch_array($run_query))  
                          {   $No++;
                        if($row["Count"]<=1)
                        { 
                        echo '


                               <tr>  
                                      <td>'.$No.'</td>
                                <td>'.$row["studentnumber"].'</td>
                                <td>'.$row["lastname"].'</td> 
                                    <td>'.$row["firstname"].'</td>
                                    <td>'.$row["middlename"].'</td>
                                     <td>'.$row["attendance_status"].'</td>
                           <td style="background-color: #FFFFFF; ">'.$row["Count"].'</td>    
                                   </td>   
                               </tr>  

                               ';} //<TD STYLE ABOVE> LESS THAN 3 ABSENT (COLOR KEME)
                              elseif($row["Count"]>=3)
                              {

                                echo '
                               <tr>  
                                           <td>'.$No.'</td>
                                   <td>'.$row["studentnumber"].'</td>
                                   <td>'.$row["lastname"].'</td> 
                                    <td>'.$row["firstname"].'</td>
                                    <td>'.$row["middlename"].'</td>
                                     <td>'.$row["attendance_status"].'</td>
                            <td style="background-color: #FF2009; ">'.$row["Count"].'</td>
                        

              

              </td>   
                               </tr>  '; //<TD STYLE> 3 OR MORE ABSENT (COLOR KEME);


}

              else
              {
                echo '
                <tr>
                                    <td>'.$No.'</td>
                                  <td>'.$row["studentnumber"].'</td>
                                    <td>'.$row["lastname"].'</td> 
                                    <td>'.$row["firstname"].'</td>
                                    <td>'.$row["middlename"].'</td>
                                     <td>'.$row["attendance_status"].'</td>
                                     <td style="background-color: #ffbd54; ">'.$row["Count"].'</td>
                                    </tr>

                ';
              }

}

}

?>

               

           </div>
       </div>