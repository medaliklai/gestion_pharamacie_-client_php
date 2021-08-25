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

$user_id=$_GET['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from fornisseur where id_fr=?');
$reponse->execute(array($user_id));
$donnees=$reponse->fetch();

if (isset($_POST['nom'])  AND isset($_POST['adresse'])  AND isset($_POST['ville']) AND isset($_POST['num_tel']) AND isset($_POST['login']) AND isset($_POST['mdp']) AND isset($_POST['role']))
{
	$nom=htmlspecialchars($_POST['nom']);
	$adresse=htmlspecialchars($_POST['adresse']);
	$ville=htmlspecialchars($_POST['ville']);
	$num_tel=htmlspecialchars($_POST['num_tel']);
	$login=htmlspecialchars($_POST['login']);
	$mdp=htmlspecialchars($_POST['mdp']);
	$role=htmlspecialchars($_POST['role']);

$user_id=$_GET['id'];
$reponse=$base->prepare('UPDATE fornisseur SET nom=:nom,adresse=:adresse,ville=:ville,num_tel=:num_tel,login=:login,mdp=:mdp,role=:role where id_fr=:user_id');
	$reponse->execute(array(
							'nom'=>$nom,
							'adresse'=>$adresse,
							'ville'=>$ville,
							'num_tel'=>$num_tel,
							'login'=>$login,
							'mdp'=>$mdp,
							'role'=>$role,
							'user_id'=>$user_id
							));

	header('location:admin_affiche_fornisseur.php');

}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>modification users</title>
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
					top: 220px;
					left: 10%;
				}
				h3{
					position: absolute;
					top: 150px;
					color:white;
					left: 30%;
					}
					label{
						color:white;
					}
				
		</style>
				
	</head>
<body>



<?php include ('admin_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3  style="color: white;">Modification de l'utilisateur</h3>

			<br/>

			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">

							<label>nom</label>
							<input class="form-control" type="text" name="nom" value="<?=$donnees['nom']?>" required/>  <br/>

							<label>adresse</label>
							<input class="form-control" type="text" name="adresse" value="<?=$donnees['adresse']?>" required/>  <br/>
							
							<label>ville</label>
							<input class="form-control" type="text" name="ville" value="<?=$donnees['ville']?>" required/>  <br/>

							<label>num_tel</label>
							<input class="form-control" type="text" name="num_tel" value="<?=$donnees['num_tel']?>" required/>  <br/>

							<label>login</label>
							<input class="form-control" type="text" name="login" value="<?=$donnees['login']?>" required/>  <br/>
					</div>
					<div class="col-md-6">
							<label>mot de pass</label>
							<input class="form-control" type="text" name="mdp" value="<?=$donnees['mdp']?>" required/>  <br/>

							<label>role</label>
							<input class="form-control" type="text" name="role" value="<?=$donnees['role']?>" required>  <br/>
							<input class="btn btn-success" type="submit"/>
							
					</div>
				</div>


			</form>
		
		</div>
	</div>
</div>


</body>

</html>