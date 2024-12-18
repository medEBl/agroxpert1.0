<?php
session_start();

$message = '';
$error = '';
$success = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../../controller/userc.php';
    $controller = new userc();

    // Trim and sanitize inputs
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Call the loginUser method
    $response = $controller->loginUser($email, $password);

    if ($response['success']) {
        // Redirect on success
        header('Location: ../home/index.php');
        exit;
    } else {
        header('Location: ../../backoffice/user/gestion.php');
        // Display error message
       
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion / Inscription</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cont">
        <!-- Formulaire de connexion -->
        <div class="form sign-in">
            <h2>Bienvenue de retour,</h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="login">
                <label>
                    <span>Email</span>
                    <input type="email" name="email" required />
                </label>
                <label>
                    <span>Mot de passe</span>
                    <input type="password" name="password" required />
                </label>
             
                    <a href="forget_password.php">Forgot your password?</a>
               
                <button type="submit" class="submit">Se connecter</button>
            </form>
        </div>

        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h2>Nouveau ici ?</h2>
                    <p>Inscrivez-vous et découvrez une multitude de nouvelles opportunités !</p>
                </div>
                <div class="img__text m--in">
                    <h2>Un de nous ?</h2>
                    <p>Si vous avez déjà un compte, connectez-vous. Vous nous avez manqué !</p>
                </div>
                <div class="img__btn">
                    <span class="m--up">S'inscrire</span>
                    <span class="m--in">Se connecter</span>
                </div>
            </div>

            <!-- Formulaire d'inscription -->
            <div class="login">
                <form action="create.php" method="POST">
                    <input type="hidden" name="action" value="register">
                    <h1>S'inscrire</h1>
                    <div class="input">
                        <input type="text" name="name" placeholder="Nom" required>
                    </div>
                    <div class="input">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input">
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div class="input">
                        <input type="text" name="adresse" placeholder="Adresse" required>
                    </div>
                    <div class="input">
                        <label for="typeUser">Êtes-vous acheteur ou vendeur ?</label>
                        <select id="typeUser" name="typeUser">
                            <option value="Acheteur">Acheteur</option>
                            <option value="Vendeur">Vendeur</option>
                        </select>
                    </div>
                    <?php if ($error && isset($_POST['action']) && $_POST['action'] === 'register'): ?>
                        <p class="error"><?= htmlspecialchars($error); ?></p>
                    <?php elseif ($success): ?>
                        <p class="success"><?= htmlspecialchars($success); ?></p>
                    <?php endif; ?>
                    <button type="submit" class="btn">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <?php if ($message): ?>
        <div id="loginModal" class="modal" style="display: flex;">
            <div class="modal-content">
                <p><?php echo htmlspecialchars($message); ?></p>
                <button onclick="closeModal()">Close</button>
            </div>
        </div>
    <?php endif; ?>

    <script>
        document.querySelector('.img__btn').addEventListener('click', function () {
            document.querySelector('.cont').classList.toggle('s--signup');
        });
    </script>
</body>
</html>
