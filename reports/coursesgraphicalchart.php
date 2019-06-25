<?php 
session_start();
include ('header.php');

$conn = mysqli_connect('localhost','root','','info_db');

$query = "SELECT course, count(*) as Attendance FROM studenttable GROUP BY course";
$result = mysqli_query($conn, $query);

?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  

<div class="container">


 <div class="jumbotron" style="background: white;">

<img class="imagelogo_" src="img/sample.png"  />
<br />
<br />
<legend>Graphical Report</legend>

  <form class="form-inline">
    <div class="form-group pull-right">
   <a class="btn btn-default" id="printpagebutton" onclick="printpage()">Print this page</a>
    <a class="btn btn-default" href="attendancestatusgraphical.php" id="back">Attendance Status Chart</a>
    </div>



<script> // Print

   function printpage() {

    //Get the print button and put it into a variable
    var printButton = document.getElementById("printpagebutton");
    var backButton = document.getElementById("back");

    //Set the button visibility to 'hidden' 
    printButton.style.visibility = 'hidden';
     backButton.style.visibility = 'hidden';

    //Print the page content
    window.print()

    //Restore button visibility
    printButton.style.visibility = 'visible';
    backButton.style.visibility = 'visible';
    

}
 </script>
 	<script type="text/javascript">
  		   google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Course', 'Course'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["course"]."', ".$row["Attendance"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                    
                      is3D:true, 
                     backgroundColor: 'transparent',
                   'width':900,
                   'height':600,
                    legend : { position : 'bottom' }
                      // pieHole: 0.6 
                     };  

                     // CHANGE CHART 
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>  

  <br /><br />  

  <h2>Percentage of Enrolled Students in Particular Courses</h2>
  
                <br />  
                <div id="piechart" class="piechart"></div>  
           </div>  </div>



