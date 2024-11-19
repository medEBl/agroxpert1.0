<?php

require_once(__DIR__ . '/../../../controller/forumcontroller.php');

$error = "";
$post = null;

// Create an instance of the controller
$postController = new ForumpostController();

if (
    isset($_POST["titrePost"]) && isset($_POST["contenuPost"]) && isset($_POST["createDateP"]) && isset($_POST["Id_User"])
) {
    if (
        !empty($_POST["titrePost"]) && !empty($_POST["contenuPost"]) && !empty($_POST["createDateP"]) && !empty($_POST["Id_User"])
    ) {
        $post = new ForumPost(
            null,
            $_POST['titrePost'],
            $_POST['contenuPost'],
            new DateTime($_POST['createDateP']),
            $_POST['Id_User'] // Assuming Id_User is coming from POST and corresponds to your foreign key.
        );
        
        $postController->addpost($post);
        header('Location:retrievepost.php'); // Redirect to the post list page
    } else {
        $error = "Missing information";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Post - BackOffice</title>
    <link rel="stylesheet" href="backi.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>DASHBOARD</h2>
            <nav>
                <ul>
                    <li><a href="#">Gestion de Compte</a></li>
                    <li><a href="#">Gestion de Market</a></li>
                    <li><a href="#">Gestion de Blog</a></li>
                    <li><a href="#">Gestion de Météo</a></li>
                    <li><a href="#">Gestion de Forum</a></li>
                    <li><a href="#">Gestion de Feedback</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenu principal -->
        <div class="main-content">
            <header>
                <h1>BackOffice - Gestion des Forums</h1>
            </header>

            <main>
                <form id="forumForm" method="POST" action="">
                    <h2>Ajouter un Post</h2>

                    <label for="titrePost">Titre :</label>
                    <input type="text" id="titrePost" name="titrePost" placeholder="Titre du post" required>

                    <label for="contenuPost">Contenu :</label>
                    <textarea id="contenuPost" name="contenuPost" rows="5" placeholder="Contenu du post" required></textarea>

                    <label for="createDateP">Date de création :</label>
                    <input type="date" id="createDateP" name="createDateP" required>

                    <label for="Id_User">ID Utilisateur :</label>
                    <input type="number" id="Id_User" name="Id_User" placeholder="ID de l'utilisateur" required>

                    <button type="submit">Enregistrer</button>
                </form>

                <?php if (!empty($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </main>
        </div>
    </div>
</body>

</html>
