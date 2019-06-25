<?php
//3//
session_start();
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 // "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>"; //
} 
include ('header.php');

// 1 //
 $connect = mysqli_connect("localhost", "root", "", "info_db");  
 $query = "SELECT * FROM visitormonitorlogtable";  
 $result = mysqli_query($connect, $query);  
 ?>  
<script> // Print
function printpage() {

    //Get the print button and put it into a variable
    var printButton = document.getElementById("printpagebutton");
    // var same = document.getElementById("same");
    // var same1 = document.getElementById("same1");
    var filter = document.getElementById("filter");

    //Set the button visibility to 'hidden' 
    printButton.style.visibility = 'hidden';
    //  same.style.visibility = 'hidden';
    //  same1.style.visibility = 'hidden';
     filter.style.visibility = 'hidden';
    // //Print the page content
    window.print()

    //Restore button visibility
    printButton.style.visibility = 'visible';
     // same.style.visibility = 'visible';
     // same1.style.visibility = 'visible';
     filter.style.visibility = 'visible';


  
  
}


 </script>


         <script src="../js/jquery-ui.js"></script>  
           <link rel="stylesheet" href="../css/jquery-ui.css">  
      
           <div class="container">  
           <div class="jumbotron" style="background: white;">


<img class="imagelogo_" src="img/sample.png"  />

<br />
          

    <form class="form-inline">
  <label>FROM</label>
     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  

  <label>TO</label>
   <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />



    <label class="form-check-label">
        <input type="button" name="filter" id="filter" value="Filter" class="btn btn-default" />  
    </label>


</form>
    
                 <div class="col-md-1 pull-right">  
                   <a class="btn btn-default" id="printpagebutton" onclick="printpage()">Print this page</a>
                </div> 
                <br/>

<style type="text/css">
  
.center {
   text-align: center;
}
</style>

     <legend class="center">Visitor Monitoring List Report</legend>

   
                <div id="college_table">  
               
                     <table class="table table-bordered">  
                          <tr>  
                               <th>VisitorID</th>  
                               <th>RFIDVisitorNo</th>  
                               <th>VisitorName</th> 
                                <th>VisitorTimelogs</th>  
                                 <th>VisitDate</th>  
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["VisitorID"]; ?></td>  
                               <td><?php echo $row["RFIDVisitorNo"]; ?></td>  
                               <td><?php echo $row["VisitorName"]; ?></td>  
                               <td> <?php echo $row["VisitorTimelogs"]; ?></td>  
                               <td><?php echo $row["VisitDate"]; ?></td>  
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
                          url:"interbranchvisitorfilter.php",  
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

