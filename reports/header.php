
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="shortcut icon" type="image/png" href="../img/icon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students and Visitors Monitoring System</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"> 
    <link href="css/design.css" rel="stylesheet">


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
       </div>

   
       <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav">
       <li class="active"><a href="../index.php">HOME<span class="sr-only">(current)</span></a></li>
      <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="../manageinstructor.php">Manage Instructor Account</a></li>
              <li><a href="../managesection.php">Manage Section</a></li>
              <li><a href="../managecourse.php">Manage Courses</a></li>
                <li><a href="../manageschoolyear.php">Manage School Year</a></li>
              <li><a href="../managesettings/manage_subject.php">Manage Subject</a></li>
              <li><a href="../managestudent.php">Manage Student</a></li>
      </ul>
      </li>
      </ul>
           <li class="dropdown">
          <li class="dropdown">
            <li><a href="../allsubjects.php">List of all Subjects<span class="sr-only">(current)</span></a></li>
            <!--    <li><a href="../bsit.php">BSIT</a></li>
              <li><a href="../bsba.php">BSBA</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="../grade11ict.php">GRADE 11 ICT</a></li>
               <li><a href="../grade11abm.php">GRADE 11 ABM</a></li>
                <li><a href="../grade11humss.php">GRADE 11 HUMSS</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="../grade12ict.php">GRADE 12 ICT</a></li>
                   <li><a href="../grade12abm.php">GRADE 12 ABM</a></li>
                    <li><a href="../grade12humss.php">GRADE 12 HUMSS</a></li> -->
      </ul>
      </li>
      </ul>
          <ul class="nav navbar-nav">
           <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Generate Reports <span class="caret"></span></a>
         <ul class="dropdown-menu">
              <li><a href="attendancestatusgraphical.php">Graphical Report</a></li>
              <li><a href="printreports.php">Print Report</a></li>   
      </ul>
      </li>
     
 </ul>
 <ul class="nav navbar-nav navbar-right">
       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo "<align='right'>Welcome, ".$_SESSION["submit"]."!";?> <span class="caret"></span></a>
         <ul class="dropdown-menu">
              <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out">  LOGOUT</span></a></li>
    </ul>
</nav>




  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

    
  <script src="tables/js/jquery.js"></script>
  <script src="tables/js/jquery.dataTables.js"></script>
  <script src="tables/js/dataTables.bootstrap.js"></script> 
      

  </body>
</html>