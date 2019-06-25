<?php
session_start();
if(!$_SESSION["loginuser"]){
  header("location: loginpage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/png" href="img/icon.png"/>
    
    <title>Welcome to Student and Visitor System | HOMEPAGE</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/all.css" rel="stylesheet">

  
  </head>
  <body>





  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="homepage.php">Attendance Monitoring System</a>-->
    </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="homepage.php">HOME<span class="sr-only">(current)</span></a></li>
         <li class=""><a href="..\instructor/subjects.php">List of Subjects<span class="sr-only">(current)</span></a></li>
           <li><a href="..\instructor/sf2basisreport.php">SF2 REPORT BASIS FOR SHS<span class="sr-only">(current)</span></a></li>
          <li class=""><a href="attendancereports.php">Attendance Reports<span class="sr-only">(current)</span></a></li>
        <ul class="nav navbar-nav">
      

            
          </ul>
        </li>
        
      </ul>
         <ul class="nav navbar-nav">
           <li class="dropdown">
        <!--   <a href="attendancereports.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Attendance Report <span class="caret"></span></a> -->
        
      </li>
      </ul>
 <ul class="nav navbar-nav navbar-right">
       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo "<align='right'>Welcome, ".$_SESSION["loginuser"]."!";?> <span class="caret"></span></a>
         <ul class="dropdown-menu">
              <li><a href="..\instructor\logout_user.php"><span class="glyphicon glyphicon-log-out">  LOGOUT</span></a></li>
    </ul>
</nav>


<div class="container">

      <div class="jumbotron">

<div class="container">
  <h2 align="center">Students and Visitors Monitoring System</h2>
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="img/banner.jpg" alt="" style="width:100%; height: 500px;">
        <div class="carousel-caption">
          <h3>Informatics College-Manila</h3>
         
        </div>
      </div>

      <div class="item">
        <img src="img/banner2.jpg" alt="" style="width:100%, width:400px; height:500px;">
        <div class="carousel-caption">
          <h3>Informatics College-Manila</h3>
          
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>




</div>
</div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>