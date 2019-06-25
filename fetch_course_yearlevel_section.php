<?php
//fetch.php
if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "", "info_db");
 $output = '';
 if($_POST["action"] == "course")
 {
  $query = "SELECT yearlevel FROM course_yearlevel_section WHERE course = '".$_POST["query"]."' GROUP BY yearlevel";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select Year Level</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["yearlevel"].'">'.$row["yearlevel"].'</option>';
  }
 }
 if($_POST["action"] == "yearlevel")
 {
  $query = "SELECT section FROM course_yearlevel_section WHERE yearlevel = '".$_POST['query']."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select Section</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["section"].'">'.$row["section"].'</option>';
  }
 }
 echo $output;
}
?>