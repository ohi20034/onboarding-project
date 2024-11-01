<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /onboarding-project/pages/login/login.php");
    exit();
}

require_once('../../models/cart_model.php'); 

try {
    $cartModel = new CartModal();
    $cartItems = $cartModel->fetchCartItems($_SESSION['user_email']);
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_product'])) {
    try {
        $product_id = intval($_POST['product_id']);
        echo $product_id;
        $cartModel->removeFromCart($_SESSION['user_email'], $product_id);
        header("Location: /onboarding-project/pages/cart/cart.php"); 
        exit();
    } catch (Exception $e) {
        echo "An error occurred while removing the item: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style_cart.css">
    <title>Cart</title>
</head>

<body>
    <?php include 'C:\xampp\htdocs\onboarding-project\header.php'; ?>
    <hr>
    <main>
        <section class="cart">
            <div class="shopping-cart">
                <h2>Shopping Cart</h2>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th class="cart-table-img">Image</th>
                            <th class="cart-table-product-name">Product Name</th>
                            <th class="cart-table-categories">Categories</th>
                            <th class="cart-table-quantity">Quantity</th>
                            <th class="cart-table-unitprice">Unit Price</th>
                            <th class="cart-table-total-price">Total</th>
                            <th class="cart-table-remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cartItems)): ?>
                            <?php foreach ($cartItems as $item): ?>
                                <tr data-row-id="row">
                                    <td><img src="/onboarding-project/pages/admin/add_product/photo/<?php echo htmlspecialchars($item['front_image']); ?>" alt="Product Image" width="50" height="50"></td>
                                    <td><?= htmlspecialchars($item['name']); ?></td>
                                    <td><?= htmlspecialchars($item['category']); ?></td>
                                    <td><?= htmlspecialchars($item['quantity']); ?></td>
                                    <td class="cart-table-unitprice"><?= htmlspecialchars(number_format($item['unit_price'], 2)); ?></td>
                                    <td class="total-price" id="total-row"><?= htmlspecialchars(number_format($item['total_price'], 2)); ?></td>
                                    <td>
                                        <form method="POST" action="">
                                             <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']); ?>">
                                            <button type="submit" name="remove_product" class="remove-btn">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7">No items in the cart.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="cart-summary">
                    <p id="total-price">Total: <span><?= htmlspecialchars(number_format(array_sum(array_column($cartItems, 'total_price')), 2)); ?></span></p>
                    <button class="checkout-btn">
                        <a href="/onboarding-project/pages/cart/checkout/checkout.php">Check Out</a>
                    </button>
                </div>
            </div>
        </section>
    </main>
    <script src="../cart/scipt_cart.js" defer></script>
</body>
</html>
