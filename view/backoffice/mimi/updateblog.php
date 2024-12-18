<?php
include(__DIR__ . '/../../../controller/blogcontroller.php');
include(__DIR__ . '/../../../model/Blog.php'); // Assurez-vous que le chemin est correct

$blogController = new BlogController();
$blog = null;
$error = "";

if (isset($_GET['id'])) {
    $blog = $blogController->getBlogById((int)$_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {
        // Si une nouvelle image est téléchargée
        $imagePath = $blog['image'];  // Garder l'image existante par défaut
        if (!empty($_FILES['image']['name'])) {
            $imagePath = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        }

        // Création de l'objet Blog mis à jour
        $blogUpdated = new Blog(
            (int)$_POST['id_blog'],
            $imagePath,
            htmlspecialchars($_POST['titre']),
            htmlspecialchars($_POST['contenu']),
            date('Y-m-d H:i:s')
        );

        // Mise à jour du blog
        $blogController->updateBlog($blogUpdated);

        // Rediriger vers la liste des articles
        header('Location: blogList.php');
        exit;
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Article</title>
    <link rel="stylesheet" href="bac.css"> <!-- Assurez-vous d'avoir un fichier CSS approprié -->
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
        <h2>Modifier l'Article</h2>
        
        <!-- Affichage du formulaire de mise à jour -->
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_blog" value="<?= $blog['id_blog'] ?>">

            <!-- Champ pour l'image -->
            <label for="image">Image :</label>
            <input type="file" name="image" id="image">
            <p><strong>Image actuelle:</strong></p>
            <img src="<?= $blog['image'] ?>" alt="Image actuelle" width="150" height="auto">

            <!-- Champ pour le titre -->
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($blog['titre']) ?>" required>

            <!-- Champ pour le contenu -->
            <label for="contenu">Contenu :</label>
            <textarea name="contenu" id="contenu" rows="5" required><?= htmlspecialchars($blog['contenu']) ?></textarea>

            <!-- Affichage des erreurs -->
            <p style="color: red;"><?= $error ?></p>

            <!-- Bouton de soumission -->
            <button type="submit">Mettre à jour</button>
        </form>

        <a href="blogList.php">Retour à la liste des articles</a>
    </div>
</body>
</html>
