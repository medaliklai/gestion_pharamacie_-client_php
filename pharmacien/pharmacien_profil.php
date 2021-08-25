<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login.php');
	die();
}



$user_id=$_SESSION['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from pharmacie where id=?');
$reponse->execute(array($user_id));
$donnees=$reponse->fetch();
//modifier nom pharmacien						
if (isset($_POST['nom']) )
{
	
	$nom=htmlspecialchars($_POST['nom']);
	

$id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE pharmacie SET nom=:nom where id='.$id);
	$reponse->execute(array(
							'nom'=>$nom
							
							));
	header('location:pharmacien_profil.php');
							}
//modifier adresse							
if (isset($_POST['adresse']) )
{
	
	$adresse=htmlspecialchars($_POST['adresse']);
	

$id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE pharmacien SET adresse=:adresse where id='.$id);
	$reponse->execute(array(
							'adresse'=>$adresse
							
							));
	header('location:pharmacien_profil.php');
							}
//modifier login							
if (isset($_POST['login']) )
{
	
	$login=htmlspecialchars($_POST['login']);
	

$id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE pharmacie SET login=:login where id='.$id);
	$reponse->execute(array(
							'login'=>$login
							
							));
	header('location:pharmacien_profil.php');
							}
//modifier mdp							
if (isset($_POST['mdp']) )
{
	
	$mdp=htmlspecialchars($_POST['mdp']);
	

$id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE pharmacie SET mdp=:mdp where id='.$id);
	$reponse->execute(array(
							'mdp'=>$mdp
							
							));
	header('location:pharmacien_profil.php');
							}


		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>administration</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style_profile.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/11.jpg);
				background-size: cover;
			}
			.table-hover{
				position: absolute;
				top: 300px;
				background-color: white;
			}
			
					
				
		</style>
	</head>
<body>



<?php include ('pharmacien_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="btn-danger text-center"></h3>

			<br/>


			<table class="table table-hover">
				
				<tr><th>Nom</th><td><?=$donnees['nom']?></td><td>  <label><a href="#" onclick="javascript:document.getElementById('quantite').className='quantite-clic';" >Modifier</a></label>
<form id="quantite" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="nom" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form>

				</td> </tr>
				<tr><th>adresse</th><td><?=$donnees['adresse']?> </td><td><label><a href="#" onclick="javascript:document.getElementById('quantite2').className='quantite2-clic';" >Modifier</a></label>
<form id="quantite2" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="adresse" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form>





				</td></tr>
				<tr><th>Login</th><td><?=$donnees['login']?> </td><td>   <label><a href="#" onclick="javascript:document.getElementById('quantite3').className='quantite3-clic';" >Modifier</a></label>
<form id="quantite3"method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="login" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form>
				</td></tr>
				<tr><th>Mot de passe</th><td><?=$donnees['mdp']?></td><td>  <label><a href="#" onclick="javascript:document.getElementById('quantite4').className='quantite4-clic';" >Modifier</a></label>
<form id="quantite4" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="mdp" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form>  </td></tr>
			</table>



			
		
		</div>
	</div>
</div>


</body>

</html>