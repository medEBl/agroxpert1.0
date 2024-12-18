<?php
include(__DIR__ . '/../../../controller/userc.php');
$userc = new userc();

$search = isset($_POST['search']) ? $_POST['search'] : '';
$typeUser = isset($_POST['typeUser']) ? $_POST['typeUser'] : '';

$users = $userc->listUser($search, ['typeUser' => $typeUser]);

if (!empty($users)) {
    foreach ($users as $user) {
        echo "<tr>
            <td>" . htmlspecialchars($user['id']) . "</td>
            <td>" . htmlspecialchars($user['name']) . "</td>
            <td>" . htmlspecialchars($user['email']) . "</td>
            <td>" . htmlspecialchars($user['adresse']) . "</td>
            <td>" . htmlspecialchars($user['typeUser']) . "</td>
            <td>
                <a href='delete.php?id=" . $user['id'] . "' class='btn-delete'>Supprimer</a>
                <a href='update.php?id=" . $user['id'] . "' class='btn-edit'>Modifier</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucun utilisateur trouvé.</td></tr>";
}
?>
