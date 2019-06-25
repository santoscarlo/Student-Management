<?php  
session_start();
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 // "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>"; //
} 
 // 1 //
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "info_db");  
      $output = '';  
      $query = "  
           SELECT * FROM collegemonitorlogtable
           WHERE date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  AND  YearLevel IN ('3RD YEAR COLLEGE - REG','2ND YEAR COLLEGE - REG','1ST YEAR COLLEGE - REG','3RD YEAR COLLEGE - NC','2ND YEAR COLLEGE - NC','1ST YEAR COLLEGE - NC') ORDER BY StudentName ASC
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                               <th>RFIDStudNo</th>  
                               <th>Student Name</th>  
                                <th>Year Level</th>  
                               <th>Student Time logs</th>  
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
                           <td>'. $row["YearLevel"] .'</td>  
                          <td>'. $row["StudentTimelogs"] .'</td>  
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
