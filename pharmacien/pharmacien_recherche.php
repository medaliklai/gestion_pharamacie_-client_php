<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}
$user_id=$_SESSION['id'] ;
if (isset($_POST['nom']))
{
	$nom=htmlspecialchars($_POST['nom']);
    
	include ('connexionBD.php');
	$reponse=$base->prepare('SELECT * from medicaments where nom_med=? AND user_id=?'  );
	$reponse->execute(array($nom,$user_id));
	$nb=$reponse->rowCount();
	if ($nb==0) {
		$resultat="";
	}
}
if (isset($_POST['périmé'])) {
	include('connexionBD.php');
	$périmé=$_POST['périmé'];
	$datetime = date("Y-m-d H:i:s");
	$data=$base->prepare('SELECT * from medicaments where user_id=? and date_fin<?');
	$data->execute(array($user_id,$datetime));
	$nbr=$data->rowCount();

}


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
				background-image: url(images/1.jpg);
				background-size: cover;
				
			}
			
			#recherche{
			 	position: absolute;
			 	top: 30%;
			 	
			 	height: 70px;
			 	width: 100%;
			 	background-color: rgba(0,0,0,0.8);
			 }
			 input[type=text]{
			 	width: 600px;
			 	height: 45px;
			 	position: absolute;
			 	top: 10%;
			 	left: 30%;
			 	background-color: transparent;
			 	color: silver;
			 }
			 button{
			 	background-color: transparent;
			 	position: absolute;
			 	left:75%;
			 	top: 15%;
			 	height: 50px;
			 	width: 50px;
			 }
			 .glyphicon-search:hover{
			 transform: scale(1.06);
			 transition: 0.25s;
			 }
			 .table-hover{
				position: absolute;
				top: 350px;
				background-color: white;	
				
		</style>
			 
				
	</head>
<body>
	<?php include ('pharmacien_menu.php');?>
	<div id="recherche">
<form method="POST">
	
	<input type="text" name="nom" class="form-control" placeholder="entrer nom de médicaments" required>
	<button type="submit" name="cherche"value="recherche" class="btn" ><i class="glyphicon glyphicon-search" style="font-size: 30px; color: dodgerblue;"></i></button>
	</form>
	<form method="POST">
				<button class="btn btn-danger" name="périmé" style="position: absolute;left: 200px; width: 150px;">Périmés</button>
			</form>	 
</div>
<?php
	if (isset($resultat)) {
		
		
	?>
	<div style="position: absolute;top: 300px; left: 40%;"><h3 style="color: red;">Aucune résultat</h3></div>
<?php
}

?>

<div class="container-fuild">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table table-hover">
<?php

				if (isset($_POST['nom'])){
					
				while($donnees=$reponse->fetch())
				

		{
			?>
			<h3 style="position: absolute;top: 300px;left: 40%;">Résultat de recherche</h3>
				<tr>
					<th>nom</th>
					<th>quantité</th>	
					<th>prix</th>
					<th>date de fabrication</th>
					<th>date de fin</th>		
					<th>description</th>
					<th>action</th>
				</tr>
        </div>
    </div>

</div>
	


			<tr>
				<td><?=$donnees['nom_med']?></td>
				<td><?=$donnees['qte']?></td>
				<td><?=$donnees['prix']?></td>
				<td><?=$donnees['date_fab']?></td>
				<td><?=$donnees['date_fin']?></td>
				<td><?=$donnees['description']?></td>

				<td>
					<a href="pharmacien_modif_med.php?med_id=<?=$donnees['med_id']?>" class="btn btn-warning"><span class="fa fa-edit"></span></a>
					<a href="pharmacien_supprimer_med.php?med_id=<?=$donnees['med_id']?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
					<?php if ($donnees['date_fab']>$donnees['date_fin']){ 
					 echo"médicaments périmé";
					
					}
					?>
				</td>
			</tr>
			<?php

	
		
}}	
?>
</table>

<table class="table table-hover">
<?php

				if (isset($_POST['périmé'])){
					
				while($donnees=$data->fetch())
				

		{
			?>
			<h3 style="position: absolute;top: 300px;left: 40%;">Les médicaments périmés</h3>
				<tr>
					<th>nom</th>
					<th>quantité</th>	
					<th>prix</th>
					<th>date de fabrication</th>
					<th>date d'expiration</th>		
					<th>description</th>
					<th>action</th>
				</tr>
        </div>
    </div>

</div>
	


			<tr>
				<td><?=$donnees['nom_med']?></td>
				<td><?=$donnees['qte']?></td>
				<td><?=$donnees['prix']?></td>
				<td><?=$donnees['date_fab']?></td>
				<td><?=$donnees['date_fin']?></td>
				<td><?=$donnees['description']?></td>

				<td>
					<a href="pharmacien_modif_med.php?med_id=<?=$donnees['med_id']?>" class="btn btn-warning"><span class="fa fa-edit"></span></a>
					<a href="pharmacien_supprimer_med.php?med_id=<?=$donnees['med_id']?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
					<?php if ($donnees['date_fab']>$donnees['date_fin']){ 
					 echo"médicaments périmé";
					
					}
					?>
				</td>
			</tr>
			<?php

	
		
}}	
?>
</table>
</body>
</html>