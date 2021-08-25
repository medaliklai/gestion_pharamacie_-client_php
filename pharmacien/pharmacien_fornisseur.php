<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}
include ('connexionBD.php');
if (isset($_POST['nom']) )
{
	$nom=htmlspecialchars($_POST['nom']);
	
    $id=$_SESSION['id'] ;
	
	$reponse=$base->prepare('SELECT * from fornisseur where nom=?'  );
	$reponse->execute(array($nom));
	$nb=$reponse->rowCount();
	
}
if (isset($_POST['ville'])) {
	$ville=$_POST['ville'];
	$reponse=$base->prepare('SELECT * from fornisseur where ville=?');
	$reponse->execute(array($ville));
	$nb=$reponse->rowCount();
}

$id_pharmacie=$_SESSION['id'];
$data=$base->prepare('SELECT * from commande_pharmacie where id_pharmacie=? ');
$data->execute(array($id_pharmacie));

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Recherche</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style_slider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<style >
			body{
				background-image: url(images/.jpg);
				background-size: cover;
				
			}
			
			.form-mod{
					position:absolute;
					top: 250px;
					width: 200%;
					left: 10%;

				}
				.form-mod input[type=text]{
					border-radius: 5px;
					width: 250px;
					position: absolute;
					left: 20%;
					height: 43px;
					top: -10px;
				}
				
					.table{
				position: absolute;
				top:350px;
				background-color: white;
			}
			
			
					
				
		</style>
				
	</head>
<body>
	<?php
	if (!isset($_POST['nom']) OR !isset($_POST['ville'])) {
		?>
	<table class="table table-hover">
				<tr class="Liste">
					<th>Fournisseur</th>
					<th>Médicament</th>	
					<th>date d'envoi</th>
					<th>confirmation</th>
					<th>date de récevoir</th>		
					
				</tr>

	<?php 

	while($donnees=$data->fetch())
		{
	
		?>
		
			<tr >
				<td><?=$donnees['nom_fornisseur']?></td>
				<td><?=$donnees['nom_med']?></td>
				<td><?=$donnees['date_cmd']?></td>
				<?php
				if ($donnees['verifier']=="oui") {
				?>
				<td style="color: green;">Confirmer</td>
				<?php
			}
			if ($donnees['verifier']=="non") {
			?>
			<td style="color: red;">N'est pas confirmer</td>

			<?php
		}
		?>
				<td><?=$donnees['date_envoi']?></td>
				

				
				</td>
			</tr>
			
		<?php
		
		}
	

?>
</table>
<?php
}
?>









	<?php include ('pharmacien_menu.php');?>
<?php
	if (isset($_POST['nom'])) {
		if (($nb==0)) {
		
		
	?>
	<div style="position: absolute;top: 400px; left: 40%;"><h4 style="color: red;"><?php print('aucune résultat ')?></h4></div>
<?php
}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
			<br/>
			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">
							
							<input class="form-control" type="text" name="nom"  placeholder="Nom de fornissuer"/>  <br/>
							<select name="ville" style="position: absolute;height:43px;width: 100px;border-radius: 5px;position: absolute;top: -10px;left: -10px;">
								<option>kef</option>
							</select>
						</div>
						<div class="col-md-6">
							
							<input class="btn btn-info" type="submit" style="position: absolute;left: -40%; height: 43px;top: -7px;">
						</div>

					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="container-fuild">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table table">
<?php

				if (isset($_POST['nom']) or isset($_POST['ville'])){
					
				while($donnees=$reponse->fetch())
		{
			?>
				<tr>
					
					<th>Nom </th>	
					<th>Adresse</th>	
					<th>ville</th>	
					<th>Numéro de téléphone</th>	
					<th>Action</th>
				</tr>
        </div>
    </div>

</div>
	


			<tr>
				
				<td><?=$donnees['nom']?></td>
				<td><?=$donnees['adresse']?></td>
				<td><?=$donnees['ville']?></td>
				<td><?=$donnees['num_tel']?></td>
				
				

				<td>
					<a href="pharmacien_creer_commande.php?id_fr=<?=$donnees['id_fr']?>" class="btn btn-success">Passer une commande</a>
					
				</td>
			</tr>
			<?php

	
		
}
}	
?>
</table>


</table>
<div id="notif">
 <?php
  if ((!isset($_POST['nom'])) OR (!isset($_POST['ville']))) {
  	
  while ($row=$data->fetch()) {
  ?>
  
  <h4>votre commande de <?php echo $row['nom_med'];?> a été recue et sera recue le <?php echo $row['date_envoi'];?></h4>
  <?php
}
}
?>
</body>
</html>