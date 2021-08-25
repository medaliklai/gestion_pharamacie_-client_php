
<?php
include ('connexionBD.php');
$requete = $base->query('SELECT COUNT(id) as countid FROM pharmacie');   
$nbligne = $requete->fetch();
$req = $base->query('SELECT COUNT(id_client) as countid FROM client');
      
$nblign = $req->fetch();
$reponse = $base->query('SELECT COUNT(id_fr) as countid FROM fornisseur');
      
$nb = $reponse->fetch();

$k=$base->prepare('SELECT * from message where  receiver="admin"');
$k->execute();
$n=$k->rowCount();


    $user_id=$_SESSION['id']; 
    $rep=$base->prepare('SELECT * from message where id_recepteur=0 ');
    $rep->execute();
    $receive=$rep->rowCount();
 
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
  background-image: url(images/15.jpg););
  
}

#navbar {
  overflow: hidden;
  background-color:transparent;
  padding: 90px 10px;
  transition: 0.4s;
  position: fixed;
  width: 100%;
  height: 200px;
  top: 0;
  
}

#navbar a {
  float: left;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 20px;
  transform: scale(1);

  
 
}



#navbar #logo {
  font-size: 30px;
  font-weight: 10px;
  transition: 0.4s;
  position: absolute;
  top:-60px;
  left: 0px;

}
#navbar #logo:hover{
  background-color: transparent;
}

#navbar  a:hover {
  color: white;
  transform: scale(1.05);
  background-color:red;
  border-radius: 15px;
}

#navbar-right {
  float: right;
  position: absolute;
  top: 20px;
 left: 650px;
  width: 700px;
  background-color:transparent;
  border-radius: 15px;
  transform: scale(1);
  transition: .3s ease-in-out;
}
#navbar-right:hover{
  transform: scale(1.06);

}

@media screen and (max-width: 580px) {
  .navbar {
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
  
  
</style>
<body>


 <div id="navbar">
  <a href="index_admin.php" id="logo"><img src="images/logo6.png"></a>
  <div id="navbar-right">
     <a href="admin_message.php"><i class="fa fa-envelope" style="font-size: 30px;"></i><i style="color: red;  background-color:rgba(0,0,0,0.5);border-radius: 100%;border:1px solid white;position: absolute;top: 6px;left: 30px; width: 25px;height: 25px;"><?php echo $receive;?></i></a>
   
     <a href="admin_affiche_pharmacie.php">Pharmacies </a>

     <a href="admin_affiche_fornisseur.php">Fournisseurs </a>
     
        <a href="admin_affiche_client.php">Clients </a>
       <!--<a href="admin_recherche.php"><i class="glyphicon glyphicon-search"> </i> </a>!-->
       <a href="admin_profil.php"><i class="glyphicon glyphicon-cog"> </i> </a>
      <a href="logout.php"><i class="glyphicon glyphicon-off" ></i> Déconnexion </a>
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
