<?php
//-- FOR PROF USER //
include ('dbcon.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
           <link rel="shortcut icon" type="image/png" href="img/icon.png"/>
            <title>LOGIN USER</title>
          <!-- Bootstrap -->
          <link href="../css/bootstrap.min.css" rel="stylesheet">
          <link href="../css/login.css" rel="stylesheet">

  </head>
  <body>
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="loginpage.php">Students and Visitoring Monitoring System</a>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/stud/loginadmin.php"><span class="glyphicon glyphicon-user"></span>  Admin</a></li>
             <li><a href="loginpage.php"><span class="glyphicon glyphicon-lock"></span>  Login as Instructor</a></li>
          </ul>
        </div>
      </nav>

   <div class="wrapper">
    <form method="POST" class="form-signin">  
      <h2 class="form-signin-heading"><span class="glyphicon glyphicon-lock"></span>  Login as Instructor</h2><br>

<?php 
       if(isset($_POST['loginuser'])) {

   
    $fullname = $_POST['fullname'];
    $usertype = 0;
    $password = $_POST['password'];

    $query = "SELECT * from usertable where Usertype ='Instructor' and fullname = '$fullname' and password='$password'";
    $exe_query = mysqli_query($conn, $query);
    $found_num_rows = mysqli_num_rows($exe_query);

    if($found_num_rows==1) {

        $_SESSION['loginuser']=$fullname;
        header('location: homepage.php');
        
    } else  {

        echo  '<div class="alert alert-danger col-md-offset-0" align="center">
         <a href="../instructor/loginpage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Invalid Username or Password. </strong><br> Please try again!</div>';


       
    }
}

?>

      <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name" required="" autofocus="" /><br>


                  
          <!-- FOR USERTYPE ---> 
                   <!--<div class="col-xs-23 selectContainer">
                                <select class="form-control" name="usertype" required>
                                  <option selected disabled>Choose Usertype</option>
                                    <option value="SuperAdministrator">Admin</option>
                                    <option value="Instructor">Instructor</option>
                                </select>
                            </div><br>-->

                            
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
    
      <br>
      <button class="btn btn-lg btn-primary btn-block" name="loginuser" type="submit">Login</button>
    </form>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    


  </body>
</html>