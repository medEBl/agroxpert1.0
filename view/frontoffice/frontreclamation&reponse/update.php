<?php
// Inclure le contrôleur pour récupérer et mettre à jour les réclamations
include '../../../controller/reclamationcontroller.php';

// Créer une instance du contrôleur
$reclamationController = new ReclamationController();

// Vérifier si un ID de réclamation est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de la réclamation
    $reclamation = $reclamationController->getReclamationById($id);

    // Vérifier si la réclamation existe
    if (!$reclamation) {
        echo "Réclamation non trouvée.";
        exit;
    }
} else {
    echo "ID de réclamation manquant.";
    exit;
}

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $datereclamation = $_POST['datereclamation'];
    $description = $_POST['description'];
    $statut = $_POST['statut'];
    $id_user = (int)$_POST['id_user'];
    $tel = (int)$_POST['tel'];
    $adresse = $_POST['adresse'];

    // Créer un objet Reclamation avec les nouvelles données
    $updatedReclamation = new Reclamation(
        null,
        new DateTime($datereclamation), // Date de la réclamation
        $description,
        $statut,
        $id_user,
        $tel,
        $adresse
    );

    // Mettre à jour la réclamation dans la base de données
    $reclamationController->updateReclamation($updatedReclamation, $id);

    // Redirection après la mise à jour
    header("Location: list_reclamations.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Réclamation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Modifier la Réclamation</h1>
    
    <!-- Formulaire de modification -->
    <form action="update.php?id=<?php echo $reclamation['id']; ?>" method="POST" id="reclamationForm">

        <!-- Date de réclamation -->
        <label for="datereclamation">Date de réclamation :</label>
        <input type="date" name="datereclamation" id="datereclamation" value="<?php echo htmlspecialchars($reclamation['datereclamation']); ?>">
        <span id="dateReclamationError" class="error-message"></span>

        <!-- Description -->
        <label for="description">Description :</label>
        <textarea name="description" id="description" rows="4"><?php echo htmlspecialchars($reclamation['description']); ?></textarea>
        <span id="descriptionError" class="error-message"></span>

        <!-- Statut -->
        <label for="statut">Statut :</label>
        <input type="text" name="statut" id="statut" value="<?php echo htmlspecialchars($reclamation['statut']); ?>">
        <span id="statutError" class="error-message"></span>

        <!-- ID utilisateur -->
        <label for="id_user">ID utilisateur :</label>
        <input type="number" name="id_user" id="id_user" value="<?php echo htmlspecialchars($reclamation['id_user']); ?>">
        <span id="idUserError" class="error-message"></span>

        <!-- Téléphone -->
        <label for="tel">Téléphone :</label>
        <input type="number" name="tel" id="tel" value="<?php echo htmlspecialchars($reclamation['tel']); ?>">
        <span id="telError" class="error-message"></span>

        <!-- Adresse -->
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" value="<?php echo htmlspecialchars($reclamation['adresse']); ?>">
        <span id="adresseError" class="error-message"></span>

        <button type="submit">Mettre à jour la réclamation</button>
    </form>
</div>

</body>
</html>
