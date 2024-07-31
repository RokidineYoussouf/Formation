<?php
require_once("outils.php");
echo debut("Exercice3");
echo <<<HTML

	             <hr />          
	  <h1>Exercice 3</h1>
          <a href="images/stockage_images.jpg" target="stockage_images">
	    <img style="float: right; vertical-align: middle; margin: 0 0 0 30px; height:100px;" src="images/stockage_images.jpg" alt="exercice3" />
	  </a>
	  <p align="justify">Sur la base de votre outil de formulaire unique confectionné durant le semestre,
	    mettre en place un stockage de données <b>images</b>.<br />
	    Pour cela, construire une base de données <i>images</i> pour l'utilisateur du même nom ainsi qu'une table <i>liens</i> qui contiendra
	    notamment les informations suivantes : <br />
	    - <i>Nom</i> : le nom donné par l'utilisateur à l'image,<br />
	    - <i>Description</i> : le texte de description de l'image en question,<br />
	    - <i>Lien</i> : l'adresse URL de l'image.<br />
	    Votre formulaire affichera dans le tableau le nom et le visuel (en miniature) des images.
	    Vous ajouterez un lien dans le tableau qui affichera toutes les informations stockées pour une image au dessus du tableau de la liste
	    des images de la base de données.
	  </p>
	  <p align="justify">Dans un seconde temps, afin d'éviter des effets de bord, vous imposerez, lors de la soumission du formulaire, 
	    que le nom choisi pour l'image ne soit pas déjà présent dans la base de données.
	  </p>
<div class="container form-section">
        <?php
         echo '<div class="exercice"><a href="solution3.php"> <h3>SOLUTION 3<h3></a></div>';
        
       </div>
HTML;
?>
<?php
echo fin();
?>
