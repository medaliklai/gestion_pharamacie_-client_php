<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="fournisseur")
{
	header('location:login_fornisseur.php');
	die();
}
include('connexionBD.php');
$user_id=$_SESSION['id'];
$req=$base->prepare('SELECT * from commande_pharmacie where id_fornisseur=?');
$req->execute(array($user_id));
$nbo=$req->rowCount();
$verif="non";
$requete=$base->prepare('SELECT * from commande_pharmacie where id_fornisseur=? and verifier=?');
$requete->execute(array($user_id,$verif));
$nbr=$requete->rowCount();

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Fornisseur</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</head>
	<style >
			body{
				background-image: url(images/11.jpg);
				background-size: cover;
				
			}
			#cercle1{
				position: absolute;
				top: 5px;
				left: 40%;
				height: 50px;
				width: 50px;
				border:3px solid dodgerblue;
				border-radius: 100%;
				 box-shadow:2px 2px 8px #aaa;
	            font:bold 13px Arial;
				background-color: white;
			}
			#cercle2{
				position: absolute;
				top: 5px;
				left: 40%;
				height: 50px;
				width: 50px;
				border-radius: 100%;
				border-radius: 100%;
				 box-shadow:2px 2px 8px #aaa;
	            font:bold 13px Arial;
				border:solid 3px tomato;
				background-color: white;
			}
			#cercle3{
				position: absolute;
				top: 5px;
				left: 40%;
				height: 50px;
				width: 50px;
				border-radius: 100%;
				border-radius: 100%;
				 box-shadow:2px 2px 8px #aaa;
	            font:bold 13px Arial;
				border:solid 3px green;
				background-color: white;
			}
			#cercle4{
				position: absolute;
				top: 5px;
				left: 40%;
				height: 50px;
				width: 50px;
				border-radius: 100%;
				border-radius: 100%;
				 box-shadow:2px 2px 8px #aaa;
	            font:bold 13px Arial;
				border:solid 3px green;
				background-color: white;
			}
			
		</style>
<body>



<?php include ('fournisseur_menu.php'); ?>
<div style="position: absolute;top: 300px;left: 35%;background-color: white;height:100px;width: 200px;border-radius: 10%; border:1px solid dodgerblue;">

	<div id="cercle1">
		<div style="position: absolute;top: 0%;left: 40%;">
			<h4>
		<?php
		echo $nbo;
		?>
	</h4>
	</div>

		
	</div>
	
<h4 style="position: absolute;top: 50px;left: 27%;">Commande</h4>

</div>
<div style="position: absolute;top: 300px;left: 50%;background-color: white;height:100px;width: 200px;border-radius: 10%; border:1px solid tomato;">

	<div id="cercle2">
		<div style="position: absolute;top: 0%;left: 40%;">
			<h4>
		<?php
		echo $nbr
		?>
	</h4>
	</div>


		
	</div>
	
<h4 style="position: absolute;top: 50px;left: 10%;">Nouveau commande</h4>
</div>








</body>

</html>