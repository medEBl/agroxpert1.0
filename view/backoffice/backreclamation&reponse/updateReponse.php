<?php
session_start();
include '../../../Controller/reponseController.php';
require_once '../../../controller/userc.php';
$error = "";
$reponseController = new ReponseController();
if (!empty($_SESSION['id'])){
    $id =  $_SESSION['id'];} 
$reponse = null;

// Vérification de l'existence de l'ID de la réponse et récupération des données
if (isset($_GET["id_reponse"]) && is_numeric($_GET["id_reponse"])) {
    $idReponse = (int)$_GET["id_reponse"];
    $reponse = $reponseController->showReponse($idReponse);
    if (!$reponse) {
        echo "<p style='color:red;'>Réponse introuvable.</p>";
        exit;
    }
} else {
    echo "<p style='color:red;'>ID de réponse manquant ou invalide.</p>";
    exit;
}

// Gestion de la soumission du formulaire
if (
    isset($_POST["id"]) &&
    isset($_POST["reponse"]) &&
    isset($_POST["date_reponse"])
) {
    if (
        !empty($_POST["id"]) &&
        !empty($_POST["reponse"]) &&
        !empty($_POST["date_reponse"])
    ) {
        // Création de l'objet Reponse mis à jour
        $updatedReponse = new Reponse(
            $reponse['id_reponse'], // ID de la réponse
            $_POST["id"],           // Clé étrangère (par exemple, ID de réclamation)
            $_POST["reponse"],      // Contenu de la réponse
            new DateTime($_POST["date_reponse"]) // Date de la réponse
        );

        // Mise à jour via le contrôleur
        $reponseController->updateReponse($updatedReponse, $reponse['id_reponse']);

        // Redirection après mise à jour
        header('Location: list_reponse.php');
        exit();
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour la réponse</title>
</head>
<body>
    <h1>Mettre à jour la réponse</h1>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="POST">
        <label for="id">ID Réclamation :</label>
        <input type="number" id="id" name="id" value="<?php echo htmlspecialchars($reponse['id']); ?>" required><br>

        <label for="reponse">Réponse :</label>
        <textarea id="reponse" name="reponse" required><?php echo htmlspecialchars($reponse['reponse']); ?></textarea><br>

        <label for="date_reponse">Date :</label>
        <input type="date" id="date_reponse" name="date_reponse" value="<?php echo htmlspecialchars($reponse['date_reponse']); ?>" required><br>

        <button type="submit">Mettre à jour</button>
    </form>
    <a href="list_reponse.php">Retour</a>
    <script src="scriptback.js"></script>
    <style>/* General styling for the body */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

/* Container for the form */
.update-container {
    max-width: 600px;
    margin: 50px auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Form title */
.form-title {
    font-size: 1.8em;
    color: #333;
    margin-bottom: 20px;
}

/* Error messages */
.error {
    color: #ff4d4d;
    background-color: #ffe6e6;
    padding: 10px;
    border: 1px solid #ffcccc;
    border-radius: 5px;
    margin-bottom: 15px;
}

/* Form group styling */
.form-group {
    margin-bottom: 15px;
    text-align: left;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input, textarea {
    width: 100%;
    padding: 10px;
    font-size: 1em;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
}

textarea {
    height: 80px;
    resize: none;
}

/* Button styling */
.btn-update {
    display: block;
    width: 100%;
    background-color: #4CAF50; /* Green */
    color: white;
    padding: 12px;
    border: none;
    border-radius: 5px;
    font-size: 1.1em;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.btn-update:hover {
    background-color: #45a049;
    transform: scale(1.05);
}

.btn-update:active {
    transform: scale(0.98);
    background-color: #3e8e41;
}

/* Back button */
.btn-back {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 15px;
    background-color: #f0f0f0;
    color: #555;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-back:hover {
    background-color: #ddd;
}

/* Responsive design */
@media (max-width: 600px) {
    .update-container {
        padding: 15px;
    }

    .btn-update, .btn-back {
        font-size: 1em;
        padding: 10px;
    }
}
</style>
<script src="scriptback.js"></script>
</body>
</html>
