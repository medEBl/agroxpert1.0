<?php
// Inclure les fichiers nécessaires
require_once __DIR__ . '/../../../model/modelUser.php';
require_once __DIR__ . '/../../../controller/userc.php';

// Récupérer l'ID de l'utilisateur à partir de la query string
$id = $_GET['id'] ?? null;

// Instancier le contrôleur
$userc = new userc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si le formulaire a été soumis, traiter la mise à jour

    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $adresse = $_POST['adresse'];
    $typeUser = $_POST['typeUser'];

    // Si le mot de passe est renseigné, le hacher
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT); // Hachage du mot de passe
    }

    // Mettre à jour l'utilisateur dans la base de données
    $userc->updateUser($name, $email, $password, $adresse, $typeUser, $id);

    // Rediriger vers la page de gestion après la mise à jour
    header('Location: gestion.php?message=Utilisateur mis à jour avec succès');
    exit;
}

// Si l'ID n'est pas fourni ou est invalide
if (!$id) {
    header('Location: gestion.php?message=ID utilisateur invalide');
    exit;
}

// Récupérer les données de l'utilisateur à modifier
$user = $userc->getUserById($id);

// Si l'utilisateur n'existe pas
if (!$user) {
    header('Location: gestion.php?message=Utilisateur non trouvé');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
</head>
<body>
    <h1>Modifier un utilisateur</h1>
    <form action="update.php?id=<?= htmlspecialchars($user['id']); ?>" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">

        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']); ?>" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" placeholder="Laissez vide si vous ne voulez pas changer le mot de passe">

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']); ?>" required>

        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" value="<?= htmlspecialchars($user['adresse']); ?>" required>

        <label for="typeUser">Rôle :</label>
        <input type="text" name="typeUser" id="typeUser" value="<?= htmlspecialchars($user['typeUser']); ?>" required>

        <button type="submit">Modifier</button>
    </form>

    <a href="gestion.php">Retour</a>
</body>
</html>
