<?php 
include('server.php');
include('nav.php');

//for restriction
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 //echo "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>";
} // until here


  // fetch the record to be updated

  if(isset($_GET['edit'])) {

    $UserID = $_GET['edit'];
    $edit_state = true;

          $rec = mysqli_query($db, "SELECT * FROM usertable WHERE UserID=$UserID");
         
          $record = mysqli_fetch_array($rec);
          $username = $record['username'];
          $password = $record['password'];
          $fullname = $record['fullname'];
          $usertype = $record['usertype'];
          $UserID = $record['UserID'];
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


 <form method="POST" action="server.php">

<div class="container">
 
        <div class="row">

            <div class="col-md-12 col-md-offset-13">

                    <legend class="text-center">Manage Instructor Account</legend>

                    <fieldset>
                        <legend>Instructor Account Details</legend>
                        <div class="form-group">
                                        <input type="hidden" name="UserID" value="<?php echo $UserID; ?>"></div>

                        <div class="form-group col-md-6">
                        <input type="text" name="fullname" class="form-control"  placeholder="Enter Full Name"  value="<?php echo $fullname; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="Password" name="password" class="form-control"  placeholder="Enter Password"  value="<?php echo $password; ?>" required>
                        </div>


                        <div class="form-group col-md-6">
                         <select class="form-control" name="usertype"  value="<?php echo $usertype; ?>" required>
                        <option selected hidden>--Select Usertype--</option>
                                <option value="Instructor">Instructor</option>
                                <option value="Admin">Administrator</option>
                          </select>
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
      <th>Full Name</th>
      <th>Password</th>
      <th>Usertype</th>
      <th>Action</th>
    </tr>
  </thead>


<tbody>
    <?php 

    $conn = mysqli_connect('localhost','root','','info_db');
    $result = mysqli_query($conn, "SELECT * FROM usertable ORDER BY UserID DESC");

    while ($row = mysqli_fetch_assoc($result)):
    ?>

  <tr>

    <td><?php echo $row['fullname'] ?></td>
    <td><?php echo $row['password'] ?></td>
    <td><?php echo $row['usertype'] ?></td>

      <td>
                     <a class="btn btn-info btn-sm" href="manageinstructor.php?edit=<?php echo $row['UserID']; ?>"><span class="glyphicon glyphicon-edit"></a> ||
                  
                     <a class="btn btn-danger btn-sm" href="server.php?del=<?php echo $row['UserID']; ?>"><span class="glyphicon glyphicon-remove-sign"></a>
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