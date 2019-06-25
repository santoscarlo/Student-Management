

<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'info_db';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT * FROM studenttable WHERE lastname LIKE '%".$searchTerm."%' ORDER BY lastname ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['lastname'];
}
//return json data
echo json_encode($data);
?>


