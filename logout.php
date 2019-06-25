<?php
session_start();
session_destroy();
header("location:loginadmin.php?logout= You are succesfully logout!");

?>
