<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}

if (!isset($_GET['id_med']))
{
	header('location:login_pharmacien.php');
	die();
}
$med_id=$_GET['id_med'];
include ('connexionBD.php');
$reponse=$base->prepare('SELECT * from vente where id_med=?');
$reponse->execute(array($med_id));
$donnees=$reponse->fetch();		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>admin_pharmacie</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
	</head>
<body>
	<div class="container">
<div class="row">

<div class="col-md-10 col-md-offset-4 " style="position:absolute;top: 150px; ">
			
				
<label>Pharmacie:</label> <?php echo $_SESSION['nom']?></br>
<br>
	<label>Médicament:</label>			<?php echo $donnees['nom']?></br>
	<br>
	<label>Quantité:</label>			<?php echo $donnees['qte']?></br>
	<br>
	<label>Prix unitaire:</label>			<?php echo $donnees['prix_unitaire']?> DT</br>
	<br>
		<label>Prix de vente:</label>	 	<?php echo $donnees['prix_vente']?> DT</br>
		<br>
			<label>Date de vente:</label>	<?php echo $donnees['date_v']?></br>
		



			
			
		

</div>
</div>
</div>

</body>

</html>