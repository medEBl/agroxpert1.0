<?php
include '../../../controller/produitController.php';

$productController = new ProduitController();
$list = $productController->listProduits();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        /* Général */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #004d40;
            color: #fff;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #b2dfdb;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar nav ul li a {
            text-decoration: none;
            color: #e0f2f1;
            font-size: 18px;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
        }

        .sidebar nav ul li a:hover {
            background: #26a69a;
            transform: translateX(10px);
        }

        main {
            flex: 1;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            margin-left: 20px;
        }

        header {
            background-color: #2e7d32;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
        }

        .form-container {
            margin-bottom: 30px;
        }

        .btn-add-product {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .btn-add-product:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #539f57;
            color: #fff;
        }

        .edit-btn, .delete-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #3498db;
        }

        .delete-btn {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Mon Dashboard</h2>
            <nav>
                <ul>
                    <li><a href="#user-management">Gestion des Utilisateurs</a></li>
                    <li><a href="#alerts">Alertes</a></li>
                    <li><a href="#forum">Forum</a></li>
                    <li><a href="#blog">Blog</a></li>
                    <li><a href="#feedback">Feedback</a></li>
                    <li><a href="#marketplace">Marketplace</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <header>
                <h1>Product Management</h1>
            </header>
            <div class="form-container">
                <a href="addProduct.php" class="btn-add-product">Add Product</a>
            </div>
            <div>
                <h2>Product List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Rating</th>
                            <th>Discount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $product): ?>
                            <tr>
                                <td><?php echo $product["id_produit"]; ?></td>
                                <td><?php echo $product["nom"]; ?></td>
                                <td><?php echo $product["prix"]; ?></td>
                                <td><?php echo $product["description"]; ?></td>
                                <td><?php echo $product["category"]; ?></td>
                                <td><?php echo $product["stock_quantity"]; ?></td>
                                <td><?php echo $product["rating"]; ?></td>
                                <td><?php echo $product["discount"]; ?>%</td>
                                <td>
                                    <form action="updateProduct.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $product["id_produit"]; ?>">
                                        <button type="submit" class="edit-btn">Edit</button>
                                    </form>
                                    <a href="deleteProduct.php?id=<?php echo $product["id_produit"]; ?>" class="delete-btn">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
