<?php
session_start();
if(!isset($_SESSION['role']) OR $_SESSION['role']!="admin"){
	header('location:login_admin.php');

}
include('connexionBD.php');
$nom=$_GET['nom'];
if ($nom=="fornisseur") {
	$requete=$base->prepare('DELETE from fornisseur');
	$requete->execute();
	header('location:admin_affiche_fornisseur.php');
	die();
}