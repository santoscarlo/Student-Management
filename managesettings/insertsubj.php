<?php  

include ('dbcon.php');  



 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $subjcode = mysqli_real_escape_string($connect, $_POST["subjcode"]); 
      $subjname = mysqli_real_escape_string($connect, $_POST["subjname"]);  
      $subjdesc = mysqli_real_escape_string($connect, $_POST["subjdesc"]);  
      $subjtimestart = mysqli_real_escape_string($connect, $_POST["subjtimestart"]);  
      $subjtimeend = mysqli_real_escape_string($connect, $_POST["subjtimeend"]);  
      $subjday = mysqli_real_escape_string($connect, $_POST["subjday"]);  
      $course = mysqli_real_escape_string($connect, $_POST["course"]);
      $yearlevel = mysqli_real_escape_string($connect, $_POST["yearlevel"]);   
      $section = mysqli_real_escape_string($connect, $_POST["section"]);  
      $term = mysqli_real_escape_string($connect, $_POST["term"]);
      $school_year = mysqli_real_escape_string($connect, $_POST["school_year"]);
      $instructorname = mysqli_real_escape_string($connect, $_POST["instructorname"]);  
 

   // VALIDATION PART

    $query = "SELECT * from subjecttable where subjname = '$subjname' AND section = '$section' AND instructorname = '$instructorname' AND school_year = '$school_year'";

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0)
    {
      $message = '<div class="alert alert-danger alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Record Already Exists!</strong>
                        </div>';
      
    }
    else
    {

           $query = "  
           INSERT INTO subjecttable(subjcode, subjname, subjdesc, subjtimestart, subjtimeend, subjday, course, yearlevel,  section, term, school_year, instructorname)  
           VALUES('$subjcode','$subjname', '$subjdesc', '$subjtimestart', '$subjtimeend', '$subjday', '$course', '$yearlevel', '$section', '$term', '$school_year', '$instructorname')  
           ";  
           $message =  '<div class="alert alert-success alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Successfully Recorded Details!</strong>
                        </div>';  
     
      }  

    
      if($_POST["subjectid"] != '')  
      {  
           $query = "  
           UPDATE subjecttable   
           SET 
           subjcode='$subjcode',
           subjname='$subjname',
           subjdesc='$subjdesc',   
           subjtimestart='$subjtimestart',   
           subjtimeend='$subjtimeend',   
           subjday = '$subjday',   
           course = '$course',
           yearlevel = '$yearlevel',
           section = '$section',
           term = '$term',
          school_year = '$school_year',
          instructorname = '$instructorname'

           WHERE id='".$_POST["subjectid"]."'";  
           
           $message = '<div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Successfully Updated Record!</strong>
                          </div>';  
      } 
      if(mysqli_query($connect, $query))  
      {  
           $output .= '' . $message . '';  
           $select_query = "SELECT * FROM subjecttable ORDER BY id DESC";  
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
               
<div id="subject_table">  
<table id="results" class="table table-bordered">
                     <tr>   
                                     
                                    <th width="40%">Subject Code</th>
                                    <th width="35%">Subject Name</th>
                                    <th width="30%">Actions</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '

                               <tr>  
                                    <td>'.$row["subjcode"].'</td>  
                                      <td>'.$row["subjname"].'</td>  

                                  <td><button name="edit" class="btn btn-info edit_data" id="'.$row["id"].'"><span class="glyphicon glyphicon-edit"></span></button>  

                                 <button name="view" class="btn btn-info view_data" id="'.$row["id"].'"><span class="glyphicon glyphicon-eye-open"></span></button> 

                                     <a class="btn btn-danger btn-sm" name="del" href="deletesubj.php?del='.$row["id"].'"><span class="glyphicon glyphicon-remove-sign"></a></td>
                               </tr></div>';
                            
               
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>
 