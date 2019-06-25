<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'info_db';

$connect = mysqli_connect($servername, $username, $password, $dbname);

if(!$connect){
    echo 'Connection Error '.mysqli_connect_error();
}