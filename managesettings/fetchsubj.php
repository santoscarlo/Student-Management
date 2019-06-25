 <?php  
 //fetch.php  
include ('dbcon.php');
 
 if(isset($_POST["subjectid"]))  
 {  
      $query = "SELECT * FROM subjecttable WHERE id = '".$_POST["subjectid"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 