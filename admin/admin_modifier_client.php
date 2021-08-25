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

$id_client=$_GET['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from client where id_client=?');
$reponse->execute(array($id_client));
$donnees=$reponse->fetch();

if (isset($_POST['nom_clt']) AND isset($_POST['prenom']) AND isset($_POST['num_tel']) AND isset($_POST['login']) AND isset($_POST['mdp']))
{
	$nom_clt=htmlspecialchars($_POST['nom_clt']);
	$prenom=htmlspecialchars($_POST['prenom']);
	$num_tel=htmlspecialchars($_POST['num_tel']);
	$login=htmlspecialchars($_POST['login']);
	$mdp=htmlspecialchars($_POST['mdp']);
	

$id_client=$_GET['id'];
	$reponse=$base->prepare('UPDATE client SET nom_clt=:nom_clt, prenom=:prenom, num_tel=:num_tel, login=:login, mdp=:mdp where id_client=:id_client');
	$reponse->execute(array(
							'nom_clt'=>$nom_clt,
							'prenom'=>$prenom,
							'num_tel'=>$num_tel,
							'login'=>$login,
							'mdp'=>$mdp,
							'id_client'=>$id_client 
							
							));

	header('location:admin_affiche_client.php');

}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>modification client</title>
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
			.row h3{
				position: absolute;
				top:150px;
				width: 50%;
				left: 30%;
			}
			.form-mod{
					position:absolute;
					top: 220px;
				}
				label{
					color: white;
					
				
		</style>
				
	</head>
<body>



<?php include ('admin_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3  style="color: white;">Modification de clients</h3>

			<br/>

			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">

							<label>nom</label>
							<input class="form-control" type="text" name="nom_clt" value="<?=$donnees['nom_clt']?>" required/>  <br/>

							<label>prenom</label>
							<input class="form-control" type="text" name="prenom" value="<?=$donnees['prenom']?>" required/>  <br/>

							<label>num_tel</label>
							<input class="form-control" type="text" name="num_tel" value="<?=$donnees['num_tel']?>" required/>  <br/>
					</div>
					<div class="col-md-6">
							<label>login</label>
							<input class="form-control" type="text" name="login" value="<?=$donnees['login']?>" required/>  <br/>

							<label>mot de pass</label>
							<input class="form-control" type="text" name="mdp" value="<?=$donnees['mdp']?>" required>  <br/>
							<input class="btn btn-success" type="submit"/>
							
					</div>
				</div>


			</form>
		
		</div>
	</div>
</div>


</body>

</html>