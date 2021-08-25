<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="fournisseur")
{
	header('location:login_admin.php');
	die();
}



$id=$_SESSION['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from fornisseur where id_fr=?');
$reponse->execute(array($id));
$donnees=$reponse->fetch();
//modifier nom fornisseur
if (isset($_POST['nom']) )
{
	
	$nom=htmlspecialchars($_POST['nom']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE fornisseur SET nom=:nom where id_fr='.$user_id);
	$reponse->execute(array(
							'nom'=>$nom
							
							));
	header('location:fournisseur_profile.php');
							}
							//modifier adresse fornisseur							
if (isset($_POST['adresse']) )
{
	
	$adresse=htmlspecialchars($_POST['adresse']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE fornisseur SET adresse=:adresse where id_fr='.$user_id);
	$reponse->execute(array(
							'adresse'=>$adresse
							
							));
	header('location:fournisseur_profile.php');
}
//modifier ville fornisseur							
if (isset($_POST['ville']) )
{
	
	$ville=htmlspecialchars($_POST['ville']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE fornisseur SET ville=:ville where id_fr='.$user_id);
	$reponse->execute(array(
							'ville'=>$ville
							
							));
	header('location:fournisseur_profile.php');
							}
							//modifier num_tel							
if (isset($_POST['num_tel']) )
{
	
	$num_tel=htmlspecialchars($_POST['num_tel']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE fornisseur SET num_tel=:num_tel where id_fr='.$user_id);
	$reponse->execute(array(
							'num_tel'=>$num_tel
							
							));
	header('location:fournisseur_profile.php');
							}
							//modifier login fornisseur							
if (isset($_POST['login']) )
{
	
	$login=htmlspecialchars($_POST['login']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE fournisseur SET login=:login where id_fr='.$user_id);
	$reponse->execute(array(
							'login'=>$login
							
							));
	header('location:fournisseur_profile.php');
							}
							if (isset($_POST['mdp']) )
{
	
	$mdp=htmlspecialchars($_POST['mdp']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE fornisseur SET mdp=:mdp where id_fr='.$user_id);
	$reponse->execute(array(
							'mdp'=>$mdp
							
							));
	header('location:fournisseur_profile.php');
							}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Profil</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style_profile.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-color: white;
				background-size: cover;
			}
			.table-hover{
				position: absolute;
				top: 300px
			}
			 #quantite input{
			 	border-radius: 15px;
			 }
			 #quantite1 input{
			 	border-radius: 15px;
			 }
			 #quantite2 input{
			 	border-radius: 15px;
			 }
			 #quantite3 input{
			 	border-radius: 15px;
			 }
			  #quantite4 input{
			 	border-radius: 15px;
			 }
			  #quantite5 input{
			 	border-radius: 15px;
			 }
			 .table-hover{
			 	background-color: white;
			 }
			
					
				
		</style>
	</head>
<body>



<?php include ('fournisseur_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="btn-danger text-center"></h3>

			<br/>


			<table class="table table-hover">
				
				<tr><th>Nom</th><td><?=$donnees['nom']?> </td><td> <label><a href="#" onclick="javascript:document.getElementById('quantite').className='quantite-clic';" >Modifier</a></label>
<form id="quantite" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="nom" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td> </tr>
				<tr><th>Adresse</th><td><?=$donnees['adresse']?></td><td> <label><a href="#" onclick="javascript:document.getElementById('quantite1').className='quantite1-clic';" >Modifier</a></label>
<form id="quantite1" method="POST" action="#" >
	<div>
		
		<input class="form-control" type="text" name="adresse" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td></tr>
<tr><th>Ville</th><td><?=$donnees['ville']?></td><td> <label><a href="#" onclick="javascript:document.getElementById('quantite2').className='quantite2-clic';" >Modifier</a></label>
<form id="quantite2" method="PST" action="#">
	<div>
		
		<input class="form-control" type="text" name="ville" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td></tr>
				<tr><th>Numéro de téléphone</th><td><?=$donnees['num_tel']?> </td> <td>  <label><a href="#" onclick="javascript:document.getElementById('quantite3').className='quantite3-clic';" >Modifier</a></label>
<form id="quantite3" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="num_tel" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form>
</td></tr>
<tr><th>login</th><td><?=$donnees['login']?> </td> <td>  <label><a href="#" onclick="javascript:document.getElementById('quantite4').className='quantite4-clic';" >Modifier</a></label>
<form id="quantite4" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="login" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form>
</td></tr>

<tr><th>Mot de pass</th><td><?=$donnees['mdp']?> </td> <td>  <label><a href="#" onclick="javascript:document.getElementById('quantite5').className='quantite5-clic';" >Modifier</a></label>
<form id="quantite5" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="mdp" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form>
</td></tr>
			</table>



			
		
		</div>
	</div>
</div>


</body>

</html>