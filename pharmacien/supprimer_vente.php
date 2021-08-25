<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login.php');
	die();
}

if (!isset($_GET['id_med']))
{
	header('location:login.php');
	die();
}

$id_med=$_GET['id_med'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from vente where id_med=?');
$reponse->execute(array($id_med));
$donnees=$reponse->fetch();



if (isset($_POST['supp']))
{
	//verification des données
	//.....

	//mise a jour dans la base de données
	$reponse=$base->prepare('DELETE from vente where id_med='.$id_med);
	$reponse->execute(array($id_med));

	
	header('location:historique_de_vente.php');

}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Suppression vente</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style>
		body{
				background-image: url(images/4.jpg);
				background-size: cover;
			}
			.table-hover{
				background-color:rgba(0,0,0,0.25);
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
				}
				.btn-danger{
						position: absolute;
						top: 500px;
					}
					.btn-success{
						position: absolute;
						top: 500px;
						left: 100px;
					}
					h3{
					position: absolute;
					top: 250px;
					color: tomato;

				}
		</style>
					
	</head>
<body>
<?php include ('pharmacien_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 >Suppression de vente</h3>

			<br/>


			<table class="table table-hover">
				

				<tr><th>nom</th><td><?=$donnees['nom']?></td></tr>
				<tr><th>qte</th><td><?=$donnees['qte']?></td></tr>
				<tr><th>prix</th><td><?=$donnees['prix_unitaire']?></td></tr>
				<tr><th>prix</th><td><?=$donnees['prix_vente']?></td></tr>
				<tr><th>date de vente</th><td><?=$donnees['date_v']?></td></tr>
			</table>



			<form method="POST"  action="#">
				<input class="btn btn-danger" type="submit" name="supp"/>
				<a href="historique_de_vente.php" class="btn btn-success ">Annuler</a>
			</form>
		
		</div>
	</div>
</div>


</body>

</html>