<?php
session_start();
session_destroy();
header('location:http://localhost/g_pharmacie/index.php');
die();
?>