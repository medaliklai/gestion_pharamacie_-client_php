<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="admin")
{
	header('location:login_admin.php');
	die();
}
include('connexionBD.php');
$req=$base->prepare('SELECT * from pharmacie');
$req->execute();
$nbo=$req->rowCount();

$requete=$base->prepare('SELECT * from client');
$requete->execute();
$nbr=$requete->rowCount();

$req=$base->prepare('SELECT * from fornisseur');
$req->execute();
$nombre=$req->rowCount();


		$user_id=$_SESSION['id'];	
		$rep=$base->prepare('SELECT * from message where id_recepteur=0 ');
		$rep->execute();
		$receive=$rep->rowCount();
	
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>administration</title>
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
				border:solid 3px #7CFC00;
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
				border:solid 3px red;
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
				border:solid 3px #BC8F8F;
				background-color: white;
			}
			
		</style>
<body>



<?php include ('admin_menu.php'); ?>
<div style="position: absolute;top: 300px;left: 20%;background-color: rgba(0,0,0,0.8); border:solid 3px dodgerblue;height:100px;width: 200px;border-radius: 10%;">

	<div id="cercle1">
		<div style="position: absolute;top: 0%;left: 40%;">
			<h4>
		<?php
		echo $receive;
		?>
	</h4>
	</div>

		
	</div>
	
<h4 style="position: absolute;top: 50px;left: 30%;color: white;">Messages</h4>
</div>
<div style="position: absolute;top: 300px;left: 35%;background-color: rgba(0,0,0,0.8);border:solid 3px #7CFC00;height:100px;width: 200px;border-radius: 10%;">

	<div id="cercle2">
		<div style="position: absolute;top: 0%;left: 40%;">
			<h4>
		<?php
		echo $nbo;
		?>
	</h4>
	</div>

		
	</div>
	
<h4 style="position: absolute;top: 50px;left: 27%;color: white;">Pharmacies</h4>
</div>
<div style="position: absolute;top: 300px;left: 50%;background-color:rgba(0,0,0,0.8);border:solid 3px red;height:100px;width: 200px;border-radius: 10%;">

	<div id="cercle3">
		<div style="position: absolute;top: 0%;left: 40%;">
			<h4>
		<?php
		echo $nbr
		?>
	</h4>
	</div>

		
	</div>
	
<h4 style="position: absolute;top: 50px;left: 37%;color: white;">Clients</h4>
</div>

<div style="position: absolute;top: 300px;left: 65%;background-color: rgba(0,0,0,0.8);border:solid 3px #BC8F8F;height:100px;width: 200px;border-radius: 10%;">

	<div id="cercle4">
		<div style="position: absolute;top: 0%;left: 40%;">
			<h4>
		<?php
		echo $nombre
		?>
	</h4>
	</div>

		
	</div>
	
<h4 style="position: absolute;top: 50px;left: 30%;color: white;">Fournisseur</h4>
</div>

</div>




</body>

</html>