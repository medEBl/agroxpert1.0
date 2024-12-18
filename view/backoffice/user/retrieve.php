<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../model/modelUser.php';
$users = getUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($users)): ?>
    <?php foreach ($users as $user): ?>
        <tr>
             <td><?= htmlspecialchars($user['id']); ?></td>
            <td><?= htmlspecialchars($user['name']); ?></td>
            <td><?= htmlspecialchars($user['email']); ?></td>
            <td><?= htmlspecialchars($user['adresse']); ?></td>
            <td><?= htmlspecialchars($user['typeUser']); ?></td>
            <td>
                <a href="delete.php?id=<?= $user['id']; ?>" class="btn-delete">Delete</a>
                <a href="update.php?id=<?= $user['id']; ?>" class="btn-edit">Update</a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4">No users found.</td>
    </tr>
<?php endif; ?>

        </tbody>
    </table>
    <a href="../Front Office/FU/create.php">Ajouter un utilisateur</a>
</body>
</html>