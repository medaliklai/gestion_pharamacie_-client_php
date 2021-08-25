<?php
session_start();
if(!isset($_SESSION['role']) OR $_SESSION['role']!="admin"){
	header('location:login_admin.php');

}
include('connexionBD.php');

	$requete=$base->prepare('DELETE from pharmacie');
$requete->execute();
header('location:admin_affiche_pharmacie.php');
die();






?>
