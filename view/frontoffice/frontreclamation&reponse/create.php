<?php


// Inclure le contrôleur
include '../../../controller/reclamationcontroller.php';
// include '../../model/reclamation.php';
require_once '../../../vendor/autoload.php'; // Inclure l'autoloader de Composer pour PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$error = "";

// Créer une instance du contrôleur
$reclamationController = new ReclamationController();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["datereclamation"], $_POST["description"], $_POST["statut"],
        $_POST["id_user"], $_POST["tel"], $_POST["adresse"])
    ) {
        if (
            !empty($_POST["datereclamation"]) && !empty($_POST["description"]) &&
            !empty($_POST["statut"]) && !empty($_POST["id_user"]) &&
            !empty($_POST["tel"]) && !empty($_POST["adresse"])
        ) {
            // Récupérer les données
            $email = $_POST['adresse']; // Adresse email de l'utilisateur

            // Valider l'adresse email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Adresse email invalide.";
            } else {
                try {
                    // Créer un objet Reclamation
                    $reclamation = new Reclamation(
                        null, // ID est généré automatiquement par la base de données
                        new DateTime($_POST['datereclamation']), // Convertir la date en objet DateTime
                        $_POST['description'],
                        $_POST['statut'],
                        (int)$_POST['id_user'], // Convertir en entier
                        (int)$_POST['tel'],
                        $email
                    );

                    // Ajouter la réclamation via le contrôleur
                    $reclamationController->addReclamation($reclamation);

                    // Envoyer l'email de confirmation
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'agroxpert.web@gmail.com'; // Remplacez par votre email
                    $mail->Password = 'yljclmobtaajnudo'; // Mot de passe d'application Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;

                    $mail->setFrom('agroxpert.web@gmail.com', 'Service Reclamation');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Confirmation de votre réclamation';
                    $mail->Body = "
                        <div style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>
                            <h2 style='text-align: center;'>Réclamation enregistrée</h2>
                            <p>Bonjour,</p>
                            <p>Nous avons bien reçu votre réclamation. Voici les détails :</p>
                            <ul>
                                <li><strong>Date :</strong> {$_POST['datereclamation']}</li>
                                <li><strong>Description :</strong> {$_POST['description']}</li>
                            </ul>
                            <p>Nous traiterons votre réclamation dans les plus brefs délais.</p>
                            <p>Cordialement,</p>
                            <p>L'équipe de support.</p>
                        </div>
                    ";

                    $mail->send();
                    echo "Email de confirmation envoyé à $email.";

                    // Redirection après succès
                    header("Location: list_reclamations.php");
                    exit;
                } catch (Exception $e) {
                    $error = "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
                }
            }
        } else {
            $error = "Veuillez remplir tous les champs.";
        }
    } else {
        $error = "Données manquantes.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soumettre une Réclamation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Soumettre une Réclamation</h1>
        <form method="POST" action="" id="reclamationForm">
            <div class="form-group">
                <label for="datereclamation">Date de Réclamation :</label>
                <input type="date" id="datereclamation" name="datereclamation" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="statut">Statut :</label>
                <select id="statut" name="statut" required>
                    <option value="non_traite">Non traité</option>
                    <option value="en_cours">En cours</option>
                    <option value="traite">Traité</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id_user">ID Utilisateur :</label>
                <input type="number" id="id_user" name="id_user" required>
            </div>
            <div class="form-group">
                <label for="tel">Téléphone :</label>
                <input type="tel" id="tel" name="tel" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse Email :</label>
                <input type="email" id="adresse" name="adresse" required>
            </div>
            <button type="submit" class="btn-submit">Soumettre</button>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>
    </div>
    
</body>
</html>
