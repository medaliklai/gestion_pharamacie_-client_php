<?php
if (isset($_GET['id_msg'])) {
	$id_msg=$_GET['id_msg'];
	
	include('connexionBD.php');
	$delete=$base->prepare('DELETE from message where id_msg=?');
	$delete->execute(array($id_msg));
	header('location:pharmacien_message.php');
}