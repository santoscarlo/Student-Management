<?php
$conn = mysqli_connect('localhost','root','','info_db');

$record_per_page = 5;
$page = '';
if(isset($_GET["page"]))
{
    $page = $_GET["page"];

}
 else

{
  $page = 1;
}



$start_from = ($page-1)*$record_per_page;

$query = "SELECT * from subjecttable order by id DESC LIMIT $start_from, $record_per_page";

$results = mysqli_query($conn, $query);

?>



<table class="table">
  
  <tr>
    <td>Subject Name</td>
    <td>Subject Code</td>
  </tr>

  <?php
  while ($row = mysqli_fetch_array($results)) 
  {



?>


<tr>

  <td><?php echo $row["subjname"]; ?></td>
 <td><?php echo $row["subjcode"]; ?></td>

</tr>

<?php
}
?>
</table>

<div align="center">
  <?php
  $page_query = "SELECT * FROM subjecttable ORDER BY id DESC";
  $page_result = mysqli_query($conn, $page_query);
  $total_records = mysqli_num_rows($page_result);
  $total_pages = ceil($total_records/$record_per_page);

  for($i=1; $i<=$total_pages; $i++)
  {
      echo '<a href="manage_subject.php?page='.$i.'">'.$i.'</a>';
  }


  ?>