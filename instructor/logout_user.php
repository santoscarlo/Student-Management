<?php
session_start();
session_destroy();
header("location: ..\instructor/loginpage.php?logout= You are succesfully logout!");

?>
