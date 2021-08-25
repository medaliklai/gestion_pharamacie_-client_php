<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="admin")
{
	header('location:login_admin.php');
	die();
}

		include ('connexionBD.php');
		$user_id=$_SESSION['id'];	
		$rep=$base->prepare('SELECT * from message where id_recepteur=0 ');
		$rep->execute();
		$receive=$rep->rowCount();

			$data=$base->prepare('SELECT * from message where id_emetteur=0 and role_emetteur="admin"');
		$data->execute();
		$nbv=$data->rowCount();
		

      if (isset($_POST['message'])) {
      $message=$_POST['message'];
      $user_id=$_SESSION['id'];
      $role="pharmacien";
      $receiver="admin";
      $nom=$_SESSION['nom'];
      $inser=$base->prepare('INSERT into message (message,id_emetteur,emetteur,role) VALUES (:message,:receiver,:user_id,:role)');
      $inser->execute(array('message'=>$message,
      	                    'id_emetteur'=>$user_id,
      	                    'emetteur'=>$nom,
      	                    'role'=>$role));
      $success="";
      }
		
		
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>administration</title>
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
				background-color:white;
				left: 110%;
				
			}
			#affiche:hover{
				background-color: rgb(220,220,220);
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
		top: 60%;
		width: 100px;
		left: 70%;
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


<?php include ('admin_menu.php'); ?>

	<div id="menu">
		<i class="fas fa-envelope-square" style="font-size: 400%;position: absolute;left: 35%;top: 5%;color:white; " ></i>
      <form method="POST" id="form">
  	
    <input type="submit" name="réception" value="Boite de réception        <?php echo $receive; ?>" style="position: absolute;top: 35%;"></br><br>
    <input type="submit" name="envoi" value="Boite d'envoi      <?php  echo $nbv; ?>" style="position: absolute;top: 45%;left:-9%;">
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
			<h4><?php echo $row['role_emetteur'];?>:<?php echo $row['emetteur'];?></h4>
			<h5><?php echo $row['message'];?></h5>
			<form method="POST" action="#">
			<a href="admin_supprimer_message.php?id_msg=<?=$row['id_msg'];?> " class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
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

<?php
if (isset($_POST['envoi']) and $nbv>0) { ?>
	<div id="entete"><h4>Boite d'envoi</h4></div>
	<?php
while($row=$data->fetch())
					{
								
				?>

			<div class="col-md-6">
			<div class="col-md-4">	
		<div id="affiche">
			<h4>Moi:<?php echo $row['role_recepteur'];?></h4>
			<h5><?php echo $row['message'];?></h5>
			<form method="POST" action="#">
			<a href="admin_supprimer_message.php?id_msg=<?=$row['id_msg'];?> " class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
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