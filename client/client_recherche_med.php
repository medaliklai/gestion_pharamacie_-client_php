<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="client")
{
	header('location:login.php');
	die();
}
include ('connexionBD.php');
if (isset($_POST['nom']) and isset($_POST['ville']) and isset($_POST['type']))
{
	$nom=htmlspecialchars($_POST['nom']); 
	$ville=htmlspecialchars($_POST['ville']);
	$type=htmlspecialchars($_POST['type']);

	$reponse=$base->prepare('SELECT * from medicaments,pharmacie where medicaments.user_id=pharmacie.id and medicaments.nom_med=? and pharmacie.ville=? and pharmacie.type=?' );
	$reponse->execute(array($nom,$ville,$type));
	$nb=$reponse->rowCount();
	
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>recherche medicaments</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/11.jpg);
				background-size: cover;
				
			}
			
			.form-mod{
					position:absolute;
					top: 300px;
					width: 200%;
					left: 50%;

				}
				.form-mod input[type=text]{
					border-radius: 2px;
					position: absolute;
					top: -290px;
					width: 200px;
					left: -400px;
					height: 50px;
					background-color: transparent;
				

				}
				

				.form-mod select[name=type]{
					border-radius: 2px;
					position: absolute;
					top: -290px;
					width: 200px;
					left: -150px;
					height: 50px;
					background-color: transparent;
					color: white;
				}
				.form-mod select[name=type] option {
					color: black;
				}

				.form-mod select[name=ville]{
					border-radius: 2px;
					position: absolute;
					top: -290px;
					width: 200px;
					left: 100px;
					height: 50px;
					background-color: transparent;
					color: white;
				}
				.form-mod select[name=ville] option{
					color:black;
				}
				
					
				.form-mode{
					position:absolute;
					top: 400px;
					
					
				}
				.affiche{
					border:1px solid white;
					 background-color:white;
					  border-radius:10px;
					   padding:16px;
					   box-shadow:  green;
					   position: absolute;
					   height: 160px;
					   width:800px;
	                 transform: scale(1);
	              left: 300px;
	                 transition: .3s ease-in-out;
					
				}
				.affiche:hover{
					-webkit-transform: scale(1.1);
	             transform: scale(1.05);
	             background-color:white;
                  }
                  .affiche .btn-warning{
                  	position: absolute;
                  	top: 70%;
                  	left: 630px;
                  }
                  #med{
                  	position: absolute;
                  	top:; 
                  	height:120px;
                  	width: 120px;
                  	border-radius: 100%;
                  	
                  	background-color: dodgerblue;
                  }
                  #recherche{
			 	position: absolute;
			 	top: 30%;
			 	
			 	height: 70px;
			 	width: 100%;
			 	background-color: rgba(0,0,0,0.8);
			 }
			 button{
			 	position: absolute;
			 	top: 200px;
			 	left: 1000px;
			 	background-color: transparent;

			 }
                  

			.form-mod input[type=text]::placeholder{
					color: white;
				}
					
				
		</style>
				
				
	</head>
<body>
	<?php include ('client_menu.php');?>
	<?php
	if (isset($_POST['nom'])) {
		if ($nb==0) {
		
		
	?>
	<div style="position: absolute;top: 350px; left: 40%;"><h4 style="color: white;background-color:rgba(30,144,255,0.8)"><?php print('aucune pharmacie qui contient le médicament  '.$_POST['nom'] )?></h4></div>
<?php
}
}
?>
			<div id="recherche">
			<form method="POST"  action="#" class="form-mod">
				

							<input class="form-control" type="text" name="nom"  placeholder="Nom de médicaments" required/>  <br/>
							<select name="type" class="form-control"  required>
								<option value="" disabled selected>type de pharmacie </option>
								<option>jour</option>
								<option>nuit</option>
							</select>
							<select name="ville" class="form-control" required>
								<option value=""disabled selected>Ville</option>
								<option>kef</option>
								
							</select>
						</div>
						
							
							<button type="submit" name="cherche"value="recherche" class="btn" ><i class="glyphicon glyphicon-search" style="font-size: 30px; color: dodgerblue;"></i></button>
						

					
			</form>
		</div>
		
<div class="col-md-6">

	
<?php

								
							
				if ((isset($_POST['nom']) and (isset($_POST['type']) and(isset($_POST['ville']))))) {
					?>
				<div style="position: absolute;top: 300px; left: 50%;color: white;"><h4>resultat de recherche:<?php echo $nb ?></h4></div>
					<?php
				while($row=$reponse->fetch())
					{
						
						
				?>
				<form class="form-mode">
			<div class="col-md-4">
				
					<div class="affiche" >
						<div id="med">
						<h4 class="texte-info" align="center" style="position:absolute;top: 25%;left:25%;color: white;"> <?php echo $row["nom_med"];?></h4><br />
					</div>

						<h4 class="text-danger" style="position:absolute;left: 80%; top: 20%;"> Prix: <?php echo $row["prix"]; ?>DT</h4>

						<h4 class="text-info" style="position: absolute;top:5%; left: 17%;"> <li><?php echo $row["description"]; ?></li></h4>
						<h4 class="text-info" style="position:absolute;left: 80%; top: 35%;"><span class="	glyphicon glyphicon-earphone"></span><?php echo $row["num_tel"]; ?></h4>

						

						<h4 class="text-info"style="position: absolute;top:25%;left: 20%;"><li><?php echo $row["nom"]; ?></li></h4>

						<h4 class="text-info"style="position: absolute;top:45%;left: 20%;"><li><span class="glyphicon glyphicon-map-marker"> </span> <?php echo $row["adresse"]; ?></li></h4> </br>
						<h4 class="text-info"style="position: absolute;top:70%;left: 17%;"><li> CNAM:<?php echo $row["cnam"]; ?></li></h4> </br>

						<a href="client_command.php?med_id=<?=$row['med_id']?>" class="btn btn-warning">passer une commade</a>

					</div>
				</br>

				
			</div>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
	


			<?php
					}
				}
			

			?>
			</br>
			<?php
			if (isset($_POST['nom']) and isset($_POST['ville']) and isset($_POST['type']) and (empty($reponse))){
				
			?>
			<div><h4>aucune pharmacien qui contient le medicicament<?php echo $_POST['nom'];?></h4></div>
			<?php
		}
	
		?>

			
</body>
</html>