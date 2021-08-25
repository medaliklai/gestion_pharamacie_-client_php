

<?php
$user_id=$_SESSION['id'];
    $nom=$_SESSION['nom'];  
    $rep=$base->prepare('SELECT * from message where id_recepteur=? and recepteur=? and role_recepteur="fournisseur"');
    $rep->execute(array($user_id,$nom));
    $receive=$rep->rowCount();

$requete=$base->prepare('SELECT * from commande_pharmacie where id_fornisseur=? and verifier="non"');
$requete->execute(array($user_id));
$nbcmd=$requete->rowCount();
?>
<!DOCTYPE html>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style_slider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<html lang="en">
<head>
  <title>gestion de médicaments</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-image: url(images/4.jpg);
  background-width: 100%;
}

#navbar {
  overflow: hidden;
  background-color:transparent;
  padding: 90px 10px;
  transition: 0.4s;
  position: fixed;
  width: 100%;
  top: 0;
  z-index: 99;
  height: 100px;
}

#navbar a {
  float: left;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 15px;
}


#navbar #logo {
  font-size: 25px;
  font-weight: 10px;
  transition: 0.4s;
  position: absolute;
  top:-40px;
  left: 0px;
  transform: scale(1);
  transition: 1s;
}
#navbar #logo:hover {
  background-color: transparent;
  transform: scale(1.1);
  
}

#navbar  a:hover {
  background-color:rgba(0,0,0,0.5);
  color: white;
}

#navbar-right {
  float: right;
  position: absolute;
  top: 30px;
  left: 700px;
  background-color:rgba(199,21,133,0.7);
  border-radius: 15px;
  -webkit-transform: scale(1);
  transform: scale(1);
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
}
#navbar-right:hover{
  -webkit-transform: scale(1.06);
  transform: scale(1.06);
  background-color:rgba(199,21,133,0.7);
}


@media screen and (max-width: 580px) {
  .navbar-default {
    padding: 20px 10px !important;
  }
  #navbar  a {
    float: none;
    display: block;
    text-align: left;

  }
  #nav-right {
    float: none;
  }
   #navbar-right h4 {
    
    color: white;
  }
  
</style>
<body>


 <div id="navbar">
  <a href="index_fournisseur.php" id="logo"><img src="images/logo6.png"></a>
  <div id="navbar-right">
    <a href="fournisseur_message.php"><i class="fa fa-envelope" style="font-size: 40px;"></i><i style="color: red;  background-color:rgba(0,0,0,0.5);border-radius: 100%;border:1px solid white;position: absolute;top: 6px;left: 40px; width: 25px;height: 25px;"><?php echo $receive;?></i></a>

    <a href="fournisseur_affiche_nouveau_commande.php"><h4>Nouveau commande<i style="color: red;  background-color:rgba(0,0,0,0.5);border-radius: 100%;border:1px solid white;position: absolute;top: 6px;left: 220px; width: 25px;height: 25px;"><?php echo $nbcmd;?></i></h4></a>
    
        <a href="fournisseur _affiche_commande.php"> <h4> Commandes</h4> </a>
       <!--<a href="fornisseur_recherche.php"><h4><i class="glyphicon glyphicon-search"> </i></h4> </a>!-->
       <a href="fournisseur_profile.php"><h4><i class="glyphicon glyphicon-cog"> </i></h4> </a>
      <a href="logout.php"><h4><i class="glyphicon glyphicon-off" ></i> Déconnexion</h4> </a>
  </div>
</div>

<script>
// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("navbar").style.padding = "30px 10px";
    document.getElementById("logo").style.fontSize = "25px";
  } else {
    document.getElementById("navbar").style.padding = "80px 10px";
    document.getElementById("logo").style.fontSize = "35px";
  }
}
</script>

</body>
</html>