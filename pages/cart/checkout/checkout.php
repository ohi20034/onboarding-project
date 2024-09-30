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
    <header>
        <nav class="container">
            <div class="nav-first-part">
                <a href="/index.html">MyShop</a>
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
                    <a href="/pages/accounts/account.html">Account</a>
                </div>
                <div class="nav-cart-bar">
                    <i class="fa-solid fa-cart-plus"></i>
                    <a href="/pages/cart/cart.html">Cart</a>
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
        <!-- Main content goes here -->
    </main>
    <script src="/pages/cart/checkout/checkout.html" defer></script>
</body>
</html>