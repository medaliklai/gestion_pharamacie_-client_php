<?php
include('connexionBD.php');
if (isset($_GET['id_cmd'])) {
	
$id_cmd=$_GET['id_cmd'];
$delete=$base->prepare('DELETE FROM commande where id_cmd=? ');
	$delete->execute(array($id_cmd));
	header('location:client_affiche_commande.php');
}

	?>