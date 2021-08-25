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
$reponse=$base->prepare('SELECT * from pharmacie where id=?');
$reponse->execute(array($user_id));
$donnees=$reponse->fetch();

if (isset($_POST['nom']) AND isset($_POST['type'])AND isset($_POST['cnam'])AND isset($_POST['adresse'])AND isset($_POST['num_tel']) AND isset($_POST['ville'])  AND isset($_POST['login']) AND isset($_POST['mdp']) AND isset($_POST['role']))
{
	$nom=htmlspecialchars($_POST['nom']);
	$type=htmlspecialchars($_POST['type']);
	$cnam=htmlspecialchars($_POST['cnam']);
	$adresse=htmlspecialchars($_POST['adresse']);
	$num_tel=htmlspecialchars($_POST['num_tel']);
	$ville=htmlspecialchars($_POST['ville']);
	$login=htmlspecialchars($_POST['login']);
	$mdp=htmlspecialchars($_POST['mdp']);
	$role=htmlspecialchars($_POST['role']);

$user_id=$_GET['id'];
$reponse=$base->prepare('UPDATE pharmacie SET nom=:nom,type=:type,cnam=:cnam,adresse=:adresse,num_tel=:num_tel,ville=:ville,login=:login,mdp=:mdp,role=:role where id=:user_id');
	$reponse->execute(array(
							'nom'=>$nom,
							'type'=>$type,
							'cnam'=>$cnam,
							'adresse'=>$adresse,
							'num_tel'=>$num_tel,
							'ville'=>$ville,
							'login'=>$login,
							'mdp'=>$mdp,
							'role'=>$role,
							'user_id'=>$user_id
							));

	header('location:admin_affiche_pharmacie.php');

}

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>modification pharmacie</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/4.jpg);
				background-size: cover;
				
			}
			.row input[type=text]{
				background-color:rgba(255,255,255,0.95);
				color: black;
				width: 350px;
				
			}
			.form-mod{
					position:absolute;
					top: 230px;
				}
				h3{
					position: absolute;
					top: 150px;
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

			<h3 class="text-center" style="color: white;">Modification de pharmacie</h3>

			<br/>

			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">

							<label>nom</label>
							<input class="form-control" type="text" name="nom" value="<?=$donnees['nom']?>" />  <br/>

							<label>adresse</label>
							<input class="form-control" type="text" name="adresse" value="<?=$donnees['adresse']?>" />  <br/>
							<label>ville</label><br/>
							<select style="height: 35px;width: 350px;background-color: rgba(255,255,255,0.95);border-radius: 5px;"name="ville" >
								<option>kef</option>
							</select><br/><br/>

							<label>Cnam</label><br/>
							<select style="height: 35px;width: 350px;background-color: rgba(255,255,255,0.95);border-radius: 5px;"name="cnam">
								<option>oui</option>
								<option>non</option>
							</select><br/><br/>

							<label>Numéro de téléphone</label>
							<input class="form-control" type="text" name="num_tel" value="<?=$donnees['num_tel']?>" />  <br/>
						</div>
<div class="col-md-6">
							<label>login</label>
							<input class="form-control" type="text" name="login" value="<?=$donnees['login']?>" />  <br/>
					
					
							<label>mdp</label>
							<input class="form-control" type="text" name="mdp" value="<?=$donnees['mdp']?>" />  <br/>
							<label>role</label>
							<input class="form-control" type="text" name="role" value="<?=$donnees['role']?>" />  <br/>
							<label>type</label><br/>
							<select style="height: 35px;width: 350px;background-color: rgba(255,255,255,0.95);border-radius: 5px;"name="type">
								<option>nuit</option>
								<option>jour</option>
							</select>

							</br>
							<input class="btn btn-info" type="submit"style="position: absolute;top:330px"; />
							
					</div>
				</div>


			</form>
		
		</div>
	</div>
</div>


</body>

</html>