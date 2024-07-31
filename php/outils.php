<?php

function debut($titre)
{
  require_once('constantes.php');
  date_default_timezone_set('Europe/Paris');
  $date=date('d/m/Y');
  $heure=date('H:i');
  echo <<<HTML
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Examen de Youssouf</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
   <body>
    <div id="maincontainer">
      
      <div id="header">
	<h1><img src="images/logo.png" width="21" height="22" alt="Logo" /> Examen <span style="color: #e8ccad">php/Mysql</span></h1>
	<h2>Master 2 ISN - 2023/2024</h2>
      </div>
      
      <div id="navtop">
	<ul>
	  <li><a href="index.php" title="">Accueil</a></li>
	  <li><a href="exercice1.php" title="">Exercice 1</a></li>
	  <li><a href="exercice2.php" title="">Exercice 2</a></li>
	  <li><a href="exercice3.php" title="">Exercice 3</a></li>
	  <li><a href="bdd.php" title="">BDD</a></li>
	  <li><a href="php_mysql.php" title="">Php/Mysql</a></li>
	</ul>
      </div>
<center>


</center>
  </body>
  </html>
HTML;
};
?>


<?php
function fin(){
    echo <<<HTML
    <footer>
    </div>
      </div>
      <div id="footer">Copyright &copy; dbaichi hicham. All Rights Reserved. |
    <a href="http://validator.w3.org/check?uri=referer">XHTML</a> |
    <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> |
    <a href="http://www.dcarter.co.uk">design by dcarter</a>
      </div>
    </div>
    </body>
    </footer>
    HTML;
    }; 
?>
