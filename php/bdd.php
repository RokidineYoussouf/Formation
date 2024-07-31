<?php
require_once("outils.php");
echo debut("Base de données");
echo <<<HTML
<hr />	  
	  <h1 style="margin: 15px 0 0 0;">Base de données</h1>
	  <a href="images/base_de_donnees.jpg" target="base_de_donnees">
	    <img style="float: right; vertical-align: middle; margin: 0 0 0 30px; height:100px;" src="images/base_de_donnees.jpg" alt="bdd" />
	  </a>
	  <p>Vous allez dans ce qui suit mettre en place et étudier une base de données.
	  </p>
	  <p align="justify">Tout d'abord, créez dans <b>phpmyadmin</b> un nouvel utilisateur <b>examen2024</b>
	    dont le mot de passe sera également <b>examen2024</b>, ainsi qu'une base de données portant son nom.
	  </p>
	  <p align="justify">Les informations sur les tables (définitions et contenus) sont rassemblées dans un fichier <i>sql</i> que vous avez téléchargé et importé via <b>phpmyadmin</b>.
	  </p>
	  <!-- ==================================================================================== -->
	  <p align="justify">
	    Analysez rapidement les tables fournies et proposer un schéma conceptuel ayant mené à ce schéma relationnel.
	    <br />
	    Réponse : <pre style="white-space:pre-line;"><i>Écrire ici votre réponse.</i></pre>
	  </p>
	  <p align="justify">
	    Proposez quelques modifications et/ou vérifications qu'il vous semble pertinent d'envisager afin d'assurer la cohérence des informations stockées et l'insertion de nouvelles données.
	    <br />
	    Réponse : <pre style="white-space:pre-line;"><i>Écrire ici votre réponse.</i></pre>
	  </p>
	  <!-- ==================================================================================== -->
	  	  <!-- ==================================================================================== -->
	  <!-- ==================================================================================== -->
	  <!-- ==================================================================================== -->
	  <p align="justify">
	    Sous chacune des questions suivantes (qui portent sur les données contenues dans les tables), donner la requête mysql permettant d'y répondre ainsi que le résultat :
	  </p>
	  <ol>
	    <li>
	      <p align="justify">Quelle est la population totale actuelle de Villeneuve-d'Ascq ?
	      </p>
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;"> SELECT population_municipale FROM communes WHERE commune = 'Villeneuve-d\'Ascq';</pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
	      <pre style="white-space:pre-line;"><i> 62067</i></pre>
	    </li>
	    
	    <li>
	      <p align="justify">Quels sont les cantons du département 59 ?
	      </p>	 
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;"> SELECT * FROM `cantons` WHERE cantons.DEP="59";</pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
	      <pre style="white-space:pre-line;"><i> <div class="exercice"><a href="respone2"> <h3>reponse2<h3></a></div></i></pre></i></pre>
	    </li>
	    
	    <li>
	      <p align="justify">Quelle est la superficie de la commune de Villeneuve-d'Ascq ?
	      </p>
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;"> SELECT h.superficie
                                                FROM communes c
                                                JOIN historique h ON c.COM = h.CODGEO
                                                WHERE c.commune = "Villeneuve-d'Ascq";</pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
	      <pre style="white-space:pre-line;"><i> 27.46</i></pre>
	    </li>
	    
	    <li>
	      <p align="justify">Quelle est la densité de population totale actuelle du département de l'Aisne ?
	      </p>
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;"> SELECT SUM(c.population_municipale + c.population_comptee_a_part) / SUM(h.superficie) AS Densite
                                            FROM communes c
                                            JOIN historique h ON c.COM = h.CODGEO
                                            WHERE c.DEP = "2"; </pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
	      <pre style="white-space:pre-line;"><i> 73.34720201614547 </i></pre>
	    </li>
	    
	    <li>
	      <p align="justify">Quel est le nombre de communes recencées dans la base de données ?
	      </p>
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;"> SELECT COUNT(*) AS nombre_communes
                                                              FROM communes;</pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
	      <pre style="white-space:pre-line;"><i> 3787</i></pre>
	    </li>
	    
	    <li>
	      <p align="justify">Quelles sont les trois communes les plus peuplées (population totale) de la région Hauts-de-France ?
	      </p>
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;"> SELECT c.commune, c.population_municipale + c.population_comptee_a_part AS PopulationTotale
                                            FROM communes c
                                            JOIN departements d ON c.DEP = d.DEP
                                            WHERE d.REG = 32
                                            ORDER BY PopulationTotale DESC
                                            LIMIT 3; </pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
	      <pre style="white-space:pre-line;"><i> Lille 238542

                                                Amiens 136265
                                                
                                                Tourcoing 99679 </i></pre>
	    </li>
	    
	    <li>
	      <p align="justify">Quelles sont les 5 communes ayant connu la plus grande augmentation de population totale depuis 1999 ?
	      </p>
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;"> SELECT c.commune, (c.population_municipale + c.population_comptee_a_part) - h.population_1999 AS Augmentation
                                            FROM communes c
                                            JOIN historique h ON c.COM = h.CODGEO
                                            ORDER BY Augmentation DESC
                                            LIMIT 5;
</pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
	      <pre style="white-space:pre-line;"><i> Écommune 	Augmentation  

	
                                                    Lille 	     25945  


                                                    Tourcoing    	6139  


                                                    Creil 	         5689    


                                                    Lesquin 	    3318        


                                                    Saint-André-lez-Lille 	 2940</i></pre>
	    </li>
	    
	    <li>
	      <p align="justify">Quelles sont les 10 communes de la base de données de moins forte densité de population totale ?
	      </p>
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;">SELECT c.commune, (c.population_municipale + c.population_comptee_a_part) / h.superficie AS Densite
                                                                FROM communes c
                                                                JOIN historique h ON c.COM = h.CODGEO
                                                                ORDER BY Densite ASC
                                                                LIMIT 10; </pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
                	      <pre style="white-space:pre-line;"><i> commune	Densite   	
                Méréaucourt	2.9605263529391834	
                Locquignol	3.1266016448833316	
                Bruys	3.3333334448741927	
                Épécamps	3.7499999441206464	
                Éparcy	4.521276607212301	
                Ployart-et-Vaurseine	4.665314564067814	
                Villers-Agron-Aiguizy	5.394839734620548	
                Gouy-les-Groseillers	5.537459403799771	
                Cuiry-lès-Iviers	5.636743259921648	
                Saint-Pierremont	5.873925485381628</i></pre>
	    </li>
	    
	    <li>
	      <p align="justify">Quels sont les nom et population totale des départements des Hauts-de-France ?
	      </p>
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;"> SELECT d.departement, SUM(c.population_municipale + c.population_comptee_a_part) AS PopulationTotale
                                                FROM departements d
                                                JOIN communes c ON d.DEP = c.DEP
                                                WHERE d.REG = 32
                                                GROUP BY d.DEP, d.departement;</pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
	      <pre style="white-space:pre-line;"><i> departement 	PopulationTotale 	
                                                    Aisne 	  :            539099 


                                                    Nord 	     :         2641207 


                                                    Oise 	        :       846339  


                                                    Pas-de-Calais 	     :        1482950 


                                                    Somme 	            :           576070</i></pre>
	    </li>
	    
	    <li>
	      <p align="justify">Quelles sont les communes du département Pas-de-Calais dont le nom commence par <i>Z</i> et dont la population a diminué depuis 2008 ?
	      </p>
	      <p align="justify">Requête :
	      </p>
	      <pre style="white-space:pre-line;"> SELECT c.commune
                                                FROM communes c
                                                JOIN historique h ON c.COM = h.CODGEO
                                                WHERE c.DEP = "62"
                                                AND c.commune LIKE "Z%"
                                                AND (c.population_municipale + c.population_comptee_a_part) < h.population_2008;</pre>
	      <br />
	      <p align="justify">Réponse :
	      </p>
	      <pre style="white-space:pre-line;"><i> </i></pre>
	    </li>
	  </ol>
	
HTML;
?>
<?php
echo fin();
?>
