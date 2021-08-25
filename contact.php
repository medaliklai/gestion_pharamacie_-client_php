

<?php
include('connexionBD.php');
if (isset($_POST['message'])) {
$message=$_POST['message'];
$email=$_POST['email'];
$reponse=$base->prepare('INSERT INTO message  (message,emetteur) VALUES (:message,:emetteur)');
	$reponse->execute(array(
							'message' => $message,
							'emetteur'=>$email
							
							));
	$success="";
}


?>

<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
        <title>Contact</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<style >
	body{
		background-image: url(images/11.jpg);
	}
	#contact {
		position: absolute;
		top: 25%;
		left: 15%;
		background-color:rgb(220,220,220);
		height:450px;
		width: 900px;
		border-radius: 5px;
		
		

	}
	::-webkit-input-placeholder{
		position: absolute;
		top: -50px;
	}
	#message input[type=text]{
		position: absolute;
		top: 60%;
		left: 10%;
		height: 150px;
		width: 500px;
		border-radius: 10px;
	}
	#message input[type=submit]{
		position: absolute;
		top: 86%;
		width: 100px;
		left: 70%;
	}
	}
</style>
<body>
	<?php include('index_menu.php');?>

	<div id="contact">
		<?php
	if (isset($success)) { ?>
<div style="position: absolute;top: 200px;left: 50%;color: green;">message envoyé</div>
	<?php
}
?>
	<form id="message" method="POST" action="#">
		<i class="fas fa-phone-volume" style="font-size: 200%;position: absolute;left: 60%;top: 10%;color: green;"></i>
		<label style="position: absolute;left: 58%;top: 18%;">29 344 547</label>
<i class="fas fa-envelope-square" style="font-size: 200%;position: absolute;left: 30%;top: 10%;color: dodgerblue;"></i>
		<label style="position: absolute;left: 22%;top: 18%;">medaliklai02@gmail.com</label>
		<label style="position: absolute;top: 35%;left: 10%;">e-mail</label>
		<input type="email" name="email" style="position: absolute;top:40%;border-radius: 10px;width: 300px;left: 10%;" class="form-control" required>
		<label style="position: absolute;top: 55%;left: 10%;">Message</label>
		<input type="text" name="message" placeholder="votre message" class="form-control" />
		<input type="submit" name="Valider" class="btn btn-success" value="Envoyer">
	</form>
</div>
</div>
</body>
</html>