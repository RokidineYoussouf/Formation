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

// Récupération du code département depuis l'URL
$code_departement = $_GET["departement"];

// Requête pour récupérer les informations sur les communes du département
$requete = $conn->prepare("SELECT c.commune, c.population_municipale + c.population_comptee_a_part AS PopulationTotale
                        FROM communes c
                        WHERE c.DEP = ?");

// Vérifier si la requête a été préparée correctement
if (!$requete) {
    die("Erreur lors de la préparation de la requête : " . $conn->error);
}

// Associer le paramètre à la requête préparée
$requete->bind_param("s", $code_departement);

// Exécuter la requête préparée
if (!$requete->execute()) {
    die("Erreur lors de l'exécution de la requête : " . $requete->error);
}

// Récupérer les résultats de la requête
$result = $requete->get_result();

// Affichage des informations dans un tableau
echo "<table>";
echo "<tr><th>Nom de la commune</th><th>Population totale</th></tr>";
while ($commune = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $commune["commune"] . "</td>";
    echo "<td>" . $commune["PopulationTotale"] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Fermeture de la connexion
$conn->close();
?>