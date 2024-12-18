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
                    header("Location: list_reclamations.php");
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

            <button type="submit" class="btn-submit">Envoyer la réponse</button>

        </form>
    </div>
    <script src="scriptback.js"></script>
    <style>
body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .response-section {
            width: 60%;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease;
        }

        .page-title {
            text-align: center;
            color: #4CAF50;
            font-size: 2em;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            font-size: 1.1em;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 1.1em;
            color: #333;
            background-color: #f8f8f8;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.6);
            outline: none;
        }

        textarea {
            height: 150px;
            resize: none;
        }

        .btn-submit {
    width: 100%;
    background-color: #007bff; /* Bleu de fond */
    color: white; /* Texte blanc */
    padding: 14px 20px; /* Espacement interne */
    border: none; /* Pas de bordure */
    border-radius: 8px; /* Coins arrondis */
    font-size: 1.2em; /* Taille de police */
    font-weight: bold; /* Texte en gras */
    cursor: pointer; /* Curseur en forme de main */
    text-align: center; /* Centre le texte */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre douce */
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; /* Transition fluide */
}

/* Au survol : changement de couleur et ombre plus marquée */
.btn-submit:hover {
    background-color: #0056b3; /* Bleu plus foncé */
    transform: scale(1.05); /* Agrandissement du bouton au survol */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Ombre plus marquée */
}

/* Lors du clic : fond encore plus foncé et rétrécissement du bouton */
.btn-submit:active {
    background-color: #004085; /* Bleu encore plus foncé */
    transform: scale(0.98); /* Réduction du bouton au clic */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Ombre plus discrète lors du clic */
}



        .error {
            color: #ff6b6b;
            background: #ffe5e5;
            padding: 12px;
            border: 1px solid #ffcccc;
            border-radius: 5px;
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
    
</body>
</html>
