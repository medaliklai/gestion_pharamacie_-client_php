<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="admin")
{
	header('location:login_admin.php');
	die();
}

if (!isset($_GET['id']))
{
	header('location:login.php');
	die();
}

$user_id=$_GET['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from pharmacie where id=?');
$reponse->execute(array($user_id));
$donnees=$reponse->fetch();



if (isset($_POST['supp']))
{
	//verification des données
	//.....

	//mise a jour dans la base de données
	$reponse=$base->prepare('DELETE from pharmacie where id='.$user_id);
	$reponse->execute(array($id));

	
	header('location:admin_affiche_pharmacie.php');

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
				top: 300px;
			}
			.form-mod{
					position:absolute;
					top: 550px;
				}
				h3{
					position: absolute;
					top: 100px;
					left: 30%;
				}
				.table-hover{
					position: absolute;
					top:220px;
				}
				.btn-danger{
					position: absolute;
					
				}
				

					
				
		</style>
	</head>
<body>



<?php include ('admin_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 style="color: red;">Suppression  de pharmacie</h3>

			<br/>


			<table class="table table-hover">
				<tr><th>id</th><td><?=$donnees['id']?></td></tr>
				<tr><th>nom</th><td><?=$donnees['nom']?></td></tr>
				<tr><th>adresse</th><td><?=$donnees['adresse']?></td></tr>
				<tr><th>ville</th><td><?=$donnees['ville']?></td></tr>
				<tr><th>type</th><td><?=$donnees['type']?></td></tr>
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