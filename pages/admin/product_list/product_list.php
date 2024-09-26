<?php
require_once '../../../models/product_model.php';
require_once 'C:/xampp/htdocs/onboarding-project/configs/db.php';


$productModel = new productModel();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    try {
        $productModel->deleteProductById($product_id);
        $successMessage = "Product deleted successfully.";
    } catch (Exception $e) {
        $errorMessage = "Error deleting product: " . $e->getMessage();
    }
}

// Fetch product details
try {
    $products = $productModel->fetchProductDetails();
} catch (Exception $e) {
    echo "Error fetching products: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_product_list.css">
    <title>Admin Panel</title>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>

<body>
    <header>
        <div class="logo">
            <a href="../admin.php">MyShop</a>
        </div>
        <div class="header-title">
            <h1>Admin Dashboard</h1>
        </div>
    </header>

    <main>
        <section class="menu-bar">
            <div class="menu">
                <div class="menu-list">
                    <ul>
                        <li><a href="product_list.php">Product List</a></li>
                        <li><a href="../add_product/add_product.php">Add Product</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="product-list">
            <div class="admin-dashboard">
                <?php if (isset($message)) : ?>
                    <p><?php echo htmlspecialchars($message); ?></p>
                <?php endif; ?>

                <table class="product-table">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>IMG</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Categories</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)) : ?>
                            <?php foreach ($products as $index => $product) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td>
                                        <img src="/onboarding-project/pages/admin/add_product/photo/<?php echo htmlspecialchars($product['front_image']); ?>" alt="Product Image" width="50" height="50">
                                    </td>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td><?php echo "$" . number_format($product['price'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($product['category']); ?></td>
                                    <td class="actionBtn">
                                        <a href="../../../pages/admin/add_product/update_product.php?editAction=edit&id=<?php echo htmlspecialchars($product['id']); ?>" id="editBtn">Edit</a>  
                                        <a href="product_list.php?action=delete&id=<?php echo htmlspecialchars($product['id']); ?>" id="deleteBtn">Delete</a>       
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">No products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <?php if (isset($successMessage)): ?>
    <script>
        showAlert("<?php echo addslashes($successMessage); ?>");
    </script>
    <?php endif; ?>

    <?php if (isset($errorMessage)): ?>
    <script>
        showAlert("<?php echo addslashes($errorMessage); ?>");
    </script>
    <?php endif; ?>
</body>

</html>
