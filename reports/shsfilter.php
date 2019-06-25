<?php  
//2//
session_start();
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 // "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>"; //
} 
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "info_db");  
      $output = '';  
      $query = "  
           SELECT * FROM shsmonitoringlogtable
           WHERE date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' AND YearLevel = 'GRADE 11 SHS' OR YearLevel = 'GRADE 12 SHS' 
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
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
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["RFIDStudNo"] .'</td>  
                          <td>'. $row["StudentName"] .'</td>  
                          <td>'. $row["StudentTimeIn"] .'</td>  
                          <td>'. $row["StudentTimeOut"] .'</td>  
                           <td>'. $row["section"] .'</td>  
                          <td>'. $row["YearLevel"] .'</td>  
                          <td>'. $row["course"] .'</td>  
                          <td>'. $row["Remarks"] .'</td>  
                           <td>'. $row["Date"] .'</td>  
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Results Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>
