<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "info_db");  
      $output = '';  
      $query = "  
           SELECT * FROM shsmonitoringlogtable WHERE StudentTimeIn IS NOT NULL
            AND YearLevel IN ('GRADE 11 SHS','GRADE 12 SHS') AND Date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ORDER BY StudentName, Date ASC
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                              <th>Student Name</th>  
                               <th>Section</th>
                               <th>Year Level</th>
                               <th>StudentTimeIn</th>
                               <th>Date</th>  
                               <th>Remarks</th>  
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["StudentName"] .'</td>  
                          <td>'. $row["section"] .'</td>  
                          <td>'. $row["YearLevel"] .'</td>  
                          <td> '. $row["StudentTimeIn"] .'</td>  
                          <td>'. $row["Date"] .'</td>  
                          <td>'. $row["Remarks"] .'</td>  
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
