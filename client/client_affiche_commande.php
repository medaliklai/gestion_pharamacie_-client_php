<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="client")
{
	header('location:login_client.php');
	die();
}
$client_id=$_SESSION['id'];
		include ('connexionBD.php');
			
		$reponse=$base->prepare('SELECT * from commande where id_client='.$client_id);
	$reponse->execute(array($client_id));
$nb=$reponse->rowCount();
	
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Affiche Commande</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/11.jpg);
				height: 50%;
				font-weight: 50%;
				background-size: cover;
			}
				.table-hover{
				background-color:white;
				position: absolute;
				top: 400px;
			}
			 .btn-success{
			 	position: absolute;
			 	top: 350px;
			 }
			 h3{
			 	position:absolute;
			 	top: 300px;
			 	width: 100%;
			 	left: 30%;
			 }
			

			

		</style>
	</head>
<body>
	
<?php include ('client_menu.php');?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
<?php 
if ($nb==0) {
	?>
	<div style="color:tomato;position: absolute;top: 100px;left: 30%; "><h2>Aucune commande</h></div>
	<?php
}
if ($nb>0) {
	?>
			<h3 style="color: rgb(0,128,128);">Liste des commandes </h3>
			<table class="table table-hover">
				<tr>
					<th>Numéro de commande</th>
					<th>Nom de médicament</th>	
					<th>qte</th>
					<th>prix_unitaire</th>
					<th>prix_achat</th>		
					<th>pharamcie</th>
					<th>date de commande</th>
					<th>Action</th>
					
				</tr>

	<?php 

	while($donnees=$reponse->fetch())
		{
	
		?>
		
			<tr>
				<td><?=$donnees['id_cmd']?></td>
				<td><?=$donnees['nom_med']?></td>
				<td><?=$donnees['qte']?></td>
				<td><?=$donnees['prix_unitaire']?></td>
				<td><?=$donnees['prix_achat']?></td>
				<td><?=$donnees['nom_user']?></td>
				<td><?=$donnees['date_cmd']?></td>
				<td>
					<a href="client_supprimer_commande.php?id_cmd=<?=$donnees['id_cmd']?>" class="btn btn-danger">supprimer</a>
</tr>
	

</table>
<?php
}
}
?>
</div>
</div>
</div>


</body>

</html>