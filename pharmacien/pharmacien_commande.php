<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}

if (isset($_POST['num_cmd']))
{
	$id=$_SESSION['id'];
	$num_cmd=htmlspecialchars($_POST['num_cmd']); 
	include ('connexionBD.php');
	$reponse=$base->prepare('SELECT * from commande where id_cmd=? and id_user=?');
	$reponse->execute(array($num_cmd,$id));
	$nb=$reponse->rowCount();
	if ($nb==0) {
		$invalid="";
	}
}


?>

<html>
    <head>
        <meta charset="utf-8">
        
        <title>Les commandes</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/.jpg);
				background-size: cover;
				
			}
			
			.form-mod{
					position:absolute;
					top: 300px;
					width: 100%;
				}
				.form-mod input{
					border-radius: 20px;
					position: absolute;
					left: 40%;
				}
				h3{
					position: absolute;
					top: 200px;
					width: 100%;}
					.btn-success{
						position: absolute;
						top: 0px;
					}
					.table-hover{
				position: absolute;
				top:400px;
				background-color: white;
			}

				
		</style>
				
	</head>
<body>
	<?php include ('pharmacien_menu.php'); ?>

<?php

	if (isset($_POST['num_cmd'])) {

		if (isset($invalid) ){
		
		
	?>
	<div style="position: absolute;top: 400px; left: 40%;"><h4 style="color: red;"> Numéro de commande invalid!</h4></div>
<?php
}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="text-center">Consulter Commande</h3>
			<br/>
			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">
							
							<input class="form-control" type="text" name="num_cmd" placeholder="numéro du commande" required/>  <br/>
						</div>
						<div class="col-md-6">
							
							<input class="btn btn-success" type="submit" name="valider" value="Valider" style="position: absolute;left: 45%;">
						</div>

					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php

				if (isset($_POST['num_cmd'])){

				while($donnees=$reponse->fetch())
				

		{
			?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table table-hover">

				<tr>
					<th>client</th>
					<th>médicament</th>	
					<th>qte</th>
					<th>prix unitaire</th>		
					<th>prix de vente</th>
					
					
				</tr>
        </div>
    </div>

</div>
	


			<tr>
				
				<td><?=$donnees['nom_client']?></td>
				<td><?=$donnees['nom_med']?></td>
				<td><?=$donnees['qte']?></td>
			
				<td><?=$donnees['prix_unitaire']?></td>
				<td><?=$donnees['prix_achat']?></td>
				
				
				
				
				<td>

				<a href="pharmacien_supprimer_commande.php?id_cmd=<?=$donnees['id_cmd']?>" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
					<a href="pharmacien_valider_commande.php?id_cmd=<?=$donnees['id_cmd']?>" class="btn btn-info" >Valider</span></a>
					
					
				</td>
			
			</tr>
			<?php
			
			
		
		}
	}
		?>
		
	

</table>
<?php
if ((isset($_GET['message'])) and (!isset($_POST['num_cmd']))){
 if ($_GET['message']=="succes") {
 	
 

	


?>

				
					<h3 style="position: absolute;top:350px; left: 40%;color: green;">votre vente  creer avec succes</h3>
					<div class="col-md-10 col-md-offset-1">
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

	$user_id=$_SESSION['id'];
	$datetime = date("Y-m-d H:i:s");
	include ('connexionBD.php');
		$reponse=$base->prepare('SELECT * from vente where user_id=?and date_v=?');
	$reponse->execute(array($user_id,$datetime));

	while($rows=$reponse->fetch())
		{
	
		?>
			<tr>
				
				<td><?=$rows['nom']?></td>
				<td><?=$rows['qte']?></td>
				<td><?=$rows['prix_unitaire']?></td>
				<td><?=$rows['prix_vente']?></td>
				<td><?=$rows['date_v']?></td>

				<td>
					
					<a href="facture.php?id_med=<?=$rows['id_med']?>" class="btn btn-warning" target="_blank"target="_blank"><span class="glyphicon glyphicon-print"></span></a>
				</td>
			</tr>
			
		<?php
		
		}
	}elseif ($_GET['message']=="med" and !isset($_POST['num_cmd'])) {
		?>
		<div><h3 style="color:red;
		position: absolute;top: 400px;left: 40%;">aucune medicament</h3></div>
		<?php

		;
	}elseif ($_GET['message']=="erreur") {
		?>
		<div><h3 style="color:red;
		position: absolute;top: 400px;left: 40%;">votre stock est finis</h3></div>

		<?php
		
	}

}




	
?>
</table>

</body>
</html>