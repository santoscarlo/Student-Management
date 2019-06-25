<?php  
//3//
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
           SELECT * FROM interbranchvisitormonitorlog
           WHERE InterBranchVisitDate BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
   								 <th>RFIDInterBranchNo</th>  
                               <th>InterBranchName</th>  
                                 <th>InterBranchTimeIn</th>  
                               <th>InterBranchTimeOut</th> 
                                <th>InterBranchVisitDate</th>  
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["RFIDInterBranchNo"] .'</td>  
                          <td>'. $row["InterBranchName"] .'</td>  
                          <td>'. $row["InterBranchTimeIn"] .'</td>  
                          <td>'. $row["InterBranchTimeOut"] .'</td>  
                          <td>'. $row["InterBranchVisitDate"] .'</td>  
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
