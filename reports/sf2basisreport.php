<?php
session_start();
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 // "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>"; //
} 

include ('header.php');


$connect = mysqli_connect("localhost", "root", "", "info_db");  
 $query = "SELECT * FROM shsmonitoringlogtable WHERE StudentTimeIn IS NOT NULL AND YearLevel IN ('Grade 11 SHS','Grade 12 SHS') ORDER BY StudentName ASC";  
 $result = mysqli_query($connect, $query);  
 ?>  


         <script src="../js/jquery-ui.js"></script>  
           <link rel="stylesheet" href="../css/jquery-ui.css">  


  <script> 
    function printpage() {

    //Get the print button and put it into a variable
    var printButton = document.getElementById("printpagebutton");
     var filter = document.getElementById("filter");
     var textsearch = document.getElementById("textsearch");


         printButton.style.visibility = 'hidden';
        filter.style.visibility = 'hidden';
        textsearch.style.visibility = 'hidden';
    window.print()

    //Restore button visibility
    printButton.style.visibility = 'visible';
     filter.style.visibility = 'visible';
    textsearch.style.visibility = 'visible';
  

}
  </script>



           <div class="container">  
  <div class="jumbotron" style="background: white;">
                  <img class="imageprint" src="img/sample.png"/>


                <h3 align="center">SF2 Basis Report</h3><br />


    <div id="textsearch" class="form-inline">
     <input type="text"  name="search_text" id="search_text" placeholder="Search Details" class="form-control pull-right"/>
    </div>

                <form class="form-inline">
  <label>FROM</label>
     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  

  <label>TO</label>
   <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />



    <label class="form-check-label">
        <input type="button" name="filter" id="filter" value="Filter" class="btn btn-default" />  
&nbsp;  
&nbsp;
      
    </label>
               <a class="btn btn-default" id="printpagebutton" onclick="printpage()">Print this page</a>

</form>
        






<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#sf2table').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

       

<br />
                <div id="sf2table">  
                     <table  class="table table-bordered">  
                          <tr>  
                               <th>Student Name</th>  
                               <th>Section</th>
                               <th>Year Level</th>
                               <th>StudentTimeIn</th>
                               <th>Date</th>  
                               <th>Remarks</th>  
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["StudentName"]; ?></td>  
                               <td><?php echo $row["section"]; ?></td>
                                <td><?php echo $row["YearLevel"]; ?></td>
                               <td><?php echo $row["StudentTimeIn"]; ?></td>  
                               <td><?php echo $row["Date"]; ?></td>  
                               <td> <?php echo $row["Remarks"]; ?></td>  
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
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#sf2table').html(data);  
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

