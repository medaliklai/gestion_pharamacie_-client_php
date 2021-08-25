<?php
if (isset($_POST['nom_clt']) AND isset($_POST['prenom']) AND isset($_POST['num_tel']) AND isset($_POST['login']) AND isset($_POST['mdp']))
{
	$nom_clt=htmlspecialchars($_POST['nom_clt']);
	$prenom=htmlspecialchars($_POST['prenom']);
	$num_tel=htmlspecialchars($_POST['num_tel']);
	$login=htmlspecialchars($_POST['login']);
	$mdp=htmlspecialchars($_POST['mdp']);
	

	
	

	include ('connexionBD.php');

	//verification des données
	//.....

	//insertion dans la base de données

	$reponse=$base->prepare('INSERT INTO client(nom_clt, prenom, num_tel, login, mdp) VALUES (:nom_clt, :prenom, :num_tel, :login, :mdp)');
	$reponse->execute(array(
							'nom_clt' => $nom_clt,
							'prenom' =>$prenom,
							'num_tel' => $num_tel,
							'login' => $login,
							'mdp' =>$mdp
							));
	
	header('location:login_client.php');

}
		
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Inscription</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style_inscription.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<style >
			body{
				background-image: url(images/1.jpg);
				background-size: cover;
			
				
			
			
margin: 0;
padding: 0;

-webkit-background-size:cover;
background-size: cover;
font-family: Tahoma,Monospace;
}
.form-area{
  position:absolute;
  top: 1000%;
  left:50%;
  transform:translate(-50%,-40%);
  width: 500px;
  height: 650px;
  box-sizing: border-box;
  background: rgba(0, 0, 0, 0.80);
  padding:40px;
  border-radius: 10px;
  box-shadow: 3px green;
}
.form-area h3{
  margin: 0;
  padding:0 0 20px;
  font-weight: ;
  color:#ffffff;
  font-family: Arial,Monospace;
  position: absolute;
  
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
.form-area input[type=text]{
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
.container{
	border:solid 5px green;
}



					
		</style>
	</head>
<body>


<?php include('C:\xampp\htdocs\g_pharmacie\index.php')?>




	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h3 class="text-center"></h3>

			<br/>
                 <div class="form-area">
			<form method="POST"  action="#">
				
					

							<p><label>nom</label></p>
							<input class="form-control" type="text" name="nom_clt" required/>  <br/>

							<p><label>prénom</label></p>
							<input class="form-control" type="text" name="prenom" required/>  <br/>

							<p><label>numéro de téléphone</label></p>
							<input class="form-control" type="text" name="num_tel" required/>  <br/>
					
					
							<p><label>login</label></p>
							<input class="form-control" type="text" name="login" required/>  <br/>
							<p><label>mot de pass</label></p>
							<input class="form-control" type="text" name="mdp" required/>  <br/>
							<input class="btn btn-success" type="submit"/>
					
				</div>
			


			</form>
		
		</div>
	</div>
</div>


</body>

</html>