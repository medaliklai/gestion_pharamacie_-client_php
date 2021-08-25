<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="admin")
{
	header('location:login_admin.php');
	die();
}
if (isset($_POST['nom']))
{
	$nom=htmlspecialchars($_POST['nom']);
    $id=$_SESSION['id'] ;
	include ('connexionBD.php');
	$reponse=$base->prepare('SELECT * from pharmacie where nom=?'  );
	$reponse->execute(array($nom));
	$nb=$reponse->rowCount();
	echo $nb;
}
if (isset($_POST['nom'])) {
	
	$reponse_e=$base->prepare('SELECT * from client where nom_clt=?'  );
	$reponse_e->execute(array($nom));
	$nombre=$reponse_e->rowCount();
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
				background-image: url(images/.jpg);
				background-size: cover;
				
			}
			
			.form-mod{
					position:absolute;
					top: 200px;
					width: 200%;

				}
				.form-mod input{
					border-radius: 20px;
					height: 40px;
				}
				.form-mod input:hover{
					
					transform: scale(1.05);
					transition: 1s;
				}
				
					.table{
				position: absolute;
				top:300px;
				background-color: white;
			}
			
					
				
		</style>
				
	</head>
<body>
	<?php include ('admin_menu.php');?>
<?php
	if (isset($_POST['nom'])) {
		if (($nb==0) OR ($nombre==0)) {
		
		
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
							
							<input class="form-control" type="text" name="nom"  placeholder="Nom de pharmacien,nom de client..."required/>  <br/>
						</div>
						<div class="col-md-6">
							
							<input class="btn btn-info" type="submit" >
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

				if (isset($_POST['nom'])){
					
				while($donnees=$reponse->fetch())
					if ($donnees['nom']==$_POST['nom']){
				

		{
			?>
				<tr>
					<th>ID</th>
					<th>Nom </th>	
					<th>  Adresse</th>	
					<th>  Login</th>	
					<th>   Mdp</th>
					<th>Role</th>	
					<th>Action</th>
				</tr>
        </div>
    </div>

</div>
	


			<tr>
				<td><?=$donnees['id']?></td>
				<td><?=$donnees['nom_user']?></td>
				<td><?=$donnees['adresse']?></td>
				<td><?=$donnees['login']?></td>
				<td><?=$donnees['mdp']?></td>
				<td><?=$donnees['role']?></td>
				

				<td>
					<a href="admin_modification_users.php?id=<?=$donnees['id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="admin_suppression_users.php?id=<?=$donnees['id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
			<?php

	
		
}
}
}	
?>
</table>
<div class="container-fuild">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-hover">
<?php

				if (isset($_POST['nom'])){
					
				while($donnees_e=$reponse_e->fetch())
					if ($donnees_e['nom_clt']=$_POST['nom']){
				

		{
			?>
				<tr>
					<th>ID</th>
					<th>nom</th>
					<th>prénom</th>	
					<th>numéro de téléphone</th>	
					<th>login</th>	
					<th>mdp</th>
					<th>role</th>	
					<th>Action</th>	
				</tr>
        </div>
    </div>

</div>
	


			
			<tr>
				<td><?=$donnees_e['id_client']?></td>
				<td><?=$donnees_e['nom_clt']?></td>
				<td><?=$donnees_e['prenom']?></td>
				<td><?=$donnees_e['num_tel']?></td>
				<td><?=$donnees_e['login']?></td>
				<td><?=$donnees_e['mdp']?></td>
				<td><?=$donnees_e['role']?></td>
				<td>
					<a href="admin_modifier_client.php?id_client=<?=$donnees_e['id_client']?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="admin_supprimer_client.php?id_client=<?=$donnees_e['id_client']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
			<?php

	
		
} 
}else{echo"resultat=0";}
}	
?>
</table>

</body>
</html>