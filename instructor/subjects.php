<?php

session_start();
if(!$_SESSION["loginuser"]){
  header("location: loginpage.php");
}

include ('../instructor/user_nav.php');

include ('../instructor/dbcon.php');

?>



<div class="container ">

<div class="panel panel-default">

<div class="panel panel-heading">
<h2 align="center"> List of Subjects </h2>

</div></div>

 <div class="jumbotron" style="background: white;">
   <a class="btn btn-info" href="homepage.php">Back</a>
<br />
<br />
  <table class="table table-responsive table-hover">
  <thead>
   
         <tr>
          
       <th>SubjID</th>
        <th>Subject </th>
        <th>Section</th>
         <th>Term</th>
          <th>View </th>
           <th>Status</th>
           <th>Add Attendance</th>
          <th>Add Attendance By Date</th>
          <th>View Details</th>

         </tr>
  </thead>

          

                <?php  $results = mysqli_query($conn, "SELECT * FROM subjecttable where instructorname= '".$_SESSION['loginuser']."'");

                  while ($row = mysqli_fetch_assoc($results)):
    ?>

           <tr>
                       <td><?php echo $row['id'] ?></td>
                     <td><?php echo $row['subjname'] ?></td>
                     <td><?php echo $row['section'] ?></td>
                     <td><?php echo $row['term'] ?></td>
              
                 
                   <td>   <a class="btn btn-default btn-sm" href="viewsubjects.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></a></td>
 
                   <!--!!!!!!!!!ATTENDANCE FORM FOR THAT SUBJECT!!!!!!!!!!!!!!!-->
        
           
<td>
  <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Status
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
   
      <li>
                   <form action="lates_counter.php">
                  <input type="submit" name="lates_counter" class="btn btn-default" value="Late Status">
                  <input  type="hidden" name="id" value="<?php echo $row['id']?>">
                  <input type="hidden" name="subjname" value="<?php echo $row['subjname']?>">

                  </form></li>


       <li>   
                  <form action="absent_counter.php">
                  <input type="submit" name="absent_counter" class="btn btn-default" value="Absent Status">
                  <input  type="hidden" name="id" value="<?php echo $row['id']?>">
                  <input type="hidden" name="subjname" value="<?php echo $row['subjname']?>">

                  </form>
      </li>
     <li>
                   <form action="excuse_counter.php">
                  <input type="submit" name="excuse_counter" class="btn btn-default" value="Excuse Status">
                  <input  type="hidden" name="id" value="<?php echo $row['id']?>">
                  <input type="hidden" name="subjname" value="<?php echo $row['subjname']?>">

                  </form></li>

       <li>
                   <form action="present_counter.php">
                  <input type="submit" name="present_counter" class="btn btn-default" value="Present Status">
                  <input  type="hidden" name="id" value="<?php echo $row['id']?>">
                  <input type="hidden" name="subjname" value="<?php echo $row['subjname']?>">

                  </form></li>
    </ul>
    </div>


    


                    <td>
                      
                    <form action="add_attendance_user.php">
                    <input type="submit" name="add_attendance" class="btn btn-default" value="Add Attendance">
                    <input  type="hidden" name="id" value="<?php echo $row['id']?>">
                     <input type="hidden" name="subjname" value="<?php echo $row['subjname']?>">
                     <input type="hidden" name="section" value="<?php echo $row['section']?>">
                    </form>
                    
  <td>
                    <form action="add_attendance_bydate.php">
                    <input type="submit" name="add_attendance_bydate" class="btn btn-default" value="Add Attendance Date">
                    <input  type="hidden" name="id" value="<?php echo $row['id']?>">
                     <input type="hidden" name="subjname" value="<?php echo $row['subjname']?>">
                     <input type="hidden" name="section" value="<?php echo $row['section']?>">
                    </form>

        
        <td>
                   <form action="view_all_user.php">
                  <input type="submit" name="view_all_user" class="btn btn-default" value="View Records">
                  <input  type="hidden" name="id" value="<?php echo $row['id']?>">
                  <input type="hidden" name="subjname" value="<?php echo $row['subjname']?>">

                  </form>
                  
                  
        </td>


         </tr>

<?php endwhile; ?>

          

 </table>

 <script>


$("table").DataTable();

$('.dataTables_filter').addClass('pull-right');


</script>



</div>