<?php
session_start();
include ('dbconnect.php');
include ('nav.php');
if(!$_SESSION["submit"]){
  header("location: loginadmin.php");
} else {
 //echo "<h3 align='right'>Welcome, ".$_SESSION["submit"]."!</h3>";
}

  // count of instructor

        $qry_appr = "SELECT count(*) FROM usertable WHERE usertype = 'Instructor'";
        $qry_data = mysqli_query($conn, $qry_appr);
        $approve_count = mysqli_fetch_array($qry_data);
        $totalCount = array_shift($approve_count);
    //    echo $totalCount; 
   ?>

   <?php
// TOTAL SUBJ

        $sql = "SELECT count(*) FROM subjecttable";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query);
        $totalSubj = array_shift($result);
     
        ?>

<?php
// TOTAL ENROLLED

        $sql = "SELECT count(*) FROM studenttable WHERE statusofstud = 'Enrolled'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query);
        $totalEnrolled = array_shift($result);
     
        ?>



 <?php
// TOTAL BSIT ENROLLED

        // $sql = "SELECT count(*) FROM studenttable WHERE statusofstud = 'Enrolled' AND course='BSIT'";
        // $query = mysqli_query($conn, $sql);
        // $result = mysqli_fetch_array($query);
        // $totalBSIT = array_shift($result);
     
        ?> 


 <?php
// TOTAL BSBA ENROLLED

        // $sql = "SELECT count(*) FROM studenttable WHERE statusofstud = 'Enrolled' AND course='BSBA'";
        // $query = mysqli_query($conn, $sql);
        // $result = mysqli_fetch_array($query);
        // $totalBSBA = array_shift($result);
     
        ?> 

 <?php
// TOTAL ICM ENROLLED

        // $sql = "SELECT count(*) FROM studenttable WHERE statusofstud = 'Enrolled' AND course='ICM'";
        // $query = mysqli_query($conn, $sql);
        // $result = mysqli_fetch_array($query);
        // $totalICM = array_shift($result);
     
        ?> 


 <?php
// TOTAL ABM ENROLLED

        // $sql = "SELECT count(*) FROM studenttable WHERE statusofstud = 'Enrolled' AND course='ABM'";
        // $query = mysqli_query($conn, $sql);
        // $result = mysqli_fetch_array($query);
        // $totalABM = array_shift($result);
     
        ?> 


 <?php
// TOTAL HUMSS ENROLLED

        // $sql = "SELECT count(*) FROM studenttable WHERE statusofstud = 'Enrolled' AND course='HUMSS'";
        // $query = mysqli_query($conn, $sql);
        // $result = mysqli_fetch_array($query);
        // $totalHUMSS = array_shift($result);
     
        ?> 

<div class="container">
  
<!-- 
<div class="col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading"> <span class="glyphicon glyphicon-user"></span><strong> Total BSIT Students</strong></div>
    <div class="panel-body" align="center">
        <h1 style="color: black;"><?php echo $totalBSIT; ?></h1>
 </div>
</div>
</div>



<div class="col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading"> <span class="glyphicon glyphicon-user"></span><strong> Total BSBA Students</strong></div>
    <div class="panel-body" align="center">
        <h1 style="color: black;"><?php echo $totalBSBA; ?></h1>
 </div>
</div>
</div>


<div class="col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading"> <span class="glyphicon glyphicon-user"></span><strong> Total SHS ICM Students</strong></div>
    <div class="panel-body" align="center">
        <h1 style="color: black;"><?php echo $totalICM; ?></h1>
 </div>
</div>
</div>



<div class="col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading"> <span class="glyphicon glyphicon-user"></span><strong> Total SHS ABM Students</strong></div>
    <div class="panel-body" align="center">
        <h1 style="color: black;"><?php echo $totalABM; ?></h1>
 </div>
</div>
</div>


<div class="col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading"> <span class="glyphicon glyphicon-user"></span><strong> Total SHS HUMSS Students</strong></div>
    <div class="panel-body" align="center">
        <h1 style="color: black;"><?php echo $totalHUMSS; ?></h1>
 </div>
</div>
</div>

 -->

<div class="col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading"> <span class="glyphicon glyphicon-user"></span><strong> Total Instructor</strong></div>
    <div class="panel-body" align="center">
        <h1 style="color: black;"><?php echo $totalCount; ?></h1>
 </div>
</div>
</div>


<div class="col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span><strong> Total Enrolled Students</strong></div>
    <div class="panel-body" align="center">
        <h1 style="color: black;"><?php echo $totalEnrolled; ?></h1>
 </div>
</div>
</div>


<div class="col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading"><span class="glyphicon glyphicon-book"></span><strong> Total Subjects</strong></div>
    <div class="panel-body" align="center">
        <h1 style="color: black;"><?php echo $totalSubj; ?></h1>
 </div>
</div>
</div>
</div>


<div class="container">
 <div class="jumbotron">
<div class="container">



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
        <img src="img/banner.jpg" alt="" style="width:150%; height: 500px;">
        <div class="carousel-caption">
          <h3>Informatics College-Manila</h3>
         
        </div>
      </div>

      <div class="item">
        <img src="img/banner2.jpg" alt="" style="width:150%, width:400px; height:500px;">
        <div class="carousel-caption">
          <h3>Informatics College-Manila</h3>
          
        </div>
      </div>

      <div class="item">
        <img src="img/banner3.jpg" alt="" style="width:150%, width:400px; height:500px;">
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
