<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="client")
{
	header('location:client.php');
	die();
}

	
?>
<!DOCTYPE html>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style_slider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<html lang="en">
<head>
  <title>Espace client</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <style >
 	body{
 		background-image: url(images/11.jpg);
 		background-size: cover;
 		
 	}
 </style>
 
<body>
	<?php include ('client_menu.php');?>



</body>
</html>