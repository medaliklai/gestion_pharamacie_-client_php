<?php
session_start();
if(!isset($_SESSION['role']) OR $_SESSION['role']!="pharmacien"){
	header('location:login_pharmacien.php');
}
include('connexionBD.php');


$user_id=$_SESSION['id'];
$requete=$base->prepare('DELETE  from vente where user_id='.$user_id);
$requete->execute(array($user_id));
header('location:historique_de_vente.php');

?>