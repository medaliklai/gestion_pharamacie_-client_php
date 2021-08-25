<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}

if (!isset($_GET['id_fr']))
{
	header('location:login_pharmacien.php');
	die();
}
$id=$_SESSION['id'];
$id_fr=$_GET['id_fr'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * FROM fornisseur where id_fr=?');
$reponse->execute(array($id_fr));
$donnees=$reponse->fetch();
$nom_fornisseur=$donnees['nom'];
$id_fornisseur=$donnees['id_fr'];


	if (isset($_POST['nom_med']) AND isset($_POST['qte']))
{
	$nom_med=htmlspecialchars($_POST['nom_med']);
	$qte=htmlspecialchars($_POST['qte']);
	
	$datetime = date("Y-m-d H:i:s");
	$nom_fornisseur=$donnees['nom'];
    $id_fornisseur=$donnees['id_fr'];

	$reponse=$base->prepare('INSERT INTO commande_pharmacie (nom_med, qte, nom_fornisseur,id_fornisseur, nom_pharmacie,id_pharmacie,date_cmd) VALUES (:nom_med, :qte, :nom_fornisseur,:id_fornisseur, :nom_pharmacie,:id_pharmacie,:date_cmd)');
	$reponse->execute(array(
							'nom_med' => $nom_med,
							'qte' =>$qte,
							'nom_fornisseur' => $nom_fornisseur,
							'id_fornisseur'=>$id_fornisseur,
							'nom_pharmacie' => $_SESSION['nom'],
							'id_pharmacie'=>$_SESSION['id'],
							'date_cmd'=>$datetime,
							
							
							));
	header('location:pharmacien_fornisseur.php');
	}
	



?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Commande</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/4.jpg);
				background-size: cover;
				
			}
			.row input[type=text]{
				background-color:rgba(0,0,0,0.25);
				color: black;
			}
			.form-mod{
					position:absolute;
					top: 300px;
					width: 100%;
					left: 30%;
				}
				h3{
					position: absolute;
					top: 200px;
					width: 100%;}
					
				
		</style>
	</head>
<body>



<?php include ('pharmacien_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="text-center">confirmer la commande</h3>

			<br/>

			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">

							

							
							<label>Médicament</label>
							<input class="form-control" type="text" name="nom_med" value="" required/>  <br/>
					        <label>Quantité</label>
							<input class="form-control" type="text" name="qte" value="" required/>  <br/>
					
							<input class="btn btn-success" type="submit"/>
							
					</div>
				</div>


			</form>
		
		</div>
	</div>
</div>

 

</body>

</html>