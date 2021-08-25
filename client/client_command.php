<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="client")
{
	header('location:login_client.php');
	die();
}

if (!isset($_GET['med_id']))
{
	header('location:login_client.php');
	die();
}
$id=$_SESSION['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * FROM client where id_client=?');
$reponse->execute(array($id));
$donnees=$reponse->fetch();


$med_id=$_GET['med_id'];
$reponse_a=$base->prepare('SELECT * from medicaments,pharmacie where medicaments.user_id=pharmacie.id and medicaments.med_id=?' );
	$reponse_a->execute(array($med_id));
	$donnees_a=$reponse_a->fetch();


	if (isset($_POST['nom_med']) AND isset($_POST['qte']) AND isset($_POST['nom_user']) AND isset($_POST['nom_client']))
{
	$nom_med=htmlspecialchars($_POST['nom_med']);
	$qte=htmlspecialchars($_POST['qte']);
	$nom_user=htmlspecialchars($_POST['nom_user']);
	$nom_client=htmlspecialchars($_POST['nom_client']);
	$id_user=$donnees_a['id'];
	$datetime = date("Y-m-d H:i:s");
	$prix_unitaire=$donnees_a['prix'];
	$prix_achat=$prix_unitaire*$qte;
	$reponse=$base->prepare('INSERT INTO commande(nom_med, qte, nom_user,id_user, nom_client,id_client,date_cmd,prix_unitaire,prix_achat) VALUES (:nom_med, :qte, :nom_user,:id_user, :nom_client,:id_client,:date_cmd,:prix_unitaire,:prix_achat)');
	$reponse->execute(array(
							'nom_med' => $nom_med,
							'qte' =>$qte,
							'nom_user' => $nom_user,
							'id_user'=>$id_user,
							'nom_client' => $nom_client,
							'id_client'=>$_SESSION['id'],
							'date_cmd'=>$datetime,
							'prix_unitaire'=>$prix_unitaire,
							'prix_achat'=>$prix_achat
							
							));
	header('location:client_affiche_commande.php');
	

}

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Commande</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/4.jpg);
				background-size: cover;
				
			}
			.row input[type=text]{
				background-color:white;
				color: black;
			}
			.form-mod{
					position:absolute;
					top: 270px;
					width: 100%;
					left: -30%;
				}
				h3{
					position: absolute;
					top: 150px;
					width: 100%;
					left: -30%;
					color: white;
				}
				label{
					color: rgb(0,128,128);
				}
					
				
		</style>
				
	</head>
<body>



<?php include ('client_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 style="color:rgb(165,42,42);">confirmer la commande</h3>

			<br/>

			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">

							<label>nom de médicament</label>
							<input class="form-control" type="text" name="nom_med"value="<?=$donnees_a['nom_med']?>" required/>  <br/>

							<label>qte</label>
							<input class="form-control" type="text" name="qte" required/>  <br/>

							<label>pharmacie</label>
							<input class="form-control" type="text" name="nom_user" value="<?=$donnees_a['nom']?>" required/>  <br/>
					        <label>client</label>
							<input class="form-control" type="text" name="nom_client" value="<?=$donnees['nom_clt']?>" required/>  <br/>
					
							<input class="btn btn-success" type="submit"/>
							
					</div>
				</div>


			</form>
		
		</div>
	</div>
</div>


</body>

</html>