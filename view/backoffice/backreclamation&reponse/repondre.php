<?php
session_start();
include '../../../controller/reponsecontroller.php';
require_once '../../../controller/userc.php';
$error = "";

// Créer une instance du contrôleur
$reponseController = new ReponseController();
if (!empty($_SESSION['id'])){
    $id =  $_SESSION['id'];} 
// Vérifier si l'ID de réclamation est présent dans l'URL
if (isset($_GET['id'])) {
    $id_reclamation = $_GET['id']; // Récupérer l'ID de réclamation
} else {
    // Si l'ID est manquant, rediriger ou afficher une erreur
    $error = "ID de réclamation manquant.";
    echo $error;
    exit; // Arrêter l'exécution du script si l'ID est manquant
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && !$error) {
    // Vérifier si les champs requis sont présents
    if (isset($_POST["id"]) && isset($_POST["reponse"]) && isset($_POST["date_reponse"])) {
        // Vérifier si les champs sont non vides
        if (!empty($_POST["id"]) && !empty($_POST["reponse"]) && !empty($_POST["date_reponse"])) {
            // Validation et conversion de l'ID de réclamation
            $idReclamation = $_POST['id'];

            // Vérification que l'ID est un entier
            if (!filter_var($idReclamation, FILTER_VALIDATE_INT)) {
                $error = "L'ID de réclamation n'est pas valide. Veuillez vérifier l'ID.";
            }

            // Si aucune erreur, valider et convertir la date de réponse
            if (!$error) {
                $dateString = $_POST['date_reponse']; // Format attendu : YYYY-MM-DD

                try {
                    // Créer un objet DateTime directement à partir de la chaîne
                    $dateReponse = new DateTime($dateString);
                } catch (Exception $e) {
                    $error = "Erreur lors de la création de la date : " . $e->getMessage();
                }

                // Si aucune erreur, procéder à la création de la réponse
                if (!$error) {
                    // Convertir l'ID de réclamation en entier
                    $idReclamation = intval($idReclamation);

                    // Créer un objet Reponse avec l'ID converti en entier
                    $reponse = new Reponse(
                        null,               // ID de la réponse (null car c'est une nouvelle réponse)
                        $idReclamation,     // ID de la réclamation
                        $_POST['reponse'],  // Texte de la réponse
                        $dateReponse        // DateTime de la réponse
                    );

                    // Appeler la méthode addReponse avec les trois paramètres nécessaires
                    $reponseController->addReponse($reponse);

                    // Rediriger vers la liste des réponses après ajout
                    header("Location: admin.php");
                    exit; // Assurez-vous d'utiliser exit() pour arrêter l'exécution après la redirection
                }
            }
        } else {
            $error = "Veuillez remplir tous les champs.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répondre à la Réclamation</title>
</head>
<body>

    <!-- Section de réponse à la réclamation -->
    <div class="response-section">
        <h2 class="page-title">Réponse à la réclamation</h2>
        <form id="formReponse" method="POST" action="">
            <label for="id_reclamation">ID de Réclamation</label>
            <input type="number" name="id" id="id_reclamation" value="<?= $id_reclamation ?>" readonly />

            <label for="reponse">Votre Réponse</label>
            <textarea name="reponse" id="reponse" required></textarea>

            <label for="date_reponse">Date de la Réponse</label>
            <input type="date" name="date_reponse" id="date_reponse" required />

            <?php if ($error): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

            <button type="submit">Envoyer la réponse</button>
        </form>
    </div>
    <script src="scriptback.js"></script>
    <style>body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

.response-section {
    width: 50%;
    margin: 50px auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.page-title {
    text-align: center;
    color: #333;
    font-size: 1.5em;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

input, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
}

textarea {
    height: 100px;
    resize: none;
}

.btn-submit {
    display: block;
    width: 100%;
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    padding: 12px 20px; /* Padding for a larger button */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    font-size: 1.1em; /* Slightly larger font */
    font-weight: bold; /* Bold text */
    text-align: center; /* Center the text */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s, transform 0.2s; /* Smooth hover effect */
}

/* Change background color and add subtle scaling on hover */
.btn-submit:hover {
    background-color: #45a049; /* Darker green */
    transform: scale(1.05); /* Slightly enlarge the button */
}

/* Add a subtle press effect when the button is clicked */
.btn-submit:active {
    transform: scale(0.98); /* Slightly shrink the button */
    background-color: #3e8e41; /* Even darker green */
}


.error {
    color: #ff6b6b;
    background: #ffe5e5;
    padding: 10px;
    border: 1px solid #ffcccc;
    border-radius: 5px;
    margin-top: 10px;
    text-align
}
</style>
<script src="scriptback.js"></script>
</body>
</html>
