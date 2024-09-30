<?php
require_once 'C:/xampp/htdocs/onboarding-project/configs/db.php';
require_once '../../models/product_model.php';


if (!isset($_GET['product_id'])) {
    echo "Product ID is missing.";
    exit();
}

$product_id = $_GET['product_id'];

try {

    
    $productModel = new productModel();

    $product = $productModel->fetchProductById($product_id);

    if (!$product) {
        echo "Product not found.";
        exit();
    }

} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_product_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Product Details</title>
</head>

<body>
    <?php include 'C:\xampp\htdocs\onboarding-project\header.php'; ?>
    <hr>
    <main>
        <section>
            <div class="product-container">
                <div class="product-image-section">
                    <div class="product-image">
                        <img src="/onboarding-project/pages/admin/add_product/photo/<?= htmlspecialchars($product['front_image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="product-image">
                    </div>
                    <div class="product-thumbnails">
                    </div>
                </div>

                <div class="product-details">
                    <div class="product-name">
                        <h2><?= htmlspecialchars($product['name']); ?></h2>
                    </div>
                    <div class="product-categories">
                        <p><?= htmlspecialchars($product['category']); ?></p>
                    </div>
                    <div class="product-code">
                        <p>Product Code: <?= htmlspecialchars($product['proCode']); ?></p>
                    </div>
                    <div class="product-price">
                        <p>Price: $<?= htmlspecialchars($product['price']); ?></p>
                    </div>
                    <div class="product-actions">
                        <button type="button">Buy Now</button>
                        <button type="button">Add to Cart</button>
                    </div>
                </div>
            </div>

            <div class="description-section">
                <h3>Description</h3>
                <p><?= nl2br(htmlspecialchars($product['description'])); ?></p>
            </div>
        </section>
    </main>
    <script src="script_product_details.js" defer></script>
</body>
</html>
