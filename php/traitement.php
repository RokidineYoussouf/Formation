// Connexion à la base de données (à adapter avec vos paramètres de connexion)
$pdo = new PDO('mysql:host=hostname;dbname=images', 'username', 'password');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $lien = $_POST['lien'];

    // Vérification de l'unicité du nom
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM liens WHERE nom = ?");
    $stmt->execute([$nom]);
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        // Le nom est unique, on peut insérer l'image
        $stmt = $pdo->prepare("INSERT INTO liens (nom, description, lien) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $description, $lien]);
        echo "Image ajoutée avec succès.";
    } else {
        echo "Une image avec ce nom existe déjà.";
    }
}
