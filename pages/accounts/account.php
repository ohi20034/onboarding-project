<?php
session_start(); // Start the session
require_once '../../models/user_model.php';

/* if (!isset($_SESSION['login'])){
    header("Location: /onboarding-project/pages/login/login.php");
    exit();
} */

if (isset($_SESSION['login']) && $_SESSION['login'] === "success") {
    // header("Location: ../../index.php");
    header("Location: /onboarding-project/pages/accounts/user_profile/user_profile.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel = new UserModel();

    $gender = $_POST['gender'] ?? '';
    $firstName = $_POST['first-name'] ?? '';
    $lastName = $_POST['last-name'] ?? '';
    $email = $_POST['email'] ?? '';
    $streetAddress = $_POST['street-address'] ?? '';
    $zipCode = $_POST['zip-code'] ?? '';
    $city = $_POST['city'] ?? '';
    $country = $_POST['country'] ?? '';
    $state = $_POST['state'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['password-confirmation'] ?? '';

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords did not match";
    } else if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please fill in all required fields';
    } else {
        try {
            $userModel->createUser($gender, $firstName, $lastName, $email, $streetAddress, $zipCode, $city, $country, $state, $telephone, $password);
            header('Location: ../login/login.php?registration=success');
            exit;
        } catch (Exception $e) {
            $_SESSION['error'] = 'Registration failed: ' . $e->getMessage();
        }
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style_account.css">
    <title>Account Page</title>
</head>

<body>
    <header>
        <nav class="container">
            <div class="nav-first-part">
                <a href="../../index.php">MyShop</a>
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
                    <a href="/pages/cart/cart.html">Cart</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section id="registration">
            <div class="registration-title">
                <div class="create-account-title">
                    <h1>Create Your MyShop Account</h1>
                </div>
                <div class="login-title">
                    <span>
                        Already Have an Account?
                        <a href="../login/login.php">Login</a>
                        here.
                    </span>
                </div>
            </div>
            <?php if ($error): ?>
                <p style='color: red;'><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form id="registrationForm" method="post" action="" class="registration_form_container" autocomplete="off">
                <div class="first-name">
                    <input type="text" id="first-name" name="first-name" required placeholder="First Name">
                </div>
                <div class="last-name">
                    <input type="text" id="last-name" name="last-name" required placeholder="Last Name">
                </div>
                <div class="email">
                    <input type="email" id="email" name="email" required placeholder="Email">
                </div>
                <div class="gender-type">
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="street-address">
                    <input type="text" id="street-address" name="street-address" required placeholder="Street Address">
                </div>
                <div class="city">
                    <input type="text" id="city" name="city" required placeholder="City">
                </div>
                <div class="apt">
                    <input type="text" id="apt" name="apt" placeholder="APT./FL./Suite No.:">
                </div>
                <div class="country">
                    <input type="text" id="country" name="country" required placeholder="Country">
                </div>
                <div class="zip-code">
                    <input type="text" id="zip-code" name="zip-code" placeholder="Zip Code">
                </div>
                <div class="state">
                    <input type="text" id="state" name="state" required placeholder="State/Province">
                </div>
                <div class="telephone">
                    <input type="text" id="telephone" name="telephone" required placeholder="Telephone Number">
                </div>
                <div class="fax">
                    <input type="text" id="fax" name="fax" placeholder="Fax">
                </div>
                <div class="password">
                    <input type="password" id="password" name="password" required placeholder="Password">
                </div>
                <div class="confirm-password">
                    <input type="password" id="password-confirmation" name="password-confirmation" required placeholder="Confirm Password">
                </div>
                <button type="submit" class="submit-button" id="submitButton">Submit</button>
            </form>
        </section>
    </main>
    <script src="./script_account.js"></script>
</body>

</html>
