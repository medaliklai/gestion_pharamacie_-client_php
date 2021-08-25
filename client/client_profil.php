<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="client")
{
	header('location:login_client.php');
	die();
}



$client_id=$_SESSION['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from client where id_client=?');
$reponse->execute(array($client_id));
$donnees=$reponse->fetch();
//modifier nom client						
if (isset($_POST['nom']) )
{
	
	$nom=htmlspecialchars($_POST['nom']);
	

$client_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE client SET nom_clt=:nom where id_client='.$client_id);
	$reponse->execute(array(
							'nom'=>$nom
							
							));
	header('location:client_profil.php');
							}
//modifier prenom							
if (isset($_POST['prenom']) )
{
	
	$prenom=htmlspecialchars($_POST['prenom']);
	

$client_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE client SET prenom=:prenom where id_client='.$client_id);
	$reponse->execute(array(
							'prenom'=>$prenom
							
							));
	header('location:client_profil.php');
							}
//modifier num_tel							
if (isset($_POST['num_tel']) )
{
	
	$num_tel=htmlspecialchars($_POST['num_tel']);
	

$client_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE client SET num_tel=:num_tel where id_client='.$client_id);
	$reponse->execute(array(
							'num_tel'=>$num_tel
							
							));
	header('location:client_profil.php');
							}
//modifier login							
if (isset($_POST['login']) )
{
	
	$login=htmlspecialchars($_POST['login']);
	

$client_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE client SET login=:login where id_client='.$client_id);
	$reponse->execute(array(
							'login'=>$login
							
							));
	header('location:client_profil.php');
							}
//modifier mdp						
if (isset($_POST['mdp']) )
{
	
	$mdp=htmlspecialchars($_POST['mdp']);
	

$client_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE client SET mdp=:mdp where id_client='.$client_id);
	$reponse->execute(array(
							'mdp'=>$mdp
							
							));
	header('location:client_profil.php');
						}
         
?>
		
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
				background-image: url(images/.jpg);
				background-size: cover;
			}
			.table-hover{
				position: absolute;
				top: 200px;
				background-color: white;
			}
					
				
		</style>
	</head>
<body>



<?php include ('client_menu.php'); ?>



<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="btn-danger text-center"></h3>

			<br/>


			<table class="table table-hover">
				
				<tr><th>Nom</th><td><?=$donnees['nom_clt']?> </td><td>  <label><a href="#" onclick="javascript:document.getElementById('quantite1').className='quantite1-clic';" >Modifier</a></label>
<form id="quantite1" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="nom" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td></tr>
				<tr><th>Prenom</th><td><?=$donnees['prenom']?></td><td> <label><a href="#" onclick="javascript:document.getElementById('quantite2').className='quantite2-clic';" >Modifier</a></label>
<form id="quantite2" method="POST"  action="#">	<div>
		
		<input class="form-control" type="text" name="prenom" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td></tr>
				<tr><th>Numéro de téléphone</th><td><?=$donnees['num_tel']?></td>   <td> <label><a href="#" onclick="javascript:document.getElementById('quantite3').className='quantite3-clic';" >Modifier</a></label>
<form id="quantite3" method="POST"  action="#">
	<div>
		
		<input class="form-control" type="text" name="num_tel" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td></tr>
				<tr><th>Login</th><td><?=$donnees['login']?> </td><td>  <label><a href="#" onclick="javascript:document.getElementById('quantite4').className='quantite4-clic';" >Modifier</a></label>
<form id="quantite4" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="login" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td></tr>
				<tr><th>Mot de pass</th><td><?=$donnees['mdp']?> </td> <td>  <label><a href="#" onclick="javascript:document.getElementById('quantite5').className='quantite5-clic';" >Modifier</a></label>
<form id="quantite5" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="mdp" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td></tr>
			</table>



			
		
		</div>
	</div>
</div>


</body>

</html>