<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login.php');
	die();
}
$user_id=$_SESSION['id'];
		include ('connexionBD.php');
			
		$reponse=$base->prepare('SELECT * from medicaments where user_id='.$user_id);
	$reponse->execute(array($user_id));
	$count=$reponse->rowCount();
	
?>


<html>
    <head>
        <meta charset="utf-8">
        <title>Les médicaments</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<style >
			body{
				background-image: url(images/.jpg);
				height: 50%;
				font-weight: 50%;
				background-size: cover;
			}
				.table-responsive{
				background-color:;
				position: absolute;
				top: 250px;
				width: 200%;
			}
			.table-responsive tr:hover{
				background-color:;
				
			}
			 .button{
			 	position: absolute;
			 	top:180px;
			 	width:60px;
	            height:60px;
	            background:#fafafa;
	            box-shadow:2px 2px 8px dodgerblue;
	            font:bold 13px Arial;
	            border-radius:50%;
	            color:#555;
	            background-color: dodgerblue;
	            transition: 0.1s;
			 }
			 .button:hover{
			 	transform: scale(1.02);
			 	transition: 0.1s;
			 }
			 h3{
			 	position:absolute;
			 	top: 150px;
			 	width: 100%;
			 }
			 .glyphicon-plus{
			 font-size: 25px;
			 color: white;
			 }
			  tr.liste{
			 	transform: scale(1.02);
			 	background-color: white;

			 }
			 tr.liste:hover{
			 	transform: scale(1.03);
			 	transition:0.5s;
			 	
			 }
			 h2{
			 	color: green;
			 	position: absolute;
			 	top: 250px;
			 	left: 30%;
			 }
			 
			

		</style>
	</head>
<body>
	
<?php include ('pharmacien_menu.php');?>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			<?php
if (isset($_GET['message'])) {
	?>
	<h2>modification creer avec succes</h2>
	<?php	
	}
	?>
			<h3 class="text-center">Liste des médicaments </h3>
			<p><a href="pharmacien_ajout_med.php"><button class="button button1"><span class="glyphicon glyphicon-plus"></span></button></a></p>
			<table class="table table-responsive">
				<tr class="Liste">
					<th>nom</th>
					<th>quantité</th>	
					<th>prix</th>
					<th>date de fabrication</th>
					<th>date d'éxpiration</th>
					<th>dosage</th>		
					<th>description</th>
					<th>action</th>
				</tr>

	<?php 

	while($donnees=$reponse->fetch())
		{
	
		?>
		
			<tr class="Liste">
				<td><?=$donnees['nom_med']?></td>
				<td><?=$donnees['qte']?></td>
				<td><?=$donnees['prix']?></td>
				<td><?=$donnees['date_fab']?></td>
				<td><?=$donnees['date_fin']?></td>
				<td><?=$donnees['dosage']?></td>
				<td><?=$donnees['description']?></td>

				<td>
					<a href="pharmacien_modif_med.php?med_id=<?=$donnees['med_id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="pharmacien_supprimer_med.php?med_id=<?=$donnees['med_id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
					<?php $datetime = date("Y-m-d H:i:s"); if ($donnees['date_fin']<$datetime){ 
					 
					?>
					<div style="color:red">Médicament périmé</div>
					<?php
				}
				?>
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
<div style="position: absolute;top: 250px;left: 88%;" >
<a href="supprimer_tous_medicament.php" class="btn btn-danger" name="delete"> Supprimer tous</a>
</div>
<?php
}
?>


</body>

</html>