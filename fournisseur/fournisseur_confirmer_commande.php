<?php
session_start();
if (!isset($_SESSION['role']) OR $_SESSION['role']!="fournisseur") {
	header('location:index_fornisseur');
}
include('connexionBD.php');
$user_id=$_SESSION['id'];
echo $user_id;


if (isset($_GET['id_cmd'])) {

	$id_cmd=$_GET['id_cmd'];
	echo $id_cmd;
	if (isset($_POST['date_e'])) {
	
$verif="oui";
$date_e=$_POST['date_e'];
$data=$base->prepare('UPDATE commande_pharmacie SET date_envoi=:date_e,verifier=:verif where id_cmd=:id_cmd ');
	$data->execute(array(
							
							'date_e'=>$date_e,
							'verif'=>$verif,
							'id_cmd'=>$id_cmd,
							
							));
	header('location:fournisseur _affiche_commande.php');
}

}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>confirmer commande</title>
         <link rel="icon" type="image/png" href="images/logo.png"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/2.jpg);
				background-size: cover;
				
			}
#box{
	height: 300px;
	width: 500px;
	position: absolute;
	top: 200px;
	left: 30%;
	background-color: rgba(0,0,0,0.5);
	border-radius: 5px;

}
#box input{
	width: 200px;
	position: absolute;
	top: 50%;
	left: 30%;
	

}
#box input[type=submit]{
	position: absolute;top: 70%;
}
#box h3{
	position: absolute;
	left: 20%;
	color: white;
}
		</style>
	</head>
	<body>
		<?php 
		include('fournisseur_menu.php');
		?>
	<div id="box">
		<h3>confirmation de commande</h3>
		<form method="POST">
		<input   class="form-control" type="date" name="date_e" required>	
		<input class="btn btn-info" type="submit"/>

		</form>



	</div>	



	</body>



</html>