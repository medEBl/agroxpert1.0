<?php 
include '../../../controller/produitController.php';

$error = "";
$productController = new ProduitController();

if (
    isset($_POST["name"], $_POST["price"], $_POST["description"], $_POST["category"], $_POST["stock_quantity"], $_POST["rating"], $_POST["discount"])
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
        $product = new Produit(
            null,
            $_POST["name"],
            floatval($_POST["price"]),
            $_POST["description"],
            $_POST["category"],
            intval($_POST["stock_quantity"]),
            floatval($_POST["rating"]),
            floatval($_POST["discount"])
        );

        $productController->addProduit($product);
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
    <title>Add Product - Product Management</title>
    <link rel="stylesheet" href="b.css">
</head>
<body>
    <header>
        <h1>Product Management</h1>
    </header>

    <main>
        <div class="form-container">
            <h2>Add a Product</h2>
            <form action="" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter product name" required>

                <label for="price">Price ($):</label>
                <input type="number" id="price" name="price" step="0.01" placeholder="Enter product price" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" placeholder="Enter product description" required></textarea>

                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Fruits">Fruits</option>
                    <option value="Vegetables">Vegetables</option>
                    <option value="Grains">Grains</option>
                </select>

                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" id="stock_quantity" name="stock_quantity" min="0" placeholder="Enter stock quantity" required>

                <label for="rating">Rating (0 to 5):</label>
                <input type="number" id="rating" name="rating" step="0.1" min="0" max="5" placeholder="Enter rating" required>

                <label for="discount">Discount (%):</label>
                <input type="number" id="discount" name="discount" step="0.01" min="0" max="100" placeholder="Enter discount percentage" required>

                <button type="submit">Add Product</button>
            </form>
            <?php if (!empty($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
        <div>
            <a href="productList.php" class="back-to-list-link">Back to Product List</a>
        </div>
    </main>
</body>
</html>
