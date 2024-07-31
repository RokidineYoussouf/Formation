<?php
require_once("outils.php");
echo debut("Exercice1");
echo <<<HTML

	  <h1>Exercice 1</h1>
          <a href="images/texte_code.jpg" target="texte_code">
	    <img style="float: right; vertical-align: middle; margin: 0 0 0 30px; height:100px;" src="images/texte_code.jpg" alt="exercice1" />
	  </a>
	  <p align="justify">Vous venez de recevoir un message qui a transité par un grand nombre de machines
	    et qui a été modifié plusieurs fois au cours de sont trajet. Vous savez que certaines machines
	    ajoutent volontairement des points. Vous savez également que d'autres, motivées par le fait de cacher
	    l'information transmise, introduisent des chaînes de caractères aléatoires entre deux signes <i>*</i>.
	  </p>
	  <p align="justify">Par exemple, la chaîne reçue : <b>Bo.nj.ou*bonne*r t.ou*année*t le m..o*à*n.d*tous*e</b>
	    correspond en fait à la chaîne initiale <b>Bonjour tout le monde</b>.
	  </p>
	  <p align="justify">Écrire une fonction <b>nettoie</b> ayant pour entrée une chaîne de caractère et qui renvoie la chaîne de caractère
	    nettoyée des différents ajouts.
	  </p>
<div class="container form-section">
        <?php
         echo '<div class="exercice"><a href="solution1.php"> <h3>SOLUTION 1<h3></a></div>';
        
       </div>

HTML;
	  
?>
<?php

echo fin();
?>
