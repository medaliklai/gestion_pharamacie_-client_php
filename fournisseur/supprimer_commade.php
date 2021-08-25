<?php
session_start();
if (!isset($_SESSION['role']) OR $_SESSION['role']!="fournisseur") {
	header('location:index_fornisseur');
}
include('connexionBD.php');
if (isset($_GET['id_cmd'])) {
	$id_cmd=$_GET['id_cmd'];
	$user_id=$_SESSION['id'];
	$req=$base->prepare('DELETE from commande_pharmacie where id_cmd=? and id_fornisseur=?');
	$req->execute(array($id_cmd,$user_id));
	header('location:fornisseur _affiche_commande.php');
}