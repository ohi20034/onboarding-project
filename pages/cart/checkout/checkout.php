<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: /onboarding-project/pages/login/login.php");
    exit();
}

require_once('C:\xampp\htdocs\onboarding-project\models\cart_model.php');

try {
    $cartModel = new CartModal();
    $cartItems = $cartModel->fetchCartItems($_SESSION['user_email']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style_checkout.css">
    <title>Checkout</title>
</head>
<body>
    <?php include 'C:\xampp\htdocs\onboarding-project\header.php'; ?>
    <hr>
    <main>
        <h1>Checkout</h1>
        
        <form action="process_checkout.php" method="POST" id="checkout-form">
            <h2>Shipping Information</h2>
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_SESSION['user_email']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="address">Shipping Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div class="form-group">
                <label for="zip">ZIP Code:</label>
                <input type="text" id="zip" name="zip" required>
            </div>
            
            <h2>Payment Information</h2>
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" required>
            </div>
            <div class="form-group">
                <label for="expiration_date">Expiration Date:</label>
                <input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            
            <h2>Your Cart</h2>
            <table class="cart-summary-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']); ?></td>
                        <td><?= htmlspecialchars($item['quantity']); ?></td>
                        <td><?= htmlspecialchars(number_format($item['unit_price'], 2)); ?></td>
                        <td><?= htmlspecialchars(number_format($item['total_price'], 2)); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">Total Amount:</td>
                        <td><?= htmlspecialchars(number_format(array_sum(array_column($cartItems, 'total_price')), 2)); ?></td>
                    </tr>
                </tbody>
            </table>
            
            <button type="submit" class="checkout-submit">Place Order</button>
        </form>
    </main>
</body>
</html>
