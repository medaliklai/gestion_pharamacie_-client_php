<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="admin")
{
	header('location:login_admin.php');
	die();
}

if (!isset($_GET['id']))
{
	header('location:login_admin.php');
	die();
}

$user_id=$_GET['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from fornisseur where id_fr=?');
$reponse->execute(array($user_id));
$donnees=$reponse->fetch();



if (isset($_POST['supp']))
{
	//verification des données
	//.....

	//mise a jour dans la base de données
	$reponse=$base->prepare('DELETE from fornisseur where id_fr='.$user_id);
	$reponse->execute(array($id));

	
	header('location:admin_affiche_fornisseur.php');

}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Suppression users</title>
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
				top: 280px;
			}
			.form-mod{
					position:absolute;
					top: 600px;
				}
				h3{
					position: absolute;
					top: 200px;
					left: 30%;
				}
				
				}
				.btn-danger{
					position: absolute;
					top: 120px;
				}
				

					
				
		</style>
	</head>
<body>



<?php include ('admin_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 style="color: red;">Suppression de Fornisseur</h3>

			<br/>


			<table class="table table-hover">
				<tr><th>id</th><td><?=$donnees['id_fr']?></td></tr>
				<tr><th>nom</th><td><?=$donnees['nom']?></td></tr>
				<tr><th>adresse</th><td><?=$donnees['adresse']?></td></tr>
				<tr><th>ville</th><td><?=$donnees['ville']?></td></tr>
				<tr><th>N Tel</th><td><?=$donnees['num_tel']?></td></tr>
				<tr><th>login</th><td><?=$donnees['login']?></td></tr>
				<tr><th>mot de passe</th><td><?=$donnees['mdp']?></td></tr>
				<tr><th>role</th><td><?=$donnees['role']?></td></tr>
			</table>



			<form method="POST"  action="#" class="form-mod">
				<input class="btn btn-danger" type="submit" name="supp"/>
			</form>
		
		</div>
	</div>
</div>


</body>

</html>