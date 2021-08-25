<?php 
session_start();
if (!isset($_SESSION['role']) OR $_SESSION['role']!="admin") {
	header('location:login_admin.php');
}
include('connexionBD.php');
if (isset($_GET['id']) AND isset($_GET['role']) AND isset($_GET['nom'])) {
	if (isset($_POST['message'])) {
$user_id=$_GET['id'];
echo $user_id;
$role=$_GET['role'];
$nom=$_GET['nom'];
$message=$_POST['message'];
$role_emetteur="admin";
$inser=$base->prepare('INSERT into message (message,id_recepteur,recepteur,role_recepteur,role_emetteur) VALUES (:message,:id_recepteur,:recepteur,:role_recepteur,:role_emetteur)');
      $inser->execute(array('message'=>$message,
      	                    'id_recepteur'=>$user_id,
      	                    'recepteur'=>$nom,
      	                    'role_recepteur'=>$role,
                            'role_emetteur'=>$role_emetteur)
  );
      $success="";
      }

}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<style >
			body{
				background-size: cover;
			}
			#contact {
		position: absolute;
		top: 25%;
		left: 15%;
		background-color: white;
		height:450px;
		width: 900px;
		border-radius: 5px;
		background-color:rgba(220,220,220,0.2);

	}
	::-webkit-input-placeholder{
		position: absolute;
		top: -50px;
	}
	#message input[type=text]{
		position: absolute;
		top: 40%;
		left: 10%;
		height: 150px;
		width: 500px;
		border-radius: 10px;
	}
	#message input[type=submit]{
		position: absolute;
		top: 80%;
		width: 100px;
		left: 66%;
	}
	}
		</style>
</head>
<body>
	<?php include('admin_menu.php');?>
	<div id="contact">
		<?php
	if (isset($success)) { ?>
<div style="position: absolute;top: 400px;left: 30%;color: white;">message envoyé</div>
	<?php
}
?>
	<form id="message" method="POST" action="#">
		<h4 style="position: absolute;left: 30%;color: white;">envoyer un message à <?php echo $_GET['nom'];?></h4>
		<label style="position: absolute;top: 55%;left: 10%;">Message</label>
		<input type="text" name="message" placeholder="votre message" class="form-control" />
		<input type="submit" name="Valider" class="btn btn-success" value="Envoyer">
	</form>
</div>

</body>
</html>