<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="admin")
{
	header('location:login_admin.php');
	die();
}

if (isset($_POST['nom']) AND isset($_POST['adresse'])AND isset($_POST['type']) AND isset($_POST['cnam']) AND isset($_POST['ville'])AND isset($_POST['num_tel']) AND isset($_POST['login']) AND isset($_POST['mdp']) AND isset($_POST['role']))
{
	$nom=htmlspecialchars($_POST['nom']);
	$adresse=htmlspecialchars($_POST['adresse']);
	$type=htmlspecialchars($_POST['type']);
	$cnam=htmlspecialchars($_POST['cnam']);
	$ville=htmlspecialchars($_POST['ville']);
	$num_tel=htmlspecialchars($_POST['num_tel']);
	$login=htmlspecialchars($_POST['login']);
	$mdp=htmlspecialchars($_POST['mdp']);
	$role=htmlspecialchars($_POST['role']);

	
	

	include ('connexionBD.php');

	//verification des données
	//.....

	//insertion dans la base de données

	$reponse=$base->prepare('INSERT INTO pharmacie(nom,type,cnam,adresse,num_tel,ville, login, mdp, role) VALUES (:nom, :type,:cnam,:adresse,:num_tel,:ville, :login, :mdp, :role)');
	$reponse->execute(array(
							'nom' => $nom,
							'type' =>$type,
							'cnam'=>$cnam,
							'adresse' =>$adresse,
							'num_tel' =>$num_tel,
							'ville'=>$ville,
							'login' => $login,
							'mdp' => $mdp,
							'role' => $role
							));

	header('location:admin_affiche_pharmacie.php');

}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Ajout users</title>
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
				
				width: 350px;
				
			
				}
				.form-mod{
					position:absolute;
					top: 220px;
				}
				h3{
					position: absolute;
					top: 300px;
				}

				label{
					color: white;
				}	
				
		</style>
	</head>
<body>



<?php include ('admin_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="text-center" style="color: white;">Ajout d'un nouvel pharmacie</h3>

			<br/>

			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">

							<label>nom</label>
							<input class="form-control" type="text" name="nom" required/>  <br/>

							<label>adresse</label>
							<input class="form-control" type="text" name="adresse" required/>  <br/>
							<label>ville</label><br/>
							<select style="height: 35px;width: 350px;background-color: white;border-radius: 5px;"name="ville" >
								<option>kef</option>
							</select><br/><br/>

							<label>Cnam</label><br/>
							<select style="height: 35px;width: 350px;background-color: white;border-radius: 5px;"name="cnam">
								<option>oui</option>
								<option>non</option>
							</select><br/><br/>

							<label>Numéro de téléphone</label>
							<input class="form-control" type="text" name="num_tel" required/>  <br/>

							<label>login</label>
							<input class="form-control" type="text" name="login" required/>  <br/>
					</div>
					<div class="col-md-6">
							<label>mdp</label>
							<input class="form-control" type="text" name="mdp" required/>  <br/>
							<label>role</label>
							<input class="form-control" type="text" name="role" required>  <br/>
							<label>type</label><br/>
							<select style="height: 35px;width: 350px;background-color: white;border-radius: 5px;"name="type">
								<option>nuit</option>
								<option>jour</option>
							</select>

							</br>
							<input class="btn btn-info" type="submit"style="position: absolute;top:250px"; />
							
					</div>
				</div>


			</form>
		
		</div>
	</div>
</div>


</body>

</html>