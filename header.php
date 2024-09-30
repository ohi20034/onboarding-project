<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        /* Nav bar */
        .container {
            display: flex;
            position: fixed;
            top: 0px;
            font-size: 24px;
            justify-content: space-between;
            align-items: center;
            color: #43655A;
            height: 80px;
            padding: 10px;
            width: 100%;
            overflow: auto;
            z-index: 1000;
        }

        nav a {
            text-decoration: none;
            color: #43655A;
        }

        .nav-first-part,
        .nav-middle-part,
        .nav-last-part {
            margin: 5px 10px 0px 5px;
        }

        .nav-middle-part {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .nav-middle-part input {
            padding-left: 10px;
            background-color: #e4ede6;
            border: none;
            border-radius: 8px 0 0 8px;
            width: 100%;
            outline: none;
            font-size: 20px;
        }

        .nav-middle-part a {
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background-color: #43655A;
            height: 45px;
            width: 60px;
            margin-left: -1px;
            border-radius: 0 8px 8px 0;
        }

        .nav-last-part {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .nav-user-account-bar,
        .nav-cart-bar {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        @media screen and (max-width: 450px) {
            .container {
                font-size: 14px;
            }

            .container-menu-bar li {
                font-size: 15px;
            }

            .nav-middle-part a {
                height: 35px;
            }

            .nav-middle-part input {
                display: none;
            }

            .nav-middle-part a {
                border-radius: 8px 8px;
            }

            #hero {
                padding: 0px 20px !important;
            }
        }

        /* menu bar */
        .container-menu-bar {
            font-size: 20px;
            overflow: auto;
            margin-top: 80px;
        }

        .menu-bar {
            display: flex;
            justify-content: space-evenly;
            list-style: none;
        }

        .menu-bar li {
            padding: 10px;
            cursor: pointer;
        }

        .menu-bar li:hover {
            background-color: #43655A;
            color: white;
        }
    </style>
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
    <script src="C:\xampp\htdocs\onboarding-project\script.js" defer></script>
</body>
</html>
