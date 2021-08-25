<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="admin")
{
	header('location:login_admin.php');
	die();
}



$id=$_SESSION['id'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from admin where id_ad=?');
$reponse->execute(array($id));
$donnees=$reponse->fetch();
//modifier nom admin
if (isset($_POST['nom']) )
{
	
	$nom=htmlspecialchars($_POST['nom']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE admin SET nom=:nom where id_ad='.$user_id);
	$reponse->execute(array(
							'nom'=>$nom
							
							));
	header('location:admin_profil.php');
							}
//modifier prenom admin							
if (isset($_POST['prenom']) )
{
	
	$prenom=htmlspecialchars($_POST['prenom']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE admin SET prenom=:prenom where id_ad='.$user_id);
	$reponse->execute(array(
							'prenom'=>$prenom
							
							));
	header('location:admin_profil.php');
							}
							//modifier login admin							
if (isset($_POST['login']) )
{
	
	$login=htmlspecialchars($_POST['login']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE admin SET login=:login where id_ad='.$user_id);
	$reponse->execute(array(
							'login'=>$login
							
							));
	header('location:admin_profil.php');
							}
							//modifier mdp admin							
if (isset($_POST['mdp']) )
{
	
	$mdp=htmlspecialchars($_POST['mdp']);
	

$user_id=$_SESSION['id'];
	$reponse=$base->prepare('UPDATE admin SET mdp=:mdp where id_ad='.$user_id);
	$reponse->execute(array(
							'mdp'=>$mdp
							
							));
	header('location:admin_profil.php');
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
				top: 300px;
				background-color: rgba(220,220,220,0.2);
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
			 .table-hover{
			 	background-color: white;
			 }
			
					
				
		</style>
	</head>
<body>



<?php include ('admin_menu.php'); ?>1



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
				<tr><th>Prenom</th><td><?=$donnees['prenom']?></td><td> <label><a href="#" onclick="javascript:document.getElementById('quantite1').className='quantite1-clic';" >Modifier</a></label>
<form id="quantite1" method="POST" action="#" ">
	<div>
		
		<input class="form-control" type="text" name="prenom" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td></tr>
<tr><th>Login</th><td><?=$donnees['login']?></td><td> <label><a href="#" onclick="javascript:document.getElementById('quantite2').className='quantite2-clic';" >Modifier</a></label>
<form id="quantite2" method="POST" action="#">
	<div>
		
		<input class="form-control" type="text" name="login" required/> 
		<input class="btn btn-info" type="submit"/>
	</div>
</form></td></tr>
				<tr><th>Mot de pass</th><td><?=$donnees['mdp']?> </td> <td>  <label><a href="#" onclick="javascript:document.getElementById('quantite3').className='quantite3-clic';" >Modifier</a></label>
<form id="quantite3" method="POST" action="#">
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