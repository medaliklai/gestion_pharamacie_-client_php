<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}

if (isset($_POST['nom_med']) AND isset($_POST['prix']) AND isset($_POST['qte']) AND isset($_POST['description'])AND isset($_POST['date_fab']) AND isset($_POST['date_fin']) AND isset($_POST['dosage']))
{
	$nom_med=htmlspecialchars($_POST['nom_med']);
	$prix=htmlspecialchars($_POST['prix']);
	$dosage=htmlspecialchars($_POST['dosage']);
	$qte=htmlspecialchars($_POST['qte']);
	$date_fab=htmlspecialchars($_POST['date_fab']);
	$date_fin=htmlspecialchars($_POST['date_fin']);
	$description=htmlspecialchars($_POST['description']);
	$user_id=$_SESSION['id'];

	
	

	include ('connexionBD.php');


	$reponse=$base->prepare('INSERT INTO medicaments(nom_med, prix, qte, date_fab, date_fin ,description, 
		dosage,user_id) VALUES (:nom_med, :prix, :qte, :date_fab, :date_fin ,:description, :dosage, :user_id)');
	$reponse->execute(array(
							'nom_med' => $nom_med,
							'prix' =>$prix,
							'qte' => $qte,
							'date_fab' => $date_fab,
							'date_fin' => $date_fin,
							'description' => $description,
							'dosage'=>$dosage,
							'user_id' =>$user_id
							));

	header('location:pharmacien_affiche_med.php');

}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Ajouter médicament</title>
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
				width: 500px;
			}
				.row input[type=date]{
				background-color:white;
				color: black;
				width: 500px;
				
			}
			.form-mod{
					position:absolute;
					top: 200px;
					left: -20%;
				}
				h3{
					position: absolute;
					top: 150px;
					left: 40%;
				}	
				
		</style>
	</head>
<body>



<?php include ('pharmacien_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="text-center">Ajout d'un nouvel medicament</h3>

			<br/>

			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">

							<label>nom</label>
							<input class="form-control" type="text" name="nom_med" required/>  <br/>

							<label>prix</label>
							<input class="form-control" type="text" name="prix" required/>  <br/>

							<label>qte</label>
							<input class="form-control" type="text" name="qte" required/>  <br/>
					
							<label>description</label>
							<input class="form-control" type="text" name="description" required/>  <br/>

							<label>dosage</label>
							<input class="form-control" type="text" name="dosage" required/>  <br/>

							<label>date de fabrication</label>
							<input class="form-control" type="date" name="date_fab" required/>  <br/>

							<label>date d'éxpération</label>
							<input class="form-control" type="date" name="date_fin"  required/>  <br/>
							
							<input class="btn btn-success" type="submit"/>
					</div>
				</div>


			</form>
		
		</div>
	</div>
</div>


</body>

</html>