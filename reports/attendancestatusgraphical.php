<?php 
session_start();
include ('header.php');

$conn = mysqli_connect('localhost','root','','info_db');

$query = "SELECT date, attendance_status, count(*) as Attendance FROM attendance_records  GROUP BY attendance_status";
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
   <a class="btn btn-default" id="printpagebutton" onclick=" printpage()">Print this page</a>
    <a class="btn btn-default" href="coursesgraphicalchart.php" id="back">Course Chart</a>
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
                          ['attendance_status', 'Attendance'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  

                               echo "['".$row["attendance_status"]."', ".$row["Attendance"]."],";  

                          }  
                          ?>  
                     ]);  
                var options = {  
                
                      is3D:true, 
                     backgroundColor: 'transparent',
                   'width':900,
                   'height':600,
                    legend : { position : 'bottom' } 
                  
                      // pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>  

  <br /><br />  

     
    <select name="monthyear" id="monthyear" class="form-control">  
                               <option value="" selected="selected">-Select Date-</option>
                               <?php 

                               $conn = mysqli_connect('localhost','root','','info_db');
                               $select = mysqli_query($conn, "SELECT date, count(*) FROM attendance_records GROUP BY date");
                               while ($row=mysqli_fetch_array($select))
                               {
                                echo "<option>".$row['date']."</option>";
                               }
                               ?>
                                
                          </select> 

            <h2>Percentage of Attendance Status</h2>
  
                <br />  
                <div class="piechart" id="piechart" ></div>  
           </div>  



