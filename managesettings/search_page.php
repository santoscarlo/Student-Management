<?php

// SEARCH FOR MANAGE_SUBJECT.PHP 

session_start();
include ('header.php');

?>  


<div class="container">
<div class="jumbotron">

	<a href="manage_subject.php" class="btn btn-info"><span class="glyphicon glyphicon-backward"></span> Back to Manage Subject </a>

<table class="table">
<legend>
	<h3 align="center">Search Results</h3>
</legend>

	<tr>
			<th>Subject Code</th>
			<th>Subject Name</th>
			<th>Actions</th>
	</tr>	

<?php 


 $conn = mysqli_connect('localhost','root','','info_db');
 $set = $_POST['search'];
 if($set) {
	$show = "SELECT * FROM subjecttable
	 where  subjcode LIKE '%$set%' 
	 OR  subjname LIKE '%$set%'
	 OR  subjdesc LIKE '%$set%'
	 OR  subjtimestart LIKE '%$set%'
	 OR  subjtimeend LIKE '%$set%'
	 OR  course LIKE '%$set%'
	 OR  yearlevel LIKE '%$set%'
	 OR  section LIKE '%$set%'
	 OR  term LIKE '%$set%'
	 OR  school_year LIKE '%$set%'
	 OR  instructorname LIKE '%$set%'";




	$result = mysqli_query($conn, $show);
	while ($rows = mysqli_fetch_array($result)) {

		echo "<tr>";
		echo "<td>";
		echo $rows['subjcode'];
		echo "</td>";
		echo "<td>";
		echo $rows['subjname'];
		echo "</td>";
		
?>
                              <td><button name="edit" class="btn btn-info edit_data" id="<?php echo $rows["id"];?>"><span class="glyphicon glyphicon-edit"></span></button>  

                                 <button name="view" class="btn btn-info view_data" id="<?php echo $rows["id"];?>"><span class="glyphicon glyphicon-eye-open"></span></button> 

                                     <a class="btn btn-danger btn-sm" name="del" href="deletesubj.php?del=<?php echo $rows["id"]; ?>"><span class="glyphicon glyphicon-remove-sign"></a></td>
                               </tr></div>
		
		
	<?php }
}
else { echo "<strong>No results found! </strong>"; 
}

?>


</div>
</div>
</table>

 

 <?php  $conn = mysqli_connect('localhost','root','','info_db');

$record_per_page = 5;
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

$results = mysqli_query($conn, $query);?>                

    

    
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
                       <input class="form-control" type="time" name="subjtimestart" id="subjtimestart">
                       </div>
                      <div class="col-sm-5">
                        <input class="form-control" type="time" name="subjtimeend" class="form-group" id="subjtimeend" >
                        <br /> </div>
                        

                        <label>Enter Subject Day</label>
                          <input type="input" onkeyup="this.value = this.value.replace(/[^a-z,A-Z]/, '')" name="subjday" id="subjday" class="form-control" />  
                          <br />  
                         
          <script type="text/javascript">
function course_onchange(){
    var course = document.getElementById("course").value;
    var yearlevel = document.getElementById("yearlevel");

    if(course=="ICT"){
        var html = '<option value="GRADE 11 SHS">GRADE 11 SHS</option>';
            html += '<option value="GRADE 12 SHS">GRADE 12 SHS</option>';
            yearlevel.innerHTML = html;
    }
    else if(course=="ABM"){
           var html = '<option value="GRADE 11 SHS">GRADE 11 SHS</option>';
            html += '<option value="GRADE 12 SHS">GRADE 12 SHS</option>';
            yearlevel.innerHTML = html;
    }
    else if(course=="HUMSS"){
         var html = '<option value="GRADE 11 SHS">GRADE 11 SHS</option>';
            html += '<option value="GRADE 12 SHS">GRADE 12 SHS</option>';
            yearlevel.innerHTML = html;
    }
     else if(course=="BSIT"){
        var html = '<option value="1ST YEAR COLLEGE - REG">1ST YEAR COLLEGE - REG</option>';
            html += '<option value="2ND YEAR COLLEGE - REG">2ND YEAR COLLEGE - REG</option>';
            html += '<option value="3RD YEAR COLLEGE - REG">3RD YEAR COLLEGE - REG</option>';
            html += '<option value="1ST YEAR COLLEGE - NC">1ST YEAR COLLEGE - NC</option>';
            html += '<option value="2ND YEAR COLLEGE - NC">2ND YEAR COLLEGE - NC</option>';
            html += '<option value="3RD YEAR COLLEGE - NC">3RD YEAR COLLEGE - NC</option>';
            yearlevel.innerHTML = html;
    }
     else if(course=="BSBA"){
        var html = '<option value="1ST YEAR COLLEGE - REG">1ST YEAR COLLEGE - REG</option>';
            html += '<option value="2ND YEAR COLLEGE - REG">2ND YEAR COLLEGE - REG</option>';
              html += '<option value="3RD YEAR COLLEGE - REG">3RD YEAR COLLEGE - REG</option>';
                html += '<option value="1ST YEAR COLLEGE - NC">1ST YEAR COLLEGE - NC</option>';
                  html += '<option value="2ND YEAR COLLEGE - NC">2ND YEAR COLLEGE - NC</option>';
                    html += '<option value="3RD YEAR COLLEGE - NC">3RD YEAR COLLEGE - NC</option>';
            yearlevel.innerHTML = html;

        }
         else if(course=="Alumni"){
        var html = '<option>-Choose-</option>';
         html += '<option value="Alumni">Alumni</option>';
            yearlevel.innerHTML = html;
    }            
}


function yearlevel_onchange(){
    var course = document.getElementById("course").value;
    var yearlevel = document.getElementById("yearlevel").value;
    var section = document.getElementById("section");

    if(course=="ICT" && yearlevel=="GRADE 11 SHS"){
        var html = '<option value="ICT - UNIX">ICT - UNIX</option>';
            html += '<option value="ICT - VISTA">ICT - VISTA</option>';
            section.innerHTML = html;
    }
    else if(course=="ICT" && yearlevel=="GRADE 12 SHS"){
        var html = '<option value="ICT - Mark Zuckerburg">ICT - Mark Zuckerburg</option>';
            html += '<option value="ICT - Bill Gates">ICT - Bill Gates</option>';
            section.innerHTML = html;
    }
     else if(course=="ABM" && yearlevel=="GRADE 11 SHS"){
        var html = '<option value="ABM - Henry Sy">ABM - Henry Sy</option>';
            section.innerHTML = html;
    }
    else if(course=="ABM" && yearlevel=="GRADE 12 SHS"){
        var html = '<option value="ABM - Steve Jobs">ABM - Steve Jobs</option>';
            section.innerHTML = html;
    }
    else if(course=="HUMSS" && yearlevel=="GRADE 11 SHS"){
        var html = '<option value="HUMSS - Sigmund Freud">HUMSS - Sigmund Freud</option>';
            section.innerHTML = html;
    }
    else if(course=="HUMSS" && yearlevel=="GRADE 12 SHS"){
        var html = '<option value="HUMSS - GRADE 12">HUMSS - GRADE 12</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="1ST YEAR COLLEGE - REG"){
        var html = '<option value="BSIT 1 - 1 REG">BSIT 1 - 1 REG</option>';
             html += '<option value="BSIT 1 - 2 REG">BSIT 1 - 2 REG</option>';
            section.innerHTML = html;
    }
     else if(course=="BSIT" && yearlevel=="2ND YEAR COLLEGE - REG"){
        var html = '<option value="BSIT 2 - 1 REG">BSIT 2 - 1 REG</option>';
             html += '<option value="BSIT 2 - 2 REG">BSIT 2 - 2 REG</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="3RD YEAR COLLEGE - REG"){
        var html = '<option value="BSIT 3 - 1 REG">BSIT 3 - 1 REG</option>';
             html += '<option value="BSIT 3 - 2 REG">BSIT 3 - 2 REG</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="1ST YEAR COLLEGE - NC"){
        var html = '<option value="BSIT 1 - 1 NC">BSIT 1 - 1 NC</option>';
             html += '<option value="BSIT 1 - 2 NC">BSIT 1 - 2 NC</option>';
            section.innerHTML = html;
    }
     else if(course=="BSIT" && yearlevel=="2ND YEAR COLLEGE - NC"){
        var html = '<option value="BSIT 2 - 1 NC">BSIT 2 - 1 NC</option>';
             html += '<option value="BSIT 2 - 2 NC">BSIT 2 - 2 NC</option>';
            section.innerHTML = html;
    }
    else if(course=="BSIT" && yearlevel=="3RD YEAR COLLEGE - NC"){
        var html = '<option value="BSIT 3 - 1 NC">BSIT 3 - 1 NC</option>';
             html += '<option value="BSIT 3 - 2 NC">BSIT 3 - 2 NC</option>';
            section.innerHTML = html;  
    }  
                 // BSBA

     else if(course=="BSBA" && yearlevel=="1ST YEAR COLLEGE - REG"){
        var html = '<option value="BSBA 1 - 1 REG">BSBA 1 - 1 REG</option>';
             html += '<option value="BSBA 1 - 2 REG">BSBA 1 - 2 REG</option>';
            section.innerHTML = html;
    }
     else if(course=="BSBA" && yearlevel=="2ND YEAR COLLEGE - REG"){
        var html = '<option value="BSBA 2 - 1 REG">BSBA 2 - 1 REG</option>';
             html += '<option value="BSBA 2 - 2 REG">BSBA 2 - 2 REG</option>';
            section.innerHTML = html;
    }
    else if(course=="BSBA" && yearlevel=="3RD YEAR COLLEGE - REG"){
        var html = '<option value="BSBA 3 - 1 REG">BSBA 3 - 1 REG</option>';
             html += '<option value="BSBA 3 - 2 REG">BSBA 3 - 2 REG</option>';
            section.innerHTML = html;  
    } 
     else if(course=="BSBA" && yearlevel=="1ST YEAR COLLEGE - NC"){
        var html = '<option value="BSBA 1 - 1 NC">BSBA 1 - 1 NC</option>';
             html += '<option value="BSBA 1 - 2 NC">BSBA 1 - 2 NC</option>';
             section.innerHTML = html;
    }
     else if(course=="BSBA" && yearlevel=="2ND YEAR COLLEGE - NC"){
        var html = '<option value="BSBA 2 - 1 NC">BSBA 2 - 1 NC</option>';
             html += '<option value="BSBA 2 - 2 NC">BSBA 2 - 2 NC</option>'; 
             section.innerHTML = html;
    }
    else if(course=="BSBA" && yearlevel=="3RD YEAR COLLEGE - NC"){
        var html = '<option value="BSBA 3 - 1 NC">BSBA 3 - 1 NC</option>';
             html += '<option value="BSBA 3 - 2 NC">BSBA 3 - 2 NC</option>';
             section.innerHTML = html; 
    }
     else if(course=="Alumni" && yearlevel=="Alumni"){
        var html = '<option value="Alumni">Alumni</option>';
             section.innerHTML = html; 
    }
    
}

</script>

                      
                             <label>Select Course</label>
                         <select id= "course" class="form-control" name="course" onChange= "course_onchange()" required>
                          <option value="" selected="selected">-Choose Course-</option>
                                <option>BSIT</option>
                                <option>BSBA</option>
                                <option>ICT</option>
                                <option>ABM</option>
                                <option>HUMSS</option>
                            </select>
                       <br /> 
                        
                           <label>Select Year Level</label>
                            <select id= "yearlevel" class="form-control" name="yearlevel" onChange= "yearlevel_onchange();" required>
                           </select>
                       <br /> 

                       
                             <label>Select Section</label>
                         <select id="section" class="form-control" name="section"  required>  
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
                               <option value="2017 - 2018 SY">2017 - 2018 SY</option>
                                <option value="2018 - 2019 SY">2018 - 2019 SY</option>
                                <option value="2019 - 2020 SY">2019 - 2020 SY</option>
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