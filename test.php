<!DOCTYPE html>
<html>
<meta charset="utf-8">
  <head>
   
  </head>
  <body>
  <?php 
  include('connexionBD.php');
  $reponse=$base->prepare('SELECT * FROM client');
  $reponse->execute();
  ?>

  <?php
  while ($client=$reponse->fetch()) {
  	?>
  	<table ="table">
  		<th>nom</th>
  		<th>prenom</th>
  		<tr>
  			<td><?=$client['nom_clt'];?></td>
  			<td><?=$client['prenom'];?></td>


  		</tr>
  	</table>
  	<?php
  }
  ?>
    
  
  
</body>
</html>
