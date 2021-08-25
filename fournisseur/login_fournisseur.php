<?php


session_start();
if (isset($_POST['login']) AND isset($_POST['mdp']))
{
	$login=htmlspecialchars($_POST['login']);
	$mdp=htmlspecialchars($_POST['mdp']);
	
	if (($mdp!="") AND ($login!=""))
	{
		include ('connexionBD.php');
	
		//test du login et du mot de passe
		$reponse=$base->prepare('SELECT * from fornisseur where login=? AND mdp=?');
		$reponse->execute(array($login,$mdp));
    $nb=$reponse->rowCount();
		$donnees=$reponse->fetch();

		if ($donnees)
		{
			$_SESSION['nom']=$donnees['nom'];
			$_SESSION['id']=$donnees['id_fr'];
      $_SESSION['role']=$donnees['role'];
			

			if ($donnees['role']=="fournisseur")
			{
				header('location:index_fournisseur.php');
				
	
		}
		}
	
	
	}}


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login fornisseur</title>
    <link rel="stylesheet" href="css/style_login.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style_slider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
  </head>
  <style >
  body{
margin: 0;
padding: 0;

-webkit-background-size:cover;
background-size: cover;
font-faily: Tahoma,Monospace;
}
.form-area{
  position:absolute;
  top:55%;
  left:50%;
  transform:translate(-50%,-40%);
  width: 400px;
  height: 400px;
  box-sizing: border-box;
  background: rgba(0, 0, 0, 0.8);
  padding:40px;
  border-radius: 10px;
}
.form-area h3{
  margin: 0;
  padding:0 0 20px;
  font-weight: ;
  color:#ffffff;
  font-family: Arial,Monospace;
}
.form-area p{
  margin:0;
  padding:0;
  font-weight:bold;
  color:#ffffff;
  font-family: arial,Monospace;
}
.form-area input,select{
  margin-bottom: 20px;
  width: 100%;
}
.form-area input[type=text],
.form-area input[type=password]{
  border:none;
border-bottom: 1px solid #ffffff;
background: transparent;
outline: none;
height: 40px;
color: #ffffff;
display: 16px;

}
::placeholder{
  color:#ffffff;
}
.form-area select {
  margin-top:20px;
  padding:10px 0;
}
.form-area input[type=submit]{
  border:none;
  height: 40px;
  outline: none;
  color: #tomato;
  font-size:15px;
  background-color: tomato;
  cursor: pointer;
  border-radius: 20px;
}
.form-area input[type=submit]:hover{
  background-color: #7CFC00;
  color:#ffffff;
}
.form-area a{
  color:#ffffff;
  text-decoration: none;
  font-size:14px;
  font-weight: hold;
}
#erreur{
  color: red;
  

}	





  </style>
  <body>
  	
<?php include('C:\xampp\htdocs\g_pharmacie\index.php')?>

			
			
		
<div class="form-area">


			<form method="POST"  action="#">
        <div id="erreur">
          <?php
         if (isset($_POST['login']) and (isset($_POST['mdp']))) {
           if ($nb==0) {
           ?>  
           <div id="erreur"> <h4>Login ou mot de pass incorrecte</h4></div>
         
          <?php
        }
      }
        ?>
         
        </div>
               
                  <h3>login form </h3>
                      <p>login</p>
				          <input  type="text" name="login" required/> 

				      <p>password</p>
				          <input  type="password" name="mdp" required/> 

				<input class="btn btn-success" type="submit"/>
			</form>
		</div>
	

  </body>
</html>








