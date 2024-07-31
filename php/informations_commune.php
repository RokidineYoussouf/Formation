<?php
// Connexion à la base de données
$servername = "mariadb";
$username = "root";
$password = "mdproot";
$database = "examen2024";

$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupération du code commune depuis l'URL
$code_commune = $_GET["commune"];

// Requête pour récupérer les informations sur la commune
$requete = $pdo->prepare("SELECT c.commune, h.superficie, h.population_1999, h.population_2008, h.population_2018, h.population_2019
                        FROM communes c
                        JOIN historique h ON c.COM = h.CODGEO
                        WHERE c.COM = :code_commune");
$requete->bindParam(":code_commune", $code_commune);
$requete->execute();
$commune = $requete->fetch(PDO::FETCH_ASSOC);

// Calcul des densités de population
$densities = [
    "Densite_1999" => $commune["population_1999"] / $commune["superficie"],
    "Densite_2008" => $commune["population_2008"] / $commune["superficie"],
    "Densite_2018" => $commune["population_2018"] / $commune["superficie"],
    "Densite_2019" => $commune["population_2019"] / $commune["superficie"],
];

// Calcul des évolutions de la population totale
$evolutions = [
    "Evolution_2008" => (($commune["population_2008"] - $commune["population_1999"]) / $commune["population_1999"]) * 100,
    "Evolution_2018" => (($commune["population_2018"] - $commune["population_2008"]) / $commune["population_2008"]) * 100,
    "Evolution_2019" => (($commune["population_2019"] - $commune["population_2018"]) / $commune["population_2018"]) * 100,
];

// Affichage des informations dans un tableau
echo "<table>";
echo "<tr><th>Information</th><th>Valeur</th></tr>";
echo "<tr><td>Nom</td><td>" . $commune["commune"] . "</td></tr>";
echo "<tr><td>Superficie</td><td>" . $commune["superficie"] . "</td></tr>";
echo "<tr><td>Population Totale 1999</td><td>" . $commune["population_1999"] . "</td></tr>";
echo "<tr><td>Population Totale 2008</td><td>" . $commune["population_2008"] . "</td></tr>";
echo "<tr><td>Population Totale 2018</td><td>" . $commune["population_2018"] . "</td></tr>";
echo "<tr><td>Population Totale 2019</td><td>" . $commune["population_2019"] . "</td></tr>";
echo "<tr><td>Densité 1999</td><td>" . $densities["Densite_1999"] . "</td></tr>";
echo "<tr><td>Densité 2008</td><td>" . $densities["Densite_2008"] . "</td></tr>";
echo "<tr><td>Densité 2018</td><td>" . $densities["Densite_2018"] . "</td></tr>";
echo "<tr><td>Densité 2019</td><td>" . $densities["Densite_2019"] . "</td></tr>";
echo "<tr><td>Evolution 2008</td><td>" . $evolutions["Evolution_2008"] . "%</td></tr>";
echo "<tr><td>Evolution 2018</td><td>" . $evolutions["Evolution_2018"] . "%</td></tr>";
echo "<tr><td>Evolution 2019</td><td>" . $evolutions["Evolution_2019"] . "%</td></tr>";
echo "</table>";

?>