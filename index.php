<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /onboarding-project/pages/login/login.php");
    exit();
}

require_once './models/product_model.php';

try {
    // Instantiate the product model
    $productModel = new productModel();

    // Fetch all products
    $products = $productModel->fetchProductDetails();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once './models/cart_model.php'; // Include the CartModel

    
    $cartModel = new CartModal();
    $user_email = $_SESSION['user_email']; // Get the logged-in user's email
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    try {
        // Add to cart
        $cartModel->addToCart($user_email, $product_id, $quantity, $unit_price);
        echo "<script>alert('Product added to cart!');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error adding to cart: " . $e->getMessage() . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Home Page</title>
</head>

<body>
    <header>
        <nav class="container">
            <div class="nav-first-part">
                <a href="./index.php">MyShop</a>
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
                    <a href="pages/accounts/account.php">Account</a>
                </div>
                <div class="nav-cart-bar">
                    <i class="fa-solid fa-cart-plus"></i>
                    <a href="/onboarding-project/pages/cart/cart.php">Cart</a>
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
    <hr>
    <main>
        <section class="product-view">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                <a href="/onboarding-project/pages/product_details/product_details.php?product_id=<?php echo htmlspecialchars($product['id']); ?>" class="product-link">
                        <img src="/onboarding-project/pages/admin/add_product/photo/<?= htmlspecialchars($product['front_image']); ?>" alt="Product Image"  width="250" height="250">
                    </a>
                    <h2 class="product-name"><?= htmlspecialchars($product['name']) ?></h2>
                    <p class="product-price"> <span class="price-text">Price: </span><?= htmlspecialchars($product['price']) ?></p>
                    <form action="" method="post">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="unit_price" value="<?= htmlspecialchars($product['price']) ?>">
                        <div class="buttons">
                            <button type="submit" class="buy-now">Buy Now</button>
                            <button type="submit" class="add-to-cart">Add Cart</button>
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </section>
    </main>
    <script src="script.js" defer></script>
</body>

</html>
