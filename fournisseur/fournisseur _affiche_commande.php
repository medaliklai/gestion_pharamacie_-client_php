<?php
session_start();
if (!isset($_SESSION['role']) OR $_SESSION['role']!="fournisseur") {
	header('location:index_fornisseur');
}
include('connexionBD.php');
$user_id=$_SESSION['id'];
$requete=$base->prepare('SELECT * from commande_pharmacie where id_fornisseur=?');
$requete->execute(array($user_id));
$donnees=$requete->fetch();

$data=$base->prepare('SELECT * from pharmacie,commande_pharmacie where pharmacie.id=commande_pharmacie.id_pharmacie and commande_pharmacie.id_fornisseur=? and commande_pharmacie.verifier="oui"');
$data->execute(array($user_id));
$count=$data->rowCount();
if (isset($_POST['date'])) {
	$id_cmd=$donnees['id_cmd'];
$verif="oui";
$date_e=$_POST['date'];
$data=$base->prepare('UPDATE commande_pharmacie SET verifier=:verif,date_envoi=:date_e where id_cmd=:id_cmd and id_fornisseur=:user_id');
	$data->execute(array(
							'verif'=>$verif,
							'date_e'=>$date_e,
							'id_cmd'=>$id_cmd,
							'user_id'=>$user_id
							));
	header('location:fournisseur _affiche_commande.php');
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Commande</title>
         <link rel="icon" type="image/png" href="images/logo.png"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				
				background-size: cover;
				
			}
			.table-hover{
				position: absolute;
				top:300px;
				background-color: rgba(255,250,250,0.9);
				width: 500px;
				border-radius: 5px;
				
			
			}
			
			h3{
				position: absolute;
				top: 200px;
				left: 40%;

			}
			.button{
			 	position: absolute;
			 	top:240px;
			 	width:60px;
	            height:60px;
	            background:#fafafa;
	            box-shadow:2px 2px 8px #aaa;
	            font:bold 13px Arial;
	            border-radius:50%;
	            color:#555;
	            background-color: rgba(0,255,0,0.7);
	            transform: scale(1);
	        }
	        .button:hover{
	        	transform: scale(1.2);
	        	transition: 1s;
	        }

			 
			  .glyphicon-plus{
			 font-size: 25px;
			 color: white;
			 }
			 tr.liste{
			 	transform: scale(1);


			 }
			 tr.liste:hover{
			 	transform: scale(1.01);
			 	transition:0.5s;
			 	background-color:tomato;
			 }
			 #navbar a:focus{
			 	background-color: red;
			 }
			 #quantite {
	display: none;
}
	.quantite-clic {
		display: block !important;
	}


			 

			
			
					
				
		</style>
	</head>
<body>


<?php include ('fournisseur_menu.php'); ?>



<!--<div class="container">
	<div class="row">
		<div class="col-md-13 col-md-offset- ">!-->

			
			
			<?php

				if($count>0)
			{
		?>
			<h3 class="text-center" style="color:indigo;">Liste des commande</h3>
			<table class="table table-hover" >
				
				<tr class="liste">
					
					<th>pharmacie</th>
					<th>adresse</th>	
					<th>Ville</th>
					<th>Numéro de téléphone</th>
					<th>cnam</th>
					<th>Médicament</th>
					<th>qte</th>
					<th>Date d'envoi</th>		
					<th >Action</th>	
				</tr>


	<?php 

	while($donnees=$data->fetch())
		{
	
		?>
			<tr class="liste">
				
				<td><?=$donnees['nom_pharmacie']?></td>
				<td><?=$donnees['adresse']?></td>
				<td><?=$donnees['ville']?></td>
				<td><?=$donnees['num_tel']?></td>
				<td><?=$donnees['cnam']?></td>
				<td><?=$donnees['nom_med']?></td>
				<td><?=$donnees['qte']?></td>
				<td><?=$donnees['date_envoi']?></td>

				
				<td>
					
					
		
		<a href="fournisseur_confirmer_commande.php?id_cmd=<?=$donnees['id_cmd']?>">modifer</a>
					
					<a href="supprimer_commade.php?id_cmd=<?=$donnees['id_cmd']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
					
				</td>
			</tr>
			
		<?php
		
		}
	}
	

?>
</table>

</div>

</div>
</div>
<?php
if($count>0){ ?>
	<form style="position: absolute;top: 250px;left: 90%;" method="POST"action="#">
	<!--<input type="submit" class="btn btn-danger" name="delete" value="supprimer tous">!-->
</form>
</div>
<?php
}
?>
<?php
if ($count==0) {
	?>
	<div style="position: absolute;top: 400px; left: 40%;"><h4 style="color: red;">aucune commande</h4></div>
	<?php
	if (isset($_POST['delete'])) {
		$user_id=$_SESSION['id'];
		$requete=$base->prepare('DELETE from commande_pharmacie where id_fornisseur=?');
		$requete->execute(array($user_id));
		header('location:fornisseur _affiche_commande.php');
	}
}
?>
</body>

</html>