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

$id_client=$_GET['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from client where id_client=?');
$reponse->execute(array($id_client));
$donnees=$reponse->fetch();



if (isset($_POST['supp']))
{
	//verification des données
	//.....

	//mise a jour dans la base de données
	$reponse=$base->prepare('DELETE from client where id_client='.$id_client);
	$reponse->execute(array($id_client));

	
	header('location:admin_affiche_client.php');

}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Suppression client</title>
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
					top: 250px;
					left: 30%;
				}
					
				
		</style>
	</head>
<body>



<?php include ('admin_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 style="color: red;">Suppression de client</h3>

			<br/>


			<table class="table table-hover">
				<tr><th>id</th><td><?=$donnees['id_client']?></td></tr>
				<tr><th>nom</th><td><?=$donnees['nom_clt']?></td></tr>
				<tr><th>prenom</th><td><?=$donnees['num_tel']?></td></tr>
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