<?php
require_once 'C:/xampp/htdocs/onboarding-project/configs/db.php';
require_once '../../models/product_model.php';


if (!isset($_GET['product_id'])) {
    echo "Product ID is missing.";
    exit();
}

$product_id = $_GET['product_id'];

//var_dump($product_id);

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
    <title>Product Details</title>
</head>

<body>
<header>
        <nav class="container">
            <div class="nav-first-part">
                <a href="/onboarding-project/index.php">MyShop</a>
            </div>
            <div class="nav-middle-part">
                <input type="text" id="searchInput" placeholder="Search Product">
                <a href="#" id="searchButton">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>
            <div class="nav-last-part">
                <div class="nav-user-account-bar">
                    <i class="fa-regular fa-user"></i>
                    <a href="/onboarding-project/pages/accounts/account.php">Account</a>
                </div>
                <div class="nav-cart-bar">
                    <i class="fa-solid fa-cart-plus"></i>
                    <a href="/pages/cart/cart.php">Cart</a>
                </div>
            </div>
        </nav>

        <div class="container-menu-bar">
            <ul class="menu-bar">
                <li id="mobile">Mobile</li>
                <li id="laptop">Laptop</li>
                <li id="keyboard">Keyboard</li>
                <li id="mouse">Mouse</li>
                <li id="headphone">Headphone</li>
            </ul>
        </div>
    </header>
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
