<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}
if (isset($_POST['nom']))
{
	$nom=htmlspecialchars($_POST['nom']);
	$user_id=$_SESSION['id'];
	include ('connexionBD.php');
	$reponse_s=$base->prepare('SELECT * from medicaments where nom_med= ? and user_id=?' );
	$reponse_s->execute(array($nom,$user_id));
	$donnees=$reponse_s->fetch();
	$med_id=$donnees['med_id'];
	
	
$qte=$donnees['qte'];
$datetime = date("Y-m-d H:i:s");
$prix=$donnees['prix'];
$qten=$_POST['qte'];
$prix_v=$prix*$qten;
if($qte>0 and $qte>$_POST['qte']){
$reponse_i=$base->prepare('INSERT INTO vente(nom, qte, prix_unitaire,prix_vente,date_v,user_id) VALUES (:nom, :qte, :prix_unitaire,:prix_vente,:date_v,:user_id)');
	$reponse_i->execute(array(
							'nom' => $nom,
							'qte' =>$qten,
							'prix_unitaire' => $prix,
							'prix_vente'=>$prix_v,
							'date_v'=>$datetime,
							'user_id' =>$user_id
							));
	$med_id=$donnees['med_id'];
	$qte_a=$donnees['qte'];
	$qte_v=$_POST['qte'];
	$qte=$qte_a-$qte_v;
	$reponse=$base->prepare('UPDATE medicaments SET  qte=:qte where med_id=:med_id AND user_id=:user_id');
	$reponse->execute(array(
							'qte'=>$qte,
							'med_id'=>$med_id,
							'user_id'=>$user_id
							));
	

}else{$erreur="stock sayer";}
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion de vente</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/4.jpg);
				background-size: cover;
				
			}
			.form-mod{
					position:absolute;
					top: 250px;
					width: 100%
				}
				.form-mod input{
					border-radius: 20px;
				}
				h3{
					position: absolute;
					top: 150px;
					width: 100%;}
					.btn-success{
						position: absolute;
						top: 25px;
						left:400px;
					}
				.table-hover{
				position: absolute;
				top:350px;
				background-color: white;

			}
			.erreur h3{
				
				position: absolute;
				top: 400px;
				width: 500px;
				color: white;
				left: 40%;
				color: red;
			}

					
				
		</style>
	</head>
<body>
	
<?php include ('pharmacien_menu.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h3 class="text-center">gestion de vente</h3>
			<br/>
			<form method="POST"  action="#" class="form-mod">
				<div class="row">
					<div class="col-md-6">
							<label style="position: absolute;left: 40%">nom</label>
							<input class="form-control" type="text" name="nom"style="width: 300px;position: absolute;top: 25px;left: 40%;" required/>  <br/>
						</div>
						<div class="col-md-6">
							<label>quantité</label>
							<input class="form-control" type="text" name="qte"style="width: 300px"required/>  <br/>
							<input class="btn btn-success" type="submit"/>
						</div>

					</div>
				</div>
			</form>
			<?php 
			if (isset($_POST['nom']) and isset($_POST['qte']) and !isset($erreur)) {
				?>
				<h3 style="position: absolute;top:300px; left: 50%;color: green;">Vente validé</h3>
				<div class="col-md-10 col-md-offset-1">
			<table class="table table-hover">
				<tr>
					<th>Nom</th>
					<th>Quantité</th>	
					<th>Prix unitaire</th>		
					<th>Prix de vente</th>
					<th>Date de vente</th>
					<th>action</th>
				</tr>

	<?php 

	$user_id=$_SESSION['id'];
	$datetime = date("Y-m-d H:i:s");
	if (isset($_POST['nom']) and isset($_POST['qte']) and !isset($erreur)) {
		$reponse=$base->prepare('SELECT * from vente where user_id=?and date_v=?');
	$reponse->execute(array($user_id,$datetime));
}
	while($rows=$reponse->fetch())
		{
	
		?>
			<tr>
				
				<td><?=$rows['nom']?></td>
				<td><?=$rows['qte']?></td>
				<td><?=$rows['prix_unitaire']?></td>
				<td><?=$rows['prix_vente']?></td>
				<td><?=$rows['date_v']?></td>

				<td>
					
					<a href="facture.php?id_med=<?=$rows['id_med']?>" class="btn btn-warning" target="_blank"target="_blank"><span class="glyphicon glyphicon-print"></span></a>
				</td>
			</tr>
			
		<?php
		
		}
	}elseif (isset($_POST['nom']) and isset($_POST['qte']) and isset($erreur)) {

?>
<div class="erreur"><h3>votre quantité de <?php echo $_POST['nom'];?> est terminée !</h3></div>
<?php
}
?>
</table>
</div>
		</div>
	</div>
</div>
</body>
</html>