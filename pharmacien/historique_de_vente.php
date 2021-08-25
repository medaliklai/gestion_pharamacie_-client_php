<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login.php');
	die();
}
$user_id=$_SESSION['id'];
		include ('connexionBD.php');
			
		$reponse=$base->prepare('SELECT * from vente where user_id='.$user_id);
	$reponse->execute(array($user_id));
	$count=$reponse->rowCount();
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Historique</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/4.jpg);
				background-size: cover;
				
			}
			.table-hover{
				background-color:white;
				position: absolute;
				top: 220px;
			}
			
			 .btn-success{
			 	position: absolute;
			 	top: 150px;
			 }
			 h3{
			 	position:absolute;
			 	top: 150px;
			 	width: 100%;
			 }
					
				
		</style>
	</head>
<body>
	
<?php include ('pharmacien_menu.php');?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="text-center">Liste des ventes</h3>
			
			<table class="table table-hover">
				<tr>
					<th>Nom</th>
					<th>Quantité</th>	
					<th>Prix unitaire</th>		
					<th>Prix de vente</th>
					<th>Date de vente</th>
					<th>action</th>
				</tr>

	<?php 

	while($donnees=$reponse->fetch())
		{
	
		?>
			<tr>
				
				<td><?=$donnees['nom']?></td>
				<td><?=$donnees['qte']?></td>
				<td><?=$donnees['prix_unitaire']?></td>
				<td><?=$donnees['prix_vente']?></td>
				<td><?=$donnees['date_v']?></td>

				<td>
					<a href="supprimer_vente.php?id_med=<?=$donnees['id_med']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
					<a href="facture.php?id_med=<?=$donnees['id_med']?>" class="btn btn-warning" target="_blank"target="_blank"><span class="glyphicon glyphicon-print"></span></a>
				</td>
			</tr>
			
		<?php
		
		}
	

?>
</table>

</div>
</div>
</div>
<?php
if ($count>0) {
?>
<div style="position: absolute;top: 220px; left:80%;" >
<a href="supprimer_tous_historique.php?nom=commande" class="btn btn-danger" name="delete"> Supprimer tous</a>
</div>
<?php
}
?>

</body>

</html>