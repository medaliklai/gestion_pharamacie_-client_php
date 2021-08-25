<?php
session_start();
if (!isset($_SESSION['role']) or $_SESSION['role']!="pharmacien")
{
	header('location:login_pharmacien.php');
	die();
}
include('connexionBD.php');
$datetime = date("Y-m-d H:i:s");
$user_id=$_SESSION['id'];
$req=$base->prepare('SELECT * from medicaments where user_id='.$user_id);
$req->execute();

$perime=$base->prepare('SELECT * FROM medicaments where user_id=? and date_fin<?') ;
$perime->execute(array($user_id,$datetime));
$nombre=$perime->rowCount();
  




$nb=$req->rowCount();
$requete=$base->prepare('SELECT * from commande where id_user='.$user_id);
$requete->execute();
$nbr=$requete->rowCount();





$id_pharmacie=$_SESSION['id'];
$data=$base->prepare('SELECT * from commande_pharmacie where id_pharmacie=? and verifier="oui"');
$data->execute(array($id_pharmacie));

	
?>
<!DOCTYPE html>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style_slider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<head>
  <title>Espace pharmacien</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <style >
 	body{
 		background-image: url(images/10.jpg);
 		background-size: cover;
 		
 	}
  
  #cercle1{
        position: absolute;
        top: 5px;
        left: 40%;
        height: 50px;
        width: 50px;
        border-radius: 100%;
        border:solid 3px dodgerblue;
        background-color: white;
        border-radius: 100%;
         box-shadow:2px 2px 8px #aaa;
              font:bold 13px Arial;
      }
      #cercle2{
        position: absolute;
        top: 5px;
        left: 40%;
        height: 50px;
        width: 50px;
        border-radius: 100%;
        border:solid 3px #00FF00;
        background-color: white;
        border-radius: 100%;
         box-shadow:2px 2px 8px #aaa;
              font:bold 13px Arial;
      }
      #cercle3{
        position: absolute;
        top: 5px;
        left: 40%;
        height: 50px;
        width: 50px;
        border-radius: 100%;
        border:solid 3px tomato;
        background-color: white;
        border-radius: 100%;
         box-shadow:2px 2px 8px #aaa;
              font:bold 13px Arial;
      }
 </style>
 
<body>
	<?php include ('pharmacien_menu.php');?>
<div style="position: absolute;top: 300px;left: 25%;background-color: white;height:100px;width: 200px;border-radius: 10%;">

  <div id="cercle1">
    <div style="position: absolute;top: 0%;left: 40%;">
      <h4>
    <?php
    echo $nb
    ?>
  </h4>
  </div>

    
  </div>
  
<h4 style="position: absolute;top: 50px;left: 25%;">Médicaments</h4>
</div>
<div style="position: absolute;top: 300px;left: 40%;background-color: white;height:100px;width: 200px;border-radius: 10%;">

  <div id="cercle2">
    <div style="position: absolute;top: 0%;left: 40%;">
      <h4>
    <?php
    echo $nbr
    ?>
  </h4>
  </div>

    
  </div>
  
<h4 style="position: absolute;top: 50px;left: 25%;">Commandes</h4>
</div>
<div style="position: absolute;top: 300px;left: 55%;background-color: white;height:100px;width: 200px;border-radius: 10%;">

  <div id="cercle3">
    <div style="position: absolute;top: 0%;left: 40%;">
      <h4>
    <?php
    echo $nombre
    ?>
  </h4>
  </div>

    
  </div>
  
<h4 style="position: absolute;top: 50px;left: 10%;"> Médicaments périmés</h4>
</div>

</div>


</body>
</html>