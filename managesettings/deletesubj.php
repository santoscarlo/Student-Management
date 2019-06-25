<?php
session_start();

 $connect = mysqli_connect('localhost','root','','info_db');

  if(isset($_GET['del'])) {

      $id = $_GET['del'];

      mysqli_query($connect, "DELETE FROM subjecttable WHERE id=$id");
      
      $_SESSION['msg11'] = '<strong>Successfully Deleted Record!</strong>';
      
      header('location: manage_subject.php');
    }
    

?>
   	

  