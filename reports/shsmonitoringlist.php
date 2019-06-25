<?php
//2//
session_start();
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 // "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>"; //
} 
include ('header.php');

// 1 //
 $connect = mysqli_connect("localhost", "root", "", "info_db");  
 $query = "SELECT * FROM shsmonitoringlogtable WHERE YearLevel = 'GRADE 11 SHS' OR YearLevel = 'GRADE 12 SHS'ORDER BY StudMonitorID desc";  
 $result = mysqli_query($connect, $query);  
 ?>  
<script> // Print
function printpage() {

    //Get the print button and put it into a variable
    var printButton = document.getElementById("printpagebutton");
    var filter = document.getElementById("filter");
    
    //Set the button visibility to 'hidden' 
    printButton.style.visibility = 'hidden';
     filter.style.visibility = 'hidden';
   
    //Print the page content
    window.print()

    //Restore button visibility
    printButton.style.visibility = 'visible';
     filter.style.visibility = 'visible';


  
  
}


 </script>


         <script src="../js/jquery-ui.js"></script>  
           <link rel="stylesheet" href="../css/jquery-ui.css">  
      
           <div class="container">  
           <div class="jumbotron" style="background: white;">


<img class="imagelogo_" src="img/new.png"  />
<br />
                
    <form class="form-inline">
  <label>FROM</label>
     <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  

  <label>TO</label>
   <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" />



    <label class="form-check-label">
        <input type="button" name="filter" id="filter" value="Filter" class="btn btn-default" />  
    </label>


</form>
                
                 <div class="col-md-1 pull-right">  
                   <a class="btn btn-default" id="printpagebutton" onclick="printpage()">Print this page</a>
                </div> 

<br />
     <legend>SHS Student Monitoring List Report</legend>

   
                <div id="college_table">  
               
                     <table class="table table-bordered">  
                          <tr>  
                               <th>RFIDStudNo</th>  
                               <th>Student Name</th>  
                                 <th>StudentTimeIn</th>  
                               <th>StudentTimeOut</th> 
                                <th>Section</th>  
                                <th>YearLevel</th> 
                                <th>Strand</th> 
                                 <th>Remarks</th> 
                               <th>Date</th>  
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["RFIDStudNo"]; ?></td>  
                               <td><?php echo $row["StudentName"]; ?></td>  
                               <td><?php echo $row["StudentTimeIn"]; ?></td>  
                               <td> <?php echo $row["StudentTimeOut"]; ?></td>  
                               <td><?php echo $row["section"]; ?></td>  
                               <td> <?php echo $row["YearLevel"]; ?></td>  
                                <td><?php echo $row["course"]; ?></td>  
                               <td> <?php echo $row["Remarks"]; ?></td> 
                                <td><?php echo $row["Date"]; ?></td>  
                          </tr>  
                     <?php  
                     }  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"shsfilter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#college_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>

