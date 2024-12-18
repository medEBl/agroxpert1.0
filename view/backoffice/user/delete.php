<?php
// Inclure le fichier userc.php
require_once '../../../controller/userc.php';

// Instancier le contrôleur
$userc = new userc();

// Si la requête est POST, traiter la suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Supprimer l'utilisateur de la base de données
        $userc->deleteUser($id);
        // Rediriger vers la liste avec un message de confirmation
        header('Location: gestion.php?message=User deleted successfully');
        exit;
    } else {
        header('Location: gestion.php?message=Invalid user ID');
        exit;
    }
}

// Si la requête est GET, afficher la page de confirmation
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: gestion.php?message=Invalid user ID');
    exit;
}

// Récupérer les informations de l'utilisateur
$user = $userc->getUserById($id);
if (!$user) {
    header('Location: gestion.php?message=User not found');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Supprimer un utilisateur</h1>
    <p>Êtes-vous sûr de vouloir supprimer l'utilisateur suivant ?</p>
    <ul>
        <li><strong>ID :</strong> <?= htmlspecialchars($user['id']); ?></li>
        <li><strong>Nom :</strong> <?= htmlspecialchars($user['name']); ?></li>
        <li><strong>Email :</strong> <?= htmlspecialchars($user['email']); ?></li>
        <li><strong>Adresse :</strong> <?= htmlspecialchars($user['adresse']); ?></li>
        <li><strong>Role :</strong> <?= htmlspecialchars($user['typeUser']); ?></li>
    </ul>

    <form action="delete.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
        <button type="submit">Supprimer</button>
    </form>
    <a href="gestion.php">Annuler</a>
</body>
</html>
