<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "info_db");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM shsmonitoringlogtable 
  WHERE StudentName LIKE '%".$search."%'
  OR section LIKE '%".$search."%' 
  OR Date LIKE '%".$search."%' 
  OR Remarks LIKE '%".$search."%' 
  OR YearLevel LIKE '%".$search."%' 
 ";
}
else
{
 $query = "
SELECT * FROM shsmonitoringlogtable WHERE StudentTimeIn IS NOT NULL AND YearLevel IN ('Grade 11 SHS','Grade 12 SHS') ORDER BY StudentName ASC
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
    
                              <th>Student Name</th>  
                               <th>Section</th>
                               <th>Year Level</th>
                               <th>StudentTimeIn</th>
                               <th>Date</th>  
                               <th>Remarks</th>  
    </tr>
 ';
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
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>