<?php
include '../../../controller/produitController.php';

$error = "";
$productController = new ProduitController();
$product = null;

// Vérifier si un ID est passé pour récupérer le produit
if (isset($_POST["id"])) {
    $product = $productController->showProduit($_POST["id"]);
    if (!$product) {
        $error = "Product not found.";
    }
}

// Vérifier si le formulaire est soumis pour mettre à jour le produit
if (
    isset($_POST["name"]) &&
    isset($_POST["price"]) &&
    isset($_POST["description"]) &&
    isset($_POST["category"]) &&
    isset($_POST["stock_quantity"]) &&
    isset($_POST["rating"]) &&
    isset($_POST["discount"])
) {
    if (
        !empty($_POST["name"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["category"]) &&
        is_numeric($_POST["stock_quantity"]) &&
        is_numeric($_POST["rating"]) &&
        is_numeric($_POST["discount"])
    ) {
        // Créer un objet Produit avec les nouvelles données
        $updatedProduct = new Produit(
            $_POST["id"],
            $_POST["name"],
            floatval($_POST["price"]),
            $_POST["description"],
            $_POST["category"],
            intval($_POST["stock_quantity"]),
            floatval($_POST["rating"]),
            floatval($_POST["discount"])
        );

        $productController->updateProduit($updatedProduct, $_POST["id"]);
        header('Location: productList.php');
        exit();
    } else {
        $error = "Missing or invalid information. Please fill all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
    /* Général */
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    .form-container {
        max-width: 600px;
        margin: 40px auto;
        background-color: #f0f4f8; /* Bleu-gris clair */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        text-align: center;
        color: #2e7d32;
    }

    h2 {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    input, select, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
        height: 100px;
    }

    button {
        width: 100%;
        background-color: #2e7d32;
        color: #fff;
        border: none;
        padding: 10px 15px;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #1b5e20;
    }

    .back-to-list-link {
        display: inline-block;
        margin-top: 20px;
        text-align: center;
        color: #3498db;
        text-decoration: none;
        font-weight: bold;
        font-size: 1rem;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        display: block;
    }

    .back-to-list-link:hover {
        color: #1d73c1;
    }

    .error-message {
        color: red;
        font-size: 0.9rem;
        margin-top: -10px;
        margin-bottom: 15px;
    }
</style>

</head>
<body>
    <div class="form-container">
        <h2>Update Product</h2>
        <?php if ($product): ?>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product["id_produit"]); ?>">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product["nom"]); ?>" required>

                <label for="price">Price ($):</label>
                <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product["prix"]); ?>" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($product["description"]); ?></textarea>

                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="A" <?php if ($product["category"] == "A") echo "selected"; ?>>Category A</option>
                    <option value="B" <?php if ($product["category"] == "B") echo "selected"; ?>>Category B</option>
                </select>

                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo htmlspecialchars($product["stock_quantity"]); ?>" required>

                <label for="rating">Rating:</label>
                <input type="number" step="0.1" id="rating" name="rating" value="<?php echo htmlspecialchars($product["rating"]); ?>" required>

                <label for="discount">Discount (%):</label>
                <input type="number" step="0.1" id="discount" name="discount" value="<?php echo htmlspecialchars($product["discount"]); ?>" required>

                <button type="submit">Update Product</button>
            </form>
        <?php else: ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <a href="productList.php" class="back-to-list-link">Back to Product List</a>
    </div>
</body>
</html>
