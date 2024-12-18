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
    /* Polices et reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff;
        color: #333;
    }

    /* Conteneur principal */
    .container {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
        width: 250px;
        background-color: #004d40;
        color: #fff;
        padding: 20px;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
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
    }

    .sidebar nav ul li {
        margin-bottom: 15px;
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

    /* Contenu principal */
    main {
        flex: 1;
        padding: 30px;
        background: #ffffff;
      
        
        overflow-y: auto;
        margin-left: 20px;
    }

    /* Header */
    header h1 {
        font-size: 28px;
        color: #004d40;
        text-align: center;
        margin-bottom: 20px;
        text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Form button styling */
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

    /* Table styling */
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

    /* Table action buttons */
    .edit-btn:hover {
        background-color: #1e88e5;
    }

    .delete-btn:hover {
        background-color: #e53935;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
        }

        main {
            margin-left: 10px;
            padding: 15px;
        }

        .sidebar h2 {
            font-size: 20px;
        }

        .sidebar nav ul li a {
            font-size: 16px;
        }

        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        table th, table td {
            text-align: center;
        }

        .edit-btn, .delete-btn {
            padding: 5px;
            font-size: 14px;
        }
   
   
</style>

</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <nav>
                <ul>
                <li><a href="../user/gestion.php">Gestion de Compte</a></li>
                    <li><a href="productList.php">Gestion de Market</a></li>
                    <li><a href="../mimi/bloglist.php">Gestion de Blog</a></li>
                    <li><a href="../back office/zonelist.php">Gestion de Météo</a></li>
                    <li><a href="../forumb/retrievepost.php">Gestion de Forum</a></li>
                    <li><a href="../backreclamation&reponse/admin.php">Gestion de Feedback</a></li>
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
