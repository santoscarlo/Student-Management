<?php 
include('server5_courses.php');
include('nav.php');
include ('dbconnect.php');

//for restriction
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 //echo "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>";
} // until here


  // fetch the record to be updated

  if(isset($_GET['edit'])) {

    $id = $_GET['edit'];
    $edit_state = true;

          $rec = mysqli_query($db, "SELECT * FROM coursestable WHERE id =$id");
         
          $record = mysqli_fetch_array($rec);
          $courses = $record['courses'];
          $description = $record['description'];
          $id = $record['id'];
  }

 ?>


<div class="container">
  <div class="jumbotron">

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

<!-- FOR UPDATE, RECORD, GET MSG -->
                  <?php if(isset($_SESSION['msg'])): ?>
                      
    <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     <?php

                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);

                            ?>
    </div>

                  <?php endif ?>


<!-- FOR USERNAME -->
     <?php if(isset($_SESSION['msgusername'])): ?>
                      
    <div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     <?php

                            echo $_SESSION['msgusername'];
                            unset($_SESSION['msgusername']);

                            ?>
    </div>

                  <?php endif ?>

<br>


 <form method="POST" action="server5_courses.php">

<div class="container">
 
        <div class="row">

            <div class="col-md-12 col-md-offset-13">

                    <legend class="text-center">Manage Courses</legend>

                    <fieldset>
                        <legend>Add Course</legend>
                        <div class="form-group">
                                        <input type="hidden" name="courses_id" value="<?php echo $id; ?>"></div>

                        <div class="form-group col-md-6">
                        	<label>Add New Course</label>
                        <input type="text" name="courses" class="form-control"  placeholder="Enter Course"  value="<?php echo $courses; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                        	<label>Description:</label>
                        <input type="text" name="description" class="form-control"  placeholder="Enter Description"  value="<?php echo $description; ?>" required>
                        </div>
                   
                    </fieldset>

    <div class="form-group pull-right">
              
              <?php if($edit_state == false): ?>
                   <button type="submit" name="save" class="btn btn-primary">Save Record</button>

          <?php else: ?>
                   <button type="submit" name="update" class="btn btn-primary">Update Record</button>
          
          <?php endif ?>  



    </div>
    </div>


        </form>

   
<!-- DISPLAY ROWS -->

<table class="table table-hover">
  <thead>
    <tr>  
      <th>ID</th>
      <th>Section</th>
      <th>Description</th>
      <th>Action</th>
    </tr>
  </thead>


<tbody>
    <?php 

    $conn = mysqli_connect('localhost','root','','info_db');
    $result = mysqli_query($conn, "SELECT * FROM coursestable ORDER BY id DESC");

    while ($row = mysqli_fetch_assoc($result)):
    ?>

  <tr>

    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['courses'] ?></td>
    <td><?php echo $row['description'] ?></td>

      <td>
                     <a class="btn btn-info btn-sm" href="managecourse.php?edit=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></a> ||
                  
                     <a class="btn btn-danger btn-sm" href="server5_courses.php?del=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-remove-sign"></a>
                  </td>

  </tr>



<?php endwhile; ?>
</tbody>
</table>



<script>
 


$("table").DataTable();

$('.dataTables_filter').addClass('pull-right');

// WIDER SEARCH BUTTON
 $('.dataTables_filter input[type="search"]').
  css({'width':'200px','display':'inline-block'});

</script>