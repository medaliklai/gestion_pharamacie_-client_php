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

$med_id=$_GET['med_id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from medicaments where med_id=?');
$reponse->execute(array($med_id));
$donnees=$reponse->fetch();



if (isset($_POST['nom']) AND isset($_POST['prix']) AND isset($_POST['qte']) AND isset($_POST['description']) AND isset($_POST['dosage']))
{
	$nom=htmlspecialchars($_POST['nom']);
	$prix=htmlspecialchars($_POST['prix']);
	$qte=htmlspecialchars($_POST['qte']);
	$description=htmlspecialchars($_POST['description']);
	$dosage=htmlspecialchars($_POST['dosage']);



	
$med_id=$_GET['med_id'];
	$reponse=$base->prepare('UPDATE medicaments SET nom_med=:nom_med, qte=:qte, prix=:prix, description=:description,dosage=:dosage where med_id=:med_id');
	$reponse->execute(array(
							'nom_med'=>$nom,
							'prix'=>$prix,
							'qte'=>$qte,
							'description'=>$description,
							'dosage'=>$dosage,
							'med_id'=>$med_id
							));
	$message="ksdjfv";

	header("location:pharmacien_affiche_med.php?message=".$message);

}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Modification médicaments</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/4.jpg);
				background-size: cover;
				
			}
			.row input[type=text]{
				background-color:white;
				color: black;
				width: 300px;
				
			}
			.form-mod{
					position:absolute;
					top: 300px;
				}
				h3{
					position: absolute;
					top: 200px;
					
					
				
		</style>
	</head>
<body>



<?php include ('pharmacien_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="text-center">Modification de médicaments</h3>

			<br/>

			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">

							<label>nom</label>
							<input class="form-control" type="text" name="nom" value="<?=$donnees['nom_med']?>" required/>  <br/>

					 		<label>prix</label>
							<input class="form-control" type="text" name="prix" value="<?=$donnees['prix']?>" required/>  <br/>

							<label>qte</label>
							<input class="form-control" type="text" name="qte" value="<?=$donnees['qte']?>" required/>  <br/>
					</div>
					<div class="col-md-6">
							<label>description</label>
							<input class="form-control" type="text" name="description" value="<?=$donnees['description']?>" required/>  <br/>

							<label>dosage</label>
							<input class="form-control" type="text" name="dosage" value="<?=$donnees['dosage']?>" required/>  <br/>
							<input class="btn btn-success" type="submit"/>
							
					</div>
				</div>


			</form>
		
		</div>
	</div>
</div>


</body>

</html>