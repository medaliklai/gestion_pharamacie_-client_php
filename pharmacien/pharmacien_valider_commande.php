<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}

    
	
	include ('connexionBD.php');
	
	$user_id=$_SESSION['id'];
		

$id_cmd=$_GET['id_cmd'];

	$reponse_s=$base->prepare('SELECT * from commande where id_cmd=? and id_user=?' );
	$reponse_s->execute(array($id_cmd,$user_id));
	$nb=$reponse_s->rowcount();
	 $donnees=$reponse_s->fetch();
	$nom_med=$donnees['nom_med'];
	 $qte_cmd=$donnees['qte'];
	 $prix=$donnees['prix_unitaire'];
	 $prix_vente=$donnees['prix_achat'];


	

	$data=$base->prepare('SELECT * from medicaments where nom_med=? AND user_id=?' );
	$data->execute(array($nom_med,$user_id));
	$nombre=$data->rowCount();
	
	$row=$data->fetch();
	$qte_med=$row['qte'];
	

	
	
$user_id=$_SESSION['id'];	
$datetime = date("Y-m-d H:i:s");

if ($nombre==0) {
	$message="med";
	header("location:pharmacien_commande.php?message=".$message);
}

elseif ($qte_med>0 and $qte_med>$qte_cmd) {
	
$reponse_i=$base->prepare('INSERT INTO vente(nom, qte, prix_unitaire,prix_vente,date_v,user_id) VALUES (:nom, :qte, :prix_unitaire,:prix_vente,:date_v,:user_id)');
	$reponse_i->execute(array(
							'nom' => $nom_med,
							'qte' =>$qte_cmd,
							'prix_unitaire' => $prix,
							'prix_vente'=>$prix_vente,
							'date_v'=>$datetime,
							'user_id' =>$user_id
							));
	
	
	$qte_a=$donnees['qte'];
	$qte_v=$row['qte'];
	$qte=$qte_v-$qte_a;
	
	$reponse=$base->prepare('UPDATE medicaments SET  qte=:qte where nom_med=:nom_med AND user_id=:user_id');
	$reponse->execute(array(
		                     'qte'=>$qte,
							'nom_med'=>$nom_med,
							'user_id'=>$user_id
							));
	


	$message="succes";
	
	
}else{$message="erreur";}

header("location:pharmacien_commande.php?message=".$message);

?>