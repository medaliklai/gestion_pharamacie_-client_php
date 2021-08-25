<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}

		include ('connexionBD.php');
		$user_id=$_SESSION['id'];
		$nom=$_SESSION['nom'];	

		$rep=$base->prepare('SELECT * from message where id_recepteur=? and recepteur=? and  role_recepteur="pharmacien"');
		$rep->execute(array($user_id,$nom));
		$receive=$rep->rowCount();

			$nom=$_SESSION['nom'];
		$requete=$base->prepare('SELECT * from message where id_emetteur=? and emetteur=? and role_emetteur="pharmacien"');
		$requete->execute(array($user_id,$nom));
		$nbv=$requete->rowCount();
		

      if (isset($_POST['message'])) {
      $message=$_POST['message'];
      $user_id=$_SESSION['id'];
      $role="pharmacien";
      $nom=$_SESSION['nom'];
      $inser=$base->prepare('INSERT into message (message,emetteur,id_emetteur,role_emetteur) VALUES (:message,:emetteur,:id_emetteur,:role_emetteur)');
      $inser->execute(array('message'=>$message,
      	                    'emetteur'=>$nom,
      	                    'id_emetteur'=>$user_id,
      	                    'role_emetteur'=>$role));
      $success="";
      }
		
		
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Messagerie</title>
         <link rel="icon" type="image/png" href="images/logo.png"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style >
			body{
				background-image: url(images/11.jpg);
				background-size: cover;
			}
			
			#affiche{
				position: absolute;
				top: 243px;
				height: 100px;
				width: 1100px;
				background-color: white;
				left: 110%;
				
			}
			#affiche:hover{
				background-color: rgb(245,245,245);
			}
			#affiche h4{
				color: dodgerblue;
			}
			#affiche h5{
				position: absolute;
				top: 30px;
			}
			.btn-danger{
				position: absolute;
				top: 0px;
				left: 92%;
				background-color: white;
			}
			#contact {
		position: absolute;
		top: 40%;
		left: 18.5%;
		background-color: white;
		height:400px;
		width: 1100px;
		background-color:white;

	}
	::-webkit-input-placeholder{
		position: absolute;
		top: -50px;
	}
	#message input[type=text]{
		position: absolute;
		top: 30%;
		left: 10%;
		height: 150px;
		width: 500px;
		border-radius: 10px;
	}
	#message input[type=submit]{
		position: absolute;
		top: 75%;
		width: 100px;
		left: 56%;
	}
	 #menu{
      	position: absolute;
      	top: 30%;
        background-color:rgba(65,105,225,0.9);
        height: 77%;
        width: 250px;
      
      }
      #menu input[type=submit]{
      	

      	color: white;
      	height: 50px;
        background-color: transparent;
        border-radius: 5px;
        border: 1px solid transparent;
        width: 250px;
        font-size: 120%;
      }
      #menu input[type=submit]:hover{
      	background-color: rgba(255,255,255,0.2);



      }
     
      #entete{
      	height: 60px;
      	width: 82%;
      	position: absolute;
      	top: 30%;
      	background-color:rgba(65,105,225,0.9);
      	left: 18.5%; 
      }
      #entete h4{
      	color: white;
      	position: absolute;
      	left: 40%;
			
		</style>
      
	</head>
<body>
	<?php
	if (isset($_POST['msg']) or isset($_POST['message'])) {
		?>
		
		<div id="entete"><h4>Nouveau message</h4></div>
<div id="contact">
<?php
	if (isset($success)) { ?>
<div style="position: absolute;top: 300px;left: 30%;color: green;">message envoyé</div>
	<?php
}
?>
	<form id="message" method="POST" action="#">
		<label style="position: absolute;top: 20%;left: 10%;">Message</label>
		<input type="text" name="message" placeholder="votre message" class="form-control" required/>
		<input type="submit" name="Valider" class="btn btn-success" value="Envoyer">
	</form>
</div>
</div>
<?php
}
?>


<?php include ('pharmacien_menu.php'); ?>

	<div id="menu">
		<i class="fas fa-envelope-square" style="font-size: 400%;position: absolute;left: 35%;top: 5%;color:white; " ></i>
      <form method="POST" id="form">
  	<input type="submit" name="msg" value=" + Nouveau message" style="position: absolute;top: 25%;left: -3%;"></br><br>
    <input type="submit" name="réception" value="Boite de réception        <?php echo $receive; ?>" style="position: absolute;top: 35%;"></br><br>
    <input type="submit" name="envoi" value="Boite d'envoi        <?php echo $nbv; ?>" style="position: absolute;top: 45%;left:-9%;">
    </form>
  		
  	</div>



<?php
if (isset($_POST['réception']) and $receive>0) { ?>
	<div id="entete"><h4>Boite de réception</h4></div>
	<?php
while($row=$rep->fetch())
					{
						
						
				?>

			<div class="col-md-6">
			<div class="col-md-4">	
		<div id="affiche">
			<h4>Admin</h4>
			<h5><?php echo $row['message'];?></h5>
			<form method="POST" action="#">
			<a href="pharmacien_supprimer_message.php?id_msg=<?=$row['id_msg'];?> " class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
		</form>
		</div>
	
</div>
	</div>
<br>
<br>
<br>




<?php
}
}
?>

<?php
if (isset($_POST['envoi']) and $nbv>0) { ?>
	<div id="entete"><h4>Boite d'envoi</h4></div>
	<?php
	
while($data=$requete->fetch())
					{
						
						
				?>

			<div class="col-md-6">
			<div class="col-md-4">	
		<div id="affiche">
			<h4>Moi</h4>
			<h5><?php echo $data['message'];?></h5>
			<form method="POST" action="#">
			<a href="pharmacien_supprimer_message.php?id_msg=<?=$data['id_msg'];?> " class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
		</form>
		</div>
	
</div>
	</div>
<br>
<br>
<br>
<br>
<br>



<?php
}
}
?>



</body>

</html>