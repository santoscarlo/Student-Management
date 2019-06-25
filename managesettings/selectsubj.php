  <?php  
  include ('dbcon.php');
 if(isset($_POST["subjectid"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM subjecttable WHERE id = '".$_POST["subjectid"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
             <tr>  
                     <td width="30%"><label>SubjectID</label></td>  
                     <td width="70%">'.$row["id"].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Subject Name</label></td>  
                     <td width="70%">'.$row["subjname"].'</td>  
                </tr> 

                <tr>  
                     <td width="30%"><label>Subject Code</label></td>  
                     <td width="70%">'.$row["subjcode"].'</td>  
                </tr>  

                 <tr>  
                     <td width="30%"><label>Subject Description</label></td>  
                     <td width="70%">'.$row["subjdesc"].'</td>  
                </tr>  

                <tr>  
                     <td width="30%"><label>Subject Time</label></td>  
                     <td width="70%">'.$row["subjtimestart"].' - '.$row["subjtimeend"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Subject Day</label></td>  
                     <td width="70%">'.$row["subjday"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Course</label></td>  
                     <td width="70%">'.$row["course"].'</td>  
                </tr>  

                 <tr>  
                     <td width="30%"><label>Year Level</label></td>  
                     <td width="70%">'.$row["yearlevel"].' </td>  
                </tr>

                 <tr>  
                     <td width="30%"><label>Section</label></td>  
                     <td width="70%">'.$row["section"].' </td>  
                </tr>  

                 <tr>  
                     <td width="30%"><label>Term</label></td>  
                     <td width="70%">'.$row["term"].'</td>  
                </tr>  
                 <tr>  
                     <td width="30%"><label>School Year</label></td>  
                     <td width="70%">'.$row["school_year"].'</td>  
                </tr>  
                 <tr> 
                     <td width="30%"><label>Assigned Instructor</label></td>  
                     <td width="70%">'.$row["instructorname"].'</td> 
                </tr>  
           ';                    
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 }  
 ?>
 