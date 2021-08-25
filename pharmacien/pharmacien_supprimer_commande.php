<?php
session_start();
if(!isset($_SESSION['role']) OR $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}
$id_cmd=$_GET['id_cmd'];

include('connexionBD.php');
$reponse=$base->prepare('DELETE from commande where id_cmd=?');
$reponse->execute(array($id_cmd));
header('location:pharmacien_commande.php');

?>









