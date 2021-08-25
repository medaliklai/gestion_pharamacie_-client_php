<?php
if (!isset($_SESSION['role']) OR $_SESSION['role']!="admin") {
	header('location:login_admin.php');
}
if (isset($_GET['id_msg'])) {
	$id_msg=$_GET['id_msg'];
	include('connexionBD.php');
	$req=$base->prepare('DELETE from message where id_msg=?');
	$req->execute(array($id_msg));
	header('location:admin_message.php');
}