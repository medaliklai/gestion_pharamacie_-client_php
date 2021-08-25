<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login.php');
	die();
}

if (!isset($_GET['med_id']))
{
	header('location:login.php');
	die();
}

$user_id=$_GET['med_id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from medicaments where med_id=?');
$reponse->execute(array($user_id));
$donnees=$reponse->fetch();



if (isset($_POST['supp']))
{
	//verification des données
	//.....

	//mise a jour dans la base de données
	$reponse=$base->prepare('DELETE from medicaments where med_id='.$user_id);
	$reponse->execute(array($user_id));
     

	
	header('location:pharmacien_affiche_med.php');

}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Suppression médicaments</title>
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
					top: 200px;
					left: 20%;
					

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

			
					
				
		</style>
	</head>
<body>
<?php include ('pharmacien_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 style="color: tomato;">Suppression de médicaments</h3>

			<br/>


			<table class="table table-hover">
				

				<tr><th>nom</th><td><?=$donnees['nom_med']?></td></tr>
				<tr><th>prix</th><td><?=$donnees['prix']?></td></tr>
				<tr><th>qte</th><td><?=$donnees['qte']?></td></tr>
				<tr><th>description</th><td><?=$donnees['description']?></td></tr>
			</table>


			<form method="POST"  action="#">
				<input class="btn btn-danger" type="submit" name="supp"/>
				<a href="pharmacien_affiche_med.php" class="btn btn-success ">Annuler</a>
			</form>
		
		</div>
	</div>
</div>


</body>

</html>