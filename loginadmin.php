
<!-- FOR ADMIN -->
<?php
include ('dbconnect.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" type="image/png" href="img/icon.png"/>
    <title>LOGIN ADMIN</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">

  </head>
  <body>

<!-- ADMIN PAGE-->


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="loginpage.php" style="font-family:"Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;">Students and Visitoring Monitoring System</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="loginadmin.php"> <span class="glyphicon glyphicon-user"></span>  Admin</a></li>
       <li><a href="/stud/instructor/loginpage.php"><span class="glyphicon glyphicon-lock"></span>  Login as Instructor</a></li>
    </ul>
  </div>
</nav>



   <div class="wrapper">
    <form method="POST" class="form-signin">   
      <h2 class="form-signin-heading"><span class="glyphicon glyphicon-user"></span>  Login as Admin</h2><br>


<?php

if(isset($_POST['submit'])) {

    $UserID =0;
    $username = $_POST['username'];
          //$usertype = $_POST['usertype'];
    $password = $_POST['password'];

        //$query = "SELECT * from usertable where UserID ='1' and  username = '$username' and usertype = '$usertype' and password='$password'";

    $query = "SELECT * from usertable where UserID ='1' and  username = '$username' and password='$password'";

    $exe_query = mysqli_query($conn, $query);
    $found_num_rows = mysqli_num_rows($exe_query);

    if($found_num_rows==1) {

        $_SESSION['submit']=$username;
        header('location: index.php');
        
    } else {
        echo  '<div class="alert alert-danger col-md-offset-0" align="center">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Invalid Username or Password. </strong><br> Please try again!</div>';
    }
}


?>

       <input type="hidden" class="form-control" name="UserID" placeholder="Enter Username" required="" autofocus="" />
      <input type="text" class="form-control" name="username" placeholder="Enter Username" required="" autofocus="" /><br>
 
         
   
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
     
      <br>
      <button class="btn btn-lg btn-primary btn-block" name="submit">Login</button>
    </form>
  


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    


  </body>
</html>