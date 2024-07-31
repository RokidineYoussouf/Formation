<?php

require_once("outils.php");
echo debut("Exercice2");

echo <<<HTML

	 <hr />
          <h1>Exercice 2</h1>
          <a href="images/devine_nombre.jpg" target="devine_nombre">
	    <img style="float: right; vertical-align: middle; margin: 0 0 0 30px; height:100px;" src="images/devine_nombre.jpg" alt="exercice2" />
	  </a>
	  <p align="justify">Vous possédez un jeu de cartes contenant chacune une liste de nombres. 
	    Vous demandez à une personne de choisir, sans vous le dire, un nombre entre 1 et 30. 
	    En lui montrant les cartes les unes après les autres et en lui demandant de vous informer 
	    si le nombre choisi fait partie des nombres inscrits, vous êtes capable de retrouver le nombre caché !</p>

	    <p align="justify">Voici sur un exemple la façon dont vous porcédez : supposons que le nombre choisi soit 23, 
	    les réponses aux questions sont les suivantes :
	    <ul>
	    <li>Carte n°1 : 1 3 5 7 9 11 13 15 17 19 21 23 25 27 29 : OUI</li>
	    <li>Carte n°2 : 2 3 6 7 10 11 14 15 18 19 22 23 26 27 30 : OUI</li>
	    <li>Carte n°3 : 4 5 6 7 12 13 14 15 20 21 22 23 28 29 30 : OUI</li>
	    <li>Carte n°4 : 8 9 10 11 12 13 14 15 24 25 26 27 28 29 30 : NON</li>
	    <li>Carte n°5 : 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 : OUI</li>
	    </ul>
	    Il vous suffit d'aditionner les premiers nombres des cartes pour lesquelles 
	    la réponse est OUI : 1+2+4+16=23 ! </p>

	  <p align="justify">Écrire un fonction php <b>devine</b> qui prend en arguments la liste des cartes (elles-mêmes listes d'entiers)
	    et la liste des réponses (liste de 0 et de 1) et qui renvoie le nombre à deviner.
	  </p>
	  
	  <p align="justify">En tant que mathématicie(ne) vous avez immédiatement compris la façon dont sont construites les cartes. 
	    Il s'agit de regrouper sur une même carte les nombres qui possèdent dans leur décomposition 
	    en base 2 le premier élément de la carte (qui est une puissance de 2).
	  </p>
	  
	  <p align="justify">Ainsi 23 =2<sup>0</sup>+2<sup>1</sup>+2<sup>2</sup>+2<sup>4</sup>, 23 devra donc apparaître dans les cartes 
	    dont le premier élément est 2<sup>0</sup>=1, 2<sup>1</sup>=2, 2<sup>2</sup>=4 et 2<sup>4</sup>=16.
	  </p>
	  
	  <p align="justify">Vous voulez faire encore plus forte impression et décidez de préparer des cartes
	    pour des nombres à deviner de taille arbitraire.
	  </p>
	  
	  <p align="justify">Écrire une fonction <b>cartes</b> qui pour un entier donné (le maximum des nombres devinables) 
            retourne le contenu des cartes nécessaires pour briller à l'heure du thé. 
            Vous testerez votre procédure en proposant un formulaire.
	  </p>

	  <p align="justify">Retrouver les cartes de l'exemple et donner les cartes nécessaires pour faire 
            deviner un nombre compris entre 1 et 127.
            Mais pourquoi avoir choisi 127 ?
	  </p>
	  
	  <p align="justify">Proposer à l'intérieur de cette page un formulaire permettant à un internaute de produire le jeu
	    de cartes pour l'entier souhaité.
	  </p>
<div class="container form-section">
        <?php
         echo '<div class="exercice"><a href="solution2.php"> <h3>SOLUTION 2<h3></a></div>';
        
       </div>
HTML;

?>
<?php

echo fin();
?>
