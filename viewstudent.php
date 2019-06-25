<?php

  include ('server3.php');
  include ('nav.php');

//for restriction
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 //echo "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>";
} // until here


	$results = mysqli_query($db, "SELECT * FROM studenttable ORDER BY id DESC");

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


<form>

<a href="managestudent.php" class="btn btn-info pull-right">Register Student</a> 

<br />
<br />

    <legend align="center">Student Information Record</legend>

<table class="table table-condensed table-hover">

  <thead>
          <tr>
        <th>Student Image</th>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Status</th>
        <th>Section</th>
        <th>Yearlevel</th>
        <th>Course</th>
        <th>Actions</th>
          </tr>
  </thead>

           <tbody>


                <?php while ($row = mysqli_fetch_array($results)): ?>

           <tr>
              <td><?php echo '<img height ="100" width="100" src="data:image/jpeg;base64,'.base64_encode($row['studimg'] ).'"/>' ?> </td>

                <td><?php echo $row['StudID'] ?></td>
                 <td><?php echo $row['lastname']. ' '. $row['firstname'] . ', '.  $row['middlename'] ?></td>
                 <td><?php echo $row['statusofstud'] ?></td>
                  <td><?php echo $row['section'] ?></td>
                   <td><?php echo $row['yearlevel'] ?></td>
                  <td><?php  echo $row['course'] ?></td>

                
                  <td>
                     <a class="btn btn-info btn-sm" href="editstudent.php?editpage=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a> <a class="btn btn-danger btn-sm" href="server3.php?del=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-remove-sign"></span></a>
                  </td>
         </tr>
             
<?php endwhile; ?>
</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
</form>


<script>

$("table").DataTable();

</script>