<?php 

session_start();
if(!$_SESSION["loginuser"]){
  header("location: loginpage.php");
}

include ('user_nav.php');
include ('dbcon.php');




?>
<div class="container">

 <div class="jumbotron" style="background: white;">

    
  <script> 
    function printpage() {

    //Get the print button and put it into a variable
    var printButton = document.getElementById("printpagebutton");
    var searchButton = document.getElementById("search");
    // var submitButton = document.getElementById("submit");
    var displayButton = document.getElementById("display");
     var form1 = document.getElementById("form1");
      var form2 = document.getElementById("form2");
    //Set the button visibility to 'hidden' 

    printButton.style.visibility = 'hidden';
    searchButton.style.visibility = 'hidden';
    // submitButton.style.visibility = 'hidden';
    displayButton.style.visibility = 'hidden';
    form1.style.visibility = 'hidden';
    form2.style.visibility = 'hidden';
    //Print the page content
    window.print()

    //Restore button visibility
    printButton.style.visibility = 'visible';
    searchButton.style.visibility = 'visible';
    // submitButton.style.visibility = 'visible';
    displayButton.style.visibility = 'visible';
    form1.style.visibility = 'visible';
    form2.style.visibility = 'visible';
  

}
  </script>
</head>




</style>


    <img class="imageprint" src="img/sample.png"/>
 
   <br />
   <br />
               
    <div class="container">
      <legend align="center">Attendance Status Report</legend>
      <form method="post" id="form1" class="form-inline">
                   <div class="form-group pull-right">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Search" name="search" id="search"   required onkeyup="showResult(this.value)"> 
                
       </div>
         </form>
     <div class="form-group">
       <form method="POST" id="form2">
                                <input type="submit" id="display" name= "display" class="btn btn-default" value="Display All Record"></button> 

                         
                               <input id="printpagebutton" type="button" class="btn btn-default" value="View/Print Page" onclick="printpage()"/>
                
                   
        </form>
</div>
 </div>  


<div class="pull-right"> 
  <strong>Date:
    <?php echo date ("Y-m-d")
      .'<br>Instructor Name: '.$_SESSION['loginuser'].'<br>' ?></strong>
  </div>
<br />
    <table class="table table-bordered">

                       
                      <th>Roll No.</th>
                      <th>Subject ID</th>
                      <th>Student Number</th>
                      <th>Student Name</th>
                      <th>Attendance Status </th>
                      <th>Date </th>
                      
                     
                  </thead>
               
                <?php

            if (!empty($_REQUEST['search'])) {
                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $dbname = "info_db";
                                            $namelast = $_REQUEST['search'];   
                                            $idsubject = $_REQUEST['search'];
                                            $namefirst = $_REQUEST['search'];   
                                            $status = $_REQUEST['search']; 
                                            $date = $_REQUEST['search']; 
                                            $numberstudent = $_REQUEST['search'];
                                            
                                        
                                          
                                            $conn = mysqli_connect($servername, $username, $password, $dbname);

                                           
                                            $sql = "SELECT * FROM attendance_records WHERE 
                                            SubjID like '%".$idsubject."%' 
                                            OR CONCAT(firstname,' ',lastname) LIKE  '%".$namefirst."%' 
                                            OR CONCAT(lastname,', ',firstname,' ',middlename) LIKE  '%".$namelast."%'
                                            OR attendance_status LIKE '%".$status."%' 
                                            OR date LIKE '%".$date."%' 
                                            OR studentnumber LIKE '%".$numberstudent."%' ORDER BY date ASC"; 
                                            $result = mysqli_query($conn, $sql); 



                                        }elseif (isset($_POST['display'])) {
                                         $servername = "localhost";
                                         $username = "root";
                                         $password = "";
                                         $dbname = "info_db";


// Create connection
                                         $conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
                                         if (!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }

                                        $sql = "SELECT * FROM attendance_records";
                                        $result = mysqli_query($conn, $sql);
                                    }
                                    else{
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "info_db";

// Create connection
                                        $conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
                                        if (!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }

                                        $sql = "SELECT * FROM attendance_records";
                                        $result = mysqli_query($conn, $sql);
                                      }

 
                                        if (mysqli_num_rows($result) > 0) {
                                           
                                               
                                                ?>
         
                        <tr>
                            <?php
                                            while($row = mysqli_fetch_assoc($result)) {
                                                $SubjID = $row['SubjID'];
                                                  
                                                $_SESSION['lastname']=$SubjID;
                                                  $_SESSION['firstname']=$SubjID;
                                                    $_SESSION['attendance_status']=$SubjID;
                                                      $_SESSION['date']=$SubjID;
                       
                                                    echo "<tr>"; 
  
  
  echo "<td>".$row['id']."</td>";
  echo "<td>".$row['SubjID']."</td>";
  echo "<td>".$row['studentnumber']."</td>";
  echo "<td>".$row['lastname'].', '.$row['firstname'].' '.$row['middlename']."</td>";
  echo "<td>".$row['attendance_status']."</td>";
  echo "<td>".$row['date']."</td>";            ;

  
 echo "</tr>"; 
                                                   
                                                    
                               ?>



                                               
                                            </tr>


                                            <?php }}else{
                                                echo "No record results found";
                                            } 
                                            mysqli_close($conn);
                                            ?>

                 
                  </tbody>
            </table>
 
  </div>
  </div>
