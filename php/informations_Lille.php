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

// Requête pour récupérer les informations sur la commune de Lille
$requete = $conn->prepare("SELECT c.commune, h.superficie, h.population_1999, h.population_2008, h.population_2013, h.population_2019
                        FROM communes c
                        JOIN historique h ON c.COM = h.CODGEO
                        WHERE c.commune = 'Lille'");

// Vérifier si la requête a été préparée correctement
if (!$requete) {
    die("Erreur lors de la préparation de la requête : " . $conn->error);
}

// Exécuter la requête
$requete->execute();

// Obtenir le jeu de résultats
$result = $requete->get_result();

// Extraire les données de la première ligne du jeu de résultats
$lille = $result->fetch_assoc();

// Calcul des densités de population
$densities = [
    "Densite_1999" => $lille["population_1999"] / $lille["superficie"],
    "Densite_2008" => $lille["population_2008"] / $lille["superficie"],
    "Densite_2013" => $lille["population_2013"] / $lille["superficie"],
    "Densite_2019" => $lille["population_2019"] / $lille["superficie"],
];

// Calcul des évolutions de la population totale
$evolutions = [
    "Evolution_2008" => (($lille["population_2008"] - $lille["population_1999"]) / $lille["population_1999"]) * 100,
    "Evolution_2013" => (($lille["population_2013"] - $lille["population_2008"]) / $lille["population_2008"]) * 100,
    "Evolution_2019" => (($lille["population_2019"] - $lille["population_2018"]) / $lille["population_2018"]) * 100,
];

// Affichage des informations dans un tableau
echo "<table>";
echo "<tr><th>Information</th><th>Valeur</th></tr>";
echo "<tr><td>Nom</td><td>" . $lille["commune"] . "</td></tr>";
echo "<tr><td>Superficie</td><td>" . $lille["superficie"] . "</td></tr>";
echo "<tr><td>Population Totale 1999</td><td>" . $lille["population_1999"] . "</td></tr>";
echo "<tr><td>Population Totale 2008</td><td>" . $lille["population_2008"] . "</td></tr>";
echo "<tr><td>Population Totale 2018</td><td>" . $lille["population_2018"] . "</td></tr>";
echo "<tr><td>Population Totale 2019</td><td>" . $lille["population_2019"] . "</td></tr>";
echo "<tr><td>Densité 1999</td><td>" . $densities["Densite_1999"] . "</td></tr>";
echo "<tr><td>Densité 2008</td><td>" . $densities["Densite_2008"] . "</td></tr>";
echo "<tr><td>Densité 2018</td><td>" . $densities["Densite_2018"] . "</td></tr>";
echo "<tr><td>Densité 2019</td><td>" . $densities["Densite_2019"] . "</td></tr>";
echo "<tr><td>Evolution 2008</td><td>" . number_format($evolutions["Evolution_2008"], 2) . "%</td></tr>";
echo "<tr><td>Evolution 2018</td><td>" . number_format($evolutions["Evolution_2018"], 2) . "%</td></tr>";
echo "<tr><td>Evolution 2019</td><td>" . number_format($evolutions["Evolution_2019"], 2) . "%</td></tr>";
echo "</table>";

$conn->close();

?>