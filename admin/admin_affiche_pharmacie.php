<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="admin")
{
	header('location:login_admin.php');
	die();
}

		include ('connexionBD.php');
			
		$ligne=$base->prepare('SELECT * from pharmacie ');
		$ligne->execute();

		$count=$ligne->rowCount();
		if (isset($_POST['nom'])) {
			$nom=$_POST['nom'];
			$rech=$base->prepare('SELECT * from pharmacie where nom=?');
			$rech->execute(array($nom));
			$nb=$rech->rowCount();
			echo $nb;
		}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>administration</title>
         <link rel="icon" type="image/png" href="images/logo.png"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/2.jpg);
				background-size: cover;
				
			}
			.table-hover{
				position: absolute;
				top:350px;
				background-color: white;
				width: 1000px;
				border-radius: 5px;
				
			
			}
			
			h3{
				position: absolute;
				top: 280px;
				left: 40%;
				color: white;

			}
			.button1{
			 	position: absolute;
			 	left: 15%;
			 	top:290px;
			 	width:60px;
	            height:60px;
	            background:#fafafa;
	            box-shadow:2px 2px 8px #aaa;
	            
	            border-radius:50%;
	            color:#555;
	            background-color:dodgerblue;
	            transform: scale(1);
	        }
	        .button1:hover{
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
			 	transform: scale(1.02);
			 	transition:0.5s;
			 	background-color:tomato;
			 }
			 #navbar a:focus{
			 	background-color: red;
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


			 

			
			
					
				
		</style>
	</head>
<body>


<?php include ('admin_menu.php'); ?>
<p><a href="admin_ajout_pharmacie.php"><button class="button1"><span class="glyphicon glyphicon-plus"></span></button></a></p>
<div id="recherche">
<form method="POST">
	
	<input type="text" name="nom" class="form-control" placeholder="entrer le nom de pharmacie" >
	<button type="submit" name="cherche"value="recherche" class="btn" ><i class="glyphicon glyphicon-search" style="font-size: 30px; color: dodgerblue;"></i></button> 
</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 ">

			<?php
			
				if(isset($_POST['nom']))
			{
		?>
			<h3 class="text-center" style="color: white;">Résultat de recherche</h3>
			<table class="table table-hover" >
				
				<tr class="liste">
					<th>ID</th>
					<th>Nom </th>	
					<th>Type</th>
					<th>Cnam</th>
					<th>Adresse</th>	
					<th>Numéro de téléphone</th>	
					<th>ville</th>
					<th>Login</th>	
					<th>Mdp</th>
					<th>Role</th>
					<th>Action</th>	
				</tr>


	<?php 

	while($cherche=$rech->fetch())
		{
	
		?>
			<tr class="liste">
				<td><?=$cherche['id']?></td>
				<td><?=$cherche['nom']?></td>
				<td><?=$cherche['type']?></td>
				<td><?=$cherche['cnam']?></td>
				<td><?=$cherche['adresse']?></td>
				<td><?=$cherche['num_tel']?></td>
				<td><?=$cherche['ville']?></td>
				<td><?=$cherche['login']?></td>
				<td><?=$cherche['mdp']?></td>
				<td><?=$cherche['role']?></td>
				<td>
					<a href="admin_modification_pharmacie.php?id=<?=$cherche['id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="admin_suppression_pharmacie.php?id=<?=$cherche['id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
					<a href="admin_envoyer_message.php?id=<?=$cherche['id']?>&role=<?=$cherche['role']?>&nom=<?=$cherche['nom']?>" class="btn btn-info"><span class="glyphicon glyphicon-envelope"></span></a>
				</td>
			</tr>
			
		<?php
		
		}
	}
	


?>
<?php
if ($nb==0 and isset($_POST['nom'])) {
	?>
<div>Résultat=0</div>
<?php
}
?>
</table>

			
			
			<?php
			
				if($count>0 and !isset($_POST['nom']))
			{
		?>
			<h3 class="text-center" style="color: white;">Liste des pharmacies</h3>
			
			<table class="table table-hover" >
				
				
				<tr class="liste">
					<th>ID</th>
					<th>Nom </th>	
					<th>Type</th>
					<th>Cnam</th>
					<th>Adresse</th>	
					<th>Numéro de téléphone</th>	
					<th>ville</th>
					<th>Login</th>	
					<th>Mdp</th>
					<th>Role</th>
					<th>Action</th>	
				</tr>


	<?php 
	while($donnees=$ligne->fetch())
		{
	
		?>
			<tr class="liste">
				<td><?=$donnees['id']?></td>
				<td><?=$donnees['nom']?></td>
				<td><?=$donnees['type']?></td>
				<td><?=$donnees['cnam']?></td>
				<td><?=$donnees['adresse']?></td>
				<td><?=$donnees['num_tel']?></td>
				<td><?=$donnees['ville']?></td>
				<td><?=$donnees['login']?></td>
				<td><?=$donnees['mdp']?></td>
				<td><?=$donnees['role']?></td>
				<td>
					<a href="admin_modification_pharmacie.php?id=<?=$donnees['id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="admin_suppression_pharmacie.php?id=<?=$donnees['id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
					<a href="admin_envoyer_message.php?id=<?=$donnees['id']?>&role=<?=$donnees['role']?>&nom=<?=$donnees['nom']?>" class="btn btn-info"><span class="glyphicon glyphicon-envelope"></span></a>
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
if($count>0 AND !isset($_POST['nom'])){ ?>
	<div style="position: absolute;top: 300px;left: 88%;">
	<a href="supprimer_tous_pharmacie.php" class="btn btn-danger"> SUPPRIMER TOUS</a>
</div>
<?php
}
?>
<?php
if ($count==0 AND !isset($_POST['nom'])) {
	?>
	<div style="position: absolute;top: 400px; left: 40%;"><h4 style="color: red;">aucune pharmacie</h4></div>
	<?php
}
?>
	
</body>

</html>