<?php  
                        // ADD VALIDATION FOR INSTRUCTOR //
session_start();
include ('header.php');
include ('dbcon.php');

//for restriction
if(!$_SESSION["insert"]){
  header("location: /stud/loginadmin.php");
} else {
 //echo "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>";
} // until here


// FOR DISPLAYING ROWS
 $query = "SELECT * FROM subjecttable ORDER BY id DESC";  
 $result = mysqli_query($connect, $query);  


// pagination for subject 

 $conn = mysqli_connect('localhost','root','','info_db');

$record_per_page = 10;
$page = '';
if(isset($_GET["page"]))
{
    $page = $_GET["page"];

}
 else

{
  $page = 1;
}



$start_from = ($page-1)*$record_per_page;

$query = "SELECT * from subjecttable order by id DESC LIMIT $start_from, $record_per_page";

$results = mysqli_query($conn, $query);

 ?>  

 <?php

$connect = mysqli_connect("localhost", "root", "", "info_db");
$course = '';
$query = "SELECT course FROM course_yearlevel_section GROUP BY course";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result))
{
 $course .= '<option value="'.$row["course"].'">'.$row["course"].'</option>';
}
?>
 ?>



<div class="container">  
<div class="jumbotron">


<div class="container">
<legend align="center">

<h3>Manage Subject</h3>
</legend>
</div>


            <div align="right">  
             <div class="row">
            <div class="col-sm-3">
              <div class="input-group">
                <span class="input-group-btn">
              <form action="search_page.php" class="searchfield form-control" method="POST">
              <input type="text" name="search" placeholder="Search Information" class="form-control" /> 
              <button class="btn btn-info sm-3">Search</button>
               </form>
              </div>
            </div>



  <div class="col-sm-9 pull-left">
              <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Add Subject</button> </div></div><br>
 </div>                   
           
                       

     <!-- FOR DELETE MSG -->  
                  <?php if(isset($_SESSION['msg11'])): ?>

     <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     <?php

                            echo $_SESSION['msg11'];
                            unset($_SESSION['msg11']);

                            ?>
    </div>

                  <?php endif ?>
                  
<div id="subject_table">  
<table id="results" class="table table-bordered">
                               <tr>  
                                    
                                    <th width="40%">Subject Code</th>
                                    <th width="35%">Subject Name</th>
                                    <th width="30%">Actions</th>  
                                    
                               </tr>  
                               <?php  
                               while($row = mysqli_fetch_array($results))  
                               {  
                               ?>  
                               <tr>  
                               		 <td><?php echo $row["subjcode"]; ?></td>  
                                    <td><?php echo $row["subjname"]; ?></td>  
                                      


                                    <td><button name="edit" class="btn btn-info edit_data" id="<?php echo $row["id"]; ?>"><span class="glyphicon glyphicon-edit"></span></button>

                                    <button name="view" class="btn btn-info view_data" id="<?php echo $row["id"]; ?>"><span class="glyphicon glyphicon-eye-open"></span></button>  

                                     <a class="btn btn-danger btn-sm" name="del" href="deletesubj.php?del=<?php echo $row["id"]; ?>"><span class="glyphicon glyphicon-remove-sign"></a></td>
                               </tr>  
                               <?php  
                               }  
                               ?>  

 

<!-- PAGINATION-->
<table align="center">                           
<div align="center">
	<ul class="pagination">
  <?php
  $page_query = "SELECT * FROM subjecttable ORDER BY id DESC";
  $page_result = mysqli_query($conn, $page_query);
  $total_records = mysqli_num_rows($page_result);
  $total_pages = ceil($total_records/$record_per_page);

  //for($i=1; $i<=$total_pages; $i++)
  {

      echo "<ul class='pagination'>";
      echo "<li><a href='manage_subject.php?page=".($page-1)."' class='button'> <span class='glyphicon glyphicon-menu-left'></a></li>"; 

      for ($i=1; $i<=$total_pages; $i++) {  
        echo "<li><a href='manage_subject.php?page=".$i."'>".$i."</a></li>";
};  

      echo "<li><a href='manage_subject.php?page=".($page+1)."' class='button'><span class='glyphicon glyphicon-menu-right'></a></li>";
      echo "</ul>";    

     //echo ' <li><a href="manage_subject.php?page='.$i.'">'.$i.'</a> </li>';
  }


  ?>

</ul></table> 


                          </table>  
                     </div>  
                </div>  
           </div>  
    

    
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Subject Details</h4>  
                </div>  
                <div class="modal-body" id="subject_details">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 
<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Add Subject Details</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                       <label>Enter Subject Code</label>  
                          <input type="text" name="subjcode" id="subjcode" class="form-control"/>  
                          <br /> 
   
                          <label>Enter Subject Name</label>  
                          <input type="text" name="subjname" id="subjname" class="form-control"/>  
                          <br /> 
   
                         <label>Enter Subject Description</label>  
                          <input type="input" name="subjdesc" id="subjdesc" class="form-control" />  
                          <br /> 
   
                       <label>Enter Subject Time</label><br/>
                      <div class="col-sm-5">
                       <input class="form-control"  type="time" name="subjtimestart" id="subjtimestart">
                       </div>

                      <div class="col-sm-5">
                        <input class="form-control" type="time" name="subjtimeend" class="form-group" id="subjtimeend" >
                        <br /> </div>
                        

                        <label>Enter Subject Day</label>
                          <input type="input" onkeyup="this.value = this.value.replace(/[^a-z/\s,A-Z/\s]/, '')" name="subjday" id="subjday" class="form-control" placeholder="eg. Mo/Tu/We/Th/Fr/Sa" />  
                          <br />  

                             <label>Select Course</label>
                         <select id= "course" class="form-control action" name="course" required>
                          <option value="" selected="selected">-Choose Course-</option>
                                                         <?php echo $course; ?>
                            </select>
                       <br /> 


                        <label>Select Year Level</label>
                            <select name="yearlevel" id="yearlevel" class="form-control action" required>
                                <option value="">Select YearLevel</option>
                               </select>
                       <br />

                         <label>Select Section</label>
                         <select id= "section"  class="form-control" name="section" required>
                         </select>
                       <br /> 

                            

                          
                           <label>Select Term</label>  
                          <select name="term" id="term" class="form-control">  
                               <option value="TERM - 1">TERM - 1</option>
                                <option value="TERM - 2">TERM - 2</option>
                                <option value="TERM - 3">TERM - 3</option>
                          </select> 

                           <br /> 
                          
                          
                            <label>Select School Year</label>
                          <select name="school_year" id="school_year" class="form-control">  
                               <option value="" selected="selected">-Select S.Y-</option>
                               <?php 

                               $select = mysqli_query($connect, "SELECT school_year FROM schoolyeartable");
                               while ($row=mysqli_fetch_array($select))
                               {
                                echo "<option>".$row['school_year']."</option>";
                               }
                               ?>
                                
                          </select> 
                          <br />


                            <label>Select Instructor</label>
                          <select name="instructorname" id="instructorname" class="form-control">  
                               <option value="" selected="selected">-Select Instructor-</option>
                               <?php 

                               $select = mysqli_query($connect, "SELECT fullname FROM usertable WHERE usertype = 'Instructor'");
                               while ($row=mysqli_fetch_array($select))
                               {
                                echo "<option>".$row['fullname']."</option>";
                               }
                               ?>
                                
                          </select> 
                          <br />

 
                          <input type="hidden" name="subjectid" id="subjectid" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-primary" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>
 </div>
 </div> 
 <script>  


 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var subjectid = $(this).attr("id");  
           $.ajax({  
                url:"fetchsubj.php",  
                method:"POST",  
                data:{subjectid:subjectid},  
                dataType:"json",  
                success:function(data){  
                     $('#subjcode').val(data.subjcode);
                     $('#subjname').val(data.subjname);
                     $('#subjdesc').val(data.subjdesc);    
                     $('#subjtimestart').val(data.subjtimestart);  
                     $('#subjtimeend').val(data.subjtimeend);  
                     $('#subjday').val(data.subjday);  
                     $('#course').val(data.course);
                     $('#yearlevel').val(data.yearlevel);
                     $('#section').val(data.section);  
                      $('#term').val(data.term);            
                    $('#school_year').val(data.school_year); 
                    $('#instructorname').val(data.instructorname);            
                     $('#subjectid').val(data.id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#subjcode').val() == "")  
           {  
                alert("Please Add Subject Code");  
           }  
           else if($('#subjname').val() == '')  
           {  
                alert("Please Add Subject Name");  
           }  
           else if($('#subjdesc').val() == '')  
           {  
                alert("Please Add Subject Description");  
           }  
             else if($('#subjtimestart').val() == '')  
           {  
                alert("Please Add Subject Time");  
           }  
           else if($('#subjtimeend').val() == '')  
           {  
                alert("Please Add Subject Time");  
           }  
           else if($('#subjday').val() == '')  
           {  
                alert("Please Add Subject Day");  
           }  
            else if($('#course').val() == '')  
           {  
                alert("Please Select Subject Course");  
           }
           else if($('#yearlevel').val() == '')  
           {  
                alert("Please Select Year Level");  
           }  
            else if($('#section').val() == '')  
           {  
                alert("Please Select Subject Section");  
           }  
            else if($('#term').val() == '')  
           {  
                alert("Please Select Subject Term");  
           }  
           else if($('#school_year').val() == '')  
           {  
                alert("Please Select School Year");  
           }
           else if($('#instructorname').val() == '')  
           {  
                alert("Please Select Instructor");  
           }   
           else  
           {  
                $.ajax({  
                     url:"insertsubj.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#subject_table').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var subjectid = $(this).attr("id");  
           if(subjectid != '')  
           {  
                $.ajax({  
                     url:"selectsubj.php",  
                     method:"POST",  
                     data:{subjectid:subjectid},  
                     success:function(data){  
                          $('#subject_details').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });

 </script>

 <script>
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "course")
   {
    result = 'yearlevel';
   }
   else
   {
    result = 'section';
   }
   $.ajax({
    url:"fetch_course_yearlevel_section_subj.php",
    method:"POST",
    data:{action:action, query:query},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});
</script>